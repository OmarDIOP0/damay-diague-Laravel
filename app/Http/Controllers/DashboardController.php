<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\FlashMessageHelper;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('dashboard', compact('user'));
    }

    public function show($id)
    {
        $user = User::where('id', $id)->first();
        return view('auth.UpdateUser', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => "required|max:255",
            'email' => "required|email|max:255",
            'password' => "required|same:confirme_password"
        ]);
        User::where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect()->route('dashboard')->with('success', FlashMessageHelper::UPDATE_SUCCESS_STORE);
    }
}
