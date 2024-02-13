@extends('layout.app')
@section('content')
<div class="ui middle aligned center aligned grid container mt-4  ">
    <div class="column ">
        <h2 class="ui  image header" id="title">
            <div class=" headerInscription content  ">
                Inscription
            </div>
        </h2>
        @if(Session::has('success'))
        <div class="ui green message">
            {{Session::get('success')}}
        </div>

        @endif
        @if(Session::has('success'))
        <div class="ui red message">
            {{Session::get('success')}}
        </div>

        @endif
        <form class="ui large form ui top" action="{{route('register')}}" method="post">

            @csrf
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="name" placeholder="entrez votre nom" value="{{old('name')}}">
                    </div>
                    <div class="containerErr">
                        @error('name')

                        <span class=" error">{{$message}}</span>

                        @enderror
                    </div>

                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="email" name="email" placeholder="entrez votre  email" value="{{old('email')}}">
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
                        <input type="password" name="password" placeholder="entrez votre mot de passe">
                    </div>
                </div>

                <div class="containerErr">
                    @error('password')

                    <span class=" error">{{$message}}</span>

                    @enderror
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="confirme_password" placeholder="confirmez votre mot de passe">
                    </div>
                </div>

                <button id="buttonColorinscription" class="  ui fluid large   submit button">S'inscrire</button>
            </div>
        </form>

        <div class="ui message">
            vous avez deja un compte? <a href="#">se connecter</a>
        </div>
    </div>
</div>

@endsection