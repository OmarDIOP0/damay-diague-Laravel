<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Helpers\FlashMessageHelper;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request)
    {

        $request->validate([
            'email' => 'email|required '
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status), "success" => FlashMessageHelper::Forgot_Password_Store]) : back()->withErrors(['email' => __($status)]);
    }
}
