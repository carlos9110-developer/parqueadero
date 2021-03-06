function inicio()
{
	$("#form-usuarios").on("submit", function(e) {
        accion_form(e);
    });
}
inicio();

// función donde se guarda un determinado cliente
function accion_form(e) 
{
    e.preventDefault(); //No se activará la acción predeterminada del evento
    var objeto = new FormData($("#form-usuarios")[0]);
    console.log(objeto);
    $.ajax({
        method: "post",
        processData: false,
        contentType: false,
        cache: false,
        data: objeto,
        url: `${ruta}/RegistroUsuariosAdministrador/editarForm`,
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
            console.log("estos son los datos que retorna",datos);
            if(datos.success){
                alertify.success("<center><b style='color:white;'>"+datos.msg+"</b></center>");
            }else{
                alertify.error("<center><b style='color:white;'>"+datos.msg+"</b></center>");
            }
            Funciones.cerrarModalCargando();
        },
        error: function(msj) {
            console.log(msj);
            Funciones.cerrarModalCargando();
        }
    });
}

