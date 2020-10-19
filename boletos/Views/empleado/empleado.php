<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("location:?e=Empleados&a=Index");
}

if (($_SESSION["role"])<> 'ROLE_COMPRADOR') {
    header("location:?e=Empleados&a=Index");
}

$NomS = $this->model->buscarIdyNombre($_SESSION["user"]);
echo '<header>
<div class="logo">
<img src="assets/img/picture.jpg" class="d-inline-block align-top" alt="">
</div>

<div class="titulo">
 <p>Bienvenid@ comprador '.$NomS[0]-> name.' '.$NomS[0]-> surname.'</p>
</div>

<div class="Cerrar">
<a class="btn pull-right bntCerrarsesion" href="?e=Empleados&a=Cerrar">Cerrar Sesión</a>
</div>

<div class="espacio">
</div>
</header>
'
?>

<div class="body">
    <div class="container">

    <a class="btn pull-right bntgris" href="?e=Empleados&a=verReserva&id_user=<?php echo $_SESSION["user"] ?>">Ver Reservas</a>    
    <a class="btn btneliminar" href="?e=Empleados&a=editarPerfil&id_user=<?php echo $_SESSION["user"] ?>">Modificar perfil</a>


<br><br>

<div class="panel-body">
<div class="table-responsive">
<table class="table table-bordered table-hover" id="tabla">
    <thead>

        <tr>
            <th  style="background-color: #273238; color:white; padding-left: 33%;font-size:1.5em;" colspan="4"> Boletos disponibles para reservar</th>
        </tr>
        <tr>
           <th style="width:120px; background-color: #273238; color:white;" id="id_ticket">Boleto</th>
           <th style="background-color: #273238; color:white;">Nombre</th>
           <th style=" background-color: #273238; color:white;">Descripción</th>
           <th style=" background-color: #273238; color:white;">Acciones</th>

        </tr>
    </thead>
    <tbody>
</div>
</div>
        
        <?php foreach($this->model->listar() as $r): ?>
            <tr>
                <td><?php echo $r->id_ticket ?></td>
                <td><?php echo $r->name ?></td>
                <td><?php echo $r->description ?></td>
                <td>
                    
                    <!-- <a href="#miModalass" class="btngris">Abrir Modal</a> -->
                    <a class="btn bntgris verReservas" href="#miModalass"  id="<?php echo $r->id_ticket ?>"  onclick="capturarId(<?php echo $r->id_ticket ?>) "  >Realizar reserva</a>
                    <div id="miModalass" class="modaldd">
                        <div class="modal-contenido">
                            <a href="#">X</a>
                            <form id="frm-reserva"   method="post">
                            <h2 style="text-align: center;">Ingresa la fecha en que deseas realizar la reserva</h2>
                            <div style="padding-left: 40%;">
                            <?php $fecha_hoy = $this->model-> fechaMinina();?>    
                                <input type="date" name="date_reservation" id="date_reservation" value="<?php  echo $fecha_hoy[0]-> fecha?>" class="form-control"  min="<?php  echo $fecha_hoy[0]-> fecha?>" max="2021-12-31" required>
                                <div style="margin-right: 39%;">
                                    <button type="button" style="margin-top: 6%;" id="btnReservar" >Reservar <span class="glyphicon glyphicon-send"></span>  </button>
                                </div>
                            </div>
                        </div>  
                    </div>

                </td> 
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>
</div>
</div>








<script  src="assets/js/datatable.js">  
</script>


</html>