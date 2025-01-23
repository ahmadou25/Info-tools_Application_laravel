<!DOCTYPE html>
<html>
<head>
    <title>Gestion des commandes</title>
    <!-- link ajouter -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        /* Appliquer un espacement plus large en haut */
        .mtop {
            margin-top: 50px;
        }

        /* Conteneur principal avec une largeur maximum large */
        .container {
            max-width: 1200px; /* Augmenter la largeur du conteneur */
            margin: 0 auto;    /* Centrer le conteneur */
            padding: 0 20px;   /* Ajouter du padding sur les côtés */
        }

        /* Flex centré */
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .content {
            text-align: center;
        }

        /* Augmenter la taille de titre si nécessaire */
        .title {
            font-size: 84px;
        }
        
    </style>
</head>
<body>
    <div class="container mtop">
        @yield('content')
    </div>

</body>
</html>
