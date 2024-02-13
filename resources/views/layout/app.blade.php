<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/images/logo.png" type="image/x-icon">
    <title>Damay-Diangue</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.5.0/semantic.min.css" integrity="sha512-KXol4x3sVoO+8ZsWPFI/r5KBVB/ssCGB5tsv2nVOKwLg33wTFP3fmnXa47FdSVIshVTgsYk/1734xSk9aFIa4A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .container {
            display: flex;
        }

        .headerInscription {
            border: 1px solid lightsalmon;
            border-radius: 2rem;
            padding: 8px;
            width: 250px;
        }

        #buttonColorinscription,
        #buttonColorConnexion {
            background: lightsalmon;
            color: white;
        }

        .containerErr {
            margin-top: 9px;

        }

        .Error {
            background-color: red;
            padding: 10px;
            color: whitesmoke;
        }

        #title,
        #titre {
            color: lightsalmon;

        }

        .success {
            background-color: lightgreen;
            padding: 10px;
            color: whitesmoke;
        }


        .error {

            color: red;
            font-size: 15px;
        }

        .inputError {
            border-color: solid red;
        }

        .titre {
            width: 250px;
            border: 1px solid lightsalmon;
            border-radius: 2rem;
            padding: 8px;


        }
    </style>
</head>

<body class="container">
    @yield('content')
</body>

</html>
