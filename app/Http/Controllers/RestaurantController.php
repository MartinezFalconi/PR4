<?php

namespace App\Http\Controllers;

//importa la base de datos
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateRestaurantControllerRequest;

use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function read(Request $request){
        //variable que recoje los datos de un filtro
        $filtro = $request->input('filtro');
        //variable que recoje del formulario del filtros, el tipo de restaurante a mostrar
        $type_restaurant = $request->input('type_restaurant');
        //variable que recoje del formulario del filtros, la valoracion de los restaurantes a mostrar
        $rating_rest = $request->input('rating_rest');
        //variable que recoje del formulario del filtros, el precio del menu de los restaurantes a mostrar
        $price_rest = $request->input('price_rest');

        if ($filtro != "" || $type_restaurant != ""  || $rating_rest != ""  || $price_rest != "" ) {
            
            if ($filtro != "" && $type_restaurant == ""  && $rating_rest == ""  && $price_rest == "" ){
                // SOLO Filtro
                $restaurants = DB::select('SELECT tbl_restaurant.name, tbl_restaurant.id_restaurant, tbl_restaurant.image_path, tbl_restaurant.description, queryAVG.stars, queryAVG.price  FROM tbl_restaurant 
                LEFT JOIN (SELECT ROUND(AVG(tbl_assessment.stars)) AS stars, ROUND(AVG(tbl_assessment.price)) AS price, tbl_restaurant.id_restaurant 
                                            FROM tbl_assessment 
                                            INNER JOIN tbl_restaurant 
                                            ON tbl_assessment.id_restaurant_fk = tbl_restaurant.id_restaurant 
                                            GROUP BY tbl_restaurant.id_restaurant) AS queryAVG 
                ON tbl_restaurant.id_restaurant = queryAVG.id_restaurant
                WHERE tbl_restaurant.name LIKE ?',["%".$filtro."%"]);

            }elseif ($filtro == "" && $type_restaurant != ""  && $rating_rest == ""  && $price_rest == "" ) {
                //SOLO tipo restaurante

                $restaurants = DB::select('SELECT tbl_restaurant.name, tbl_restaurant.id_restaurant, tbl_restaurant.image_path, tbl_restaurant.description, queryAVG.stars, queryAVG.price  FROM tbl_restaurant
                LEFT JOIN (SELECT ROUND(AVG(tbl_assessment.stars)) AS stars, ROUND(AVG(tbl_assessment.price)) AS price, tbl_restaurant.id_restaurant 
                                            FROM tbl_assessment 
                                            INNER JOIN tbl_restaurant 
                                            ON tbl_assessment.id_restaurant_fk = tbl_restaurant.id_restaurant 
                                            GROUP BY tbl_restaurant.id_restaurant) AS queryAVG 
                ON tbl_restaurant.id_restaurant = queryAVG.id_restaurant
                INNER JOIN tbl_type_restaurant 
                ON tbl_restaurant.id_restaurant_type_fk = tbl_type_restaurant.id_type_restaurant
                WHERE tbl_type_restaurant.id_type_restaurant = ?',[$type_restaurant])
                ;

            }elseif ($filtro == "" && $type_restaurant == ""  && $rating_rest != ""  && $price_rest == "" ) {
                //SOLO ranquing de popularidad
                $restaurants = DB::select('SELECT tbl_restaurant.name, tbl_restaurant.id_restaurant, tbl_restaurant.image_path, tbl_restaurant.description, queryAVG.stars, queryAVG.price  FROM tbl_restaurant
                LEFT JOIN (SELECT ROUND(AVG(tbl_assessment.stars)) AS stars, ROUND(AVG(tbl_assessment.price)) AS price, tbl_restaurant.id_restaurant 
                                            FROM tbl_assessment 
                                            INNER JOIN tbl_restaurant 
                                            ON tbl_assessment.id_restaurant_fk = tbl_restaurant.id_restaurant 
                                            GROUP BY tbl_restaurant.id_restaurant) AS queryAVG 
                ON tbl_restaurant.id_restaurant = queryAVG.id_restaurant
                WHERE stars = ?',[$rating_rest])
                ;
            }elseif ($filtro == "" && $type_restaurant == ""  && $rating_rest == ""  && $price_rest != "" ) {
                //SOLO precio
                $restaurants = DB::select('SELECT tbl_restaurant.name, tbl_restaurant.id_restaurant, tbl_restaurant.image_path, tbl_restaurant.description, queryAVG.stars, queryAVG.price  FROM tbl_restaurant
                LEFT JOIN (SELECT ROUND(AVG(tbl_assessment.stars)) AS stars, ROUND(AVG(tbl_assessment.price)) AS price, tbl_restaurant.id_restaurant 
                                            FROM tbl_assessment 
                                            INNER JOIN tbl_restaurant 
                                            ON tbl_assessment.id_restaurant_fk = tbl_restaurant.id_restaurant 
                                            GROUP BY tbl_restaurant.id_restaurant) AS queryAVG 
                ON tbl_restaurant.id_restaurant = queryAVG.id_restaurant
                WHERE price = ?',[$price_rest])
                ;
            }elseif ($filtro != "" && $type_restaurant != ""  && $rating_rest == ""  && $price_rest == "" ) {
                //Filtros + Tipo restaurante
                $restaurants = DB::select('SELECT tbl_restaurant.name, tbl_restaurant.id_restaurant, tbl_restaurant.image_path, tbl_restaurant.description, queryAVG.stars, queryAVG.price  FROM tbl_restaurant
                LEFT JOIN (SELECT ROUND(AVG(tbl_assessment.stars)) AS stars, ROUND(AVG(tbl_assessment.price)) AS price, tbl_restaurant.id_restaurant 
                                            FROM tbl_assessment 
                                            INNER JOIN tbl_restaurant 
                                            ON tbl_assessment.id_restaurant_fk = tbl_restaurant.id_restaurant 
                                            GROUP BY tbl_restaurant.id_restaurant) AS queryAVG                 
                ON tbl_restaurant.id_restaurant = queryAVG.id_restaurant 
                WHERE tbl_restaurant.name LIKE ? AND id_restaurant_type_fk = ?',["%".$filtro."%","$type_restaurant"])
                ;
            }elseif ($filtro != "" && $type_restaurant == ""  && $rating_rest != ""  && $price_rest == "" ) {
                //Filtros + Ranquing de popularidad
                $restaurants = DB::select('SELECT tbl_restaurant.name, tbl_restaurant.id_restaurant, tbl_restaurant.image_path, tbl_restaurant.description, queryAVG.stars, queryAVG.price  FROM tbl_restaurant
                LEFT JOIN (SELECT ROUND(AVG(tbl_assessment.stars)) AS stars, ROUND(AVG(tbl_assessment.price)) AS price, tbl_restaurant.id_restaurant 
                            FROM tbl_assessment 
                            INNER JOIN tbl_restaurant 
                            ON tbl_assessment.id_restaurant_fk = tbl_restaurant.id_restaurant 
                            GROUP BY tbl_restaurant.id_restaurant) AS queryAVG 
                ON tbl_restaurant.id_restaurant = queryAVG.id_restaurant 
                WHERE tbl_restaurant.name LIKE ? AND queryAVG.stars = ?',["%".$filtro."%",$rating_rest])
                ;
            }elseif ($filtro != "" && $type_restaurant == ""  && $rating_rest == ""  && $price_rest != "" ) {
                //Filtros + Precio
                $restaurants = DB::select('SELECT tbl_restaurant.name, tbl_restaurant.id_restaurant, tbl_restaurant.image_path, tbl_restaurant.description, queryAVG.stars, queryAVG.price  FROM tbl_restaurant
                LEFT JOIN (SELECT ROUND(AVG(tbl_assessment.price)) AS price, ROUND(AVG(tbl_assessment.stars)) AS stars, tbl_restaurant.id_restaurant 
                            FROM tbl_assessment 
                            INNER JOIN tbl_restaurant 
                            ON tbl_assessment.id_restaurant_fk = tbl_restaurant.id_restaurant 
                            GROUP BY tbl_restaurant.id_restaurant) AS queryAVG 
                ON tbl_restaurant.id_restaurant = queryAVG.id_restaurant 
                WHERE tbl_restaurant.name LIKE ? AND queryAVG.price = ?',["%".$filtro."%",$price_rest])
                ;
            }elseif ($filtro == "" && $type_restaurant != ""  && $rating_rest != ""  && $price_rest == "" ) {
                //Tipo restaurante + Ranquing de popularidad
                $restaurants = DB::select('SELECT tbl_restaurant.name, tbl_restaurant.id_restaurant, tbl_restaurant.image_path, tbl_restaurant.description, queryAVG.stars, queryAVG.price  FROM tbl_restaurant
                LEFT JOIN (SELECT ROUND(AVG(tbl_assessment.stars)) AS stars, ROUND(AVG(tbl_assessment.price)) AS price, tbl_restaurant.id_restaurant 
                            FROM tbl_assessment 
                            INNER JOIN tbl_restaurant 
                            ON tbl_assessment.id_restaurant_fk = tbl_restaurant.id_restaurant 
                            GROUP BY tbl_restaurant.id_restaurant) AS queryAVG 
                ON tbl_restaurant.id_restaurant = queryAVG.id_restaurant
                INNER JOIN tbl_type_restaurant
                ON tbl_restaurant.id_restaurant_type_fk = tbl_type_restaurant.id_type_restaurant
                WHERE queryAVG.stars = ? AND tbl_restaurant.id_restaurant_type_fk = ?',[$rating_rest,$type_restaurant])
                ;
            }elseif ($filtro == "" && $type_restaurant != ""  && $rating_rest == ""  && $price_rest != "" ) {
                //Tipo restaurante + Precio
                $restaurants = DB::select('SELECT tbl_restaurant.name, tbl_restaurant.id_restaurant, tbl_restaurant.image_path, tbl_restaurant.description, queryAVG.stars, queryAVG.price  FROM tbl_restaurant
                LEFT JOIN (SELECT ROUND(AVG(tbl_assessment.price)) AS price, ROUND(AVG(tbl_assessment.stars)) AS stars, tbl_restaurant.id_restaurant 
                            FROM tbl_assessment 
                            INNER JOIN tbl_restaurant 
                            ON tbl_assessment.id_restaurant_fk = tbl_restaurant.id_restaurant 
                            GROUP BY tbl_restaurant.id_restaurant) AS queryAVG
                ON tbl_restaurant.id_restaurant = queryAVG.id_restaurant
                INNER JOIN tbl_type_restaurant
                ON tbl_restaurant.id_restaurant_type_fk = tbl_type_restaurant.id_type_restaurant
                WHERE queryAVG.price = ? AND tbl_restaurant.id_restaurant_type_fk = ?',[$price_rest,$type_restaurant])
                ;
            }elseif ($filtro == "" && $type_restaurant == ""  && $rating_rest != ""  && $price_rest != "" ) {
                //Ranquing de popularidad + Precio
                $restaurants = DB::select('SELECT tbl_restaurant.name, tbl_restaurant.id_restaurant, tbl_restaurant.image_path, tbl_restaurant.description, queryAVG.stars, queryAVG.price  FROM tbl_restaurant
                INNER JOIN tbl_assessment
                ON tbl_restaurant.id_restaurant = tbl_assessment.id_restaurant_fk
                GROUP BY tbl_restaurant.name
                HAVING ROUND(AVG(tbl_assessment.price)) = ? AND ROUND(AVG(tbl_assessment.stars)) = ?',[$price_rest,$rating_rest])
                ;
            }elseif ($filtro != "" && $type_restaurant != ""  && $rating_rest != ""  && $price_rest == "" ) {
                //Filtros + Tipo restaurante + Ranquing de popularidad
                $restaurants = DB::select('SELECT tbl_restaurant.name, tbl_restaurant.id_restaurant, tbl_restaurant.image_path, tbl_restaurant.description, queryAVG.stars, queryAVG.price  FROM tbl_restaurant
                LEFT JOIN (SELECT ROUND(AVG(tbl_assessment.price)) AS price, ROUND(AVG(tbl_assessment.stars)) AS stars, tbl_restaurant.id_restaurant
                            FROM tbl_assessment 
                            INNER JOIN tbl_restaurant 
                            ON tbl_assessment.id_restaurant_fk = tbl_restaurant.id_restaurant 
                            GROUP BY tbl_restaurant.id_restaurant) AS queryAVG
                ON tbl_restaurant.id_restaurant = queryAVG.id_restaurant
                INNER JOIN tbl_type_restaurant
                ON tbl_restaurant.id_restaurant_type_fk = tbl_type_restaurant.id_type_restaurant
                WHERE queryAVG.stars = ? AND tbl_restaurant.id_restaurant_type_fk = ? AND tbl_restaurant.name LIKE ?',[$rating_rest,$type_restaurant,"%".$filtro."%"])
                ;
            }elseif ($filtro != "" && $type_restaurant == ""  && $rating_rest != ""  && $price_rest != "" ) {
                //Filtros + Ranquing de popularidad + Precio
                $restaurants = DB::select('SELECT tbl_restaurant.name, tbl_restaurant.id_restaurant, tbl_restaurant.image_path, tbl_restaurant.description, queryAVG.stars, queryAVG.price  FROM tbl_restaurant
                LEFT JOIN (SELECT ROUND(AVG(tbl_assessment.price)) AS price, ROUND(AVG(tbl_assessment.stars)) AS stars, tbl_restaurant.id_restaurant 
                            FROM tbl_assessment 
                            INNER JOIN tbl_restaurant 
                            ON tbl_assessment.id_restaurant_fk = tbl_restaurant.id_restaurant 
                            GROUP BY tbl_restaurant.id_restaurant) AS queryAVG
                ON tbl_restaurant.id_restaurant = queryAVG.id_restaurant
                INNER JOIN tbl_type_restaurant
                ON tbl_restaurant.id_restaurant_type_fk = tbl_type_restaurant.id_type_restaurant
                WHERE queryAVG.stars = ? AND queryAVG.price = ? AND tbl_restaurant.name LIKE ?',[$rating_rest,$price_rest,"%".$filtro."%"])
                ;
            }elseif ($filtro != "" && $type_restaurant != ""  && $rating_rest == ""  && $price_rest != "" ) {
                //Filtros + Tipo restaurante + Precio
                $restaurants = DB::select('SELECT tbl_restaurant.name, tbl_restaurant.id_restaurant, tbl_restaurant.image_path, tbl_restaurant.description, queryAVG.stars, queryAVG.price  FROM tbl_restaurant
                LEFT JOIN (SELECT ROUND(AVG(tbl_assessment.price)) AS price, ROUND(AVG(tbl_assessment.stars)) AS stars, tbl_restaurant.id_restaurant 
                            FROM tbl_assessment 
                            INNER JOIN tbl_restaurant 
                            ON tbl_assessment.id_restaurant_fk = tbl_restaurant.id_restaurant 
                            GROUP BY tbl_restaurant.id_restaurant) AS queryAVG
                ON tbl_restaurant.id_restaurant = queryAVG.id_restaurant
                INNER JOIN tbl_type_restaurant
                ON tbl_restaurant.id_restaurant_type_fk = tbl_type_restaurant.id_type_restaurant
                WHERE queryAVG.price = ? AND tbl_restaurant.id_restaurant_type_fk = ? AND tbl_restaurant.name LIKE ?',[$price_rest,$type_restaurant,"%".$filtro."%"])
                ;
            }elseif ($filtro == "" && $type_restaurant != ""  && $rating_rest != ""  && $price_rest != "" ) {
                //Tipo restaurante + Ranquing de popularidad + Precio
                $restaurants = DB::select('SELECT tbl_restaurant.name, tbl_restaurant.id_restaurant, tbl_restaurant.image_path, tbl_restaurant.description, queryAVG.stars, queryAVG.price  FROM tbl_restaurant
                LEFT JOIN (SELECT ROUND(AVG(tbl_assessment.price)) AS price, ROUND(AVG(tbl_assessment.stars)) AS stars, tbl_restaurant.id_restaurant 
                            FROM tbl_assessment 
                            INNER JOIN tbl_restaurant 
                            ON tbl_assessment.id_restaurant_fk = tbl_restaurant.id_restaurant 
                            GROUP BY tbl_restaurant.id_restaurant) AS queryAVG
                ON tbl_restaurant.id_restaurant = queryAVG.id_restaurant
                LEFT JOIN tbl_type_restaurant
                ON tbl_restaurant.id_restaurant_type_fk = tbl_type_restaurant.id_type_restaurant
                WHERE queryAVG.stars = ? AND queryAVG.price = ? AND tbl_type_restaurant.id_type_restaurant = ?',[$rating_rest,$price_rest,$type_restaurant])
                ;
            }elseif ($filtro != "" && $type_restaurant != ""  && $rating_rest != ""  && $price_rest != "" ) {
                //Todos los filtros
                $restaurants = DB::select('SELECT tbl_restaurant.name, tbl_restaurant.id_restaurant, tbl_restaurant.image_path, tbl_restaurant.description, queryAVG.stars, queryAVG.price  FROM tbl_restaurant
                LEFT JOIN (SELECT ROUND(AVG(tbl_assessment.stars)) AS stars, ROUND(AVG(tbl_assessment.price)) AS price, tbl_restaurant.id_restaurant 
                            FROM tbl_assessment 
                            INNER JOIN tbl_restaurant 
                            ON tbl_assessment.id_restaurant_fk = tbl_restaurant.id_restaurant 
                            GROUP BY tbl_restaurant.id_restaurant) AS queryAVG
                ON tbl_restaurant.id_restaurant = queryAVG.id_restaurant
                INNER JOIN tbl_type_restaurant
                ON tbl_restaurant.id_restaurant_type_fk = tbl_type_restaurant.id_type_restaurant
                WHERE queryAVG.stars = ? AND queryAVG.price = ? AND tbl_type_restaurant.id_type_restaurant = ? AND tbl_restaurant.name LIKE ?',[$rating_rest,$price_rest,$type_restaurant,"%".$filtro."%"])
                ;
            }
            
        }else {
            //Por defecto
            $restaurants = DB::select('SELECT tbl_restaurant.name, tbl_restaurant.id_restaurant, tbl_restaurant.image_path, tbl_restaurant.description, queryAVG.stars, queryAVG.price  FROM tbl_restaurant
            LEFT JOIN (SELECT ROUND(AVG(tbl_assessment.stars)) AS stars, ROUND(AVG(tbl_assessment.price)) AS price, tbl_restaurant.id_restaurant 
                        FROM tbl_assessment 
                        INNER JOIN tbl_restaurant 
                        ON tbl_assessment.id_restaurant_fk = tbl_restaurant.id_restaurant 
                        GROUP BY tbl_restaurant.id_restaurant) AS queryAVG
            ON tbl_restaurant.id_restaurant = queryAVG.id_restaurant
            INNER JOIN tbl_type_restaurant
            ON tbl_restaurant.id_restaurant_type_fk = tbl_type_restaurant.id_type_restaurant');
        }

        // $restaurants = DB::select('SELECT * FROM tbl_restaurant');
        foreach ($restaurants as $i ) {
            if (isset($i->image_path) && $i->image_path !=null) {
                $i->image_path = base64_encode($i->image_path);
            }
        }
        return response()->json($restaurants, 200);
    }

    public function filters(){
        $filtros = DB::select('SELECT * FROM `tbl_type_restaurant`');
        return response()->json($filtros, 200);
    }

    public function registroRestaurante(){
        // Envia a la pagina del registro
        $typeRestaurant = DB::select('SELECT * FROM tbl_type_restaurant');
        return view('formCreateRestaurant', compact('typeRestaurant'));
    }

    public function generarRestaurante(CreateRestaurantControllerRequest $request){
        $datos=$request->except('_token', 'register-boton');
        //recogemos la imagen que viene del form, y nos quedamos con la ruta temportal.
        $img = $request->file('image_path')->getRealPath();
        //nos quedamos solamente con el contenido del fichero para subirlo a la db
        $bin = file_get_contents($img);

        // Recogemos todo el formulario, y lo insertamos en la base de datos
        DB::table('tbl_restaurant')->insertGetId(['name'=>$datos['name'],'description'=>$datos['description'],'image_path'=>$bin,'id_restaurant_type_fk'=>$datos['id_restaurant_type_fk']]);
        // lo redireccionamos a la funcion mostrar para coger la lista con los usuarios
        return view('homeAdmin');
    }

    public function deleteRestaurant(Request $request){
        try {
            if (DB::select('DELETE FROM `tbl_assessment` WHERE id_restaurant_fk = ?', [$request->input('id_restaurant')])) {
                DB::select('DELETE FROM `tbl_restaurant` WHERE id_restaurant = ?', [$request->input('id_restaurant')]);
            }else {
                DB::select('DELETE FROM `tbl_restaurant` WHERE id_restaurant = ?', [$request->input('id_restaurant')]);
            }
            
            
            return response()->json(array('resultado'=>'OK'), 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(array('resultado'=>'NOK'.$th->getMessage()), 200);
        }
    }

    public function actualizar($id){
        // recuperrar alumno a partir del id
        // el first nos quedamos con el 1r id que encuentre
        $restaurant=DB::table('tbl_restaurant')->where('id_restaurant', '=', $id)->first();
        
        //recogemos en otra variable 
        $typesrestaurant=DB::select('SELECT * FROM `tbl_type_restaurant`');
        
        
        // enviar los datos del alumno a la vista
        return view('actualizar', compact('restaurant'), compact('typesrestaurant'));
    }

    public function modificar($id, Request $request){
        // recibir los datos del usuario
        $datos=request()->except('_token','enviar','_method');
        // return $datos;
        // actualizar bd
        DB::table('tbl_restaurant')->where('id_restaurant', '=', $id)->update($datos);
        // redirigir a mostrar
        return redirect('homeAdmin');
    }

    public function opinar($id){
        
        $restaurant=DB::table('tbl_restaurant')->where('id_restaurant', '=', $id)->first();
        // Envia a la pagina del registro
        return view('formValidationRestaurant', compact('restaurant'));
    }

    public function validar(Request $request) {
        $datos=$request->except('_token', 'enviar');
        //recogemos la imagen que viene del form, y nos quedamos con la ruta temportal.
        // Recogemos todo el formulario, y lo insertamos en la base de datos
        DB::table('tbl_assessment')->insertGetId(['stars'=>$datos['estrellas'],'price'=>$datos['monedas'],'id_restaurant_fk'=>$datos['restaurante']]);
        // lo redireccionamos a la funcion mostrar para coger la lista con los usuarios
        return view('homeStandard');
    }
}
