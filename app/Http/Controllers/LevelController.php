<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;
use Carbon\Carbon;


class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $niveaux=Level::paginate(10);
        return view('admin.niveau',compact('niveaux'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validate=$request->validate([
            'libelle'=>'required|min:3|max:255|unique:levels'
        ]);
        if($validate){
           $createLevel=Level::create([
            'libelle'=>$request->libelle
            ]);

        return redirect('/admin/niveau')->with('success','Niveau creer avec succes');
        }
        else{
            return back()->with('fail','Erreur lors de la creation du niveau');
        }


    }

    public function store(Request $request)
    {
        //
    }

    public function show(Level $level)
    {
    }

    public function edit($id,Level $level)
    {
        $niveau=Level::where('id','=',$id)->get();
        return view('admin.updateNiveau',compact('niveau'));
    }

    public function update(Request $request,Level $level,$id)
    {
        $validate=$request->validate([
            'libelle'=>'required|min:3'
        ]);
        if($validate){
          Level::where('id',$id)->update([
            'libelle'=>$request->libelle,
        ]);
        return redirect('/admin/niveau')->with('success','Niveau mis a jour avec succes');
        }
        return redirect('/admin/niveau')->with('fail','Erreur lors de la mise a jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Level $level)
    {
       $affected=Level::where('id',$id)->delete();
       if($affected){
        return redirect('/admin/niveau')->with('success','Suppression avec succes');
        }
        else{
            return back()->with('fail','Erreur lors de la suppression du niveau');
        }


    }
 }
