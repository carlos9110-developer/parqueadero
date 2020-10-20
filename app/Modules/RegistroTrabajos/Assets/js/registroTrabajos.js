var tbl_trabajos;
var tbl_productos;
var cont = 0; // va llevando los id de los input que se agregan en las columnas
var detalles = 0; //lleva la cuenta real de los detalles que hay
var id_trabajos;
var datos_formulario;

function inicio() {
    esconderElementosFormulario();
    listar_trabajos();
    iniciarSelectTecnicos();
    $("#form_registro_trabajos").on("submit", function(e) {
        accion_form(e);
    });
    $("#form_facturacion").on("submit", function(e) {
        guardarFacturacion(e);
    });
}
inicio();

// función donde se listan todos los trabajos
function listar_trabajos() {
    Funciones.abrirModalCargando();
    tbl_trabajos = $("#tbl_trabajos").DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        pageLength: 5,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        ajax: {
            url: "RegistroTrabajos/listarTrabajos",
            type: "GET",
            dataType: "json"
        },
        columns: [{
                data: "id"
            },
            {
                data: "cliente",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    if (oData.estado == '1') {
                        if (oData.correo_cliente != "") {
                            $(nTd).html(oData.cliente + '<br/><i  title="Ver Productos Utilizados"  onclick="verProductosUtilizados(' + oData.id + ')" style="color:slateblue;" class="fas fa-cogs pointer"></i> <i title="Editar Registro"  onclick="abrirEditar(' + oData.id + ')" style="color:gold;" class="fas fa-edit pointer"></i> <i title="Facturar"  onclick="abrirFacturar(' + oData.id + ')" style="color:#93E671;" class="fas fa-file-invoice-dollar pointer"></i>');
                        } else {
                            $(nTd).html(oData.cliente + '<br/><i  title="Ver Productos Utilizados"  onclick="verProductosUtilizados(' + oData.id + ')" style="color:slateblue;" class="fas fa-cogs pointer"></i> <i title="Editar Registro"  onclick="abrirEditar(' + oData.id + ')" style="color:gold;" class="fas fa-edit pointer"></i> <i title="Facturar"  onclick="abrirFacturar(' + oData.id + ')" style="color:#93E671;" class="fas fa-file-invoice-dollar pointer"></i>');
                        }
                    } else {
                        if (oData.correo_cliente != "") {
                            $(nTd).html(oData.cliente + '<br/><i  title="Ver Productos Utilizados"  onclick="verProductosUtilizados(' + oData.id + ')" style="color:slateblue;" class="fas fa-cogs pointer"></i>');
                        } else {
                            $(nTd).html(oData.cliente + '<br/><i  title="Ver Productos Utilizados"  onclick="verProductosUtilizados(' + oData.id + ')" style="color:slateblue;" class="fas fa-cogs pointer"></i>');
                        }
                    }
                }
            },
            {
                data: "correo_cliente"
            },
            {
                data: "placa"
            },
            {
                data: "marca"
            },
            {
                data: "telefono_cliente"
            },
            {
                data: "fecha"
            },
            {
                data: "tecnico"
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
    Funciones.cerrarModalCargando();
}

// funcón esconder botones formulario 
function esconderElementosFormulario() {
    $("#btn_cerrar_formulario").hide();
    $("#btn_abrir_registro_productos").hide();
    $("#btn_guardar").hide();
    $("#div-form-trabajos").hide();
    $("#tbl_detalles").hide();
}

// función para mostrar los elementos del formulario
function mostrarElementosFormulario() {
    $("#btn_cerrar_formulario").show();
    $("#btn_abrir_registro_productos").show();
    $("#div-form-trabajos").show();
    $("#tbl_detalles").show();
    $("#collapseCardExample").collapse('show');
    $("#btn_guardar").show();
}

// function para esconder los elementos del listado trabajos
function esconderElementosListadoTrabajos() {
    $("#div-listado-trabajos").hide();
    $("#btn-abrir-registrar-trabajo").hide();
}

// function para mostrar los elementos del listado entradas
function mostrarElementosListadoTrabajos() {
    $("#div-listado-trabajos").show();
    $("#btn-abrir-registrar-trabajo").show();
}

// función donde se abre el modal para registrar la entrada de unos determinados productos
function abrir_modal_registro_trabajos() {
    id_trabajos = 0;
    esconderElementosListadoTrabajos();
    mostrarElementosFormulario();
    $("#btn_guardar").html('<i class="fa fa-save"></i> <b> Guardar</b>');
    $("#tituloForm").html('<i class="fas fa-cogs"></i> Registro Trabajo');
    listar_componentes();
    evaluar();
}

// función donde se carga el select con los técnicos de la base de datos
function iniciarSelectTecnicos() {
    $("#tecnico").html(
        '<option disabled selected value="">Seleccione el técnico:</option>'
    );
    $.get("RegistroTrabajos/traerTecnicos", function(datos) {
        $.each(datos, function(indice, valor) {
            let html = "";
            html += '<option value="' + valor.id + '">' + valor.nombre + "</option>";
            $("#tecnico").append(html);;
        });
        $("#tecnico").selectpicker("refresh");
    });
}

function cerrar_modal_registro_trabajos() {
    esconderElementosFormulario();
    mostrarElementosListadoTrabajos();
    limpiar_form();
    if (id_trabajos == 0) {
        tbl_productos.destroy();
    }

}



function agregar_detalle(id_producto, producto) {
    var confirmacion = 1; // si se encuentra el artículo esta pasara a cero
    var array = document.getElementsByName("input_id_producto[]");
    for (var i = 0; i < array.length; i++) {
        var guia = array[i];
        if (guia.value == id_producto) {
            confirmacion = 0;
            i = array.length;
        }
    }
    if (confirmacion == 1) {
        var cantidad = 1;
        var precio_compra = 1;
        if (id_producto != "") {
            var fila = '<tr class="filas" id="fila_' + cont + '">' +
                '<td><button type="button" class="btn btn-danger" onclick="eliminar_producto(' + cont + ')">X</button></td>' +
                '<td><input  type="hidden" name="input_id_producto[]" value="' + id_producto + '">' + producto + '</td>' +
                '<td><input  type="number" step="any" min="1" name="input_cantidad[]" id="input_cantidad[]" value="' + cantidad + '"></td>' +
                '</tr>';
            cont++;
            detalles = detalles + 1;
            $('#tbl_detalles').append(fila);
            evaluar();
            alertify.success(
                "<center><b style='color:white;'>Producto agregado</b></center>"
            );
        } else {
            alertify.error(
                "<center><b style='color:white;'>Error al ingresar el detalle, revisar los datos del producto</b></center>"
            );
        }
    } else {
        alertify.error(
            "<center><b style='color:white;'>Error, este producto ya fue cargado en el trabajo actual</b></center>"
        );
    }
}

// función donde se limpia el formulario
function limpiar_form() {
    $("#form_registro_trabajos")[0].reset();
    $("#tecnico").val("");
    $("#tecnico").selectpicker("refresh");
    cont = 0;
    detalles = 0;
    $(".filas").remove();
    evaluar();
    datos_formulario = "";
}

// función donde se registra la entrada de un determinado componente
function accion_form(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    datos_formulario = new FormData($("#form_registro_trabajos")[0]);
    if (id_trabajos == 0) {
        $("#modal_confirmacion").modal("show");
    } else {
        editarRegistroTrabajo();
    }
}

// función apra cerrar el modal de de confirmación
function cerrar_modal_confirmacion() {
    $("#modal_confirmacion").modal("hide");
}

// function para registrar los trabajos
function registrarTrabajos() {
    $.ajax({
        url: "RegistroTrabajos/registrarTrabajo",
        type: "POST",
        data: datos_formulario,
        contentType: false,
        processData: false,
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
            Funciones.cerrarModalCargando();
            if (datos.success == true) {
                alertify.success(
                    "<center><b style='color:white;'>Trabajo registrado exitosamente</b></center>"
                );
                cerrar_modal_registro_trabajos();
                cerrar_modal_confirmacion();
                tbl_trabajos.ajax.reload();
            }
            if (datos.success == false) {
                if (datos.caso == 1) {
                    alertify.error(
                        "<center><b style='color:white;'>Error, faltaron campos por digitar</b></center>"
                    );
                } else {
                    alertify.error(
                        "<center><b style='color:white;'>No fue posible registrar el trabajo, por favor intentelo de nuevo</b></center>"
                    );
                }
            }
        },
        error: function(error) {
            Funciones.cerrarModalCargando();
            Funciones.mensajeCerroSesion();
        }
    });
}

