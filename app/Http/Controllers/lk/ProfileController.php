<?php

    namespace App\Http\Controllers\lk;

    use App\Http\Controllers\Controller;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use function redirect;
    use function route;
    use function url;
    use function view;

    class ProfileController extends Controller
    {

        public function deleteAccount(Request $request) {

            User::find(Auth::user()->id)->delete();
            Auth::logout();
            return redirect(route('home'));
        }
    }
