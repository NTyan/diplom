<?php

    namespace App\Http\Controllers\lk;

    use App\Http\Controllers\Controller;

    use App\Models\Order;
    use App\Models\OrderModel;
    use App\Models\Organization;
    use App\Models\Price;
    use Exception;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Redirect;
    use function abort;
    use function array_diff;
    use function back;
    use function filter_var;
    use function getimagesize;
    use function in_array;
    use function is_dir;
    use function json_decode;
    use function parse_str;
    use function public_path;
    use function rmdir;
    use function route;
    use function scandir;
    use function storage_path;
    use function time;
    use function unlink;
    use function url;
    use function view;
    use const FILTER_VALIDATE_EMAIL;

    class OrgController extends Controller
    {
        public function show(Request $request) {
            $orgs = Auth::user()->organizations()->with('prices')->get();
            $path = []; $prices = [];

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
                    $prices[$org->id][] = $price->price;
                }
            }

            $request->session()->put('role', 'executor');
            return view('lk.orgs', ['orgs' => $orgs, 'path' => $path, 'prices' => $prices]);
        }

        public function organization($id) {
            $org = Organization::find($id);
            $prices = $org->prices;

            try{
                $name = scandir(public_path() . "/files/orgs/" . $id)[2] ?? 'default.jpg';
            } catch (Exception $exception) {
                $name = 'default.jpg';
            }

            if($name === 'default.jpg') {
                $path = "/files/orgs/" . $name;
            }
            else {
                $path = "/files/orgs/" . $id . "/" . $name;
            }

            return view('lk.org', ['org' => $org, 'prices' => $prices, 'imgPath' => $path, 'plastic' => OrderModel::PLASTIC]);
        }

        public function editInfo(Request $request) {

            $file = $request->file('file');

            if($file !== null) {
                if($file->getMimeType() !== 'image/jpeg' && $file->getMimeType() !== 'image/png') {
                    return abort(500, 'Тип изображения не поддерживается');
                }
                if(getimagesize($file)[0] > 600 || getimagesize($file)[1] > 400) {
                    return abort(500, 'Размеры не должны превышать 600х400');
                }

                $dir = public_path() . '/files/orgs/' . $request['id'];

                if (file_exists($dir)) {
                    $files = array_diff(scandir($dir), ['.','..']);
                    foreach ($files as $xfile) {
                        (is_dir($dir.'/'.$xfile)) ? delDir($dir.'/'.$xfile) : unlink($dir.'/'.$xfile);
                    }
                    rmdir($dir);
                }

                $file->move($dir  . '/', time());
            }

            if (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
                return abort(500, 'Email некорректен');
            }

            Organization::where('id', $request['id'])
                ->update([
                    'name' => $request['name'],
                    'phone_number' => $request['phone'],
                    'email' => $request['email'],
                    'jur_address' => $request['address'],
                    'inn' => $request['inn'],
                    'kpp' => $request['kpp'],
                    'ogrn' => $request['ogrn'],
                    'payment_account' => $request['payment'],
                    'description' => $request['description'],
                ]);

            return true;
        }

        public function addNewOrg(Request $request) {

            $file = $request->file('file');

            if($file !== null) {

                if($file->getMimeType() !== 'image/jpeg' && $file->getMimeType() !== 'image/png') {
                    return abort(500, 'Тип изображения не поддерживается');
                }
                if(getimagesize($file)[0] > 600 || getimagesize($file)[1] > 400) {
                    return abort(500, 'Размеры не должны превышать 600х400');
                }

            }

            if (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
                return abort(500, 'Email некорректен');
            }

            $org = new Organization();
            $org->setName($request['name'])
                ->setUserId(Auth::user()->id)
                ->setDescription($request['description'])
                ->setEmail($request['email'])
                ->setInn($request['inn'])
                ->setJurAddress($request['address'])
                ->setKpp($request['kpp'])
                ->setOgrn($request['ogrn'])
                ->setPaymentAccount($request['payment'])
                ->setPhoneNumber($request['phone'])
                ->setType($request['type'])
                ->save();


            $file?->move(public_path() . '/files/orgs/' . $org->id . '/', time());

            $request->session()->put('org_id', $org->id);
            return true;
        }

        public function addNewPrice(Request $request) {

            $prices = json_decode($request['prices']);
            $org_id =  $request->session()->get('org_id');

            foreach($prices as $plastic => $price) {
                $newPrice = new Price();
                $newPrice->plastic = $plastic;
                $newPrice->price = $price;
                $newPrice->organization_id = $org_id;

                $newPrice->save();

            }
            return $org_id;
        }

        public function deleteOrganization($orgId) {
            Organization::find( $orgId )->delete();
            return \redirect(route('orgs'));
        }

        public function showOrders($orgId, Request $request) {

            $org = Organization::find($orgId);
            $orgs = Auth::user()->organizations()->get();
            $orgs_id = [];

            foreach ($orgs as $organization) {
                $orgs_id[] = $organization->id;
            }

            if(in_array(+$orgId, $orgs_id, true)) {
                $orders = Order::where('organization_id', $orgId)->get();

                $request->session()->put('role', 'executor');
                return view('lk.orders', ['orders' => $orders, 'org' => $org, 'role' => 'executor']);
            }
            else {
                return abort(404);
            }
        }

        public function editPrice(Request $request) {

            $prices = json_decode($request['prices']);
            $org_id = $request['org_id'];

            Price::where('organization_id', $org_id)
                ->delete();

            foreach($prices as $plastic => $price) {
                $newPrice = new Price();
                $newPrice->plastic = $plastic;
                $newPrice->price = $price;
                $newPrice->organization_id = $org_id;

                $newPrice->save();

            }
            return true;
        }
    }
