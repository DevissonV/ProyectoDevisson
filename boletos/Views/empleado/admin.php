<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("location:?e=Empleados&a=Index");
}
if (($_SESSION["role"])<> 'ROLE_ADMIN') {
    header("location:?e=Empleados&a=Index");
}

$NomS = $this->model->buscarIdyNombre($_SESSION["user"]);
echo '<header>
<div class="logo">
<img src="assets/img/picture.jpg" class="d-inline-block align-top" alt="">
</div>

<div class="titulo">
<p>Bienvenid@ Administrador '.$NomS[0]-> name.' '.$NomS[0]-> surname.'</p>
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


<a class="btn pull-right bntgris" href="?e=Empleados&a=CrudBoletos">Crear Boleto</a>
<a class="btn btneliminar" href="?e=Empleados&a=verReservas">Ver Reservas</a>
<a class="btn btnver" href="?e=Empleados&a=verCompradores">Ver Compradores</a>
<br><br>

<div class="panel-body">
<div class="table-responsive">
<table class="table table-bordered table-hover" style="border-radius: 4px;" id="tabla">
    <thead>
        <tr>
            <th  style="background-color: #273238; color:white; padding-left: 39%;font-size:1.5em;" colspan="4"> Boletos disponibles</th>
        </tr>
        <tr>
           <th style="width:120px; background-color: #273238; color:white;">Boleto</th>
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
                    <a class="btn bntgris"  href="?e=Empleados&a=CrudBoletos&id_ticket=<?php echo $r->id_ticket; ?>" >Editar</a>

                    <a class="btn btneliminar"  onclick="javascript:return confirm('¿Seguro quieres eliminar este boleto?')" href="?e=Empleados&a=eliminarBoleto&id_ticket=<?php echo $r->id_ticket; ?>">Eliminar</a>
                </td> 
            </tr>
<?php endforeach; ?>
    </tbody>
</table>
</div>
</div>
</body>

<script  src="assets/js/datatable.js">  
</script>

</html>


