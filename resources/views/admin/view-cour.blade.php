<!DOCTYPE html>
<html lang="fr" dir="ltr">
<title>
    Damay-Diangue
</title>
<link href="/css/cours-content.css" rel="stylesheet" type="text/css" />
<link href="/css/cours-pdf-content.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/semantic.min.css') }}">
<link rel="shortcut icon" href="/images/logo.png" type="image/x-icon">
<meta name="description" content=@yield('description')>
<script src="{{ URL::asset('js/dist/jquery.min.js') }}"></script>
<script src="/js/dist/pdf.js"></script>
 <style>
    .list-sommaire:hover{
       background-color:yellow;
       color:white;
       border-radius:20%;
       padding: 7px;
    }
    .list-sommaire:active{
        background-color:yellow;
    }

 </style>

</head>

<body>
    <div id="wrapper">
        <div class="ui grid internally celled">
            <div class="row">

                <div class="ui four wide column">
                    <div class="ui header centered">
                        <h2>Sommaire</h2>
                    </div>
                    <div class="ui list divided">
                        <ul id="sommaire">
                            @foreach ($sommaires as $index => $sommaire)
                            <li data-page="{{$sommaire->page_num}}"style="list-style: none;" class="list-sommaire">
                                <div class="ui header" style="cursor: pointer">
                                     - {{$sommaire->libelle_sommaire}}
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        <button class="ui inverted green button"><a href="/admin/cour" style="color: black">Retour</a></button>
                    </div>
                </div>

                <div class="ui twelve wide column divided">
                    @foreach ($cours as $cour)
                    <div class="ui header centered" style="border-bottom:1px solid rgba(128, 128, 128, 0.58);">
                        <h1 style="text-transform: uppercase">{{$cour->libelle}}</h1>
                    </div>
                    <div class="row">
                        <canvas class="course-canvas" data-pdf-url="{{asset('cours/'.$cour->nomFichier)}}" height="500px"></canvas>
                            </div>
                            <div class="row">
                                <div class="ui grid centered">
                                    <div class="column">
                                        <img id="prev-btn" class="ui image mini" style="cursor: pointer"
                                        src="{{ URL::asset('images/left-arrow.png') }}" alt="">
                                    </div>
                                    <div class="column">
                                        <img id="next-btn" class="ui image mini" style="cursor: pointer"
                                        src="{{ URL::asset('images/right-arrow.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="row">
                            <div class="ui grid centered">
                                <div class="column">
                                    <div id="page-info" class="ui header centered" style="cursor: pointer">
                                        Page <span id="page-num"></span> de <span id="page-count"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

    @yield('script')
    <script src="{{ URL::asset('js/src/modules/cours-second-module.js')}}"></script>
</body>

</html>
