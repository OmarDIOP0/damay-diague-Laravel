<!DOCTYPE html>
<html lang="fr">
    <head>
        <style>
            .pusher{
                padding-top: 50px;
            }
            sidebar > a.active{
                border-radius: 10px;
                background-color: #d71b3b;
            }
        </style>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/images/logo.png" type="image/x-icon">
        <link rel="stylesheet" href="/css/list-cours.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
        <title>Damay-Diague</title>
    </head>
    <body>
        <div class="ui sidebar vertical inverted menu" style="background-color:black">
            <h4 class="header item" style="background-color:white; text-align:center; color:black">DAMAYDIAGUE</h4>
            <div class="item">
                <div class="ui icon input">
                  <input type="text" placeholder="Rechercher...">
                  <i class="search icon"></i>
                </div>
            </div>
            <a href="/admin/dashboard" class="item {{request()->url()==route("admin.dashboard")? 'active' : '' }}">
                Tableau de Bord
            </a>
            <a href="/admin/cour" class="item {{request()->url()==route("admin.cour")? 'active' : '' }}">
                Gestion de Cours
            </a>
            <a href="/admin/niveau" class="item {{request()->url()==route("admin.niveau")? 'active' : '' }}">
                Gestion des Niveau
            </a>
            <a href="/admin/matiere" class="item {{request()->url()==route("admin.matiere")? 'active' : '' }}">
                Gestion des Matieres
            </a>
          </div>
          <div class="ui basic icon top fixed menu">
            <a href="" id="toggle" class="item" style="font-size:15px; font-weight:bold;">
                <i class="sidebar icon"></i>
                MENU
            </a>
            <div class="ui right compact menu">
                <div class="ui simple dropdown item" style="background-color:black;color:white;">
                  {{Session::get('name')}}
                  <i class="dropdown icon"></i>
                  <div class="menu">
                    <div class="item"><i class="user icon"></i><a href="/admin/profile">Profile</a></div>
                    <div class="item"><i class="sign out alternate icon"></i><a href="/admin/logout">Deconnexion</a></div>
                    <div class="item"><i class="wrench icon"></i>Parametre</div>
                  </div>
                </div>
              </div>
        </div>
          <div class="dimmed pusher ">
            <div class="ui container">
                <h3 class="ui dividing header">@yield('titre')</h3>
                @yield('contenu')
            </div>
          </div>
          <script>
             $('.ui.sidebar')
                .sidebar('toggle');
          </script>

    </body>

</html>


