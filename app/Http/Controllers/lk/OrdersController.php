<?php

    namespace App\Http\Controllers\lk;

    use App\Http\Controllers\Controller;
    use App\Models\Order;
    use Illuminate\Support\Facades\Auth;
    use function view;

    class OrdersController extends Controller
    {
        public function show() {
            $orders = Auth::user()->orders;

            return view('lk.orders', ['orders' => $orders]);
        }
        public function order($id) {
            $order = Order::where('id', $id)->first();
            $models = $order->orderModels;
            $org = $order->organization()->first();
            return view('lk.order', ['order' => $order, 'models' => $models, 'org' => $org]);
        }
    }
