<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Level;
use App\Models\Matiere;
use Illuminate\Support\Str;
use App\Models\SommaireItem;
use Illuminate\Http\Request;

class CoursController extends Controller
{
    public function index()
    {
        $matieres=Matiere::all();
        $niveaux=Level::all();
        $cours=Cours::join('matieres','cours.matiere_id','=','matieres.id')
        ->join('levels','cours.level_id','=','levels.id')
        ->select('cours.*','matieres.libelle as matiere_libelle','levels.libelle as level_libelle')
         ->get();
        return view("cours.list-cours",compact('matieres','niveaux','cours'));
    }

    public function create(Request $request)
    {
        $validate=$request->validate([
            'libelle'=>'required|min:3|max:255',
            'description'=>'required|min:5|max:255',
            'published'=>'required',
            'matiere_id'=>'required',
            'level_id'=>'required',
        ]);

        if($validate)
        {


            $file=$request->file;
            $extension=$file->getClientOriginalExtension();
            if($extension=='pdf')
            {

                $file_name=time().'.'.$file->getClientOriginalExtension();
                $request->file->move('cours',$file_name);
                $originalName=$file->getClientOriginalName();
                $libelle=$request->libelle;
                $slug=Str::slug($libelle);
                $cours=Cours::create([
                    'libelle'=>$libelle,
                    'nomFichier'=>$file_name,
                    'slug'=>$slug,
                    'description'=>$request->description,
                    'published'=>$request->published,
                    'matiere_id'=>$request->matiere_id,
                    'level_id'=>$request->level_id,
                ]);
                $courId=$cours->id;
                $sommaireLibelles = $request->input('sommaires');
                $sommairePageNums = $request->input('page_num');

                foreach ($sommaireLibelles as $key => $libelleSommaire) {
                    SommaireItem::create([
                        'libelle_sommaire' => $libelleSommaire,
                        'page_num' => $sommairePageNums[$key],
                        'cour_id' => $courId,
                    ]);
                }
                return redirect('/admin/cour')->with('success','Cour ajouté avec success');
            }
            else
            {
                dd('Non valide');
                return redirect('/admin/cour')->with('fail','Extension non prise en compte !');
            }
        }
        return redirect('/admin/cour')->with('fail','Erreur lors de la creation du cour');
    }

    public function store(Request $request)
    {
        //
    }

    public function view($slug,Request $request)
    {
      $cours=Cours::where('slug',$slug)->get();
      $courSommaire=Cours::where('slug',$slug)->first();
       $cour_id=$courSommaire->id;
      $sommaires=SommaireItem::where('cour_id',$cour_id)->get();
      return view('admin.view-cour',compact('cours','sommaires'));
    }

    public function viewCours()
    {
        return view("cours.cours");
    }

    public function show(Cours $cours)
    {
        //
    }

    public function edit($id,Cours $cours)
    {
        $cours=Cours::where('id',$id)->get();
        $matieres=Matiere::all();
        $niveaux=Level::all();
        return view('admin.updateCour',compact('cours','matieres','niveaux'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cours  $cours
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request, Cours $cours)
    {
        $validate=$request->validate([
            'libelle'=>'required|min:3|max:255',
            'slug'=>'required|min:3|max:255',
            'published'=>'required',
            'matiere_id'=>'required',
            'level_id'=>'required'
        ]);
        if($validate){
            $file=$request->file;
            $extension=$file->getClientOriginalExtension();
            if($extension=='pdf')
            {

                $file_name=time().'.'.$file->getClientOriginalExtension();
                $request->file->move('cours',$file_name);

                Cours::where('id',$id)->update([
                    'libelle'=>$request->libelle,
                    'nomFichier'=>$file_name,
                    'slug'=>$request->slug,
                    'published'=>$request->published,
                    'matiere_id'=>$request->matiere_id,
                    'level_id'=>$request->level_id,
                ]);
                return redirect('/admin/cour')->with('success','Cour modifié avec success');
            }
        return redirect('/admin/updateCour')->with('fail','Extension non prise en compte !');
        }
        return redirect('/admin/updateCour')->with('fail','Erreur lors de la mise a jour du cour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cours  $cours
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Cours $cours)
    {
      $affected=Cours::where('id',$id)->delete();
      if($affected)
      {
        return redirect('/admin/cour')->with('success','Cour supprimé avec success');
      }
      return redirect('/admin/cour')->with('fail','Erreur lors de la suppression du cour');
    }
}
