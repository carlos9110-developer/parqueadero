var tbl_usuarios;
var idUsuarios = 0;

// función que se inicia al empezar el archivo
function inicio() {
    esconderElementosForm();
    listar();
    $("#form-usuarios").on("submit", function(e) { accion_form(e); });
}
inicio();

// función donde se lista la tabla con los clientes registrados
function listar() {
    tbl_usuarios = $("#tbl_usuarios").DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        pageLength: 5,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        ajax: {
            url: "RegistroUsuariosAdministrador/listar",
            type: "GET",
            dataType: "json"
        },
        columns: [{
                data: "id"
            },
            {
                data: "cedula",

                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    if (oData.estado == "Activado") {
                        $(nTd).html(oData.cedula + '<br/><i title="Editar Registro"  onclick="abrirEditar(' + oData.id + ')" style="color:gold;" class="fas fa-edit pointer"></i> <i title="Desactivar Usuario" onclick="abrirDesactivar(' + oData.id + ')" class="fas fa-minus-square pointer" style="color:#F23647;"></i>');
                    } else {
                        $(nTd).html(oData.cedula + '<br/><i title="Editar Registro"  onclick="abrirEditar(' + oData.id + ')" style="color:gold;" class="fas fa-edit pointer"></i> <i title="Activar Usuario" onclick="abrirActivar(' + oData.id + ')" class="fas fa-plus-square pointer" style="color:#5FE36D;"></i>');
                    }
                }
            },
            {
                data: "nombre"
            },
            {
                data: "telefono"
            },
            {
                data: "correo"
            },
            {
                data: "user"
            },
            {
                data: "estado"
            }
        ],
        columnDefs: [{
                className: "dt-center",
                targets: "_all"
            },
            {
                targets: [0],
                visible: false
            }
        ],
        lengthChange: true,
        responsive: true,
        order: [
            [0, "desc"]
        ], //Ordenar (columna,orden)
        lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50]
        ]
    });
}

// funciòn donde se esconden los elementos de un formulario
function esconderElementosForm() {
    $("#div-form-usuarios").hide();
    $("#btn_cerrar_formulario").hide();
    $("#btn_guardar").hide();
}


function abrirForm() {
    $("#div-listado-usuarios").hide();
    $("#div-form-usuarios").show();
    $("#div-titulo-form").html('<i class="fas fa-address-book"></i> Registro Usuario');
    $("#btn_cerrar_formulario").show();
    $("#btn_guardar").show();
    $("#btn_guardar").html('<i class="fas fa-save"></i> Registrar');
    $(".btn-abrir-registrar-usuario").hide();
    idUsuarios = 0;
}

function cerrarForm() {
    esconderElementosForm();
    $("#div-listado-usuarios").show();
    $(".btn-abrir-registrar-usuario").show();
    $("#form-usuarios")[0].reset();
}

// función donde se guarda un determinado cliente
function accion_form(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    var objeto = new FormData($("#form-usuarios")[0]);

    if (idUsuarios == 0) {
        guardar(objeto);
    } else {
        editar(objeto);
    }
}

function guardar(objeto) {
    $.ajax({
        method: "post",
        processData: false,
        contentType: false,
        cache: false,
        data: objeto,
        url: "Usuarios/insertar",
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
            console.log(datos);
            Funciones.cerrarModalCargando();
            if (datos.success == true) {
                alertify.success("<center><b style='color:white;'>Usuario registrado exitosamente</b></center>");
                cerrarForm();
                tbl_usuarios.ajax.reload();
            }
            if (datos.success == false) {
                if (datos.caso == 1) {
                    alertify.error("<center><b style='color:white;'>Error, faltaron campos por digitar</b></center>");
                } else {
                    alertify.error("<center><b style='color:white;'>No fue posible registrar el usuario, por favor verifique que no exista un usuario con la misma cédula</b></center>");
                }
            }
        },
        error: function() {
            Funciones.cerrarModalCargando();
            alertify.error("<center><b style='color:white;'>Error, se presento un problema en el servidor al realizar la acción, intentelo de nuevo</b></center>");
        }
    });
}

