<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\FlashMessageHelper;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {

        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|max:255",
            'email' => "required|email|max:255",
            'password' => "required|min:8|same:confirme_password"
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('login')->with('success', FlashMessageHelper::INSCRIPTION_SUCCESS_STORE);
    }
}
