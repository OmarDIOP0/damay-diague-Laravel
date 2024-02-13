<?php

namespace App\Http\Controllers;

use App\Models\Matiere;
use Illuminate\Http\Request;

class MatiereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matieres=Matiere::paginate(10);
        return view('admin.matiere',compact('matieres'));
    }

    public function create(Request $request)
    {
        $validate=$request->validate([
            'libelle'=>'required|min:3|max:255'
        ]);
        if($validate)
        {
            Matiere::create([
                'libelle'=>$request->libelle
            ]);
            return redirect('/admin/matiere')->with('success','Matiere enrégistré avec success');
        }
        else{
            return back()->with('fail','Erreur lors de creation de la matiere');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Matiere  $matiere
     * @return \Illuminate\Http\Response
     */
    public function show(Matiere $matiere)
    {
        //
    }

    public function edit(Matiere $matiere,$id)
    {
        $matieres=Matiere::where('id',$id)->get();
        return view('admin.updateMatiere',compact('matieres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Matiere  $matiere
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Matiere $matiere,$id)
    {
       $update=Matiere::where('id',$id)->update([
        'libelle'=>$request->libelle
       ]);
       return redirect('/admin/matiere')->with('success','Matiere mis a jour avec success');
    }

    public function destroy(Matiere $matiere,$id)
    {
      $affected=Matiere::where('id',$id)->delete();

      if($affected){
        return redirect('/admin/matiere')->with('success','Matiere supprimé avec success');
      }
      else{
        return redirect('/admin/matiere')->with('fail','Erreur de la suppression de la matiere');
      }

    }
}
