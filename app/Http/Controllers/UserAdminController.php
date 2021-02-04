<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//importa la base de datos
use Illuminate\Support\Facades\DB;

//importa la validacion del Registro
use App\Http\Requests\RegisterControllerRequest;

class UserAdminController extends Controller
{
    public function registroUser(){
        // Envia a la pagina del registro
        return view('register');
    }

    public function generarUser(RegisterControllerRequest $request){
        $datos=$request->except('_token', 'enviar');
        // Recogemos todo el formulario, y lo insertamos en la base de datos
        DB::table('tbl_user')->insertGetId(['email'=>$datos['email'],'name'=>$datos['name'],'lastname'=>$datos['lastname'],'pass'=>md5($datos['passwd']),'phone_num'=>$datos['phone_num'],'id_user_type_fk'=>2]);
        // lo redireccionamos a la funcion mostrar para coger la lista con los usuarios
        return view('login');

    }

    public function readadmin(Request $request){
        //variable que recoje los datos de un filtro
        $filtro = $request->input('filtro');

        if ($filtro != "") {
            # code...
        }else {
            $restaurants = DB::select('SELECT * FROM tbl_restaurant');
        }
        foreach ($restaurants as $i ) {
            if ($i->image_path !=null) {
                $i->image_path = base64_encode($i->image_path);
            }
        }
        
        return response()->json($restaurants, 200);
    }

}

