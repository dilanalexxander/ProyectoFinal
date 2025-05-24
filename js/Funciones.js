function encontrarID(texto){
    const checkedRadio = document.querySelector('input[type="radio"]:checked');
    const radioID = checkedRadio.id;
    const idArray = radioID.split(texto);
    return idArray[1];
}

function eliminarCategoria(texto){
    const idEliminar = encontrarID(texto);
    var datos = new FormData();
    datos.append('accion', "eliminar");
    datos.append('id',idEliminar);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../php/ModeloCategoria.php', true);
    xhr.send(datos);
}