<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
            "name" => 'required|min:5|max:255',
            "email" => 'required|email|min:5|max:255',
            "password" => 'required|same:confirme_password|min:5|max:255',
        ]);

        $utilisateur = new User();
        $utilisateur->name = $request->name;
        $utilisateur->email = $request->email;
        $utilisateur->password = Hash::make($request->password);
        $resultat = $utilisateur->save();
        if ($resultat) {
            return back()->with('success', 'inscription reussie');
        } else {
            return back()->with('fail', "erreur lors de l'inscription");
        }
    }
}
