
function confirmarEliminar(formId){
    var form = document.getElementById(formId);
    var msg = "¿Está seguro que desea eliminar el elemento seleccionado?";
    if(confirm(msg)){
        form.submit();
        return true;
    }
    return false;
}
