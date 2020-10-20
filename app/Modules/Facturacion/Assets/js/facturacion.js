var tbl_facturas;
var id_facturas;

function inicio() {
    listar_facturas();
    $("#form_facturacion").on("submit", function(e) {
        editarFacturacion(e);
    });
}
inicio();

// función donde se listan todas las facturas
function listar_facturas() {
    Funciones.abrirModalCargando();
    tbl_facturas = $("#tbl_facturas").DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        pageLength: 5,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        ajax: {
            url: "Facturacion/listarFacturas",
            type: "GET",
            dataType: "json"
        },
        columns: [{
                data: "id"
            },
            {
                data: "telefono_cliente"
            },
            {
                data: "placa",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(oData.placa + '<br/><a title="Ver Factura"  href="' + Funciones.retornarUrl() + '/Facturacion/verFactura/' + oData.id + '" target="_blank"><i class="fas fa-file-invoice-dollar"></i></a> <i  title="Editar Registro"  onclick="abrirEditar(' + oData.id + ')" style="color:gold;" class="fas fa-edit pointer"></i>');
                },
            },
            {
                data: "marca"
            },
            {
                data: "cliente",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(oData.cliente + "<br/>" + "cel " + oData.telefono_cliente);
                }
            },
            {
                data: "fecha"
            },
            {
                data: "precio",
                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    num = oData.precio.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1.');
                    num = num.split('').reverse().join('').replace(/^[\.]/, '');
                    $(nTd).html("$ " + num);
                }
            },
            {
                data: "meses_garantia"
            }
        ],
        columnDefs: [{
                className: "dt-center",
                targets: "_all"
            },
            {
                targets: [0, 1],
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


// función apra cerrar el modal de de confirmación
function cerrar_modal_confirmacion() {
    $("#modal_confirmacion").modal("hide");
}

// función donde se edita una determinada factura
function abrirEditar(id) {
    id_facturas = id;
    $("#modal_facturacion").modal("show");
    $.ajax({
        url: "Facturacion/traerDatosRegistro/" + id,
        type: "GET",
        contentType: false,
        processData: false,
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
            Funciones.cerrarModalCargando();
            let precio = datos.precio.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1.');
            precio = precio.split('').reverse().join('').replace(/^[\.]/, '');
            $("#precio").val(precio);
            $("#meses_garantia").val(datos.meses_garantia);
        },
        error: function(error) {
            Funciones.cerrarModalCargando();
            Funciones.mensajeCerroSesion();
        }
    });
}

// función donde se cierra el modal para generar las facturas
function cerrar_modal_facturacion() {
    $("#modal_facturacion").modal("hide");
    $("#precio").val('');
    $("#meses_garantia").val('');
    id_facturas = 0;
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

// función donde se edita la información de una determinada factura
function editarFacturacion(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    let datos_facturacion = new FormData($("#form_facturacion")[0]);
    $.ajax({
        url: "Facturacion/editarFacturacion/" + id_facturas,
        type: "POST",
        data: datos_facturacion,
        contentType: false,
        processData: false,
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
            console.log(datos);
            Funciones.cerrarModalCargando();
            if (datos.success == true) {
                alertify.success("<center><b style='color:white;'>Factura editada correctamente</b></center>");
                cerrar_modal_facturacion();
                tbl_facturas.ajax.reload();
            }
            if (datos.success == false) {
                if (datos.caso == 1) {
                    alertify.error("<center><b style='color:white;'>Error, faltaron campos por digitar</b></center>");
                } else {
                    alertify.error("<center><b style='color:white;'>No fue posible editar la factura, por favor intentelo de nuevo</b></center>");
                }
            }
        },
        error: function(error) {
            Funciones.cerrarModalCargando();
            Funciones.mensajeCerroSesion();
        }
    });
}