<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    public function register(Request $request){
        // para probar por backend enviar datos en json similando formulario
        // {"doc_identity":"12345","name":"David","surname":"vasquez","email":"dev@gmail.com","password":"123","birthdate":"1999-08-16"}
        // http://localhost/ProyectoDevisson/api-rest-Prueba/public/api/register


        //Recoger datos
        $json = $request->input('json',null);

        $params = json_decode($json); //objeto
        $params_array = json_decode($json, true); //array

        if(!empty($params) && !empty($params_array)){
            //limpiar datos
            $params_array = array_map('trim', $params_array);
            //validar datos
            $validate = \Validator::make($params_array, [
                'doc_identity' => 'required|numeric',
                'name'     => 'required|alpha',
                'surname'  => 'required|alpha',
                'email'    => 'required|email|unique:users',
                // 'birthdate' => 'required|date_format:"YYYY-MM-DD"',
                'password' => 'required'
            ]);

            if($validate->fails()){
            //la validacion fallo
                $data = array(
                    'status' => 'error',
                    'code' => 404,
                    'message' => "El usuario no se ha creado",
                    'errors' => $validate->errors()
                );
            }else{
            // Validacion pasada de manera correcta

            //cifrar contraseña
            $pwd = hash('sha256', $params->password);

            //crear usuario
            $user = new User();
            $user-> doc_identity = $params_array['doc_identity'];
            $user-> name = $params_array['name'];
            $user-> surname = $params_array['surname'];
            $user-> email = $params_array['email'];
            $user-> password = $pwd;
            $user-> birthdate = $params_array['birthdate'];
            $user-> role = 'ROLE_COMPRADOR';

            
            //Guardar usuario
            $user-> save();

            //validacion de si se crea o no

                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => "El usuario se ha creado correctamente",
                    'user' => $params_array
                );

            }
           
        }
        else{
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => "los datos enviados no son correctos"
            );

        }

        return response()-> json($data,$data['code']);

    }

    public function login(Request $request){

        // para probar por back end se debe simular peticion por formulario(jsn)
        // http://localhost/ProyectoDevisson/api-rest-Prueba/public/api/login
        // {"name":"David","surname":"vasquez","email":"dev@gmail.com","password":"123"} para probar
        
        $jwtAuth = new \JwtAuth();
        
        //Recibir los datos por post
        $json = $request->input('json',null);
        $params = json_decode($json);
        $params_array = json_decode($json,true);

        //validar los datos
        $validate = \Validator::make($params_array, [
            'email'    => 'required|email',
            'password' => 'required'
        ]);
        
        if($validate->fails()){
        
        //la validacion fallo
            $signup = array(
                'status' => 'error',
                'code' => 404,
                'message' => "El usuario no se ha podido identificar",
                'errors' => $validate->errors()
            );
            
        }else{
            //cifrar la contraseña
            $pwd = hash('sha256', $params->password);
            //devolver token o datos
            $signup = $jwtAuth->signup($params->email,$pwd);
            if(!empty($params->gettoken)){
                $signup = $jwtAuth->signup($params->email,$pwd,true);
            }

        }
        
        return response()->json($signup,200);
        
    }

    public function update(Request $request){
        // para probar por backend
        // http://localhost/ProyectoDevisson/api-rest-Prueba/public/api/user/update
        // se necesita el token enviar por header('Authorization')

        // Comprobar si el usuario esta identificado
        $token = $request-> header('Authorization');
        $jwtAuth = new \JwtAuth();
        $checkToken = $jwtAuth->checkToken($token);

        // Recoger los datos por Post
        $json = $request->input('json',null);
        $params_array = json_decode($json,true);

        
        if($checkToken && !empty($params_array)){
            
            //sacar usuario identificado
            $user  = $jwtAuth-> checkToken($token,true);

            //Validar datos
            $validate = \Validator::make($params_array, [
                'name'     => 'required|alpha',
                'surname'  => 'required|alpha',
                'email'    => 'required|email|unique:users,'.$user->sub
            ]);


            //Quitar datos que no quiero actualizar
            unset($params_array['id_user']);
            unset($params_array['created_at']);
            unset($params_array['remember_token']);

            if($params_array['password'] && $params_array['email'] == ''){
                unset($params_array['password']);
                unset($params_array['email']);
            }else{
                // Encriptar contraseña
                $pwd = hash('sha256', $params_array['password']);
                $params_array['password'] = $pwd;
            }

            
            //Actualizar usuario en BD
            $user_update = User::where('id_user', $user->sub)->update($params_array);
            //Devolver array con resultado

            $data = array(
                'code'      => 200,
                'status'    => 'success',
                'message'   => 'Usuario modificado con exito',
                'user'      => $user,
                'changes'   => $params_array

            );
            
        }else{
            $data = array(
                'code' => 400,
                'status' => 'error',
                'message' => 'El usuario no esta identificado'

            );
        }

        return response()->json($data, $data['code']);

    }

    public function detail(Request $request){
        //  para probar por backend:
        // http://localhost/ProyectoDevisson/api-rest-Prueba/public/api/user/detail
        // se necesita el token enviar por header('Authorization')

        // // Comprobar si el usuario esta identificado
        $token = $request-> header('Authorization');
        $jwtAuth = new \JwtAuth();
        $checkToken = $jwtAuth->checkToken($token);


        if($checkToken){
            // $user = User::all();
            // Buscamos la informacion del usuario 
            $user = User::select('name','doc_identity',"birthdate")->get();
            // Buscamos el total de los usuarios registrados
            $cant = User::count();

            if(is_object($user)){
                $data = array(
                    'code'      => 200,
                    'status'    => 'success',
                    'cant_user' => $cant,
                    'users'     => $user
                );

            }else{
                $data = array(
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'No hay usuarios disponibles'
                );
            }
        }else{
            $data = array(
                'code' => 400,
                'status' => 'error',
                'message' => 'Debe identificarse para realizar peticiones'

            );
        }
        
        
        return response()->json($data);

    }

}
