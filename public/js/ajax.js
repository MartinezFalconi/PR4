window.onload = function() {
    filters();
    read();

}

function objetoAjax() {
    var xmlhttp = false;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

function ViewStars(id) {
    var ajax = new objetoAjax();
    //variable con los datos token
    var token = document.getElementById('token').getAttribute('content');
    // Busca la ruta read y que sea asyncrono
    ajax.open('POST', 'read/' + id, true);
}

/* Muestra todos los registros de la base de datos (sin filtrar y filtrados) */
function read() {
    //variable con div donde meter los datos
    var section = document.getElementById('restaurant_box');
    //varaible con la informacion para el filtrado
    var buscador = document.getElementById('buscarRestaurante').value;


    //varaible con la informacion para el filtrado
    var type_restaurant_div = document.getElementById('type_restaurant');
    var type_restaurant;
    //Si es null lo registramos como nulo y si no le damos datos (forma de solucionar error Not Read Null)
    if (type_restaurant_div != null) {
        type_restaurant = type_restaurant_div.value;
    } else {
        type_restaurant = "";
    }



    //varaible con la informacion para el filtrado
    var rating_rest_div = document.getElementById('rating_rest');
    var rating_rest;
    //Si es null lo registramos como nulo y si no le damos datos (forma de solucionar error Not Read Null)
    if (rating_rest_div != null) {
        rating_rest = rating_rest_div.value;
    } else {
        rating_rest = "";
    }


    //varaible con la informacion para el filtrado
    var price_rest_div = document.getElementById('price_rest');
    var price_rest;
    //Si es null lo registramos como nulo y si no le damos datos (forma de solucionar error Not Read Null)
    if (price_rest_div != null) {
        price_rest = price_rest_div.value;
    } else {
        price_rest = "";
    }


    //variable para inicializar funcion ajax
    var ajax = new objetoAjax();
    //variable con los datos token
    var token = document.getElementById('token').getAttribute('content');
    // Busca la ruta read y que sea asyncrono
    ajax.open('POST', 'read', true);
    //variable para iniciar FormData (directorio activo para alamacenamiento de datos json)
    var datasend = new FormData();

    // guardar Filtro
    datasend.append('filtro', buscador);

    // guardar Tipo Restaurante
    datasend.append('type_restaurant', type_restaurant);

    // guardar Popularidad de Restaurante
    datasend.append('rating_rest', rating_rest);

    // guardar Precio
    datasend.append('price_rest', price_rest);

    //guardar Token
    datasend.append('_token', token);

    ajax.onreadystatechange = function() {
        // si el funcionamiento es correcto continua con el montaje de los datos
        if (ajax.readyState == 4 && ajax.status == 200) {
            //variable con los datos obtenido de la funcion read
            var respuesta = JSON.parse(ajax.responseText);

            //variable vacia para rellenar
            var tabla = '';
            for (let i = 0; i < respuesta.length; i++) {
                //const element = array[i];
                tabla += '<div class="col">';
                tabla += '<div class="card">';
                tabla += '<div class="card-body">';
                tabla += '<div class="img-rest">';
                tabla += '<div class="valoracion">';
                tabla += '<p class="clasificacion">';
                if (respuesta[i].stars == 5) {
                    tabla += '<label class="label-estrellas" for="radio">★★★★★</label>';
                } else if (respuesta[i].stars == 4) {
                    tabla += '<label class="label-estrellas" for="radio">★★★★</label>';
                } else if (respuesta[i].stars == 3) {
                    tabla += '<label class="label-estrellas" for="radio">★★★</label>';
                } else if (respuesta[i].stars == 2) {
                    tabla += '<label class="label-estrellas" for="radio">★★</label>';
                } else if (respuesta[i].stars == 1) {
                    tabla += '<label class="label-estrellas" for="radio">★</label>';
                } else {
                    tabla += '<label class="label-estrellas" for="radio"></label>';
                }
                tabla += '</p>';
                tabla += '<p class="clasificacion-monedas">';
                if (respuesta[i].price == 4) {
                    tabla += '<label class="label-monedas" for="radio">€€€€</label>';
                } else if (respuesta[i].price == 3) {
                    tabla += '<label class="label-monedas" for="radio">€€€</label>';
                } else if (respuesta[i].price == 2) {
                    tabla += '<label class="label-monedas" for="radio">€€</label>';
                } else if (respuesta[i].price == 1) {
                    tabla += '<label class="label-monedas" for="radio">€</label>';
                } else {
                    tabla += '<label class="label-monedas" for="radio"></label>';
                }
                tabla += '</p>';
                tabla += '</div>';
                tabla += '</div>';
                tabla += '<img src="data:image/png;base64,' + respuesta[i].image_path + '" alt="error" class="card-img-top">';
                tabla += '<h5 class="card-title">' + respuesta[i].name + '</h5>';
                tabla += '<form method="get" action="opinar/' + respuesta[i].id_restaurant + '">';
                tabla += '<button type="submit" class="btn btn-info btn-xs" onclick="return">Opinar</button>';
                tabla += '</form>';
                tabla += '<p class="card-text">' + respuesta[i].description + '</p>';
                tabla += '</div>';
                tabla += '</div>';
                tabla += '</div>';
                tabla += '</div>';
                // console.log(respuesta[i].name);
            }
            section.innerHTML = tabla;
        }
    }
    ajax.send(datasend);
}

function filters() {
    //variable con div donde meter los datos
    var section = document.getElementById('filter_box');

    //variable para inicializar funcion ajax
    var ajax = new objetoAjax();
    //variable con los datos token
    var token = document.getElementById('token').getAttribute('content');
    // Busca la ruta filters y que sea asyncrono
    ajax.open('POST', 'filters', true);
    //variable para iniciar FormData (directorio activo para alamacenamiento de datos json)
    var datasend = new FormData();

    // //guardar Token
    datasend.append('_token', token);

    ajax.onreadystatechange = function() {
        // si el funcionamiento es correcto continua con el montaje de los datos
        if (ajax.readyState == 4 && ajax.status == 200) {
            //variable con los datos obtenido de la funcion read
            var respuesta = JSON.parse(ajax.responseText);

            //variable vacia para rellenar
            var tabla = '';

            //FILTROS TIPO DE RESTAURANTE
            tabla += '<label for="SelectForType"><h5>Tipo de Restaurante</h5></label>';
            tabla += '<select class="form-control" id="type_restaurant" onchange="read()">';
            tabla += '<option value="">Elige una opcion...</option>';
            for (let i = 0; i < respuesta.length; i++) {
                tabla += '<option value="' + respuesta[i].id_type_restaurant + '">' + respuesta[i].type_food + '</option>';
            }
            tabla += '</select><br>';


            //FILTRO POR POPULARIDAD
            tabla += '<label for="SelectForType"><h5>Popularidad del Restaurante</h5></label>';
            tabla += '<select class="form-control" id="rating_rest" onchange="read()">';
            tabla += '<option value="">Elige una opcion...</option>';
            tabla += '<option value="1">1</option>';
            tabla += '<option value="2">2</option>';
            tabla += '<option value="3">3</option>';
            tabla += '<option value="4">4</option>';
            tabla += '<option value="5">5</option>';
            tabla += '</select><br>';

            //FILTROS POR PRECIO
            tabla += '<label for="SelectForType"><h5>Calidad / Precio Restaurante</h5> </label>';
            tabla += '<select class="form-control" id="price_rest" onchange="read()">';
            tabla += '<option value="">Elige una opcion...</option>';
            tabla += '<option value="1">1</option>';
            tabla += '<option value="2">2</option>';
            tabla += '<option value="3">3</option>';
            tabla += '<option value="4">4</option>';
            tabla += '</select><br>';


            section.innerHTML = tabla;


        }
    }
    ajax.send(datasend);
}