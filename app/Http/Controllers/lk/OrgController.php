<?php

    namespace App\Http\Controllers\lk;

    use App\Http\Controllers\Controller;
    use App\Models\Order;
    use App\Models\Organization;
    use Illuminate\Support\Facades\Auth;
    use function view;

    class OrgController extends Controller
    {
        public function show() {
            $orgs = Auth::user()->organizations;

            return view('lk.orgs', ['orgs' => $orgs]);
        }
        public function organization($id) {
            $org = Organization::where('id', $id)->first();
            $prices = $org->prices;

            return view('lk.org', ['org' => $org, 'prices' => $prices]);
        }
    }
