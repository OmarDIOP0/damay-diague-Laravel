<!DOCTYPE html>
<html lang="fr" dir="ltr">
<title>
    Damay-Diangue
</title>
<link href="/css/cours-content.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="/images/logo.png" type="image/x-icon">
<meta name="description" content=@yield('description')>
<script src="/js/dist/jquery.min.js"></script>
<script src="/js/dist/semantic.min.js"></script>
<script src="/js/dist/pdf.js"></script>
</head>

<body>
    <div id="wrapper">
        <div id="content">
            <div id="section-course">
                <h2 style="text-align: center;color:gray;">Sommaire</h2>
                <div id="sommaire">
                    @yield('sommaire-content')
                </div>
                @yield('btn-back')
            </div>
            <div id="course">
                <h2 id="lesson-title">@yield('title')</h2>
                <div class="course-content">
                    @yield('course-content')
                </div>
            </div>
        </div>
        @yield('script')
        <script>
          
        </script>
</body>

</html>
