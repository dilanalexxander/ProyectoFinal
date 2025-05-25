function encontrarID(){
    var checkedRadio = document.querySelector('input[type="radio"]:checked');
    var radioID = checkedRadio.id;
    var idArray = radioID.split('-');
    return idArray[1];
}


//FUNCIONES CATEGORIA
function agregarCategoria(){
    var nombreTexto = $("#cname").val();
    var archivoInput = document.getElementById("cfoto");

    if(nombreTexto === '' || archivoInput.files.length === 0){
        alert("Favor de llenar todos los campos");
        return;
    }else{
         var xhr = new XMLHttpRequest();
         var archivo = archivoInput.files[0];
         var datos = new FormData();
         datos.append('accion', "crear");
         datos.append('Nombre', nombreTexto);
         datos.append('Foto', archivo);  

          xhr.open('POST', '../php/ModeloCategoria.php', true);
          xhr.onload = function () {
            console.log("Respuesta:", xhr.responseText);
            if (xhr.status === 200) {
                alert("Categoría agregada correctamente.");
                // Puedes limpiar los campos o recargar la tabla, etc.
                $("#cname").val('');
                $("#cfoto").val('');
            } else {
                alert("Error al agregar la categoría. Inténtalo de nuevo.");
            }
        }
    };

        xhr.onerror = function () {
            alert("Error de red. Verifica tu conexión.");
        };
          xhr.send(datos);
}

function eliminarCategoria(){
    if(!confirm("¿Estás seguro de que deseas eliminar esta categoría?")){
        return;
    }
    else{
    var xhr = new XMLHttpRequest();
    var idEliminar = encontrarID();

    var datos = new FormData();
    datos.append('accion', "eliminar");
    datos.append('id',idEliminar);

    xhr.open('POST', '../php/ModeloCategoria.php', true);
    xhr.onload = function () {
       //console.log("Respuesta:", xhr.responseText);
        if (xhr.status === 200) {
            var respuesta = JSON.parse(xhr.responseText);
            if (respuesta.statusCode == 200) {
                alert("Categoría eliminada correctamente");
                location.reload();  // Recargar tabla o actualizar DOM
            } else {
                alert("Error: " + (respuesta.error || "No se pudo eliminar"));
            }
        }
        }
    };
     xhr.onerror = function () {
            alert("Error de red. Verifica tu conexión.");
        };
    xhr.send(datos);
}


//FUNCIONES HORAS
function agregarHora(){
    var horaTexto = $("#hhora").val();

    if(horaTexto === ''){
        alert("Favor de agregar la hora");
        return;
    }else{
         var xhr = new XMLHttpRequest();

         var datos = new FormData();
         datos.append('accion', "crear");
         datos.append('Hora', horaTexto);

          xhr.open('POST', '../php/ModeloHora.php', true);
          xhr.onload = function () {
            console.log("Respuesta:", xhr.responseText);
            if (xhr.status === 200) {
                alert("Hora agregada correctamente.");
                // Puedes limpiar los campos o recargar la tabla, etc.
                $("#hhora").val('');
            } else {
                alert("Error al agregar la hora. Inténtalo de nuevo.");
            }
        }
    };

        xhr.onerror = function () {
            alert("Error de red. Verifica tu conexión.");
        };
          xhr.send(datos);
}


//FUNCIONES CANTIDAD PERSONAS
function agregarCantidadP(){
    var cantidadTexto = $("#pnumber").val();

    if(cantidadTexto === ''){
        alert("Favor de agregar la cantidad de personas");
        return;
    }else{
         var xhr = new XMLHttpRequest();

         var datos = new FormData();
         datos.append('accion', "crear");
         datos.append('Cantidad', cantidadTexto);

          xhr.open('POST', '../php/ModeloCantidad.php', true);
          xhr.onload = function () {
            console.log("Respuesta:", xhr.responseText);
            if (xhr.status === 200) {
                alert("Cantidad de personas agregada correctamente.");
                // Puedes limpiar los campos o recargar la tabla, etc.
                $("#pnumber").val('');
            } else {
                alert("Error al agregar la cantidad de personas. Inténtalo de nuevo.");
            }
        }
    };

        xhr.onerror = function () {
            alert("Error de red. Verifica tu conexión.");
        };
          xhr.send(datos);
}


