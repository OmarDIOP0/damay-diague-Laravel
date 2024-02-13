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
                        <div class="item">
                            <div class="ui header">
                                Apples Apples ApplesAppleApplesApple
                            </div>
                        </div>
                        <div class="item">Pears</div>
                        <div class="item">Oranges</div>
                    </div>
                </div>
                <div class="ui twelve wide column divided">
                    <div class="ui header centered" style="border-bottom    :1px solid rgba(128, 128, 128, 0.58);">
                        <h1>Les Suites Numériques</h1>
                    </div>
                    <div class="row">
                        <canvas id="course-content" height="500px"></canvas>
                    </div>
                    <div class="row">
                        <div class="ui grid centered">
                            <div class="column">
                                <img id="prev" class="ui image mini"
                                    src="{{ URL::asset('images/left-arrow.png') }}" alt="">
                            </div>
                            <div class="column">
                                <img id="next" class="ui image mini"
                                    src="{{ URL::asset('images/right-arrow.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('script')
    <script src="{{ URL::asset('js/src/course-content.js') }}"></script>
</body>

</html>
