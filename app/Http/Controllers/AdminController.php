<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Cours;
use App\Models\Level;
use App\Models\Matiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $loading=true;
        $users = User::orderBy('created_at','desc')
        ->limit(10)
        ->get();
        $matiere=Matiere::count();
        $cour=Cours::count();
        $user=User::count();
        $loading=false;
        return view('admin.dashboard',compact('users','matiere','cour','user','loading'));
    }

    public function cours(Request $request,Matiere $matiereCours)
    {
        $filter_matiere=$request->input('filter_matiere');
        $cours_filter=Cours::where('matiere_id',$filter_matiere)->get();
        $matieres=Matiere::all();
        $niveaux=Level::all();
        $cours=Cours::join('matieres','cours.matiere_id','=','matieres.id')
        ->join('levels','cours.level_id','=','levels.id')
        ->select('cours.*','matieres.libelle as matiere_libelle','levels.libelle as level_libelle')
         ->get();
        return view('admin.cour',compact('matieres','niveaux','cours','cours_filter'));
    }
    public function eleve()
    {
        $users = User::paginate(10);
        return view('admin.eleve',compact('users'));
    }

    public function createEleve(Request $request)
    {
        $validate=$request->validate([
            'name'=>'required |min:3',
            'email'=>'required|email',
            'password'=>'required|min:5'
        ]);
        if($validate)
        {
            User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$request->password
            ]);
        return redirect('/admin/eleve')->with('success','Eleve ajouté avec succes');
        }
        else{
            return back()->with('fail','Erreur lors de l ajout de l eleve');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id,User $user)
    {
        $users=User::where('id',$id)->get();
        return view('admin.updateEleve',compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateEleve(Request $request, User $user,$id)
    {
       $update=User::where('id',$id)->update([
        'name'=>$request->name,
        'email'=>$request->email
       ]);
       return redirect('/admin/eleve')->with('success','Eleve mis a jour avec success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyEleve($id,User $eleve)
    {
        $affected=User::where('id',$id)->delete();
        if($affected){
            return redirect('/admin/eleve')->with('success','Suppression avec succes');
        }
        else{
            return back()->with('fail','Erreur lors de la suppression de l eleve');
        }

    }

    public function profile()
    {
        $id=session('id');
        $infoAdmin=Admin::where('id','=',$id)->get();
        return view('admin.profile',compact('infoAdmin'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $session=$request->session()->regenerateToken();
        return redirect('/admin/login');
    }
}
