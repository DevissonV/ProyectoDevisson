<?php
session_start();

if (!isset($_SESSION["user"])) {
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
        Editar usuario
    </div>
</h1>

<ol class="breadcrumb">
        <?php if ($_SESSION["role"] == "ROLE_ADMIN"): ?>    
            <li><a href="?e=Empleados&a=verCompradores"><button class="btn btnregresar">Regresar</button></a></li>
        <?php  endif; ?>
        <?php if ($_SESSION["role"] == "ROLE_COMPRADOR"): ?>    
            <li><a href="?e=Empleados&a=index"><button class="btn btnregresar">Regresar</button></a></li>
        <?php  endif; ?>
</ol>

<form id="frm-alumno"  method="post" enctype="multipart/form-data" class="form-horizontal">
    <input type="hidden" name="id_user" id="id_user" value=""/>

    <div class="form-group">
    <label class="col-md-2 control-label">Documento: *</label>
    <div class="col-md-8  inputGroupContainer">
    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input type="number" id="doc_identity" name="doc_identity"  minlength="5"   onkeypress="return Solo_Numero(event);" value="<?php echo $empleados[0]->doc_identity; ?>" class="form-control" placeholder="Ingresa la cedula porfavor" >
        <div id="resultado"></div>
        </div>
        </div>
      </div>

    <div class="form-group">
    <label class="col-md-2 control-label">Nombre: *</label>
    <div class="col-md-8  inputGroupContainer">
    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input type="text" name="name" id="name" onkeypress="return Solo_Texto(event);" value="<?php echo $empleados[0]->name; ?>" class="form-control" placeholder="Ingresa Nombre" >
        </div>
        </div>
      </div>
      

    <div class="form-group">
    <label class="col-md-2 control-label">Apellido: *</label>
    <div class="col-md-8  inputGroupContainer">
    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input type="text" name="surname" id="surname" onkeypress="return Solo_Texto(event);" value="<?php echo $empleados[0]->surname; ?>" class="form-control" placeholder="Ingresa Apellidos" >
        </div>
        </div>
      </div>

    <?php if ($_SESSION["role"] == "ROLE_COMPRADOR"): ?>   
        <div class="form-group">
        <label class="col-md-2 control-label">Email:</label>
        <div class="col-md-8  inputGroupContainer">
            <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="email" name="email" id="email"  value="<?php echo $empleados[0]->email; ?>" class="form-control" placeholder="Ingresa correo elecrónico" onkeyup="validarEmail(this)">
                    <div id="resulemail"></div>
                </div>
            </div>
        </div>
    <?php  endif; ?>


    <?php if ($_SESSION["role"] == "ROLE_ADMIN"): ?>  
            <input type="hidden" name="email" id="email"  value="<?php echo $empleados[0]->email; ?>" class="form-control" placeholder="Ingresa correo elecrónico" onkeyup="validarEmail(this)">                   
    <?php  endif; ?>


    <?php if ($_SESSION["role"] == "ROLE_COMPRADOR"): ?>                                                
        <div class="form-group">
            <label class="col-md-2 control-label">Contraseña: *</label>
            <div class="col-md-8  inputGroupContainer">
                <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="password" name="password" id="password"  value="" class="form-control" placeholder="Ingresa contraseña" required >
                </div>
            </div>
        </div>
    <?php  endif; ?>

      <div class="form-group">
    <label class="col-md-2 control-label">Fecha de nacimiento: *</label>
    <div class="col-md-8  inputGroupContainer">
    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input type="date" name="birthdate" id="birthdate"  value="<?php echo $usuario[0]->birthdate; ?>" class="form-control" placeholder="Ingresa tu fecha de nacimiento" >
        </div>
        </div>
      </div>

    
   
    <div class="form-group">
    <label class="col-md-2 control-label">Rol</label>
        <div class="col-md-8  inputGroupContainer">
            <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <select name="role" id="role" class="select-css" >
                    <option  value="ROLE_COMPRADOR">Comprador</option>
                    <?php if ($_SESSION["role"] == "ROLE_ADMIN"): ?>                            
                        <option  value="ROLE_ADMIN">Administrador</option>
                    <?php  endif; ?>
                </select>
            </div>
        </div>
    </div>
        

    

    <div class="text-right">
        <button type="button" class="btn btneliminar" id="Editar" onclick="Update('<?php echo $_SESSION['role']?>');">Editar <span class="glyphicon glyphicon-send"></span> </button>
    
    </div>
    </div>
    </form>

    <script>

</script>
