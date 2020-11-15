<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>{{config('app.name')}}</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body class="login-content">

    <nav class="blue darken-4">
        <div class="nav-wrapper">
        <a href="#" class="brand-logo"><img src="/img/loudcssyf-logo.png" style="margin-left : 10% !important;margin-top : 10% !important;" width="50" height="50" alt=""></a>
    </nav>

    <div id="app">
        <login-component></login-component>
    </div>
    <div class="copy">
        <div>
            <p class="center">
               <a href="#">Conditions generales</a> | <a href="#">Mentions legales</a>
               <span class="right"> &copy; Copyright {{date('Y')}} GRH | LOUDCSSYF-SARL | By Smartech</span>
            </p>
        </div>
    </div>
<script src="{{mix('js/app.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>