function encontrarID(){
    var checkedRadio = document.querySelector('input[type="radio"]:checked');
    var radioID = checkedRadio.id;
    var idArray = radioID.split('-');
    return idArray[1];
}

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