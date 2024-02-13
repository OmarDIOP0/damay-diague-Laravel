@extends('layout.app')
@section('content')
<div class="ui middle aligned center aligned grid container">
    <div class="column">
        <h2 class="ui  image header" id="titre">
            <div class="ui segment">
                <img class="ui centered small image"
                src="/images/student.png">
            </div>
        </h2>
        @if(Session::has('success'))
            <div class="ui green visible message">
                    {{Session::get('success')}}
            </div>
        @endif

        @if(Session::has('fail'))
            <div class="ui red visible message">
                    {{Session::get('fail')}}
            </div>
        @endif
        <form class="ui large form ui top" action="/admin/login" method="post">
           @csrf
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="email" name="email" placeholder="entrer votre  email" value="{{old('email')}}">
                    </div>
                </div>
                 <div class=" containerErr">
                    @error('email')
                    <span class=" error">{{$message}}</span>
                    @enderror
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password" placeholder="entrer votre mot de passe">
                    </div>
                </div>

                 <div class="containerErr">
                    @error('password')

                    <span class=" error">{{$message}}</span>

                    @enderror
                </div>
                <button class="ui fluid large orange submit button" id="buttonColorinscription">Se connecter</button>
            </div>
        </form>
    </div>
</div>
        @endsection
