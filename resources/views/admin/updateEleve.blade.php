@extends('layout.sidebar')
@section('titre', 'Modifier Eleve');
@section('contenu')
    @if (Session::has('fail'))
        <div class="ui red visible message">
            {{ Session::get('fail') }}
        </div>
    @endif
    @foreach ($users as $user)
        <form class="ui form" action="/admin/updateEleve/{{ $user->id }}" method="post">
            @csrf
                <div class="content">
        <div class="ui form">
            <div class="ui segment">
            <div class="field">
                <label>Name</label>
                <input type="text" name="name" placeholder="Saisir le prenom et nom" value="{{$user->name}}">
                <div class="ui red">
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="field">
                <label>Email</label>
                <input type="email" name="email" placeholder="Saisir l email" value="{{$user->email}}">
                <div class="ui red">
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        </div>
    </div>
            <button class="ui basic positive button" type="submit" style="margin-top:20px;margin-left:50%">Modifier</button>
    @endforeach
    </form>
@endsection
