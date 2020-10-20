function inicio() {
    traerDatosEncuestador();
    $("#form_informacion_personal").on("submit", function(e) {
        actualizar_datos(e);
    });
    $("#form_cambiar_clave").on("submit", function(e) {
        cambiar_clave(e);
    });
}
inicio();

function traerDatosEncuestador() {
    $.ajax({
        method: "GET",
        processData: false,
        contentType: false,
        cache: false,
        url: "Perfil/traerInfo",
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
            $("#cedula").val(datos.user);
            $("#nombre").val(datos.nombre);
            $("#celular").val(datos.celular);
            $("#correo").val(datos.correo);
            Funciones.cerrarModalCargando();
        },
        error: function() {
            Funciones.cerrarModalCargando();
            Funciones.mensajeCerroSesion();
        }
    });
}

function actualizar_datos(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    var objeto = new FormData($("#form_informacion_personal")[0]);
    $.ajax({
        method: "POST",
        processData: false,
        contentType: false,
        cache: false,
        data: objeto,
        url: "Perfil/actualizarDatos",
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
            Funciones.cerrarModalCargando();
            if (datos.success == true) {
                alertify.success("<center><b style='color:white;'>Datos actualizados exitosamente</b></center>");
                $("#span-nombre-usuario").text($("#nombre").val());
            } else {
                if (datos.caso == 1) {
                    alertify.error("<center><b style='color:white;'>Error, faltaron campos por digitar</b></center>");
                } else if (datos.caso == 2) {
                    alertify.error("<center><b style='color:white;'>No fue posible actualizar los datos, por favor intentelo de nuevo</b></center>");
                }
            }
        },
        error: function() {
            Funciones.cerrarModalCargando();
            Funciones.mensajeCerroSesion();
        }
    });
}

function cambiar_clave(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    var objeto = new FormData($("#form_cambiar_clave")[0]);
    $.ajax({
        method: "POST",
        processData: false,
        contentType: false,
        cache: false,
        data: objeto,
        url: "Perfil/actualizarClave",
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
            Funciones.cerrarModalCargando();
            if (datos.success == true) {
                alertify.success("<center><b style='color:white;'>Contraseña actualizada exitosamente</b></center>");
                $("#form_cambiar_clave")[0].reset();
            } else {
                if (datos.caso == 1) {
                    alertify.error("<center><b style='color:white;'>Error, faltaron campos por digitar</b></center>");
                } else if (datos.caso == 2) {
                    alertify.error("<center><b style='color:white;'>Error, la contraseña actual digitada no coincide con la almacenada en el sistema</b></center>");
                } else if (datos.caso == 3) {
                    alertify.error("<center><b style='color:white;'>Error las contraseñas nuevas no coinciden</b></center>");
                } else {
                    alertify.error("<center><b style='color:white;'>Error no fue posible actualizar la contraseña, por favor intentelo de nuevo</b></center>");
                }
            }
        },
        error: function() {
            Funciones.cerrarModalCargando();
            Funciones.mensajeCerroSesion();
        }
    });
}