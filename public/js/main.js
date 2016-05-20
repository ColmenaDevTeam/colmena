
function confirmarEliminar(formId){
    var form = document.getElementById(formId);
    var msg = "¿Está seguro que desea eliminar el elemento seleccionado?";
    if(formId == 'deleteUsu')
        msg = "¿Está seguro que desea eliminar el usuario seleccionado?";
    if(confirm(msg)){
        form.submit();
    }
    return false;
}
function validarFecha(fecha, nombreItem){
    if(fecha == '' || fecha == null || fecha == 'dd/mm/aaaa' || fecha == 'aa/mm/dd'){
        alert(nombreItem+' está vacío');
        return false;
    }
    return true;
}