//FUNCIONES OPINIONES
function agregarOpinion(idUSer){
    var reservacionTexto = $('#rFecha').find(":selected").text();
    var opinionTexto = $("#rOpinion").val();
    var estrellasTexto = $('#rEstrellas').find(":selected").text();

    if(opinionTexto === '' || reservacionTexto === '' || estrellasTexto === ''){
        alert("Favor de llenar todos los campos.");
        return;
    }else{
         var xhr = new XMLHttpRequest();

         var datos = new FormData();
         datos.append('accion', "crear");
         datos.append('ReservacionID', reservacionTexto);
         datos.append('Comentario', opinionTexto);
         datos.append('Calificacion', estrellasTexto);

          xhr.open('POST', '../php/ModeloOpinion.php', true);
          xhr.onload = function () {
            console.log("Respuesta:", xhr.responseText);
            if (xhr.status === 200) {
                alert("Opinión agregada correctamente.");
                // Puedes limpiar los campos o recargar la tabla, etc.
                $("#rOpinion").val('');
                $('#rFecha option[value="default"]').prop('selected', true);
                $('#rEstrellas option[value="1E"]').prop('selected', true);
            } else {
                alert("Error al realizar tu reservación. Inténtalo de nuevo.");
            }
        }
    };

        xhr.onerror = function () {
            alert("Error de red. Verifica tu conexión.");
        };
          xhr.send(datos);
}


//FUNCIONES RESERVACIONES
function agregarReserva(idUSer){
    var fechaVal = $("#fechaR").val();
    var fechaTexto = fechaVal.replace("-", "/");
    var cantidadTexto = $('#PersonasR').find(":selected").text();
    var horaTexto = $('#HoraR').find(":selected").text();

    if(fechaTexto === '' || cantidadTexto === '' || horaTexto === ''){
        alert("Favor de llenar todos los campos.");
        return;
    }else{
         var xhr = new XMLHttpRequest();

         var datos = new FormData();
         datos.append('accion', "crear");
         datos.append('UsuarioID', idUSer);
         datos.append('HorarioID', horaTexto);
         datos.append('CantidadID', cantidadTexto);
         datos.append('Fecha', fechaTexto);
         datos.append('EstadoID', "1");

          xhr.open('POST', '../php/ModeloReservacion.php', true);
          xhr.onload = function () {
            console.log("Respuesta:", xhr.responseText);
            if (xhr.status === 200) {
                alert("Reservación realizada correctamente.");
                // Puedes limpiar los campos o recargar la tabla, etc.
                $("#fechaR").val('');
                $('#PersonasR option[value="personadefault"]').prop('selected', true);
                $('#HoraR option[value="horadefault"]').prop('selected', true);
            } else {
                alert("Error al agregar tu opinión. Inténtalo de nuevo.");
            }
        }
    };

        xhr.onerror = function () {
            alert("Error de red. Verifica tu conexión.");
        };
          xhr.send(datos);
}

function agregarReservaAdmin(){
    var userTexto = $("#nombreR").val();
    var fechaVal = $("#fechaR").val();
    var fechaTexto = fechaVal.replace("-", "/");
    var cantidadTexto = $('#PersonasR').find(":selected").text();
    var horaTexto = $('#HoraR').find(":selected").text();

    if(fechaTexto === '' || cantidadTexto === '' || horaTexto === ''){
        alert("Favor de llenar todos los campos.");
        return;
    }else{
         var xhr = new XMLHttpRequest();

         var datos = new FormData();
         datos.append('accion', "crearAdmin");
         datos.append('Nombre', userTexto);
         datos.append('HorarioID', horaTexto);
         datos.append('CantidadID', cantidadTexto);
         datos.append('Fecha', fechaTexto);
         datos.append('EstadoID', "1");

          xhr.open('POST', '../php/ModeloReservacion.php', true);
          xhr.onload = function () {
            console.log("Respuesta:", xhr.responseText);
            if (xhr.status === 200) {
                alert("Reservación realizada correctamente.");
                // Puedes limpiar los campos o recargar la tabla, etc.
                $("#nombreR").val('');
                $("#fechaR").val('');
                $('#PersonasR option[value="personadefault"]').prop('selected', true);
                $('#HoraR option[value="horadefault"]').prop('selected', true);
            } else {
                alert("Error al realizar la reservación. Inténtalo de nuevo.");
            }
        }
    };

        xhr.onerror = function () {
            alert("Error de red. Verifica tu conexión.");
        };
          xhr.send(datos);
}


