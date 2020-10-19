<?php
namespace App\Helpers;

use Firebase\JWT\JWT;
use Iluminate\Support\Facades\DB;
use App\User;

class JwtAuth{

    public $key;

    public function __construct(){
        $this->key = 'Esto_Es_La_Clave_Segura_Para_Autenti';
    }

    function signup($email, $password, $getToken = null){
        //buscar usuario y credenciales
        $user = User::where([
            'email' => $email
            // 'password' => $password

        ])->first();
        
        //comprobar si son correctas
        $signup = false;
        if(is_object($user)){
            $signup = true;
        }
        //generar token con datos del usuario
        if($signup){
            $token = array(
                'sub'       =>      $user->id_user,
                'email'     =>      $user->email,
                'name'      =>      $user->name,
                'surname'   =>      $user->surname,
                'role'      =>      $user->role,
                'iat'       =>      time(),
                'exp'       =>      time() + (7*24*60*60)
            );

            $jwt = JWT::encode($token,$this->key,'HS256');
            $decoded =  JWT::decode($jwt, $this->key,['HS256']) ;
            if(is_null($getToken)){
                $data = $jwt; 
            }else{
                $data = $decoded;
            }
            
        }else{
            $data = array(
                'status'    => 'error',
                'message'   => 'Login incorrecto.'
            );
        }

        //devolver datos decodificados o el token en funcion de un parametro

        return $data;

    }

    public function checkToken($jwt, $getIdentity = false){
        $auth = false;

        try{
            $jwt = str_replace('"','',$jwt);
            $decoded = JWT::decode($jwt, $this->key, ['HS256']);    
        }catch(\UnexpectedValueException $e){
            $auth = false;
        }catch(\DomainException $e){
            $auth = false;
        }

        if(!empty($decoded) && is_object($decoded) && isset($decoded->sub)){
            $auth = true;
        }else{
            $auth = false;
        }

        if($getIdentity){
            return $decoded;
        }

        return $auth;

    }

}

?>