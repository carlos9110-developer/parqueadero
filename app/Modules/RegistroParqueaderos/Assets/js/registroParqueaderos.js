var tbl_parqueaderos;
var idParqueaderos;

var editar_insertar = "";
// variables para saber la información general del parqueadero, necesaria para la configuarión del plano
var capacidad_carros = 0;
var capacidad_motos = 0;
var numero_pisos = 0;
var imagen_cambio = 0;
// sirve para saber si la configuración del plano de un parquedero ya se realizo
var configuracion_plano = "0";
// variable que sirve para saber que piso se esta congifurando del parqueadero
var piso_elejido = 0;
// variables necesarias para la configuración de filas y columnas de el piso de un parqueadero de un parqueadero
var num_filas = 0;
var num_columas = 0;
var herramienta_seleccionada = "";
var matrix = null;

// función que se inicia al empezar el archivo
function inicio() {
    esconderElementosForm();
    listar();
    $("#form-parqueaderos").on("submit", function(e) {
        accion_form(e);
    });
    $("#logo").change(function() {
        // Código a ejecutar cuando se detecta un cambio de archivO
        readImage(this);
    });
}
inicio();

function readImage(input) {
    if (input.files && input.files[0]) {
        imagen_cambio = 1;
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#img-muestra').attr('src', e.target.result); // Renderizamos la imagen
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// función donde se lista la tabla con los clientes registrados
function listar() {
    tbl_parqueaderos = $("#tbl_parqueaderos").DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        pageLength: 5,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        ajax: {
            url: "RegistroParqueaderos/listar",
            type: "GET",
            dataType: "json"
        },
        columns: [{
                data: "id"
            },
            {
                data: "nit",

                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {

                    $(nTd).html(oData.nit + '<br/><i title="Editar Registro"  onclick="abrirEditar(' + oData.id + ')" style="color:gold;" class="fas fa-edit pointer"></i>');

                }
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
    $("#div-form-parqueaderos").hide();
    $("#btn_cerrar_formulario").hide();
    $("#btn_cerrar_configuracion_plano").hide();
}


function abrirForm() {
    $("#div-listado-parqueaderos").hide();
    $("#div-form-parqueaderos").show();
    $("#div-titulo-form").html('<i class="fas fa-file-alt"></i> Información Parqueadero');
    $("#btn_cerrar_formulario").show();
    $("#div-btn-registrar-editar-informacion").html('<button class="btn btn-success" type="submit" id="btn_guardar"><i class="fas fa-save"></i> <b> Registrar Información</b></button>');
    $(".btn-abrir-registrar-parqueadero").hide();
    $("#div-configuracion-plano").hide();
    $("#div-matriz").hide();
    editar_insertar = "I";
    idParqueaderos = 0;
}

function cerrarForm() {
    esconderElementosForm();
    $("#div-listado-parqueaderos").show();
    $(".btn-abrir-registrar-parqueadero").show();
    $("#form-parqueaderos")[0].reset();
    $('#img-muestra').attr('src', "https://via.placeholder.com/150"); // Renderizamos la imagen
    reset_variables();
    tbl_parqueaderos.ajax.reload();
}

function reset_variables() {

    capacidad_carros = 0;
    capacidad_motos = 0;
    numero_pisos = 0;
    imagen_cambio = 0;
    // sirve para saber si la configuración del plano de un parquedero ya se realizo
    configuracion_plano = "0";
    // variable que sirve para saber que piso se esta congifurando del parqueadero
    piso_elejido = 0;
    // variables necesarias para la configuración de filas y columnas de el piso de un parqueadero de un parqueadero
    num_filas = 0;
    num_columas = 0;
    matrix = null;
}

// función donde se guarda un determinado cliente
function accion_form(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    var objeto = new FormData($("#form-parqueaderos")[0]);

    if (idParqueaderos == 0) {
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
        url: "RegistroParqueaderos/insertar",
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
            console.log(datos);
            if (datos.success == true) {
                numero_pisos = $("#pisos").val();
                capacidad_carros = $("#capacidad_carros").val();
                capacidad_motos = $("#capacidad_motos").val();
                idParqueaderos = datos.id;
                alertify.success("<center><b style='color:white;'>" + datos.msg + "</b></center>");
                tbl_parqueaderos.ajax.reload();
            } else {
                alertify.error("<center><b style='color:white;'>" + datos.msg + "</b></center>");
            }
            Funciones.cerrarModalCargando();
        },
        error: function(msj) {
            console.log(msj);
            Funciones.cerrarModalCargando();
            alertify.error("<center><b style='color:white;'>Error, se presento un problema en el servidor al realizar la acción, intentelo de nuevo</b></center>");
        }
    });
}

// función donde se abre el form con los datos de un determinado registro
function abrirEditar(id) {
    $("#div-listado-parqueaderos").hide();
    $("#div-form-parqueaderos").show();
    $("#div-titulo-form").html('<i class="fas fa-address-book"></i> Actualización Datos');
    $("#btn_cerrar_formulario").show();
    $("#btn_guardar").show();
    $("#btn_guardar").html('<i class="fas fa-save"></i> Editar');
    $(".btn-abrir-registrar-parqueadero").hide();
    $("#div-configuracion-plano").hide();
    $("#div-matriz").hide();
    idParqueaderos = id;
    editar_insertar = "E";
    traerDatosRegistro(idParqueaderos);
}

// función donde se traen los datos de un determinado registro
function traerDatosRegistro(id) {
    $.ajax({
        method: "GET",
        processData: false,
        contentType: false,
        cache: false,
        url: "RegistroParqueaderos/traerDatos/" + id,
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
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
    $("#nit").val(datos.nit);
    $("#nombre").val(datos.nombre);
    $("#direccion").val(datos.direccion);
    $("#telefono").val(datos.telefono);
    $("#pisos").val(datos.pisos);
    $("#capacidad_carros").val(datos.capacidad_carros);
    $("#capacidad_motos").val(datos.capacidad_motos);
    numero_pisos = parseInt(datos.pisos);
    if (datos.registro_logo == "1") {
        $('#img-muestra').attr('src', "img/logos_parqueaderos/" + datos.id + ".jpg");
    } else {
        $('#img-muestra').attr('src', "https://via.placeholder.com/150"); // Renderizamos la imagen
    }
}

// función donde se edita un determinado registro
function editar(objeto) {
    $.ajax({
        method: "post",
        processData: false,
        contentType: false,
        cache: false,
        data: objeto,
        url: "RegistroParqueaderos/editar/" + idParqueaderos,
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
            Funciones.cerrarModalCargando();
            if (datos.success == true) {
                alertify.success("<center><b style='color:white;'>Información actualizada correctamente</b></center>");
                cerrarForm();
                tbl_parqueaderos.ajax.reload();
            }
            if (datos.success == false) {
                if (datos.caso == 1) {
                    alertify.error("<center><b style='color:white;'>Error, faltaron campos por digitar</b></center>");
                } else {
                    alertify.error("<center><b style='color:white;'>No fue posible actualizar la información, por favor verifique que no exista un parqueadero con el mismo nit</b></center>");
                }
            }
        },
        error: function(msj) {
            console.log(msj);
            Funciones.cerrarModalCargando();
            alertify.error("<center><b style='color:white;'>Error, se presento un problema en el servidor al realizar la acción, intentelo de nuevo</b></center>");
        }
    });
}

function verConfiguracionPlano() {
    if (idParqueaderos == 0) {
        alertify.error("<center><b style='color:white;'>Error, debe digitar la información del parqueadero</b></center>");
    } else {
        $("#div-informacion-parqueadero").hide();
        $("#div-configuracion-plano").show();
        $("#btn_cerrar_formulario").hide();
        $("#btn_cerrar_configuracion_plano").show();
        if (editar_insertar == "I") {
            cargar_pisos_inicial(numero_pisos);
        } else {
            cargar_pisos_editar(numero_pisos);
        }
    }
}

function verInformacion() {
    $("#div-informacion-parqueadero").show();
    $("#div-configuracion-plano").hide();
    $("#div-matriz").hide();
    $("#btn_cerrar_formulario").show();
    $("#btn_cerrar_configuracion_plano").hide();
    $("#list-config-pisos").html('');
}

function cargar_pisos_inicial(pisos) {
    $("#list-config-pisos").html('');
    for (let index = 1; index <= pisos; index++) {
        let html = '<li id="item-piso-' + index + '" onclick="eleccion_piso(' + index + ')" class="list-group-item cursor">Piso #' + index + '</li>'
        $("#list-config-pisos").append(html);
    }
}

function cargar_pisos_editar(pisos) {
    $("#list-config-pisos").html('');
    $.get("RegistroParqueaderos/traerPisosParqueadero/" + idParqueaderos, function(datos) {
        console.log("pisos  traidos desde la base de datos", datos);
        $.each(datos, function(indice, valor) {
            let html = '<li id="item-piso-' + valor.id + '" onclick="eleccion_piso_editar(' + valor.id + ')" class="list-group-item cursor">Piso #' + valor.piso + '</li>';
            $("#list-config-pisos").append(html);
        });
    });
}


function eleccion_piso(piso) {
    piso_elejido = piso;
    $(".list-group-item").removeClass("active");
    $("#item-piso-" + piso).addClass("active");
    $("#span-piso-configurando").text(piso);
    $("#div-matriz").show();
    $("#div-imprimir-matriz").hide();
    $("#div-imprimir-matriz").html('');
    habilitar_filas_columnas();
}

function eleccion_piso_editar(piso) {
    piso_elejido = piso;
    $(".list-group-item").removeClass("active");
    $("#item-piso-" + piso).addClass("active");
    $("#span-piso-configurando").text(piso);
    $("#div-matriz").show();
    $("#div-imprimir-matriz").hide();
    $("#div-imprimir-matriz").html('');
    habilitar_filas_columnas();
    traerInfoPiso(piso_elejido);
}

function traerInfoPiso(piso) {
    $.get("RegistroParqueaderos/traerInfoPiso/" + piso, function(datos) {
        console.log("estos son los datos del piso ", datos);
        num_columas = datos.info_piso.num_columnas;
        num_filas = datos.info_piso.num_filas;
        num_columas = parseInt(num_columas);
        num_filas = parseInt(num_filas);
        $("#num_filas").val(num_filas);
        $("#num_columas").val(num_columas);
        iniciar_matriz_editar(num_columas, num_filas, datos.puestos_piso);
    });
}


function iniciar_matriz_editar(columnas, filas, puestos) {
    console.log(filas);
    matrix = new Array(filas);
    //Bucle para en cada posición del array crear otro array del número de columnas
    for (var f = 0; f < filas; f++) {
        matrix[f] = new Array(columnas);
    }

    let cont = 0;
    for (var f = 0; f < matrix.length; f++) {
        // Ciclo #2 donde se recorren las columnas de la matriz
        for (var c = 0; c < matrix[f].length; c++) {
            matrix[f][c] = puestos[cont].tipo_puesto;
            cont++;
        }
    }
    imprimir_matriz_editar();
    console.log("asi quedo la matriz de este piso cargado de la base de datos ", matrix);
}

function imprimir_matriz_editar() {
    $("#div-imprimir-matriz").show();
    let html = "";
    let cont = 1;
    // Ciclo anidado donde se le asigna el valor L a todos los campos de la matrix
    for (var f = 0; f < matrix.length; f++) {
        html = html + '<div class="flex">';
        //Bucle que recorre el array que está en la posición i
        for (var c = 0; c < matrix[f].length; c++) {
            if (matrix[f][c] == "L") {
                html = html + '<div id="div_fila_' + f + '_columna_' + c + '"  onclick="columna_seleccionada(' + f + ',' + c + ');" class="columna-matrix"><span id="span_icono_fila_' + f + '_columna_' + c + '"><i class="fas fa-square-full"></i></span><br/><span class="span-contador-columna-fila" id="span_cont_fila_' + f + '_columna_' + c + '">' + cont + '</span></div>';
            } else if (matrix[f][c] == "M") {
                html = html + '<div id="div_fila_' + f + '_columna_' + c + '"  onclick="columna_seleccionada(' + f + ',' + c + ');" class="columna-matrix"><span id="span_icono_fila_' + f + '_columna_' + c + '"><i class="fas fa-motorcycle"></i></span><br/><span class="span-contador-columna-fila" id="span_cont_fila_' + f + '_columna_' + c + '">' + cont + '</span></div>';
            } else if (matrix[f][c] == "C") {
                html = html + '<div id="div_fila_' + f + '_columna_' + c + '"  onclick="columna_seleccionada(' + f + ',' + c + ');" class="columna-matrix"><span id="span_icono_fila_' + f + '_columna_' + c + '"><i class="fas fa-car-side"></i></span><br/><span class="span-contador-columna-fila" id="span_cont_fila_' + f + '_columna_' + c + '">' + cont + '</span></div>';
            }
            //html = html + '<div id="btn_fila_' + f + '_columna_' + c + '" type="button" onclick="columna_seleccionada(' + f + ',' + c + ');" class="div-matrix"><i class="fas fa-square-full"></i></div>';
            cont++;
        }
        html = html + '</div>';
        $("#div-imprimir-matriz").append(html);
        html = "";
    }
}


function guardar_info_matrix() {
    num_columas = $("#num_columnas").val();
    num_filas = $("#num_filas").val();
    num_columas = parseInt(num_columas);
    num_filas = parseInt(num_filas);
    console.log("# columnas", num_columas);
    console.log("# filas", num_filas);
    deshabilitar_filas_columnas();
    iniciar_matriz(num_columas, num_filas);
}

function iniciar_matriz(columnas, filas) {
    matrix = new Array(filas);
    //Bucle para en cada posición del array crear otro array del número de columnas
    for (var f = 0; f < filas; f++) {
        matrix[f] = new Array(columnas);
    }
    // Ciclo anidado donde se le asigna el valor L a todos los campos de la matrix
    // Ciclo #1 donde se recorren las filas de la matriz
    for (var f = 0; f < matrix.length; f++) {
        // Ciclo #2 donde se recorren las columnas de la matriz
        for (var c = 0; c < matrix[f].length; c++) {
            matrix[f][c] = "L";
        }
    }
    imprimir_matriz_inicio();
}


function imprimir_matriz_inicio() {
    $("#div-imprimir-matriz").show();
    let html = "";
    let cont = 1;
    // Ciclo anidado donde se le asigna el valor L a todos los campos de la matrix
    for (var f = 0; f < matrix.length; f++) {
        html = html + '<div class="flex">';
        //Bucle que recorre el array que está en la posición i
        for (var c = 0; c < matrix[f].length; c++) {
            //html = html + '<div id="btn_fila_' + f + '_columna_' + c + '" type="button" onclick="columna_seleccionada(' + f + ',' + c + ');" class="div-matrix"><i class="fas fa-square-full"></i></div>';
            html = html + '<div id="div_fila_' + f + '_columna_' + c + '"  onclick="columna_seleccionada(' + f + ',' + c + ');" class="columna-matrix"><span id="span_icono_fila_' + f + '_columna_' + c + '"><i class="fas fa-square-full"></i></span><br/><span class="span-contador-columna-fila" id="span_cont_fila_' + f + '_columna_' + c + '">' + cont + '</span></div>';
            cont++;
        }
        html = html + '</div>';
        $("#div-imprimir-matriz").append(html);
        html = "";
    }
}

function deshabilitar_filas_columnas() {
    $("#num_filas").prop('disabled', true);
    $("#num_columnas").prop('disabled', true);
    $("#btn-guardar-filas-columnas-matrix").prop('disabled', true);
}

function habilitar_filas_columnas() {
    $("#num_filas").prop('disabled', false);
    $("#num_columnas").prop('disabled', false);
    $("#btn-guardar-filas-columnas-matrix").prop('disabled', false);
}


function marcar_herramienta(herramienta) {
    herramienta_seleccionada = herramienta;
    $(".btn-herramienta").removeClass("btn-success");
    $(".btn-herramienta").addClass("btn-default");
    if (herramienta == "C") {
        $("#btn-herramienta-carro").addClass("btn-success");
        $("#btn-herramienta-carro").removeClass("btn-default");
    } else if (herramienta == "M") {
        $("#btn-herramienta-moto").addClass("btn-success");
        $("#btn-herramienta-moto").removeClass("btn-default");
    } else {
        $("#btn-herramienta-libre").addClass("btn-success");
        $("#btn-herramienta-libre").removeClass("btn-default");
    }
}

function columna_seleccionada(fila, columna) {
    console.log("fila  seleccionada ", fila);
    console.log("columna  seleccionada ", columna);
    if (herramienta_seleccionada == "C") {
        $("#span_icono_fila_" + fila + '_columna_' + columna).html('<i class="fas fa-car-side"></i>');
        matrix[fila][columna] = "C";
    } else if (herramienta_seleccionada == "M") {
        $("#span_icono_fila_" + fila + '_columna_' + columna).html('<i class="fas fa-motorcycle"></i>');
        matrix[fila][columna] = "M";
    } else {
        $("#span_icono_fila_" + fila + '_columna_' + columna).html('<i class="fas fa-square-full"></i>');
        matrix[fila][columna] = "L";
    }
    console.log("asi quedo la matriz despues de elejir una columna", matrix);
}

function guardar_matrix() {
    let arrayJson = JSON.stringify(matrix);
    console.log("este es el array codificado nuev ccarlos", arrayJson);
    let objeto = {
        parqueadero: idParqueaderos,
        piso: piso_elejido,
        filas: num_filas,
        columnas: num_columas,
        matrix: arrayJson
    };
    let url_get = "";
    if (editar_insertar == "I") {
        url_get = "RegistroParqueaderos/guardarMatrixPiso";
    } else {
        url_get = "RegistroParqueaderos/guardarMatrixPisoEditar/" + piso_elejido;
    }
    $.ajax({
        method: "post",
        data: objeto,
        url: url_get,
        beforeSend: function() {
            Funciones.abrirModalCargando();
            $("#btn-guardar-matriz").prop('disabled', true);
            $("#btn-guardar-matriz").html("Guardando Información");
        },
        success: function(datos) {
            if (datos.success == true) {
                alertify.success('<center><b style="color:white;">' + datos.msg + '</b></center>');
            } else {
                alertify.error('<center><b style="color:white;">' + datos.msg + '</b></center>');
            }
            $("#btn-guardar-matriz").prop('disabled', false);
            $("#btn-guardar-matriz").html('<i class="fas fa-save"></i> Guardar Diseño Piso');
            Funciones.cerrarModalCargando();
        },
        error: function(msj) {
            console.log(msj);
            Funciones.cerrarModalCargando();
            $("#btn-guardar-matriz").prop('disabled', false);
            $("#btn-guardar-matriz").html('<i class="fas fa-save"></i> Guardar Diseño Piso');
            alertify.error("<center><b style='color:white;'>Error, se presento un problema en el servidor al realizar la acción, intentelo de nuevo</b></center>");
        }
    });
}