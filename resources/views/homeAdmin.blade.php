<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="./css/homeStandard.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/ajaxadmin.js"></script>
    <title>Home Admin | To Good To Go</title>
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
                 <a href="{{url('homeAdmin')}}"><img src="./storage/images/header.png" class="logo"> <span class="sr-only">(current)</span></a> 
                </li>
                <li>
                <a href="{{url('registroRestaurante')}}">Crear restaurante</a>
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
<div class="container">
    <h1>ADMIN.</h1>
    <hr>
    <div class="row py-3">
        <div class="col-7 col-sm-8 content">
                <div class="content">
                <h2>Restaurantes en tu zona</h2>
                <div class="row row-cols-1 row-cols-md-2 g-4" id="restaurant_box">
                
                </div>
            </div>

        </div>
        <div class="col-5 col-sm-4">
            <div class="card border-primary mb-4">
                <div class="card-body">
                </div>
            </div>
            <div class="menu sticky-top p-3 bg-light">
                <div class="buscador">
                    <input type="text" name="buscarRestaurante" id="buscarRestaurante" placeholder="Restaurante..." onkeyup="read()">
                </div>
                <h5 class="text-primary">Menú de opciones</h5>
                <h4>Típo de cocina</h4>
                <div class="nav flex-column">
                <div class="form-group" id="filter_box">

                </div>
            </div>
        </div>
    </div>
</div>
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