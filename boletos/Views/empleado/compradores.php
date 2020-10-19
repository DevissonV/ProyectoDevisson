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
<p> Administrador '.$NomS[0]-> name.' '.$NomS[0]-> surname.'</p>
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
        
        <a class="btn btnregresar2" href="?e=Empleados&a=indexAdmin">Regresar</a>
<br><br>

<div class="panel-body">
<div class="table-responsive">
<table class="table table-bordered table-hover" style="border-radius: 4px;" id="tabla">
    <thead>
        <tr>
            <th  style="background-color: #273238; color:white; padding-left: 39%;font-size:1.5em;" colspan="7"> Compradores disponibles</th>
        </tr>
        <tr>
           <th style=" background-color: #273238; color:white;">Documento</th>
           <th style=" background-color: #273238; color:white;">Nombre</th>
           <th style=" background-color: #273238; color:white;">Fecha de nacimiento</th>
           <th style=" background-color: #273238; color:white;">Acciones</th>

        </tr>
    </thead>
    <tbody>
</div>
</div>
        
        <?php foreach($this->model->verCompradores() as $r): ?>
            <tr>
                <td><?php echo $r->doc_identity ?></td>
                <td><?php echo $r->name?>  <?php echo $r->surname?></td>
                <td><?php echo $r->birthdate?></td>
                <td>
                    <a class="btn btneliminar" href="?e=Empleados&a=editarPerfil&id_user=<?php echo $r->id_user ?>">Modificar perfil</a>
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