//FUNCIONES USUARIOS
function agregarUsuario(){
    var usuarioTexto = $("#uName").val();
    var userTexto = $("#uUser").val();
    var telefonoTexto = $("#uTel").val();
    var contrasenaTexto = $("#uPass").val();

    if(usuarioTexto === '' || userTexto === '' || telefonoTexto === '' || contrasenaTexto === ''){
        alert("Favor de llenar todos los campos.");
        return;
    }else{
         var xhr = new XMLHttpRequest();

         var datos = new FormData();
         datos.append('accion', "crear");
         datos.append('Nombre', usuarioTexto);
         datos.append('NombreUsuario', userTexto);
         datos.append('Telefono', telefonoTexto);
         datos.append('Contrasena', contrasenaTexto);
         datos.append('TipoID', "1");

          xhr.open('POST', '../php/ModeloUsuario.php', true);
          xhr.onload = function () {
            console.log("Respuesta:", xhr.responseText);
            if (xhr.status === 200) {
                alert("Usuario creado correctamente.");
                // Puedes limpiar los campos o recargar la tabla, etc.
                $("#uName").val('');
                $("#uUser").val('');
                $("#uTel").val('');
                $("#uPass").val('');
            } else {
                alert("Error al crear usuario. Inténtalo de nuevo.");
            }
        }
    };

        xhr.onerror = function () {
            alert("Error de red. Verifica tu conexión.");
        };
        xhr.send(datos);
}

function iniciarSesion(){
    var telefonoTexto = $("#uTel").val();
    var contrasenaTexto = $("#uPass").val();

    if(telefonoTexto === '' || contrasenaTexto === ''){
        alert("Favor de llenar todos los campos.");
        return;
    }else{
         var xhr = new XMLHttpRequest();

         var datos = new FormData();
         datos.append('accion', "iniciarSesion");
         datos.append('Telefono', telefonoTexto);
         datos.append('Contrasena', contrasenaTexto);
         

          xhr.open('POST', '../php/ModeloUsuario.php', true);
          xhr.onload = function () {
            console.log("Respuesta:", xhr.responseText);
            if (xhr.status === 200) {
                //alert("Usuario creado correctamente.");
                // Puedes limpiar los campos o recargar la tabla, etc.
                $("#uTel").val('');
                $("#uPass").val('');
            } else {
                alert("Error al iniciar sesión. Inténtalo de nuevo.");
            }
        }
    };

        xhr.onerror = function () {
            alert("Error de red. Verifica tu conexión.");
        };
        xhr.send(datos);
}

function agregarUsuarioAdmin(){
    var tipoTexto = $('#uTipo').find(":selected").val();
    var usuarioTexto = $("#uName").val();
    var userTexto = $("#uUser").val();
    var telefonoTexto = $("#uTel").val();
    var contrasenaTexto = $("#uPass").val();

    if(usuarioTexto === '' || userTexto === '' || telefonoTexto === '' || contrasenaTexto === '' || tipoTexto === ''){
        alert("Favor de llenar todos los campos.");
        return;
    }else{
         var xhr = new XMLHttpRequest();

         var datos = new FormData();
         datos.append('accion', "crearAdmin");
         datos.append('Nombre', usuarioTexto);
         datos.append('NombreUsuario', userTexto);
         datos.append('Telefono', telefonoTexto);
         datos.append('Contrasena', contrasenaTexto);
         datos.append('TipoID', tipoTexto );

          xhr.open('POST', '../php/ModeloUsuario.php', true);
          xhr.onload = function () {
            console.log("Respuesta:", xhr.responseText);
            if (xhr.status === 200) {
                alert("Usuario creado correctamente.");
                // Puedes limpiar los campos o recargar la tabla, etc.
                $('#uTipo option[value="default"]').prop('selected', true);
                $("#uName").val('');
                $("#uUser").val('');
                $("#uTel").val('');
                $("#uPass").val('');
            } else {
                alert("Error al crear usuario. Inténtalo de nuevo.");
            }
        }
    }
}
