<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN | Too Good To Go</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="./css/login.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    
</head>
<body class="registro-body">
    @if ($errors->any())
    <div role="alert">
        <ul class="list-group">
            @foreach ($errors->all() as $error)
            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{url('generarRestaurante')}}" enctype="multipart/form-data" method="post" class="formulario-register">
    <form action="{{url('generarRestaurante')}}" method="post" class="formulario-register" enctype="multipart/form-data">
    @csrf
        <div class="div-form-register">
            <div class="frase-register">
            <img src="./storage/images/logo.png" class="img-logo">
                <h1>¡Crear un restaurante!</h1>
            </div>
            <div class="register-div2">
                <h3 class="titulo-register">Registro</h3>
                <div class="background-form">
                    <div class="inputs-form"> 
                        <div class="div-register">
                            <input class="campoform" type="text" name="name" id="name">
                            <span class="focus-campoform"></span>
                            <span class="label-campoform">Nombre restaurante</span>
                        </div>
                        <div class="div-register">
                            <input class="campoform" type="text" name="description" id="description">
                            <span class="focus-campoform"></span>
                            <span class="label-campoform">Descripción</span>
                        </div>
                        <div class="div-restaurante">
                            <input class="campoform" accept="image/png" type="file" name="image_path" id="image_path">
                            <span class="focus-campoform"></span>
                            <span class="label-campoform">Imagen</span>
                        </div>
                        <div class="div-restaurante">
                            <span class="focus-campoform"></span>
                            <select name="id_restaurant_type_fk" id="id_restaurant_type_fk">
                            @foreach($typeRestaurant as $type)
                                <option value="{{ $type->id_type_restaurant }}">{{ $type->type_food }}</option>';
                            @endforeach
                            </select>
                            <span class="label-campoform">Tipo</span>
                        </div>
                        <button type="submit" class="register-boton">Crear</button>
                    </div>
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