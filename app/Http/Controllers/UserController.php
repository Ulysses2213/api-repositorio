<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use stdClass;

class UserController extends Controller
{
    public function authUser(Request $request){
        $user = DB::select('select * from user where username = ?', [$request -> username]);
        if(!empty($user)){
            $arrayJson = json_decode(json_encode($user), true);
            if(password_verify($request -> password, $arrayJson[0]['pass'])){
                $response = new stdClass();
                $response -> id = $arrayJson[0]['ID'];
                $response -> username = $arrayJson[0]['username'];
                $response -> name = $arrayJson[0]['name'];
                $response -> firstname = $arrayJson[0]['firstname'];
                $response -> secondname = $arrayJson[0]['secondname'];
                $response -> usertype = $arrayJson[0]['usertype'];
                $response -> logged = true;
                return json_decode(json_encode($response), true);
            }else{
                return -1;
                /*
                return response() -> json([
                    'Mensaje' => 'La contraseña es incorrecta'
                ]);*/
            }
        }else{
            return -2;
            /*
            return response() -> json([
                'Mensaje' => 'No existe el usuario dentro de la base de datos'
            ]);*/
        }
    }

    public function addUser(Request $request){
        $userExist = DB::select('select username from user where username = ?', [$request -> username]);
        if(empty($userExist)){
            //Encriptación del password
            $password = password_hash($request -> password, PASSWORD_BCRYPT);
            $user = DB::insert('insert into user (username, pass, name, firstname, secondname, usertype) 
            values (?,?,?,?,?,?)',
            [
                $request -> username,
                $password,
                $request -> name,
                $request -> firstname,
                $request -> secondname,
                $request -> usertype
            ]);
            return response() -> json([
                'Mensaje' => 'El usuario se ha creado correctamente',
                'data' => $user
            ]);
        }
    }

    
}
