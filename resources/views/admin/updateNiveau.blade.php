@extends('layout.sidebar')
@section('titre','Modifier le Niveau');
@section('contenu')
@if(Session::has('fail'))
            <div class="ui red visible message">
                    {{Session::get('fail')}}
            </div>
        @endif
@foreach ($niveau as $niveaux)
<form class="ui form" action="/admin/updateNiveau/{{$niveaux->id}}" method="post">
    @csrf
    <div class="field">
      <label>Libelle</label>
      <input type="text" name="libelle" placeholder="Saisir le libelle"value="{{$niveaux->libelle}}">
    </div>
    <div class=" containerErr">
        @error('libelle')
        <span class=" error">{{$message}}</span>
        @enderror
    </div>
    <button class="ui basic positive button" type="submit">Modifier</button>
    @endforeach
  </form>


@endsection
