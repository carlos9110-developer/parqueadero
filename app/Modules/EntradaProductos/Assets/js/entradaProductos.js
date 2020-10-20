var tbl_entradas;
var tbl_productos;
var cont = 0; // va llevando los id de los input que se agregan en las columnas
var detalles = 0; //lleva la cuenta real de los detalles que hay
var id_entrada_productos;
var datos_formulario;

function inicio() {
    esconderElementosFormulario();
    listar_entrada_productos();
    $("#form_registro_entrada_productos").on("submit", function(e) {
        accion_form(e);
    });
}
inicio();

// función donde se listan todas las entradas de productos
function listar_entrada_productos() {
    Funciones.abrirModalCargando();
    tbl_entradas = $("#tbl_entrada_productos").DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        pageLength: 5,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        ajax: {
            url: "EntradaProductos/listarEntradas",
            type: "GET",
            dataType: "json"
        },
        columns: [{
                data: "id"
            },
            {
                data: "proveedor",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(oData.proveedor + '<br/><i  title="Ver Productos Entrada"  onclick="verProductosEntrada(' + oData.id + ')" style="color:slateblue;" class="fas fa-cogs pointer"></i> <i title="Editar Registro"  onclick="abrirEditar(' + oData.id + ')" style="color:gold;" class="fas fa-edit pointer"></i>');
                }
            },
            {
                data: "fecha"
            },
            {
                data: "observacion",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(oData.observacion.substr(0, 50) + "....");
                }
            },
            {
                data: "total_compra",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    num = oData.total_compra.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1.');
                    num = num.split('').reverse().join('').replace(/^[\.]/, '');
                    $(nTd).html("$ " + num);
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
        responsive: true,
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
    $("#div-form-entradas").hide();
    $("#tbl_detalles").hide();
}

// función para mostrar los elementos del formulario
function mostrarElementosFormulario() {
    $("#btn_cerrar_formulario").show();
    $("#btn_abrir_registro_productos").show();
    $("#div-form-entradas").show();
    $("#tbl_detalles").show();
    $("#collapseCardExample").collapse('show');
}

// function para esconder los elementos del listado entradas
function esconderElementosListadoEntradas() {
    $("#div-listado-entrada-productos").hide();
    $("#btn-abrir-registrar-entrada-productos").hide();
}

// function para mostrar los elementos del listado entradas
function mostrarElementosListadoEntradas() {
    $("#div-listado-entrada-productos").show();
    $("#btn-abrir-registrar-entrada-productos").show();
}

// función donde se abre el modal para registrar la entrada de unos determinados productos
function abrir_modal_registro_entrada_productos() {
    id_entrada_productos = 0;
    esconderElementosListadoEntradas();
    mostrarElementosFormulario();
    listar_componentes();
    evaluar();
    $("#btn_guardar").html('<i class="fa fa-save"></i> <b> Guardar</b>');
    $("#tituloForm").html('<i class="fas fa-dolly"></i> Registro Entrada Productos');
}


function cerrar_modal_registro_entrada_productos() {
    esconderElementosFormulario();
    mostrarElementosListadoEntradas();
    limpiar_form();
    if (id_entrada_productos == 0) {
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
                '<td><input  type="text" onkeyup="format(this)" onchange="format(this)" name="input_precio_compra[]" id="input_precio_compra[]" value="' + precio_compra + '"></td>' +
                '</tr>';
            cont++;
            detalles = detalles + 1;
            $('#tbl_detalles').append(fila);
            calcular_totales();
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
            "<center><b style='color:white;'>Error, este producto ya fue cargado en el registro de entrada actual</b></center>"
        );
    }
}

// función donde se limpia el formulario
function limpiar_form() {
    $("#form_registro_entrada_productos")[0].reset();
    cont = 0;
    detalles = 0;
    $(".filas").remove();
    evaluar();
}

// función donde se registra la entrada de un determinado componente
function accion_form(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    datos_formulario = new FormData($("#form_registro_entrada_productos")[0]);
    if (id_entrada_productos == 0) {
        $("#modal_confirmacion").modal("show");
    } else {
        editarRegistro();
    }
}