// función donde se abre el form con los datos de un determinado registro
function abrirEditar(id) {
    $("#div-listado-usuarios").hide();
    $("#div-form-usuarios").show();
    $("#div-titulo-form").html('<i class="fas fa-address-book"></i> Actualización Datos');
    $("#btn_cerrar_formulario").show();
    $("#btn_guardar").show();
    $("#btn_guardar").html('<i class="fas fa-save"></i> Editar');
    $(".btn-abrir-registrar-usuario").hide();
    idUsuarios = id;
    traerDatosRegistro(idUsuarios);
}

// función donde se traen los datos de un determinado registro
function traerDatosRegistro(id) {
    $.ajax({
        method: "GET",
        processData: false,
        contentType: false,
        cache: false,
        url: "Usuarios/traerDatos/" + id,
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
            console.log(datos);
            setearDatos(datos);
            Funciones.cerrarModalCargando();
        },
        error: function() {
            Funciones.cerrarModalCargando();
            alertify.error(
                "<center><b style='color:white;'>Error, se presento un problema en el servidor al realizar la acción, intentelo de nuevo</b></center>"
            );
        }
    });
}

// función donde se setean los datos
function setearDatos(datos) {
    $("#cedula").val(datos.user);
    $("#nombre").val(datos.nombre);
    $("#tipo_usuario").val(datos.tipo_usuario);
    $("#celular").val(datos.celular);
    $("#correo").val(datos.correo);
}

// función donde se edita un determinado registro
function editar(objeto) {
    $.ajax({
        method: "post",
        processData: false,
        contentType: false,
        cache: false,
        data: objeto,
        url: "Usuarios/editar/" + idUsuarios,
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
            Funciones.cerrarModalCargando();
            if (datos.success == true) {
                alertify.success("<center><b style='color:white;'>Información actualizada correctamente</b></center>");
                cerrarForm();
                tbl_usuarios.ajax.reload();
            }
            if (datos.success == false) {
                if (datos.caso == 1) {
                    alertify.error("<center><b style='color:white;'>Error, faltaron campos por digitar</b></center>");
                } else {
                    alertify.error("<center><b style='color:white;'>No fue posible actualizar la información, por favor verifique que no exista un usuario con la misma cédula</b></center>");
                }
            }
        },
        error: function() {
            Funciones.cerrarModalCargando();
            alertify.error("<center><b style='color:white;'>Error, se presento un problema en el servidor al realizar la acción, intentelo de nuevo</b></center>");
        }
    });
}

function abrirDesactivar(id) {
    idUsuarios = id;
    $("#modal_desactivar").modal("show");
}

function cerrar_modal_desactivar() {
    idUsuarios = 0;
    $("#modal_desactivar").modal("hide");
}

function desactivar_usuario() {
    $.ajax({
        method: "POST",
        processData: false,
        contentType: false,
        cache: false,
        url: "Usuarios/desactivarUsuario/" + idUsuarios,
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
            Funciones.cerrarModalCargando();
            if (datos.success == true) {
                alertify.success("<center><b style='color:white;'>Usuario desactivado exitosamente</b></center>");
                cerrar_modal_desactivar();
                tbl_usuarios.ajax.reload();
            } else {
                alertify.error("<center><b style='color:white;'>Error, no fue posible desactivar al usuario, por favor intentelo de nuevo</b></center>");
            }
        },
        error: function() {
            Funciones.cerrarModalCargando();
            alertify.error("<center><b style='color:white;'>Error, se presento un problema en el servidor al realizar la acción, intentelo de nuevo</b></center>");
        }
    });
}

function abrirActivar(id) {
    idUsuarios = id;
    $("#modal_activar").modal("show");
}

function cerrar_modal_activar() {
    idUsuarios = 0;
    $("#modal_activar").modal("hide");
}

function activar_usuario() {
    $.ajax({
        method: "POST",
        processData: false,
        contentType: false,
        cache: false,
        url: "Usuarios/activarUsuario/" + idUsuarios,
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
            Funciones.cerrarModalCargando();
            if (datos.success == true) {
                alertify.success("<center><b style='color:white;'>Usuario activado exitosamente</b></center>");
                cerrar_modal_activar();
                tbl_usuarios.ajax.reload();
            } else {
                alertify.error("<center><b style='color:white;'>Error, no fue posible activar al usuario, por favor intentelo de nuevo</b></center>");
            }
        },
        error: function() {
            Funciones.cerrarModalCargando();
            alertify.error("<center><b style='color:white;'>Error, se presento un problema en el servidor al realizar la acción, intentelo de nuevo</b></center>");
        }
    });
}