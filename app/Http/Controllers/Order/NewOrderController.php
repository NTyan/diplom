<?php

    namespace App\Http\Controllers\Order;

    use App\Models\Order;
    use App\Models\OrderModel;
    use App\Models\Organization;
    use App\Models\Price;
    use Exception;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use Symfony\Component\HttpFoundation\Response;
    use function abort;
    use function array_unique;
    use function count;
    use function dd;
    use function mt_rand;
    use function public_path;
    use function redirect;
    use function response;
    use function route;
    use function scandir;
    use function sprintf;
    use function storage_path;
    use function url;
    use function view;

    class NewOrderController
    {
        public function showPage() {

            return view('order.newOrder', ['plastic' => OrderModel::PLASTIC]);
        }

        public function createNewOrder(Request $request) {

            try {
                $files = $request->file('file');

                $order = new Order();
                $order->setUserId(Auth::user()->id)
                    ->setNumber(sprintf('%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535)))
                    ->setDateOfReceiving($request->input('date'))
                    ->setComment($request->input('comment'))
                    ->save();

                for($i = 0; $i < count($files); $i++) {

                    $model= new OrderModel();
                    $model->setOrderId($order->id)
                        ->setTitle($request->input('title')[$i])
                        ->setColor($request->input('color')[$i])
                        ->setCount($request->input('count')[$i])
                        ->setHeight($request->input('height')[$i])
                        ->setLength($request->input('length')[$i])
                        ->setPlastic($request->input('plastic')[$i])
                        ->setVolume($request->input('volume')[$i])
                        ->setWeight($request->input('weight')[$i])
                        ->setWidth($request->input('width')[$i])
                        ->setFilling($request->input('filling')[$i])
                        ->setArea($request->input('area')[$i])
                        ->save();

                    $files[$i]->move(storage_path() . '/app/public/files/orders/' . $order->id, $model->id . '.stl');

                }
            } catch (Exception $exception) {

                return new Exception($exception->getMessage());
            }


            $request->session()->put('order_id', $order->id);

            return response('success', 200);

        }

        public function addExecutorToNewOrder(Request $request) :string {

            $orgs = []; $path = []; $xprices = [];

            if ($request->session()->has('order_id'))
                $order_id = $request->session()->get('order_id');
            else {
                return abort(404);
            }

            $models = OrderModel::select('plastic')
                ->where('order_id', $order_id)
                ->distinct()
                ->get();

            $prices = Price::select('organization_id')
                ->whereIn('plastic', $models)
                ->with('organization')
                ->distinct()
                ->groupBy('organization_id')
                ->having(DB::raw('count(plastic)'), '=', count($models))
                ->get();

            foreach ($prices as $price) {
                $orgs[] = $price->organization;
            }

            foreach ($orgs as $org) {

                try{
                    $name = scandir(public_path() . "/files/orgs/" . $org->id)[2] ?? 'default.jpg';
                } catch (Exception $exception) {
                    $name = 'default.jpg';
                }

                if($name === 'default.jpg') {
                    $path[$org->id] = "/files/orgs/" . $name;
                }
                else {
                    $path[$org->id] = "/files/orgs/" . $org->id . "/" . $name;
                }
                foreach ($org->prices as $price) {
                    $xprices[$org->id][] = $price->price;
                }
            }

            return view('order.executors', ['orgs' => $orgs, 'path' => $path, 'prices' => $xprices]);
        }

        /**
         * @param $executor_id
         * @param Request $request
         * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
         */
        public function selectedExecutor($executor_id, Request $request) {
            $plastic = []; $sum = 0;
            $org = Organization::find($executor_id);

            if ($request->session()->has('order_id'))
                $order_id = $request->session()->get('order_id');

            $order = Order::find($order_id);
            $order->organization_id = $executor_id;
            $order->status = 'processing';

            foreach ($org->prices as $price) {
                $plastic[$price->plastic] = $price->price;
            }

            $models = $order->orderModels()->get();

            foreach ($models as $model) {
                foreach ($plastic as $pl => $price) {
                    if($model->plastic === $pl) {
                        $model->price = ceil($model->weight * $price * $model->count);
                        $model->save();
                        $sum += $model->price;
                    }
                }
            }

            $order->sum = $sum;
            $order->save();

            $request->session()->put('role', 'customer');

            return redirect(url('/orders/' . $order->id));
        }
    }
