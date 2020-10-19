<?php


//  modelo para la conexion 
class Database3
{
    public static function StartUp2()
    {
        $pdo3 = new PDO('mysql:host=localhost;dbname=boletos;charset=utf8', 'root', '');
        $pdo3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo3;
    }
}

?>
