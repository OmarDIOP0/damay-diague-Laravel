<!DOCTYPE html>
<html>

<head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="DamayDiangue plateforme web de cours en ligne 100% sénégalais.">
    <!-- Site Properties -->
    <title>Damay-Diangue</title>
    <link rel="shortcut icon" href="/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/semantic.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/home.css') }}">
</head>

<body>
    <div class="header">
        @include('shared-header')
    </div>
    <div id="container">
        <div class="content">
            <img src="/images/learned.png" alt="le numerique au service de l'education" width="400px">
            <div class="content-left">
                <h1>L'éducation <br> notre priorité</h1>
                <p class="text-white" id="desc">Apprenez ce que vous voulez,
                quand vous voulez et où vous voulez.</p>
                <a class="btn btn-blue text-white bold" href="/cours" id="btn-details">Voir les Cours</a>
            </div>
        </div>
        <br>
        <div id="diplomes" class="ui stackable three column grid">
            <div class="diplome-item  column">
                <img src="/images/g12.png" width="35%" alt="Apprendre à votre rythme">
                <div class="description">
                    <h3>Apprenez à votre rythme</h3>
                </div>
            </div>
            <div class="diplome-item  column">
                <img src="/images/exam.png" width="35%" alt="Testez vos connaissances">
                <div class="description">
                    <h3>Testez vos connaissances</h3>
                </div>
            </div>
            <div class="diplome-item  column">
                <img src="/images/asking.jpg" width="35%" alt="Partagez avec vos amis">
                <div class="description">
                    <h3>Partagez avec vos amis</h3>
                </div>
            </div>
        </div>
        <div id="description-plateforme" class="ui grid container ">
            <img src="/images/backv.jpg" class="right floated left aligned six wide column " id="desc-plat-img"
                height="250px" alt="Apprendre avec Damay Diangue">
            <div id="desc-text" class="nine wide column">
                <h2 id="desc-title">Présentation</h2>
                <p>Bienvenue sur notre plateforme d'apprentissage en ligne conçu par des 
                    sénégalais dans le but de mettre la connaissance à la portée de tous aussi  
                    bien pour les éleves, les étudiants et les professionnels à trouver des formations théorique et 
                    pratiques à fin de s’améliorer.<br><br> 
                    <i class="bold">L'Education Notre Priorité</i>
                    <br>
                </p>
            </div>
        </div>
        <div id="desc-infos" class="ui grid container ">
            <div id="details" class="five wide column">
                <h2>DamayDiangue</h2>
                <ul style="list-style:none;padding:0;color:#150035;">
                    <li>Télécharger le resume des cours</li>
                    <br>
                    <li>Poser des questions dans le forum</li>
                    <br>
                    <li>Suivre les cours sur ordinateur ou portable</li>
                </ul>
                <a class="btn btn-orange text-blue bold" href="/cours">Commencer</a>
            </div>
            <div id="desc-img" class="eight wide column">
                <img class="bordered miny-img" src="/images/istock4.jpg" alt="Le numerique au service de l'education" width="200px">
                <img class="bordered medium-img" src="/images/istock2.jpg" alt="La connaissance à la portée de tous" width="250px">
                <img class="bordered medium-img" src="/images/istock3.jpg" alt="Suivre ses cours depuis" width="250px">
                <img class="bordered miny-img" src="/images/istock1.jpg" alt="Apprendre avec ses amis" width="200px">
            </div>
        </div>
       
        
        @include('footer')
    </div>
    <br>
    <script src="/js/dist/jquery.min.js" charset="utf-8"></script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11"></script>

    <script>
        $(() => {
            $("#menu-item1").addClass("active");
            let windowWidth = $(window).width();
            if (windowWidth < 630) {
                $("#details").removeClass("five column wide");
            }

            $(window).resize(function() {
                windowWidth = $(window).width();
                if (windowWidth < 720) {
                    $("#details").addClass("five column   wide");
                }

                if (windowWidth < 550) {
                    $("#desc-plat-img").hide();
                    $("#desc-text").removeClass("nine wide column");
                }
            });
        })
    </script>
</body>

</html>