//función donde se realiza la edición de un determinado registro
function editarRegistroTrabajo() {
    $.ajax({
        url: "RegistroTrabajos/editarRegistroTrabajo/" + id_trabajos,
        type: "POST",
        data: datos_formulario,
        contentType: false,
        processData: false,
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
            Funciones.cerrarModalCargando();
            if (datos.success == true) {
                alertify.success(
                    "<center><b style='color:white;'>Registro editado exitosamente</b></center>"
                );
                cerrar_modal_registro_trabajos();
                tbl_trabajos.ajax.reload();
            }
            if (datos.success == false) {
                if (datos.caso == 1) {
                    alertify.error(
                        "<center><b style='color:white;'>Error, faltaron campos por digitar</b></center>"
                    );
                } else {
                    alertify.error(
                        "<center><b style='color:white;'>No fue posible editar el registro, por favor intentelo de nuevo</b></center>"
                    );
                }
            }
        },
        error: function(error) {
            Funciones.cerrarModalCargando();
            Funciones.mensajeCerroSesion();
        }
    });
}

// función donde se evalua para saber si se muestra el botón o no de guardar
function evaluar() {
    if (detalles > 0) {
        $('#tbl_detalles').show();
    } else {
        $('#tbl_detalles').hide();
        cont = 0;
    }
}

// función donde se abre el modal y se carga la tabla con todos los productos
function abrir_agregar_producto() {
    $('#modal_detalles_trabajo').modal('show');
}

