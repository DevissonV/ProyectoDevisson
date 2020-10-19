<?php
require_once '../model/Conexion.php';
require_once '../model/Empleados.php';


if (isset($_POST['user']) && isset($_POST['pass']))
{
      session_start();
      $empleados2 = new empleados();
      try {
      
            $email = (String)$_POST['user'];
            $pass = (String)$_POST['pass'];

            // como se presentan errores con el verify del sha256
            // se implementa login buscando con la contra y el usuario en la Bd si existe algun registro que coincida
            $password= hash('sha256', $pass);
            $BuscarUser = $empleados2->BuscarUsuario($email,$password);

            if($BuscarUser){
                  $user = $_SESSION["user"] =  $BuscarUser[0]->id_user;
                  $user = $_SESSION["role"] =  $BuscarUser[0]->role;

                  if(($BuscarUser[0]->role) == 'ROLE_ADMIN'){
                        $response = 1;
                  }elseif (($BuscarUser[0]->role) == 'ROLE_COMPRADOR') {
                        $response = 2;
                  }
            }
            else{
                  $response = 0;
            }
            echo $response;
      
           
      } catch (\Throwable $th) {
            //throw $th;
      }
}

?>

