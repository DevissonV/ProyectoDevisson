<?php
require_once '../model/Conexion.php';
require_once '../model/Empleados.php';


      session_start();
      $empleados = new empleados();
      try {
      
            $id_ticket = (String)$_POST['id_ticket'];
            $fecha = (String)$_POST['fecha'];

            $reservar = $empleados->realizarReserva($id_ticket,$fecha);

            if($reservar == 1){
                $response = 1;
            }else{
                $response = 2;
            }

            echo $response;
      
           
      } catch (\Throwable $th) {
            //throw $th;
      }

?>

