var tbl_usuarios;
function inicio()
{
	listar();
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
            url: `${ruta}/RegistroUsuariosAdministrador/listar`,
            type: "GET",
            dataType: "json"
        },
        columns: [{
                data: "id"
            },
            {
                data: "cedula"
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
                data: "estado"
            },
            {
                data: "id",

                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`<a class="btn btn-sm btn-warning" href="${ruta}/RegistroUsuariosAdministrador/editar/${oData.id}"><i class="fas fa-edit"></i></a><a class="btn btn-sm btn-primary" href="${ruta}/RegistroUsuariosAdministrador/asignarAdministracionParqueaderos/${oData.id}"><i class="fas fa-cogs"></i></a>`);
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



