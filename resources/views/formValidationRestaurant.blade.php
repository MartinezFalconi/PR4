<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../css/valorarUsuario.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <script src="js/ajax.js"></script>
    <title>Update Restaurant | Too Good To Go</title>
</head>
<body class="body-homeStandard">
    <nav class="navbar navbar-expand-lg navbar-light bg-light"> 
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                 <a href="{{url('homeStandard')}}"><img src="../storage/images/header.png" class="logo"> <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <i class="fa fa-user-plus" style="font-size:36px"></i>
                </li>
                <li class="nav-item">
                    <li class="inicio-sesion">
                    <div class="session">Bienvenido, {{Session::get('email')}}</div>
                    </li>
                    <li class="cerrar-sesion">
                        <button class="cerrars-boton"><a href="{{url('logout')}}">Cerrar Sesión</a></button></li>
                    </li>
                
                </li>
            </ul>
        </div>
    </nav>
    @if ($errors->any())
    <div role="alert">
        <ul class="list-group">
            @foreach ($errors->all() as $error)
            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
<div class="container">

    <h1>¿Qué te ha parecido nuestro restaurante? Háznolo saber!</h1>
    <hr>
    <form action="{{url('validar')}}" method="get" class="formulario-register" enctype="multipart/form-data">

    <h1>{{ $restaurant->name }}</h1>
    <div class="div-valoracion">
        <h4>Valora nuestro restaurante!</h4>
        <p class="clasificacion">
            <input id="radio1" type="radio" name="estrellas" value="5"><!--
            --><label class="label-estrellas" for="radio1">★</label><!--
            --><input id="radio2" type="radio" name="estrellas" value="4"><!--
            --><label class="label-estrellas" for="radio2">★</label><!--
            --><input id="radio3" type="radio" name="estrellas" value="3"><!--
            --><label class="label-estrellas" for="radio3">★</label><!--
            --><input id="radio4" type="radio" name="estrellas" value="2"><!--
            --><label class="label-estrellas" for="radio4">★</label><!--
            --><input id="radio5" type="radio" name="estrellas" value="1"><!--
            --><label class="label-estrellas" for="radio5">★</label>
        </p>

        <h4>Valora nuestro precio!</h4>
        <p class="clasificacion-monedas">
            <input id="radio6" type="radio" name="monedas" value="4"><!--
            --><label  class="label-monedas" for="radio6">€</label><!--
            --><input id="radio7" type="radio" name="monedas" value="3"><!--
            --><label class="label-monedas" for="radio7">€</label><!--
            --><input id="radio8" type="radio" name="monedas" value="2"><!--
            --><label class="label-monedas" for="radio8">€</label><!--
            --><input id="radio9" type="radio" name="monedas" value="1"><!--
            --><label class="label-monedas" for="radio9">€</label><!-
        </p>
        <input type="hidden"  id="restaurante" name="restaurante" value="{{ $restaurant->id_restaurant }}"><br><br>
        <button type="submit" class="boton-enviar">Enviar</button>
    </div>
</form>
</div>

<div class="footer-basic">
    <footer>
        <div class="social"><a href="#"><i class="icon ion-social-instagram"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-facebook"></i></a></div>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Inicio</a></li>
                <li class="list-inline-item"><a href="#">Restaurantes</a></li>
                <li class="list-inline-item"><a href="#">Sobre Nosotros</a></li>
                <li class="list-inline-item"><a href="#">Términos y condiciones</a></li>
                <li class="list-inline-item"><a href="#">Política de Privacidad</a></li>
            </ul>
            <p class="copyright">Too Good To Go © 2021</p>
    </footer>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

    <script src="{{ mix('js/app.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/app.js')}}"></script>  

</body>
</html>