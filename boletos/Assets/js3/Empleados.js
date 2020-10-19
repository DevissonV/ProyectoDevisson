$(document).ready(function(){
   $('#login').click(function(){
      var user = $("#user").val();
      var pass = $("#pass").val();
      if(user.length > 0 && pass.length > 0){
         $.ajax({
            method:"POST",
            url: "Controller/LogueoController.php",
            data:'user='+user+'&pass='+pass,
            dataType: "html",
            beforeSend:function(){
               $("#login").val("Conectando...");
            }
         }).done(function(response){
            alert(response);
            // if (response == true){
               if(response == 1){
                  alert("Ingreso Exitoso!");
                  window.location.href = "?e=Empleados&a=IndexAdmin";
               }else if(response == 2){
                  alert("Ingreso Exitoso!");
                  window.location.href = "?e=Empleados&a=Index1";
               

            }else{
               $("#login").val("Login");
               alertify.set('notifier','position', 'top-center');
            alertify.error('Error:Usuario o Contraseñsa incorrectas.');
            }
         }).fail(function(response){
           
         })
      }else{
         alertify.set('notifier','position', 'top-center');
         alertify.error('Error: Por favor ingresa las credenciales');
      }
   })
})

//Validar que los campos esten llenos
$(document).ready(function(){
      $("#Guardar").click(function(){
          var documento =  $("#DocumentoIdentidad").val().trim();
          var nombre =  $("#Nombres").val().trim();
          var apellido =  $("#Apellidos").val().trim();
          var fechainicio =  $("#FechaInicioCargo").val().trim();

          if (documento.length == 0 || nombre.length == 0 || apellido.length == 0  || fechainicio.length == 0 || cargo.length == 0) {
					 alert("Todos los campos son obligatorios");
                return false;
          }else{
            alert("Correcto");
            return true;
          }
      })
})

$(document).ready(function(){
   $("#guardarBoleto").click(function(){
       var nombre =  $("#nameBoleto").val().trim();
       var desc =  $("#descBoleto").val().trim();


       if (desc.length == 0 || nombre.length == 0 ) {
             alert("Todos los campos son obligatorios");
             return false;
       }else{
         alert("Correcto");
         return true;
       }
   })
})

// Aca hacemos la peticion para comprobar si el DOCUMENTO existe.
$(document).ready(function(){                   
   var consulta;      
    //hacemos focus
   $("#DocumentoIdentidad").focus();                                           
   //comprobamos si se pulsa una tecla
   $("#DocumentoIdentidad").keyup(function(e){
		//obtenemos el texto introducido en el campo
      consulta = $("#DocumentoIdentidad").val();                 
         //hace la búsqueda
         $("#resultado").delay(250).queue(function(n){      
				$.ajax({
               type: "POST",
               url: "Model/Validaciones.php",
               data: "BuscarDoc="+consulta,
               dataType: "html",
            }).done(function(response){
               	if (response == "Disponible") {
                  $("#resultado").html("<span style='font-weight:bold;color:#FF9E1B;'>Documento Disponible.</span>"); 
                  $('#Guardar').attr("disabled", false);
                  $('#Nombres').attr("disabled", false);
                  $('#Apellidos').attr("disabled", false);
                  $('#Usuario').attr("disabled", false);
                  $('#FechaInicioCargo').attr("disabled", false);
                  $('#IdCargo').attr("disabled", false);
                  $('#CentroCosto').attr("disabled", false);
                  $('#IdPerfilAplicacion').attr("disabled", false);
                  n();
            }else if(response == "NoDisponible"){
                  $("#resultado").html("<span style='font-weight:bold;color:#273238;'>Documento No Disponible.</span>"); 
                  $('#Guardar').attr("disabled", true);
                  $('#Nombres').attr("disabled", true);
                  $('#Apellidos').attr("disabled", true);
                  $('#Usuario').attr("disabled", true);
                  $('#FechaInicioCargo').attr("disabled", true);
                  $('#IdCargo').attr("disabled", true);
                  $('#CentroCosto').attr("disabled", true);
                  $('#IdPerfilAplicacion').attr("disabled", true);
                  n();
            }}).fail(function(){
               alert("error petición ajax");
         	});
         });
		});
});

