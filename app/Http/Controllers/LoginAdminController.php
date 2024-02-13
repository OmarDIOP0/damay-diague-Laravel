<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginAdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function store(Request $request)
    {

        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        $admin = Admin::where('email', '=', $request->email)->first();

        if ($admin)
        {
            if (Hash::check($request->password, $admin->password))
             {

                   session([
                           'id'=>$admin['id'],
                           'name'=>$admin['name']
                   ]);
                   return redirect('/admin/dashboard')->with('success','Bienvenue!');

            } else {
                return back()->with('fail', 'votre mot de passe est incorrect');
            }
        } else {
            return back()->with('fail', 'votre email  est  incorrect');
        }
    }
}
