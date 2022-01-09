<?php

    namespace App\Http\Controllers\lk;

    use App\Http\Controllers\Controller;
    use App\Models\Order;
    use App\Models\OrderModel;
    use App\Models\User;
    use Exception;
    use Illuminate\Support\Facades\Storage;
    use Reliese\Coders\Model\Model;
    use Symfony\Component\HttpFoundation\Request;
    use Illuminate\Support\Facades\Auth;
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
        public function show() {

            $orders = Auth::user()->orders;

            return view('lk.orders', ['orders' => $orders, 'role' => 'customer']);
        }
        public function order($id, $role) {

            $order = Order::where('id', $id)
                ->with('orderModels')
                ->with('organization')
                ->first();

            $user = Auth::user();

            $orgs_id = [];

            foreach ($user->organizations as $organization) {
                $orgs_id[] = $organization->id;
            }

                if($user->id === $order->user_id || in_array($order->organization_id, $orgs_id, true)) {

                    $models = $order->orderModels;
                    $org = $order->organization;

                    if($role === "customer") {
                        $name = $org->name;
                    }
                    elseif($role === "executor") {
                        $name = $user->name;
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
                $order = Order::find($orderId)->setIsPaid(true)->setStatusConfirmed();

                $order->save();

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
