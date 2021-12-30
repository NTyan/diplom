<?php

    namespace App\Http\Controllers\lk;

    use App\Http\Controllers\Controller;
    use App\Models\Order;
    use App\Models\User;
    use Exception;
    use Symfony\Component\HttpFoundation\Request;
    use Illuminate\Support\Facades\Auth;
    use function in_array;
    use function view;

    class OrdersController extends Controller
    {
        public function show() {
            $orders = Auth::user()->orders;

            return view('lk.orders', ['orders' => $orders]);
        }
        public function order($id) {

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

                    if($user->id === $order->user_id) {
                        $name = $org->name;
                        $role = "customer";
                    }
                    else {
                        $name = $user->name;
                        $role = "executor";
                    }

                    return view('lk.order',
                        [
                        'order' => $order,
                        'models' => $models,
                        'org' => $org,
                        'role' => $role,
                        'name' =>$name
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
    }
