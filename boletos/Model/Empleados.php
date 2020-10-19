    <?php
    /**
     * Se crea la clase empleados que nos va almacenar todos los metodos
     * De nuestra aplicación 
     */
    class empleados{

        /**
        * Comenzamos creando una variable privada llamada Pdo, que por medio de
        * Constructor le vamos a almacenar la conexion a la base de datos
        */
        public $pdo3;
        public $id_user;
        public $doc_identity;
        public $name;
        public $surname;
        public $email;
        public $password;
        public $role;
        public $birthdate;
        public $id_ticket;
   


    public function __CONSTRUCT()
    { 
        try {
            $this->pdo3=Database3::StartUp2();
        }catch (Exception $e) {
            die($e->getMessage());
        }
    }

// Se listan TODAS las reservas para que el administrador las vea
    public function listarReservas()
    {
            try{

            /**
            * Creamos una variable stmt donde le pasamos lo siguiente
            */
            $stmt = $this->pdo3->prepare("SELECT r.id_reserva, t.id_ticket,t.name AS name_ticket ,u.doc_identity,u.name AS name_user, r.date_reservation 
            FROM reservations r
            LEFT JOIN users u ON r.id_user = u.id_user
            LEFT JOIN tickets t ON r.id_ticket = t.id_ticket");
            
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);

        }catch (Exception $e) {
            die($e->getMessage());
        }
    }

// Se listan TODOS los boletos DISPONIBLES
    public function listar()
    {
            try{

            /**
            * Creamos una variable stmt donde le pasamos lo siguiente
            */
            $stmt = $this->pdo3->prepare("SELECT * from tickets where state = 1");
            
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);

        }catch (Exception $e) {
            die($e->getMessage());
        }
    }

// Se actualiza/modifica  del ticket (boleto)
    public function actualizarBoleto($data)
    {
        try{
            $sql = "UPDATE tickets SET 
                    name = ?,
                    description = ?
                    WHERE id_ticket = ?";
        
            $this->pdo3->prepare($sql)->execute(
                array(
                    $data->name,
                    $data->description,
                    $data->id_ticket
                )
                );

        
        }
        catch (Exception $e) {
            die($e->getMessage());
        }
    }

//  Se registra el ticket en la BD
    public function registrarBoleto(Empleados $data){
        $sql = "INSERT INTO tickets (name,description)
        VALUES (?,?)";
        
        /**
         * Luego se ejecuta la query
         */
        $this->pdo3->prepare($sql)->execute(
            array(
                $data->name,
                $data->description
                )
            ); 
            
    }

// Se captura la fecha actual para realizar validaciones en el formulario de reserva
    public function fechaMinina()
    {
        try {

            $stmt = $this->pdo3->prepare("select CURDATE() AS fecha");
            
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
// Se realiza la reserva
    public function realizarReserva($id_ticket,$date_reservation)
    {
        try {

            // session_start();
            $user= ($_SESSION["user"]);

            $sql = "INSERT INTO reservations (id_ticket,id_user,date_reservation)
                VALUES (?,?,?)";
                $this->pdo3->prepare($sql)->execute(
                    array(
                        $id_ticket,
                        $user,
                        $date_reservation
                    )
                    );

            $sql2 = $this->pdo3->prepare("UPDATE tickets SET state = 0 WHERE id_ticket = ?");
            $sql2->execute(array($id_ticket));

            if($sql and $sql2){
                $resp = 1;
            }else{
                $resp = 2;
            }

            return $resp;
        
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
// Se realiza la busqueda de un ticket/boleto
    Public function obtenerBoletos($id_ticket)
    {
        try {

            $stmt = $this->pdo3->prepare("SELECT * FROM tickets WHERE id_ticket = ?");

            $stmt->execute(array($id_ticket));

            return $stmt->fetch(PDO::FETCH_OBJ);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

// Se elimina el ticket/boleto
    public function eliminarBoleto($id_ticket)
    {
        try {

            $stmt = $this->pdo3->prepare("DELETE FROM tickets WHERE Id_ticket = ?");
            $stmt->execute(array($id_ticket));

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

// Se elimina una reserva y se actualiza el estado de un ticket
    public function eliminarReserva($id_reserva,$id_ticket)
    {
        try {

            $stmt = $this->pdo3->prepare("DELETE FROM reservations WHERE Id_reserva = ?");
            $stmt->execute(array($id_reserva));

            $stmt2 = $this->pdo3->prepare("UPDATE tickets SET state = 1 WHERE id_ticket = ?");
            $stmt2->execute(array($id_ticket));

            
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

// Visualizar reserva(comprador)
    public function verReserva($id_user)
    {
        try{
            $stmt = $this->pdo3->prepare("SELECT r.id_reserva, t.id_ticket,t.name AS name_ticket ,u.doc_identity,u.name AS name_user, r.date_reservation 
            FROM reservations r
            LEFT JOIN users u ON r.id_user = u.id_user
            LEFT JOIN tickets t ON r.id_ticket = t.id_ticket WHERE u.id_user = $id_user");            
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        }catch (Exception $e) {
            echo 'No Entro';
        die($e->getMessage());
        }
    }

// Busqueda del nombre del usuario
    public function buscarIdyNombre($Condicion)
    {
        try {            
            $NomC = $this->pdo3->prepare("SELECT doc_identity, name , surname  FROM users WHERE id_user = '$Condicion'");
            $NomC->execute();
            $Exec = ($NomC->fetchAll(PDO::FETCH_OBJ));
            return $Exec;
        } catch (\Throwable $th) {
        }
    }

// Para el login    
// email
// password
    public function BuscarUsuario($email,$password)
    {
        try{
            $stmt = $this->pdo3->prepare("SELECT * FROM users WHERE email ='$email' AND password = '$password'");            
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        }catch (Exception $e) {
            echo 'No Entro';
        die($e->getMessage());
        }
    }

// Para rellenar el formulario de editar el usuario
// id_user
public function consulUsuario($id_user)
{

    try{
        $stmt = $this->pdo3->prepare("SELECT * FROM users WHERE id_user ='$id_user'");            
        $stmt->execute();

        // var_dump($stmt);
        // die();  
        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }catch (Exception $e) {
        echo 'No Entro';
    die($e->getMessage());
    }
}
  

// Consulta para ver todos los compradores
public function verCompradores()
{
    try{
        $stmt = $this->pdo3->prepare("SELECT * FROM users");            
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }catch (Exception $e) {
        echo 'No Entro';
    die($e->getMessage());
    }
}

}
?>