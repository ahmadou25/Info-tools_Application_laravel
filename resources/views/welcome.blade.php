<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INFO-TOOLS</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <style>
        html, body {
            background-color: #f8f9fa; /* Couleur de fond plus claire */
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            margin-top: 100px; /* Ajustement de l'espacement */
        }

        .mtop {
            margin-top: 50px;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 72px;
            color: #007bff;
        }

        .slogan {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .description {
            font-size: 18px;
            margin-bottom: 40px;
        }

        .services {
            margin-top: 40px;
            text-align: left;
        }

        .services h2 {
            font-size: 36px;
            color: #007bff;
        }

        .services ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        .services li {
            margin: 5px 0;
            font-size: 18px;
        }

        .button-container {
            text-align: center;
            margin-top: 50px;
        }

        .button-container a {
            display: inline-block;
            margin: 10px;
            padding: 15px 30px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .button-container a:hover {
            background-color: #0056b3;
        }

        .welcome-message {
            font-size: 24px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref">
    <div class="content">
        <h1 class="title">INFO-TOOLS</h1>
        <p class="slogan">Solutions Innovantes pour un Avenir Meilleur</p>
        <p class="welcome-message">Bienvenue sur la plateforme de INFO-TOOLS !</p>
        <p class="description">Découvrez nos logiciels et services conçus pour optimiser votre activité.</p>
        
        <div class="services">
            <h2>Nos Services</h2>
            <p>Nous proposons des solutions adaptées à vos besoins :</p>
            <ul>
                <li>Développement de logiciels sur mesure</li>
                <li>Gestion d'infrastructure</li>
                <li>Support technique et maintenance</li>
            </ul>
        </div>

        <div class="button-container">
            <a href="{{ route('register') }}">Inscription</a>
            <a href="{{ route('login') }}">Connexion</a>
        </div>
    </div>
</div>
</body>
</html>
