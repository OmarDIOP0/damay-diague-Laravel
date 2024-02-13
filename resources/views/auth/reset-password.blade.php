@extends('layout.app')
@section('content')

<div class="ui middle aligned center aligned grid container mt-4  ">

    <div class="column ">
        <h2 class="titre header " id="titre" style="margin:auto">Réinitialisation du mot de passe</h2>
        @if(Session::has('success'))
        <div class="ui red message large">
            {{Session::get('success')}}
        </div>

        @endif

        @if(Session::has('fail'))
        <div class="ui red message large">
            {{Session::get('fail')}}
        </div>

        @endif


        <form class="ui large form ui top" action="{{route('password.update')}}" method="post">


            @csrf
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">

                        <input id="token" type="hidden" name="token" value="{{$token}}" />
                    </div>
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="email" name="email" placeholder="entrez votre email" value="{{old('email')}}">
                    </div>
                    <div class="containerErr">
                        @error('email')

                        <span class=" error">{{$message}}</span>

                        @enderror
                    </div>
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="password" name="password" placeholder="entrez votre nouveau  mot de passe">
                    </div>
                    <div class="containerErr">
                        @error('password')

                        <span class=" error">{{$message}}</span>

                        @enderror
                    </div>

                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="password" name="password_confirmation" placeholder="confirmez  votre mot de passe">
                    </div>
                    @error('password_confirmation')

                    <span class=" error">{{$message}}</span>

                    @enderror

                </div>
            </div>
            <button class="ui fluid large orange submit button" id="buttonColorinscription">Réinitialiser</button>
        </form>
    </div>

    @endsection