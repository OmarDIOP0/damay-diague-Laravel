@extends('layout.app')
@section('content')
<div class="ui middle aligned center aligned grid container mt-4  ">
    <div class="column ">
        <h2 class="ui  image header" id="titre">
            <div class="content titre ">
                Se Connecter
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



        <form class="ui large form ui top" action="{{route('login')}}" method="post">
            @csrf
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="email" name="email" placeholder="entrez votre  email" value="{{old('email')}}">
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password" placeholder="entrez votre mot de passe">
                    </div>
                </div>

                <button class="ui fluid large orange submit button" id="buttonColorinscription">Se connecter</button>
                <div class="ui message">
                    <a href="{{route('password.request')}}">mot de passe oublié ? </a>
                </div>
        </form>

        @endsection