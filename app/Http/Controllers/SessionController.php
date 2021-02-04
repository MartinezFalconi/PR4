<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//importa la base de datos
use Illuminate\Support\Facades\DB;

//importa la validacion del Login
use App\Http\Requests\LoginControllerRequest;

class SessionController extends Controller
{
    public function login(){
        return view('login');
    }
    public function register(){
        return view('register');
    }

    public function requestLogin(LoginControllerRequest $request){
        //recogemos los datso en $data, sin los datos de '_token' y el submit 'enviar'
        $data = $request->except('_token', 'enviar');
        //realiza una query para traer la informacion del usuario (si existe)
        $num_user = DB::table('tbl_user')
                    ->where([['email','=', $data['email']],['pass','=', md5($data['passwd'])]])
                    ->count()
        ; 

            //recogemos el dato para isentificar que tipo de usuario que es
        if ($num_user == 1) {
            //recogemos el dato para isentificar que tipo de usuario es

            $type_user = DB::table('tbl_user')
                            ->select('id_user_type_fk')
                            ->where([['email','=', $data['email']],['pass','=', md5($data['passwd'])]])
                            ->value('id_user_type_fk')
            ;

            if ($type_user == 1) {
                // establece sesion
                $request->session()->put('email',$data['email']);
                //vista del Admin
                return view('homeAdmin');

            }elseif ($type_user == 2) {
                // establece sesion
                $request->session()->put('email',$data['email']);
                //vista del Usuario
                return view('homeStandard');
            }else {
                //devuelve al Login
                return redirect('/');
            }
            
        }else {
            // devuelve al login
            return redirect('/');
        }
    }

    // public function requestStart(Request $request){
    //     if (isset($request->session())) {
    //         if ($request->session()->get('')) {
    //             return view('homeAdmin');
    //         }elseif ($request->session()) {
    //             return view('homeStandard');
    //         }
    //     }
    // }

    public function logout(Request $request){
        $request->session()->forget('user');
        return redirect('/');
    }
    
}
