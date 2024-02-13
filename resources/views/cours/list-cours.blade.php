<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <title>
        Damay-Diangue
    </title>
    <link rel="shortcut icon" href="/images/logo.png" type="image/x-icon">
    <meta name="description" content=@yield('description')>

    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/list-cours.css">
    <link rel="shortcut icon" href="/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/semantic.min.css') }}">
</head>

<body>
    @include('shared-header')
    <div id="container" class="ui container">
        <div class="ui grid container">
            <div class="row" style="margin-top:5%;">
                <h2 class="ui dividing header">Nos Cours</h2>
            </div>
            <div class="row ui cards four column stackable">
                @foreach ($cours as $cour)
                <div class="card">
                    <div class="image">
                        <img src="/images/math.png">
                    </div>
                    <div class="content">
                        <a class="header">{{$cour->libelle}}</a>
                        <div class="description">
                            {{$cour->matiere_libelle}}
                        </div>
                    </div>
                    <div class="extra content">
                        <div class="ui btn-blue btn-consulter" id="">
                            <a href="/admin/viewCour/{{$cour->slug}}" style="color:white;">Consulter</a>
                        </div>
                    </div>
                </div>
                {{-- <div class="card">
                    <div class="image">
                        <img src="/images/english.png">
                    </div>
                    <div class="content">
                        <div class="header">Matt Giampietro</div>
                        <div class="description">
                            Matthew is an interior designer living in New York.
                        </div>
                    </div>
                    <div class="extra content">
                        <span class="right floated">
                            Joined in 2013
                        </span>
                        <span>
                            <i class="user icon"></i>
                            75 Friends
                        </span>
                    </div>
                </div> --}}
                @endforeach
            </div>
        </div>
    </div>
    <br>
    <br>
    @include('footer')
    @yield('script')
</body>

</html>
