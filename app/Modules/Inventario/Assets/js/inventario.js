var tbl_productos;
var idProductos;
// función que se inicia al empezar el archivo
function inicio() {
    $("#div-form-productos").hide();
    $("#btn_cerrar_formulario").hide();
    $("#btn_guardar").hide();
    listar();
    $("#form-productos").on("submit", function(e) {
        accion_form(e);
    });
}
inicio();

// función donde se lista la tabla con los clientes registrados
function listar() {
    tbl_productos = $("#tbl_productos").DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        pageLength: 5,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        ajax: {
            url: "Inventario/listar",
            type: "GET",
            dataType: "json"
        },
        columns: [{
                data: "id"
            },
            {
                data: "nombre",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(oData.nombre + '<br/><i style="color:gold;" title="Editar" onclick="abrirEditar(' + oData.id + ')" class="fas fa-edit pointer"></i></button>');
                }
            },
            {
                data: "tipo_medida"
            },
            {
                data: "cantidad",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    if (oData.tipo_medida == 'Metros') {
                        $(nTd).html(oData.cantidad + " m de largo");
                    } else {
                        $(nTd).html(Math.trunc(oData.cantidad) + " ud");
                    }
                }
            },
            {
                data: "cantidad_alarma",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    if (oData.tipo_medida == 'Metros') {
                        $(nTd).html(oData.cantidad_alarma + " m de largo");
                    } else {
                        $(nTd).html(Math.trunc(oData.cantidad_alarma) + " ud");
                    }
                }
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
        order: [
            [0, "desc"]
        ], //Ordenar (columna,orden)
        lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50]
        ]
    });
}

function abrirForm() {
    $("#div-listado-productos").hide();
    $("#div-form-productos").show();
    $("#div-titulo-form").html('<i class="fas fa-cube"></i> Registro Producto');
    $(".btn-abrir-registrar-producto").hide();
    $("#btn_cerrar_formulario").show();
    $("#btn_guardar").show();
    $("#btn_guardar").html('<i class="fas fa-save"></i> Registrar');
    idProductos = 0;
}

function abrirEditar(id) {
    $("#div-listado-productos").hide();
    $("#div-form-productos").show();
    $("#div-titulo-form").html('<i class="fas fa-cube"></i> Editar Producto');
    $(".btn-abrir-registrar-producto").hide();
    $("#btn_cerrar_formulario").show();
    $("#btn_guardar").show();
    $("#btn_guardar").html('<i class="fas fa-edit"></i> Editar');
    idProductos = id;
    traerDatosProducto(id);
}

function cerrarForm() {
    $("#div-form-productos").hide();
    $("#div-listado-productos").show();
    $("#form-productos")[0].reset();
    $(".btn-abrir-registrar-producto").show();
    $("#btn_cerrar_formulario").hide();
    $("#btn_guardar").hide();
    $("#btn_guardar").html('');
}

// función donde se guarda un determinado cliente
function accion_form(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    var objeto = new FormData($("#form-productos")[0]);

    if (idProductos == 0) {
        guardar(objeto);
    } else {
        editar(objeto);
    }
}

function guardar(objeto) {
    $.ajax({
        method: "POST",
        processData: false,
        contentType: false,
        cache: false,
        data: objeto,
        url: "Inventario/insertar",
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
            Funciones.cerrarModalCargando();
            if (datos.success == true) {
                alertify.success(
                    "<center><b style='color:white;'>Producto registrado exitosamente</b></center>"
                );
                $("#form-productos")[0].reset();
                cerrarForm();
                tbl_productos.ajax.reload();
            }
            if (datos.success == false) {
                if (datos.caso == 1) {
                    alertify.error(
                        "<center><b style='color:white;'>Error, faltaron campos por digitar</b></center>"
                    );
                } else {
                    alertify.error(
                        "<center><b style='color:white;'>No fue posible registrar el producto, por favor verifique que no halla un producto con el mismo nombre</b></center>"
                    );
                }
            }
        },
        error: function() {
            Funciones.cerrarModalCargando();
            Funciones.mensajeCerroSesion();
        }
    });
}

function editar(objeto) {
    $.ajax({
        method: "POST",
        processData: false,
        contentType: false,
        cache: false,
        data: objeto,
        url: "Inventario/editar/" + idProductos,
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
            Funciones.cerrarModalCargando();
            if (datos.success == true) {
                alertify.success(
                    "<center><b style='color:white;'>Producto editado exitosamente</b></center>"
                );
                $("#form-productos")[0].reset();
                cerrarForm();
                tbl_productos.ajax.reload();
            }
            if (datos.success == false) {
                if (datos.caso == 1) {
                    alertify.error(
                        "<center><b style='color:white;'>Error, faltaron campos por digitar</b></center>"
                    );
                } else {
                    alertify.error(
                        "<center><b style='color:white;'>No fue posible editar el producto, por favor verifique que no halla un producto con el mismo nombre</b></center>"
                    );
                }
            }
        },
        error: function() {
            Funciones.cerrarModalCargando();
            Funciones.mensajeCerroSesion();
        }
    });
}

function traerDatosProducto(id) {
    $.ajax({
        method: "GET",
        processData: false,
        contentType: false,
        cache: false,
        url: "Inventario/traerInfoProducto/" + id,
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
            if (datos.tipo_medida == "Unidades") {
                $("#cantidad_alarma").val(Math.trunc(datos.cantidad_alarma));
            } else {
                $("#cantidad_alarma").val(datos.cantidad_alarma);
            }
            $("#producto").val(datos.nombre);
            $("#tipo_medida").val(datos.tipo_medida);
            Funciones.cerrarModalCargando();
        },
        error: function() {
            Funciones.cerrarModalCargando();
            Funciones.mensajeCerroSesion();
        }
    });
}