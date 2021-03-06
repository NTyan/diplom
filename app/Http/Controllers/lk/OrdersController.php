<?php

    namespace App\Http\Controllers\lk;

    use App\Http\Controllers\Controller;
    use App\Mail\OrderCanceled;
    use App\Mail\OrderCompleted;
    use App\Mail\OrderCreate;
    use App\Mail\OrderPaid;
    use App\Mail\OrderTransit;
    use App\Models\Order;
    use App\Models\OrderModel;
    use App\Models\User;
    use Exception;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Support\Facades\Storage;
    use Reliese\Coders\Model\Model;
    use Symfony\Component\HttpFoundation\Request;
    use Illuminate\Support\Facades\Auth;
    use function abort;
    use function array_diff;
    use function array_push;
    use function file_exists;
    use function in_array;
    use function public_path;
    use function readfile;
    use function scandir;
    use function storage_path;
    use function view;

    class OrdersController extends Controller
    {
        public function show(Request $request) {

            $orders = Auth::user()->orders;
            $role = $request->session()->put('role', 'customer');

            return view('lk.orders', ['orders' => $orders]);
        }
        public function order($id, Request $request) {

            $role = $request->session()->get('role');

            $order = Order::where('id', $id)
                ->with('orderModels')
                ->with('organization')
                ->with('user')
                ->first();

            $user = Auth::user();

            $orgs_id = [];

            foreach ($user->organizations as $organization) {
                $orgs_id[] = $organization->id;
            }

                if($user->id === $order->user_id || in_array($order->organization_id, $orgs_id, true)) {

                    $models = $order->orderModels;
                    $org = $order->organization()->withTrashed()->first();

                    if($role === "customer") {
                        $name = $org->name;
                    }
                    elseif($role === "executor") {
                        $name = $order->user->name;
                    }

                    return view('lk.order',
                        [
                        'order' => $order,
                        'models' => $models,
                        'org' => $org,
                        'role' => $role,
                        'name' =>$name,
                        ]);
                }
                else {
                    return abort(404);
                }
        }

        public function changeOrderStatusPaid(Request $request) {
            try {
                $orderId = $request['order_id'];
                $order = Order::find($orderId);
                $order->setIsPaid(true)->setStatusConfirmed()->save();

                foreach ([$request->user(), $order->user] as $recipient) {
                    Mail::to($recipient)->queue(new OrderPaid($order));
                }


            } catch (Exception $exception) {
                return new Exception($exception->getMessage());
            }
            return true;
        }

        public function changeOrderStatusCanceled(Request $request) {
            try {

                $orderId = $request['order_id'];
                $order = Order::find($orderId);
                $order->setStatusCanceled()->save();

                foreach ([$request->user(), $order->organization->user] as $recipient) {
                    Mail::to($recipient)->queue(new OrderCanceled($order));
                }

            } catch (Exception $exception) {
                abort('404', $exception->getMessage());
            }
            return true;
        }

        public function changeOrderStatusTransit(Request $request) {
            try {
                $orderId = $request['order_id'];
                $order = Order::find($orderId);
                $order->setStatusTransit()->save();

                foreach ([$request->user(), $order->user] as $recipient) {
                    Mail::to($recipient)->queue(new OrderTransit($order));
                }

            } catch (Exception $exception) {
                return new Exception($exception->getMessage());
            }
            return true;
        }

        public function changeOrderStatusCompleted(Request $request) {
            try {
                $orderId = $request['order_id'];
                $order = Order::find($orderId);
                $order->setStatusCompleted()->save();

                foreach ([$request->user(), $order->organization->user] as $recipient) {
                    Mail::to($recipient)->queue(new OrderCompleted($order));
                }

            } catch (Exception $exception) {
                return new Exception($exception->getMessage());
            }
            return true;
        }

        public function downloadFile($order_id, $model_id) {

            $model = OrderModel::find($model_id);
            $filePath = storage_path() . '/app/public/files/orders/' . $order_id . '/' . $model_id . '.stl';

            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $model->title . '.stl"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            return readfile($filePath);
        }

    }
