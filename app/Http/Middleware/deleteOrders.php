<?php

    namespace App\Http\Middleware;

    use App\Models\Order;
    use App\Models\OrderModel;
    use Closure;
    use Exception;
    use function array_diff;
    use function is_dir;
    use function rmdir;
    use function scandir;
    use function storage_path;
    use function unlink;


    class deleteOrders
    {

        public function handle($request, Closure $next)
        {
            $emptyOrders = Order::where('organization_id', null)->get();

            foreach ($emptyOrders as $order) {

                $dirPath = storage_path() . '/app/public/files/orders/' . $order->id;
                $this->deleteFiles($dirPath);
                OrderModel::where('order_id', $order->id)->delete();
                $order->forceDelete();
            }
            return $next($request);
        }

        private function deleteFiles($dirPath)
        {
            try {
                $files = array_diff(scandir($dirPath), ['.','..']);
                foreach ($files as $file) {
                    (is_dir($dirPath.'/'.$file)) ? $this->deleteFiles($dirPath.'/'.$file) : unlink($dirPath.'/'.$file);
                }
                rmdir($dirPath);
            } catch (Exception $exception) {

            }
        }
    }
