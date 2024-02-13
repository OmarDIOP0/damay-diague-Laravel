<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\SommaireItem;
use Illuminate\Http\Request;

class SommaireItemController extends Controller
{
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cours=Cours::all();
        $sommaires=SommaireItem::all();
        return view('admin.sommaire',compact('cours','sommaires'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validate=$request->validate([
            'libelle'=>'required|min:3',
            'page_num'=>'required|numeric'
        ]);
        if($validate){
            SommaireItem::create([
                'libelle'=>$request->libelle,
                'page_num'=>$request->page_num,
                'cour_id'=>$request->cour_id
            ]);
             return redirect('/admin/sommaire')->with('success','Sommaire creer avec succes');
            }
        else{
                return redirect('/admin/sommaire')->with('fail','Erreur lors de la creation du sommaire');
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
     * @param  \App\Models\SommaireItem  $sommaireItem
     * @return \Illuminate\Http\Response
     */
    public function show(SommaireItem $sommaireItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SommaireItem  $sommaireItem
     * @return \Illuminate\Http\Response
     */
    public function edit(SommaireItem $sommaireItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SommaireItem  $sommaireItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SommaireItem $sommaireItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SommaireItem  $sommaireItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(SommaireItem $sommaireItem)
    {
        //
    }
}
