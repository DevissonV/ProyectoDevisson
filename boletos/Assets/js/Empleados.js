
// Se crea para el inicio de sesion
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

         ///ENVIO PARA AUTENTICAR Y CREAR EL TOKEN EN EL API REST
         // name
         // surname
         // email
         // password
         var name       =  "";
         var surname    =  "";
         var email      =  $("#user").val();
         var password   =  $("#pass").val();

         var obj = { name: name, surname: surname, email:email, password:password};
         var json = JSON.stringify(obj);
         var params = 'json='+json;   
         console.log(params);
      
         $.ajax({
               method: "POST",
               url: "http://localhost/ProyectoDevisson/api-rest-Prueba/public/api/login",
               data:params
         })
         .done(function( data ) {
               console.log(data);
               // localStorage.setItem("token", data);
               sessionStorage.setItem("token",data);
         })
         .fail(function(data){
               alert(data.message);
               alert(data.responseJSON.message);
         });
      }else{
         alertify.set('notifier','position', 'top-center');
         alertify.error('Error: Por favor ingresa las credenciales');
      }
   })
})

//Crear ticket
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

// Se guarda el dato en el local storage para poder crear la reserva
function capturarId(id){
   localStorage.setItem("id_ticket", id);
}

// Crear reserva
$(document).ready(function(){
   $('#btnReservar').click(function(){
      var id = localStorage.getItem("id_ticket");
      var fecha = $("#date_reservation").val();
      $.ajax({
         method:"POST",
         url: "Controller/ReservaController.php",
         data:'id_ticket='+id+'&fecha='+fecha,
         dataType: "html",
         beforeSend:function(){
            $("#login").val("Conectando...");
         }
      }).done(function(response){
 
         if(response == 1){
            alert("Boleto reservado con exito")
            window.location.href = "?e=Empleados&a=Index1";
         }
         else if(response == 2){
            // alert("Su boleto no se ha podido reservar");
            alertify.set('notifier','position', 'top-center');
            alertify.error('Su boleto no se ha podido reservar');
            window.location.href = "?e=Empleados&a=Index1";
         }
         else{
            alert("error");
         }
      }).fail(function(response){
        alert("salio mal");
      })
   })
})


// validar correo
function validarEmail(elemento){

   var texto = document.getElementById(elemento.id).value;
   var regex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
   
   if (!regex.test(texto)) {
      document.getElementById("resulemail").innerHTML = "Correo invalido";
      $('#Guardar').attr("disabled", true);
      $('#Editar').attr("disabled", true);
   } else {
     document.getElementById("resulemail").innerHTML = "";
     $('#Guardar').attr("disabled", false);
     $('#Editar').attr("disabled", false);
   }
 
 }

// Crear usuario consumiendo API REST 
function Register()
{
   // var id_user       = $("#id_user").val();;
   var doc_identity  = $("#doc_identity").val().trim();
   var name          = $("#name").val().trim();
   var surname       = $("#surname").val().trim();
   var email         = $("#email").val().trim();
   var password      = $("#password").val().trim();
   var birthdate     = $("#birthdate").val().trim();


    if (doc_identity != '' && name != '' && surname != '' && email != '' &&  password != '' &&  birthdate != '')
    {
      var obj = { doc_identity: doc_identity, name: name, surname: surname, email:email, password:password,birthdate:birthdate};
      var json = JSON.stringify(obj);
      var params = 'json='+json;   
      console.log(params);
   
        $.ajax({
            method: "POST",
            url: "http://localhost/ProyectoDevisson/api-rest-Prueba/public/api/register",
            data:params
        })
        .done(function( data ) {
            alert(data.message);
            // sessionStorage.setItem('login', email);
            // localStorage.setItem("identity", json);
            window.location.href = "?e=Empleados&a=Index";
        })
        .fail(function(data){
            alert(data.message);
            alert(data.responseJSON.message);
        });
    }else{
        alert("completa todos los campos por favor");
    }
    
}

// Actualizar usuario consumiendo API REST
// rol_user_sesion ---> es el rol del usuario que esta loggeado actualmente
function Update(rol_user_sesion){
      // var id_user       = $("#id_user").val();;
      var doc_identity  = $("#doc_identity").val();
      var name          = $("#name").val();
      var surname       = $("#surname").val();
      var email         = $("#email").val();
      var password      = $("#password").val();
      var birthdate     = $("#birthdate").val();
      var role          = $("#role").val();
   
      // alert(password);
      // alert(email);


   if(rol_user_sesion=='ROLE_ADMIN'){
      pas = 'abc';
      var obj = { name: name, surname: surname, email:email, password:pas};
      var json = JSON.stringify(obj);
      var params = 'json='+json;   
      console.log(params);
   
      $.ajax({
            method: "POST",
            url: "http://localhost/ProyectoDevisson/api-rest-Prueba/public/api/login",
            data:params
      })
      .done(function( data ) {
            console.log(data);
            sessionStorage.setItem("token",data);
            // alert("Si actualizo el token");
      })
      .fail(function(data){
            alert(data.message);
            alert(data.responseJSON.message);
      });
   }



       if (doc_identity != '' && name != '' && surname != '' && email != '' &&  password != '' &&  birthdate != '')
       {
         if(rol_user_sesion=='ROLE_ADMIN'){
            password = "";
         }
         var obj = { doc_identity: doc_identity, name: name, surname: surname, email:email, password:password,birthdate:birthdate,role:role};
         var json = JSON.stringify(obj);
         var params = 'json='+json;  
         // var token = localStorage.getItem("token");
         var token = sessionStorage.getItem("token");
   
         console.log(params);   
           $.ajax({
               method: "PUT",
               url: "http://localhost/ProyectoDevisson/api-rest-Prueba/public/api/user/update",
               data:params, 
               headers: {
                  Authorization: token
              }

              
           })
           .done(function( data ) {
               alert(data.message);
               if(role=='ROLE_COMPRADOR'){
                  window.location.href = "?e=Empleados&a=Index";
               }else if(role=='ROLE_ADMIN'){
                  window.location.href = "?e=Empleados&a=verCompradores";
               }
               
           })
           .fail(function(data){
               alert(data.message);
               alert(data.responseJSON.message);
           });
       }else{
           alert("completa todos los campos por favor");
       }
}


$(document).ready(function(){
   $(".bntCerrarsesion").click(function(){
      localStorage.removeItem('token');      
   })
})