// function para registrar la entrada de productos
function registrarEntradaProductos() {
    $.ajax({
        url: "EntradaProductos/registrarEntrada",
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
                    "<center><b style='color:white;'>Entrada productos registrada exitosamente</b></center>"
                );
                cerrar_modal_registro_entrada_productos();
                cerrar_modal_confirmacion();
                tbl_entradas.ajax.reload();
            }
            if (datos.success == false) {
                if (datos.caso == 1) {
                    alertify.error(
                        "<center><b style='color:white;'>Error, faltaron campos por digitar</b></center>"
                    );
                } else {
                    alertify.error(
                        "<center><b style='color:white;'>No fue posible registrar la entrada de productos, por favor intentelo de nuevo</b></center>"
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



// function donde se actualiza el total del ingreso actual
function calcular_totales() {
    let total = 0;
    let num;
    $("input[name='input_precio_compra[]']").each(function(indice, elemento) {
        num = $(elemento).val();
        num = num.split('.').join('');
        num = parseInt(num);
        total = total + num;
    });
    $("#h4_total_compra").html("$ " + formatNumber.new(total));
    $("#input_total_compra").val(total);
    evaluar();
}

// función donde se evalua para saber si se muestra el botón o no de guardar
function evaluar() {
    if (detalles > 0) {
        $("#btn_guardar").show();
        $('#tbl_detalles').show();
    } else {
        $("#btn_guardar").hide();
        $('#tbl_detalles').hide();
        cont = 0;
    }
}

// función donde se abre el modal y se carga la tabla con todos los productos
function abrir_agregar_producto() {
    $('#modal_detalles_entrada').modal('show');
}

// función donde se cierra el modal que contiene todos los prodcutos para ser agregados
function cerrar_modal_detalles_entrada() {
    $('#modal_detalles_entrada').modal('hide');
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
        responsive: true,
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
    calcular_totales();
    detalles = detalles - 1;
    evaluar();
}

var formatNumber = {
    separador: ".", // separador para los miles
    sepDecimal: ',', // separador para los decimales
    formatear: function(num) {
        num += '';
        var splitStr = num.split('.');
        var splitLeft = splitStr[0];
        var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
        var regx = /(\d+)(\d{3})/;
        while (regx.test(splitLeft)) {
            splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
        }
        return this.simbol + splitLeft + splitRight;
    },
    new: function(num, simbol) {
        this.simbol = simbol || '';
        return this.formatear(num);
    }
}

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
    calcular_totales();
}

// función apra cerrar el modal de de confirmación
function cerrar_modal_confirmacion() {
    $("#modal_confirmacion").modal("hide");
}

// función donde se ven los productos de una determinada entrada 
function verProductosEntrada(id) {
    $("#modal_productos_entrada").modal("show");
    Funciones.abrirModalCargando();
    tbl_productos = $("#tbl_productos_entrada").DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        pageLength: 5,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        ajax: {
            url: "EntradaProductos/listarProductosEntrada/" + id,
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
            },
            {
                data: "precio",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    num = oData.precio.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1.');
                    num = num.split('').reverse().join('').replace(/^[\.]/, '');
                    $(nTd).html("$ " + num);
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

function cerrar_modal_productos_entrada() {
    $("#modal_productos_entrada").modal("hide");
    tbl_productos.destroy();
}

// función para arbri el formulario para editar la entrada de registro de trabajos
function abrirEditar(id) {
    id_entrada_productos = id;
    esconderElementosListadoEntradas();
    mostrarElementosFormulario();
    $("#btn_guardar").html('<i class="fa fa-save"></i> <b> Editar Registro</b>');
    traerDatosRegistro(id);
    $("#tituloForm").html('<i class="fas fa-cogs"></i> Editar Entrada Productos');
    $("#tbl_detalles").hide();
    $("#btn_abrir_registro_productos").hide();
    $("#btn_guardar").show();
}

// función donde se traen los datos de un determinado registro
function traerDatosRegistro(id) {
    $.ajax({
        url: "EntradaProductos/traerDatosRegistro/" + id,
        type: "GET",
        contentType: false,
        processData: false,
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
            Funciones.cerrarModalCargando();
            $("#proveedor").val(datos.proveedor);
            $("#observacion").val(datos.observacion);
        },
        error: function(error) {
            Funciones.cerrarModalCargando();
            Funciones.mensajeCerroSesion();
        }
    });
}

// function donde se edita un determinado registro
function editarRegistro() {
    $.ajax({
        url: "EntradaProductos/editarRegistro/" + id_entrada_productos,
        type: "POST",
        data: datos_formulario,
        contentType: false,
        processData: false,
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
            console.log(datos);
            Funciones.cerrarModalCargando();
            if (datos.success == true) {
                alertify.success(
                    "<center><b style='color:white;'>Registro editado exitosamente</b></center>"
                );
                cerrar_modal_registro_entrada_productos();
                tbl_entradas.ajax.reload();
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