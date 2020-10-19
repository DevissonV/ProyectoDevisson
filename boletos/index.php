<?php
    require_once 'model/Conexion.php';

    $controller = 'empleados';

    if (!isset($_REQUEST['e'])) {
        // requerimos el controlador
        require_once "Controller/EmpleadosController.php";
        // el ucwords convierte a mayuscula el primeri caracter de cada palabra de una cadena
        $controller = ucwords($controller).'Controller';
        // 
        $controller = new $controller;
        $controller->index();
    }else{
        //Obtenemos el controlador que queremos cargar
        $controller = strtolower($_REQUEST['e']);
        $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';

        // Instanciamos el controlador
        require_once 'Controller/EmpleadosController.php';
        $controller = ucwords($controller).'Controller';
        $controller = new $controller;

        //Llama la accion
        call_user_func( array( $controller, $accion) );
    }
?>