<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <title>DamayDiangue | Se Connecter</title>
    <link rel="stylesheet" type="text/css" href="/css/semantic.min.css">
    <style media="screen">
        body {
            background-image: url("/images/login-back.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            padding-top: 10%;
            color: white;
        }

        .white {
            color: white;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="ui container">
        <h1 class="ui white">Page de Connexion</h1>
        <br>
        <div class="row centered">
            <div class="ui grid centered stackable">

                <form class="ui form six wide column segment" action="/user-login" method="POST">
                    <h1 class="ui header centered">Se Connecter</h1>
                    <div class="h3 white">
                        <?php if (isset($error) && !empty($error)) { ?>
                        <h2 style="color: red"><?= $error ?></h2>
                        <?php } ?>
                    </div>
                    <div class="field">
                        <label for="inputEmail" class="">Login</label>
                        <input name="login" type="text" id="inputEmail" class="form-control"
                            placeholder="Votre Login" required autofocus>
                    </div>
                    <div class="field">
                        <label for="inputPassword" class="sr-only">Password</label>
                        <input name="password" type="password" id="inputPassword" class="form-control"
                            placeholder="Saisir Mot de Passe" required>
                    </div>
                    <br>
                    <button class="ui button blue" type="submit">Se Connecter</button>
                </form>
                <p class="row">&copy;2020</p>
            </div>

        </div>
    </div>
</body>

</html>
