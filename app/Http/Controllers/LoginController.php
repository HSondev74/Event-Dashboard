<?php

namespace App\Http\Controllers;

use App\Models\Organizer;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $message = null;
        if ($request->email || $request->password) {
            $organizer = Organizer::where('email', $request->email)
                ->where('password_hash', $request->password)
                ->first();

            if ($organizer) {
                session('organizer', $organizer);

                return redirect('events/index');
            }
            $message = "Bạn nhập sai tên đăng nhập hoặc mật khẩu !";
        }

        return view('login.index', ['message' => $message]);
    }

    //logout

    public function logout()
    {
        session('organizer', null);

        return redirect('login');
    }
}
