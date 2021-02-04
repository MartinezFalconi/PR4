<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>LOGIN | Too Good To Go</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
</head>
<body class="login-body">

    <!-- Mensaje de error en caso de que algo no este bien escrito a la hora de entrar -->
    @if ($errors->any())
    <div role="alert">
        <ul class="list-group">
            @foreach ($errors->all() as $error)
            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{url('requestLogin')}}" method="post" class="formulario-login">
    @csrf
        <div class="div-form-login">
            <div class="frase-login">
            <img src="./storage/images/logo.png" class="img-logo">
                <h1>VENDE TU EXCEDENTE DE MANERA FÁCIL</h1>
            </div>
            <div class="login-div2">
                <h3 class="titulo-login">Login</h3>
                <div class="background-form">
                    <div class="inputs-form"> 
                        <div class="div-login">
                            <input class="campoform" type="email" name="email" id="email">
                            <span class="focus-campoform"></span>
                            <span class="label-campoform">Correo Electrónico</span>
                        </div>
                        <div class="div-login">
                            <input class="campoform" type="password" name="passwd" id="passwd">
                            <span class="focus-campoform"></span>
                            <span class="label-campoform">Contraseña</span>
                        </div>
                        <button type="submit" class="login-boton">Iniciar Sesión</button>
                    </div>
                </div>
            <p>¿Ya tienes cuenta? <a href="{{url('registroUser')}}">¡Regístrate!</a></p>
        </div>

        <!-- Muestra el error al usuario -->
        @if(session('error'))
            <p><strong>{{session('error')}}</strong></p>
        @endif

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