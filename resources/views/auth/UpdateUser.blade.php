@extends('layout.app')
@section('content')
<div class="ui middle aligned center aligned grid container mt-4  ">
    <div class="column ">
        <h2 class="ui  image header" id="title">

            <div class=" headerInscription content  ">
                Modifer Utilisateur
            </div>
        </h2>
        @if(Session::has('success'))
        <div class="ui green message">
            {{Session::get('success')}}
        </div>

        @endif

        <form class="ui large form ui top" action="/modifier/{{$user->id}}" method="post">

            @csrf
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="name" placeholder="entrer votre nom" value="{{$user->name}}">
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
                        <input type="email" name="email" placeholder="entrer votre  email" value="{{$user->email}}">
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
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="confirme_password" placeholder="confirmer votre mot de passe">
                    </div>
                </div>

                <button id="buttonColorinscription" class="  ui fluid large   submit button">Modifier</button>
            </div>
        </form>


    </div>
</div>

@endsection