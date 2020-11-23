var tblIngresos;
var fechaInicio;
var fechaFinal;

function inicio() {
    fechaInicio = $("#fecha-inicio-input").val();
    fechaFinal = $("#fecha-fin-input").val();
    listar();
}
inicio();

// función donde se realiza la petición por ajax del json para cargr el dataTable
function listar() {
    tblIngresos = $("#tbl_ingresos").DataTable({
        dom: 'Bfrtip',
        buttons: [
            { extend: 'csv', className: 'btn btn-success' },
            { extend: 'excel', className: 'btn btn-success' },
            { extend: 'pdf', className: 'btn btn-danger' }
        ],
        responsive: true,
        processing: true,
        serverSide: true,
        pageLength: 5,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        ajax: {
            url: `${ruta}/RegistroIngreso/ListarInformeIngresos`,
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
                data: "tipo"
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
                data: "fecha_entrada"
            },
            {
                data: "fecha_salida"
            },
            {
                data: "horas"
            },
            {
                data: "precio"
            },
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