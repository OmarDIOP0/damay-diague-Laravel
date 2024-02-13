@extends('layout.sidebar')
@section('titre', 'Modifier Cour');
@section('contenu')
    @if (Session::has('fail'))
        <div class="ui red visible message">
            {{ Session::get('fail') }}
        </div>
    @endif
    @foreach ($cours as $cour)
        <form class="ui form" action="/admin/updateCour/{{ $cour->id }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="content">
        <div class="ui form">
            <div class="ui segment">
            <div class="field">
                <label>Libelle</label>
                <input type="text" name="libelle" value="{{$cour->libelle}}">
                <div class="ui red">
                    @error('libelle')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="field">
                <input type="file" name="file" value="{{$cour->nomFichier}}">
                @if ($cour->nomFichier)
                    <a href="{{asset($cour->nomFichier)}}">{{$cour->nomFichier}}</a>
                @endif
                <div class="ui red">
                    @error('nomFichier')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="field">
                <label>Description</label>
                {{-- <textarea name="slug" cols="30" rows="3" aria-valuemax="{{$cour->slug}}"></textarea> --}}
                <input type="text"  name="slug" value="{{$cour->slug}}" style="height:70px;">
                <div class="ui red">
                    @error('slug')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="field">
                  <label for="publie">Publié</label>
                  <div class="ui radio checkbox">
                    <input type="radio" name="published" value="vrai" {{$cour->published === 'vrai' ? 'checked' : ''}}>
                    <label for="vrai">Vrai</label>
                </div>
            </div>
            <div class="field">
                <div class="ui radio checkbox">
                    <input type="radio" name="published" value="faux" {{$cour->published === 'faux' ? 'checked' : ''}}>
                    <label for="vrai">Faux</label>
                </div>
            </div>
            <div class="field">
                <label for="matiere">Matiere</label>
                <select class="ui dropdown" name="matiere_id">
                    @foreach ($matieres as $matiere)
                    <option value="{{$matiere->id}}" {{$matiere->id ==$cour->matiere_id ? 'selected' : '' }}>{{$matiere->libelle}}</option>
                    @endforeach
                </select>
            </div>
            <div class="field" style="margin-bottom: 20px;">
                <label for="level">Niveau</label>
                <select class="ui dropdown" name="level_id">
                    @foreach ($niveaux as $niveau)
                      <option value="{{$niveau->id}}" {{$niveau->id === $cour->level_id ? 'selected' : '' }}>{{$niveau->libelle}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        </div>
    </div>
            <button class="ui basic positive button" type="submit" style="margin-top:20px;margin-left:50%">Modifier</button>
    @endforeach
    </form>
@endsection