// función donde se cierra el modal que contiene todos los prodcutos para ser agregados
function cerrar_modal_detalles_trabajo() {
    $('#modal_detalles_trabajo').modal('hide');
}

// función donde se cargan los productos registrados actualmente con su respectiva información
function listar_componentes() {
    Funciones.abrirModalCargando();
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
                data: "id",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<button type="button" class="btn btn-primary btn-sm" onclick="agregar_detalle(' + oData.id + ',\'' + oData.nombre + '\')"><span class="fas fa-plus"></span></button>');
                }
            },
            {
                data: "nombre"
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
    Funciones.cerrarModalCargando();
}

// función donde se elimina un determinado detalle
function eliminar_producto(indice) {
    $("#fila_" + indice).remove();
    detalles = detalles - 1;
    evaluar();
}

// función donde se ven los productos utilizados
function verProductosUtilizados(id) {
    $("#modal_productos_utilizados").modal("show");
    Funciones.abrirModalCargando();
    tbl_productos = $("#tbl_productos_utilizados").DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        pageLength: 5,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        ajax: {
            url: "RegistroTrabajos/listarProductosUtilizados/" + id,
            type: "GET",
            dataType: "json"
        },
        columns: [{
                data: "nombre"
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
            }
        ],
        columnDefs: [{
            className: "dt-center",
            targets: "_all"
        }],
        lengthChange: true,
        info: false,
        lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50]
        ]
    });
    Funciones.cerrarModalCargando();
}

function cerrar_modal_productos_utilizados() {
    $("#modal_productos_utilizados").modal("hide");
    tbl_productos.destroy();
}

// función para arbri el formulario para editar la entrada de registro de trabajos
function abrirEditar(id) {
    id_trabajos = id;
    esconderElementosListadoTrabajos();
    mostrarElementosFormulario();
    $("#btn_guardar").html('<i class="fa fa-save"></i> <b> Editar Registro</b>');
    traerDatosRegistro(id);
    $("#tituloForm").html('<i class="fas fa-cogs"></i> Editar Información Trabajo');
    $("#tbl_detalles").hide();
    $("#btn_abrir_registro_productos").hide();
}

// función donde se traen los datos de un determinado registro
function traerDatosRegistro(id) {
    $.ajax({
        url: "RegistroTrabajos/traerDatosRegistro/" + id,
        type: "GET",
        contentType: false,
        processData: false,
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
            console.log(datos);
            Funciones.cerrarModalCargando();
            $("#cliente").val(datos.cliente);
            $("#tecnico").val(datos.id_tecnico);
            $("#tecnico").selectpicker("refresh");
            $("#placa").val(datos.placa);
            $("#marca").val(datos.marca);
            $("#telefono_cliente").val(datos.telefono_cliente);
            $("#email_cliente").val(datos.correo_cliente);
            $("#observacion").val(datos.descripcion);
        },
        error: function(error) {
            Funciones.cerrarModalCargando();
            Funciones.mensajeCerroSesion();
        }
    });
}

// función donde se abre el modal para realizar la factura de un determinado trabajo
function abrirFacturar(id) {
    $("#modal_facturacion").modal("show");
    id_trabajos = id;
}

// función donde se cierra el modal para generar las facturas
function cerrar_modal_facturacion() {
    $("#modal_facturacion").modal("hide");
    id_trabajos = 0;
    $("#precio").val('');
    $("#meses_garantia").val('');
}

// función para dar formato de miles a un número 
function format(input) {
    var num = input.value.replace(/\./g, '');
    if (!isNaN(num)) {
        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1.');
        num = num.split('').reverse().join('').replace(/^[\.]/, '');
        input.value = num;
    } else {
        alertify.error(
            "<center><b style='color:white;'>Error, Solo se permiten números</b></center>"
        );
        input.value = input.value.replace(/[^\d\.]*/g, '');
    }
}

// función donde se guarda una determinada facturación
function guardarFacturacion(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    let datos_facturacion = new FormData($("#form_facturacion")[0]);
    $.ajax({
        url: "RegistroTrabajos/registrarFacturacion/" + id_trabajos,
        type: "POST",
        data: datos_facturacion,
        contentType: false,
        processData: false,
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
            Funciones.cerrarModalCargando();
            if (datos.success == true) {
                alertify.success(
                    "<center><b style='color:white;'>Facturación realizada correctamente</b></center>"
                );
                cerrar_modal_facturacion();
                tbl_trabajos.ajax.reload();
            }
            if (datos.success == false) {
                if (datos.caso == 1) {
                    alertify.error(
                        "<center><b style='color:white;'>Error, faltaron campos por digitar</b></center>"
                    );
                } else {
                    alertify.error(
                        "<center><b style='color:white;'>No fue posible realizar la facturación, por favor intentelo de nuevo</b></center>"
                    );
                }
            }
        },
        error: function(error) {
            Funciones.cerrarModalCargando();
            Funciones.mensajeCerroSesion();
        }
    });
}