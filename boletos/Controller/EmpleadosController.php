<?php
  
    require_once 'Model/Empleados.php';

 
    class EmpleadosController
    {

        private $model;

        public function __CONSTRUCT()
        {
            $this->model = new empleados();
        }

        public function Cerrar()
        {
            require_once 'views/header.php';
            require_once 'views/empleado/Logout.php';
        }

        public function index1()
        {
            require_once 'views/header.php';
            require_once 'views/empleado/empleado.php';
            
        }

        public function indexAdmin()
        {
            require_once 'views/header.php';
            require_once 'views/empleado/admin.php';
            
        }

        public function index()
        {
            require_once 'views/header.php';
            require_once 'views/empleado/sigin.php';
        }


        public function CrudBoletos()
        {
            $empleados = new empleados();

            if(isset($_REQUEST['id_ticket'])) {
                $empleados = $this->model->obtenerBoletos($_REQUEST['id_ticket']);
            }

            require_once 'views/header.php';
            require_once 'views/empleado/boleto.php';
        }
      
      
        public function verReservas()
        {

            require_once 'views/header.php';
            require_once 'views/empleado/reservas.php';
        }


        public function guardarBoleto()
        {
    
            $boletos = new empleados();


            $boletos->name = $_REQUEST['nameBoleto'];
            $boletos->description = $_REQUEST['descBoleto'];
            $boletos->id_ticket = $_REQUEST['id_ticket'];
            

            $boletos-> id_ticket <> ""
            ? $this->model->actualizarBoleto($boletos)
            : $this->model->registrarBoleto($boletos);
            

            
            require_once 'views/header.php';
            require_once 'views/empleado/admin.php';
        }
    
        public function eliminarBoleto()
        {
            $this->model->eliminarBoleto($_REQUEST['id_ticket']);
            
            require_once 'views/header.php';
            require_once 'views/empleado/admin.php';
        }

        public function verReserva()
        {
        
            $empleados = new empleados();

            if(isset($_REQUEST['id_user'])) {
                $empleados = $this->model->verReserva($_REQUEST['id_user']);
            }

            require_once 'views/header.php';
            require_once 'views/empleado/reservasUsuario.php';
        }

        public function eliminarReserva()
        {
            $this->model->eliminarReserva($_REQUEST['id_reserva'],$_REQUEST['id_ticket']);
            
            require_once 'views/header.php';
            require_once 'views/empleado/admin.php';
        }

        public function crearUsuario()
        {   
            require_once 'views/header.php';
            require_once 'views/empleado/crearUsuario.php';
        }

        public function editarPerfil()
        {
         
            $empleados = new empleados();
            if(isset($_REQUEST['id_user'])) {
                $empleados = $this->model->consulUsuario($_REQUEST['id_user']);
            }

            require_once 'views/header.php';
            require_once 'views/empleado/editarUsuario.php';
        }

        public function verCompradores()
        {
            $this->model->verCompradores();
            require_once 'views/header.php';
            require_once 'views/empleado/compradores.php';
        }


        


        
}
?>