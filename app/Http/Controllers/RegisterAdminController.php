<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterAdminController extends Controller
{
    public function index()
    {
        return view('admin.register');
    }

    public function store(Request $request)
    {
        $validation=$request->validate([
            "name" => 'required|min:5|max:255',
            "email" => 'required|email|min:5|max:255|unique:admins',
            "password" => 'required|same:confirme_password|min:5|max:255',
        ]);

        if($validation){
          $admin=Admin::create([
          'name'=> $request->name,
          'email'=>$request->email,
          'password'=>Hash::make($request->password),
        ]);
        return redirect('/admin/login')->with('success','Inscription reussie');
        }
        else{
            //return back()->with('fail', "erreur lors de l'inscription");
        }

    }
}
