<?php

namespace App\Http\Controllers;

use App\Helpers\FlashMessageHelper;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "email" => "email|required",
            "password" => "required"
        ]);


        if (!auth()->attempt($request->only('email', 'password'))) {
            return back()->with('fail', FlashMessageHelper::LOGIN_FAIL_STORE);
        }

        if (auth()->user()->role) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('dashboard');
        }
    }
}
