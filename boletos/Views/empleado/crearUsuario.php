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
        Crear usuario
    </div>
</h1>

<ol class="breadcrumb">
    <li><a href="?e=Empleados&a=index"><button class="btn btnregresar">Regresar</button></a></li>
</ol>

<form id="frm-alumno"  method="post" enctype="multipart/form-data" class="form-horizontal">



<!-- id_user
doc_identity
name
surname
email
password
birthdate -->
    <input type="hidden" name="id_user" id="id_user" value=""/>

    <div class="form-group">
    <label class="col-md-2 control-label">Documento: *</label>
    <div class="col-md-8  inputGroupContainer">
    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input type="number" id="doc_identity" name="doc_identity"  minlength="5"   onkeypress="return Solo_Numero(event);" value="" class="form-control" placeholder="Ingresa la cedula porfavor" >
        <div id="resultado"></div>
        </div>
        </div>
      </div>

    <div class="form-group">
    <label class="col-md-2 control-label">Nombre: *</label>
    <div class="col-md-8  inputGroupContainer">
    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input type="text" name="name" id="name" onkeypress="return Solo_Texto(event);" value="" class="form-control" placeholder="Ingresa Nombre" >
        </div>
        </div>
      </div>

    <div class="form-group">
    <label class="col-md-2 control-label">Apellido: *</label>
    <div class="col-md-8  inputGroupContainer">
    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input type="text" name="surname" id="surname" onkeypress="return Solo_Texto(event);" value="" class="form-control" placeholder="Ingresa Apellidos" >
        </div>
        </div>
      </div>

    <div class="form-group">
    <label class="col-md-2 control-label">Email:</label>
    <div class="col-md-8  inputGroupContainer">
    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input type="email" name="email" id="email"  value="" class="form-control" placeholder="Ingresa correo elecrónico" onkeyup="validarEmail(this)">
        <div id="resulemail"></div>
        </div>
        </div>
      </div>
    
      <div class="form-group">
    <label class="col-md-2 control-label">Contraseña: *</label>
    <div class="col-md-8  inputGroupContainer">
    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input type="password" name="password" id="password"  value="" class="form-control" placeholder="Ingresa contraseña" >
        </div>
        </div>
      </div>

      <div class="form-group">
    <label class="col-md-2 control-label">Fecha de nacimiento: *</label>
    <div class="col-md-8  inputGroupContainer">
    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input type="date" name="birthdate" id="birthdate"  value="" class="form-control" placeholder="Ingresa tu fecha de nacimiento" >
        </div>
        </div>
      </div>


    <div class="text-right">
        <button type="button" class="btn btneliminar" id="Guardar" onclick="Register();">Guardar <span class="glyphicon glyphicon-send"></span> </button>
    
    </div>
    </div>
    </form>

    <script>

</script>
