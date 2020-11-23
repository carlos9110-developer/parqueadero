var Tbl_parqueaderos;

function inicio() {
    listar();
}
inicio();
// función donde se lista la tabla con los clientes registrados
function listar() {
    Tbl_parqueaderos = $("#tbl_parqueaderos").DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        pageLength: 5,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        ajax: {
            url: `${ruta}/RegistroParqueaderos/listar`,
            type: "GET",
            dataType: "json"
        },
        columns: [{
                data: "id"
            },
            {
                data: "nit"
            },
            {
                data: "nombre"
            },
            {
                data: "direccion"
            },
            {
                data: "telefono"
            },
            {
                data: "pisos"
            },
            {
                data: "capacidad_carros"
            },
            {
                data: "capacidad_motos"
            },
            {
                data: "fecha_registro"
            },
            {
                data: "id",

                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    if(oData.configuracion_plano=="1"){
                        $(nTd).html(
                            `<a title="Editar Información Parqueadero" class="btn btn-sm btn-warning" href="${ruta}/RegistroParqueaderos/Editar/${oData.id}"><i class="fas fa-edit"></i></a>` +
                            `<a title="Editar Planos Parqueadero" class="btn btn-sm btn-primary" href="${ruta}/RegistroParqueaderos/EditarPlanoParqueadero/${oData.id}"><i class="fas fa-cogs"></i></a>`
                        );
                    }else{
                        $(nTd).html(
                            `<a title="Editar Información Parqueadero" class="btn btn-sm btn-warning" href="${ruta}/RegistroParqueaderos/Editar/${oData.id}"><i class="fas fa-edit"></i></a>` +
                            `<a title="Configurar Planos Parqueadero" class="btn btn-sm btn-primary" href="${ruta}/RegistroParqueaderos/ConfiguracionPlano/${oData.id}"><i class="fas fa-cog"></i></a>`
                        );
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
}


/**            
 * {
        data: "foto",

        "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
            $(nTd).html(`<img src="${ruta}/public/img/logos_parqueaderos/img/.jpg" alt="">`);
        }
    }, */