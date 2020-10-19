<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("location:?e=Empleados&a=Index");
}
if (($_SESSION["role"])<> 'ROLE_ADMIN') {
    header("location:?e=Empleados&a=Index");
}
?>
<div class="container">
<div class="row">
        <div class="col-4">
          <div class="text-center">
          <img id="imgNewEdit" src="assets/img/picture.jpg" style="text-align:center;width: 28%;" class="rounded float-right logo" alt="Responsive image">
          </div>     
        </div>
</div>

<h1 class="page-header">
    <div class="TituloNuevoEmpleado">
        <?php echo $empleados->id_ticket != null ? $empleados->name : 'NUEVO BOLETO'; ?>
    </div>
</h1>

<ol class="breadcrumb"> 
    <li><a href="?e=Empleados&a=indexAdmin"><button class="btn btnregresar">Regresar</button></a></li>
    <li class="active"><?php echo $empleados->id_ticket != null ? $empleados->name : 'Nuevo Registro'; ?></li>
</ol>

<form id="frm-alumno" action="?e=Empleados&a=guardarBoleto" method="post" enctype="multipart/form-data" class="form-horizontal">

    <input type="hidden" name="id_ticket" id="id_ticket" value="<?php echo $empleados->id_ticket; ?>"/>

    <div class="form-group">
    <label class="col-md-2 control-label">Nombre: *</label>
    <div class="col-md-8  inputGroupContainer">
    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input type="text" name="nameBoleto" id="nameBoleto" onkeypress="" value="<?php echo $empleados->name; ?>" class="form-control" placeholder="Ingresa el nombre del boleto" >
        </div>
        </div>
    </div>

    <div class="form-group">
    <label class="col-md-2 control-label">Descripción: *</label>
    <div class="col-md-8  inputGroupContainer">
    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input type="text" name="descBoleto" id="descBoleto" " value="<?php echo $empleados->description; ?>" class="form-control" placeholder="Ingresa la descripción del boleto" >
        </div>
        </div>
    </div>


    <div class="text-right">
        <button type="submit" class="btn btneliminar" id="guardarBoleto" >Guardar <span class="glyphicon glyphicon-send"></span> </button>
    </div>


    </form>

    <script>


    $(document).ready(function(){
        $("#frm-alumno").submit(function(){
            return $(this).validate();
        });
    })

</script>
