<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Restaurant | Too Good To Go</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../css/actualizar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
</head>
<body class="registro-body">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
            <li class="cerrar-sesion"><button class="cerrars-boton"><a href="{{url('logout')}}">Cerrar Sesión</a></button></li>
            </li>
            </ul>

        </div>
    </nav>

    <!-- Muestra el error al usuario -->
    @if(session('error'))
            <p><strong>{{session('error')}}</strong></p>
        @endif
    <form action="{{url('modificar/'.$restaurant->id_restaurant)}}" method="get" class="formulario-register" enctype="multipart/form-data">
    @csrf
        <div class="div-form-register">
            <div class="frase-register">
            <img src="../storage/images/floating-food-bag.png" class="img-logo">
                <h1>¡Da VISIBILIDAD a tu NEGOCIO!</h1>
            </div>
            <div class="register-div2">
                <h3 class="titulo-register">¡Edita el restaurante!</h3>
                <div class="background-form">
                    <div class="inputs-form"> 
                        <div class="div-register">
                            <input class="campoform" type="text" name="name" id="name" value="{{ $restaurant->name }}">
                            <span class="label-campoform">Nombre restaurante</span>
                        </div>
                        <div class="div-register">
                            <input class="campoform" type="text" name="description" id="description" value="{{ $restaurant->description }}">
                            <span class="label-campoform">Descripción</span>
                        </div>
                        <div class="div-restaurante">
                            <input class="campoform" accept="image/png" type="file" name="image_path" id="image_path" value="{{ $restaurant->image_path }}">
                            <span class="label-campoform">Imagen</span>
                        </div>
                        <div class="div-restaurante">
                            <span class="focus-campoform"></span>
                            <select name="id_restaurant_type_fk" id="id_restaurant_type_fk">
                            @foreach($typesrestaurant as $type)
                                <option value="{{ $type->id_type_restaurant }}">{{ $type->type_food }}</option>';
                            @endforeach
                            </select>
                            <span class="label-campoform">Tipo</span>
                        </div>
                        <button type="submit" class="login-boton">Actualizar</button>
                    </div>
                    <button class="volver-boton"><a href="{{url('homeAdmin')}}">Volver Atrás</a></button>
                </div>
            </div>
        </div>
        <!-- Muestra el error al usuario -->
        @if(session('error'))
            <p><strong>{{session('error')}}</strong></p>
        @endif
    </form>
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