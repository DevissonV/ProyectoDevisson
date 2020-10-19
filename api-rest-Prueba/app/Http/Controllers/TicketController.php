<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;


class TicketController extends Controller
{
    public function detailTicket(Request $request){
        //  para probar por backend:
        // http://localhost/ProyectoDevisson/api-rest-Prueba/public/api/ticket
        // se necesita el token enviar por header('Authorization')

        // // Comprobar si el usuario esta identificado
        $token = $request-> header('Authorization');
        $jwtAuth = new \JwtAuth();
        $checkToken = $jwtAuth->checkToken($token);


        if($checkToken){

            // realizar busqueda de boletos disponibles
            $ticket = Ticket::where("state","=",1)->get();            
            $cant = Ticket::count();

            if(is_object($ticket)){
                $data = array(
                    'code'      => 200,
                    'status'    => 'success',
                    'cant_ticket_Dispo' => $cant,
                    'ticket'     => $ticket
                );

            }else{
                $data = array(
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'No hay boletos disponibles'
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
