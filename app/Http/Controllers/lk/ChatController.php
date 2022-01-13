<?php

    namespace App\Http\Controllers\lk;

    use App\Http\Controllers\Controller;
    use App\Models\Message;
    use App\Models\Order;
    use App\Models\Organization;
    use Exception;
    use Symfony\Component\HttpFoundation\Request;
    use function public_path;
    use function scandir;

    class ChatController extends Controller
    {
        public function getMessages(Request $request) {

            $order_id = $request->request->get('order_id');

            $messages = Message::where('order_id', $order_id)->get()->sortby('created_at');

            $order = Order::find($order_id);
            $org_id = $order->organization_id;
            $user_id = $order->user_id;

            try{
                $name = scandir(public_path() . "/files/orgs/" . $org_id)[2] ?? 'default.jpg';
            } catch (Exception $exception) {
                $name = 'default.jpg';
            }

            if($name === 'default.jpg') {
                $path = "/files/orgs/" . $name;
            }
            else {
                $path = "/files/orgs/" . $org_id . "/" . $name;
            }

            return [
                'messages' => $messages,
                 'org_id' => $org_id,
                 'user_id' => $user_id,
                'imgPath' => $path
            ];
        }

        public function sendMessage(Request $request) {

            $order_id = $request->request->get('order_id');
            $role = $request->request->get('role');
            $message = $request->request->get('message');

            $order = Order::find($order_id);

            if($role === 'customer') {
                $sender = $order->user_id;
            }
            else {
                $sender = $order->organization_id;
            }

            $new_message = new Message();
            $new_message->setOrderId(+$order_id)
                ->setSenderId(+$sender)
                ->setMessage($message)
                ->save();
        }
    }
