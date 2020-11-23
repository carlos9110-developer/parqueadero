var tblIngresos;
var fechaInicio;
var fechaFinal;
var idIngreso;
var precio;
var valor;

function inicio() {
    fechaInicio = $("#fecha-inicio-input").val();
    fechaFinal = $("#fecha-fin-input").val();
    listar();
}
inicio();

// función donde se realiza la petición por ajax del json para cargr el dataTable
function listar() {
    tblIngresos = $("#tbl_ingresos").DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        pageLength: 5,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        ajax: {
            url: `${ruta}/RegistroSalida/listar`,
            type: "GET",
            data: function(d) {
                d.fechaInicio = fechaInicio;
                d.fechaFinal = fechaFinal;
            },
            dataType: "json"
        },
        columns: [{
                data: "id"
            },
            {
                data: "cedula"
            },
            {
                data: "placa"
            },
            {
                data: "marca"
            },
            {
                data: "piso"
            },
            {
                data: "fecha"
            },
            {
                data: "hora"
            },
            {
                data: "id",

                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`<button class="btn btn-sm btn-primary" onclick="traerInfoSalida('${oData.id}','${oData.tipo}','${oData.placa}')" type="button"><i class="fas fa-share-square"></i></button>`);
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
}

// función donde se detecta el cambio de fecha de cualquiera de los dos filtros
function cambioFecha() {
    let fecha_inicio = $("#fecha-inicio-input").val();
    let fecha_final = $("#fecha-fin-input").val();

    //Split de las fechas recibidas para separarlas
    let fecha_1 = fecha_inicio.split("-");
    let fecha_2 = fecha_final.split("-");

    //Cambiamos el orden al formato americano, de esto dd/mm/yyyy a esto mm/dd/yyyy
    let fecha_1_formato_nuevo = `${fecha_1[1]}-${fecha_1[2]}-${fecha_1[0]}`;
    let fecha_2_formato_nuevo = `${fecha_2[1]}-${fecha_2[2]}-${fecha_2[0]}`;

    console.log(fecha_1_formato_nuevo);
    //Comparamos las fechas
    if (Date.parse(fecha_1_formato_nuevo) > Date.parse(fecha_2_formato_nuevo)) {
        $("#fecha-inicio-input").val(fechaInicio);
        $("#fecha-fin-input").val(fechaFinal);
        alertify.error("<center><b style='color:white;'>Error, la fecha de inicio de los filtros no puede ser mayor a la fecha fin</b></center>");
    } else {
        fechaInicio = fecha_inicio;
        fechaFinal = fecha_final;
        tblIngresos.ajax.reload();
    }
}


// función donde se abre el modal para marcar la salida de un determinado vehículo
function traerInfoSalida(id, tipo, placa) {
    idIngreso = id;
    $.ajax({
        method: "GET",
        url: `${ruta}/RegistroSalida/TraerInfoParaSalida/${id}/${tipo}`,
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
            console.log(datos);
            setearInfoSalida(datos, placa);
            Funciones.cerrarModalCargando();
        },
        error: function(msj) {
            console.log(msj);
            Funciones.cerrarModalCargando();
        }
    });
}


// función donde se setea la información de la salida en el modal
function setearInfoSalida(datos, placa) {
    valor = datos.valor;
    horas = datos.horas;
    let html = `<p>¿Esta seguro de registrar la salida de este vehículo con placas ${placa} </p>`;
    html += `<p>Valor: ${datos.valor} por ${datos.horas} horas </p>`;
    $("#modal-confirmar-salida").modal("show");
    $("#div-cargar-info-salida").html(html);

}

// función donde se cierra el modal para confirmar la salida de un vehículo
function cerrarModalConfirmacionSalida() {
    $("#modal-confirmar-salida").modal("hide");
}

// función donde se registra la salida de los vehículos
function registrarSalidaVehiculo() {
    let objeto = {
        idIngreso: idIngreso,
        horas: horas,
        valor: valor
    };
    $.ajax({
        method: "POST",
        url: `${ruta}/RegistroSalida/RegistrarSalidaVehiculo`,
        data: objeto,
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
            console.log(datos);
            if (datos.res) {
                alertify.success(`<center><b style='color:white;'>${datos.msg}</b></center>`);
                tblIngresos.ajax.reload();
                cerrarModalConfirmacionSalida();
            } else {
                alertify.error(`<center><b style='color:white;'>${datos.msg}</b></center>`);
            }
            Funciones.cerrarModalCargando();
        },
        error: function(msj) {
            alertify.error(`<center><b style='color:white;'>${msj.responseText}</b></center>`);
            console.log(msj);
            Funciones.cerrarModalCargando();
        }
    });
}