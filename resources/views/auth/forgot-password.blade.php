@extends('layout.app')
@section('content')
<div style="width:400px ; margin:auto ">
    <div class="column ">
        <h2 class="ui  image header" id="titre">
            <div style="margin-left:  20px; ">
                Réinitialisation mot de passe
            </div>
        </h2>
        @if(Session::has('success'))
        <div class="ui green message large">
            {{Session::get('success')}}
        </div>

        @endif

        @if(Session::has('fail'))
        <div class="ui red message large">
            {{Session::get('fail')}}
        </div>

        @endif




        <form class="ui large form ui top" action="{{route('password.email')}}" method="post">

            @csrf
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="email" name="email" placeholder="entrer votre email" value="{{old('email')}}">
                    </div>
                    <div class="containerErr">
                        @error('email')

                        <span class=" error">{{$message}}</span>

                        @enderror
                    </div>

                </div>

            </div>
            <button class="ui fluid large orange submit button" id="buttonColorinscription">Envoyer</button>

        </form>

        @endsection