// Aca hacemos hacemos la peticion para comprobar si el USUARIO existe.
$(document).ready(function(){                     
   var consultaUser;
   //comprobamos si se pulsa una tecla
    	$("#Usuario").keyup(function(e){
         //obtenemos el texto introducido en el campo
         consultaUser = $("#Usuario").val();                     
         //hace la búsqueda
         $("#resultado1").delay(250).queue(function(n) {      
            $.ajax({
               type: "POST",
               url: "Model/Validaciones.php",
               data: "BuscarUser="+consultaUser,
               dataType: "html",
            }).done(function(response){
					if (response == "Disponible") {
						$("#resultado1").html("<span style='font-weight:bold;color:#FF9E1B;'>Usuario Disponible.</span>"); 
                  $('#Guardar').attr("disabled", false);
                  $('#FechaInicioCargo').attr("disabled", false);
                  $('#IdCargo').attr("disabled", false);
                  $('#CentroCosto').attr("disabled", false);
                  $('#IdPerfilAplicacion').attr("disabled", false);
						n();
				  }else if(response == "NoDisponible"){
						  $("#resultado1").html("<span style='font-weight:bold;color:#273238;'>Usuario No Disponible.</span>"); 
                    $('#Guardar').attr("disabled", true);
                    $('#FechaInicioCargo').attr("disabled", true);
                    $('#IdCargo').attr("disabled", true);
                    $('#CentroCosto').attr("disabled", true);
                    $('#IdPerfilAplicacion').attr("disabled", true);
						  n();
				  }
				}).fail(function(){
					alert("error petición ajax");
				})
			})
		});
});

// Aca hacemos la peticion para comprobar si el DOCUMENTO ya existe en CONTROLACTIVOS
function Activos() {
    if( $('#chkctlact').prop('checked') ) {
		//obtenemos el texto introducido en el campo
      consultaActivos = $("#DocumentoIdentidad").val();
      //hace la búsqueda
         $("#resultado2").delay(250).queue(function(n) {      
   			$.ajax({
                  type: "POST",
                     url: "Model/Validaciones.php",
                     data: "BuscarDocA="+consultaActivos,
                     dataType: "html",
                  }).done(function(response){
                        if (response == "Disponible") {
                        $("#resultado2").html("<span style='font-weight:bold;color:#FF9E1B;'>Documento Disponible.</span>"); 
                        n();
                  }else if(response == "NoDisponible"){
                        $("#resultado2").html("<span style='font-weight:bold;color:#273238;'>Documento No Disponible.</span>"); 
								$('#Guardar').attr("disabled", true);
								$('#chkctlact').prop('unchecked')
                        n();
                  }
                 }).fail(function(){
                  		alert("error petición ajax");
                 })
                                          
            });
}
}

// Jquery para ponerle buscador a los SELECT
$(document).ready(function(){ $(".select-css").select2(); });


// Function para solo ingresar numeros en el campo documento
function Solo_Numero(e) {
    var code;
    if (!e) var e = window.event;
    if (e.keyCode) code = e.keyCode;
    else if (e.which) code = e.which;
    var character = String.fromCharCode(code);
    var AllowRegex  = /^[@.\0-9\s-]+$/;
    if (AllowRegex.test(character)) return true;     
    alertify.set('notifier','position', 'top-center');
      alertify.error('Error: Ingresa solo numeros.');
    return false; 
}

// Function para solo ingresar letras en los campos nombres y apellidos.
function Solo_Texto(e) {
   // poner esto en la etiqueta para que funcione:
   // onkeypress="return Solo_Texto(event)"
    var code;
    if (!e) var e = window.event;
    if (e.keyCode) code = e.keyCode;
    else if (e.which) code = e.which;
    var character = String.fromCharCode(code);
    var AllowRegex  = /^[@.\ba-zA-Z\s-]$/;
    if (AllowRegex.test(character)) return true;     
    alertify.set('notifier','position', 'top-center');
      alertify.error('Error: Ingresa solo letras.');
    return false; 
}


