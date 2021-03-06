var NumPisos;
var IdParqueadero;
var NumColumas = 0;
var NumFilas = 0;
var PisoElejido = 0;
var Matrix = null;
var MatrixIds = null;
var HerramientaSeleccionada;

function inicio() {
    IdParqueadero = $("#input-id").val();
}

inicio();

// función donde se guarda el número de filas y columnas de una matriz
function guardarInfoMatrix() {
    if (PisoElejido != 0) {
        if ($("#num_columnas").val() != '' && $("#num_filas").val() != '') {
            NumColumas = $("#num_columnas").val();
            NumFilas = $("#num_filas").val();
            NumColumas = parseInt(NumColumas);
            NumFilas = parseInt(NumFilas);
            deshabilitarFilasColumnas();
            iniciarMatriz(NumColumas, NumFilas);
        } else {
            alertify.error("<center><b style='color:white;'>Error, debe digitar el número de columnas y de filas</b></center>");
        }
    } else {
        alertify.error("<center><b style='color:white;'>Error, debe elejir primero un piso</b></center>");
    }
}

function columnaSeleccionada(fila, columna) {
    if (HerramientaSeleccionada == "C") {
        $(`#span_icono_fila_${fila}_columna_${columna}`).html('<i class="fas fa-car-side"></i>');
        Matrix[fila][columna] = "C";
    } else if (HerramientaSeleccionada == "M") {
        $(`#span_icono_fila_${fila}_columna_${columna}`).html('<i class="fas fa-motorcycle"></i>');
        Matrix[fila][columna] = "M";
    } else {
        $(`#span_icono_fila_${fila}_columna_${columna}`).html('<i class="fas fa-square-full"></i>');
        Matrix[fila][columna] = "L";
    }
    console.log("asi quedo la matriz despues de elejir una columna", Matrix);
}

function marcarHerramienta(herramienta) {
    HerramientaSeleccionada = herramienta;
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

function deshabilitarFilasColumnas() {
    $("#num_filas").prop('disabled', true);
    $("#num_columnas").prop('disabled', true);
    $("#btn-guardar-filas-columnas-matrix").prop('disabled', true);
}

function eleccionPiso(piso) {
    PisoElejido = piso;
    $(".list-group-item").removeClass("active");
    $("#item-piso-" + piso).addClass("active");
    $("#span-piso-configurando").text(piso);
    $("#div-matriz").show();
    $("#div-imprimir-matriz").hide();
    $("#div-imprimir-matriz").html('');
    traerInfoPiso(piso);
}

function traerInfoPiso(piso) {
    $.get(`${ruta}/RegistroParqueaderos/traerInfoPiso/${piso}`, function(datos) {
        NumColumas = parseInt(datos.info_piso.num_columnas);
        NumFilas = parseInt(datos.info_piso.num_filas);
        $("#num_filas").val(NumFilas);
        $("#num_columnas").val(NumColumas);
        iniciarMatriz(NumColumas, NumFilas, datos.puestos_piso);
    });
}

function iniciarMatriz(columnas, filas, puestos) {
    Matrix = new Array(filas);
    MatrixIds = new Array(filas);
    //Bucle para en cada posición del array crear otro array del número de columnas
    for (var f = 0; f < filas; f++) {
        Matrix[f] = new Array(columnas);
        MatrixIds[f] = new Array(columnas);
    }
    let cont = 0;
    for (var f = 0; f < MatrixIds.length; f++) {
        // Ciclo #2 donde se recorren las columnas de la matriz
        for (var c = 0; c < MatrixIds[f].length; c++) {
            Matrix[f][c] = puestos[cont].tipo_puesto;
            MatrixIds[f][c] = puestos[cont].id;
            cont++;
        }
    }
    console.log("esta es la matrix de tipo puesto", Matrix);
    console.log("esta es la matrix de ids", MatrixIds);
    imprimirPlano(puestos);
}

//
function imprimirPlano(puestos) {
    $("#div-imprimir-matriz").show();
    let html = "";
    let cont = 1;
    let contArray = 0;
    // Ciclo anidado donde se le asigna el valor L a todos los campos de la matrix
    for (var f = 0; f < Matrix.length; f++) {
        html = html + '<div class="flex">';
        //Bucle que recorre el array que está en la posición i
        for (var c = 0; c < Matrix[f].length; c++) {
            html += `<div id="div_fila_${f}_columna_${c}"  onclick="columnaSeleccionada('${f}','${c}');" class="columna-matrix">` +
                `<span id="span_icono_fila_${f}_columna_${c}"><i class="${retornarIconoColumna(puestos[contArray].tipo_puesto)}"></i></span><br/>` +
                `<span class="span-contador-columna-fila" id="span_cont_fila_${f}_columna_${c}">${cont}</span>` +
                '</div>';
            cont++;
            contArray++;
        }
        html += '</div>';
        $("#div-imprimir-matriz").append(html);
        html = "";
    }
}

// metodo que retorna el icono de la columnam, según sea el tipo de puesto
function retornarIconoColumna(tipoPuesto) {
    let iconoPuesto = "";
    switch (tipoPuesto) {
        case "L":
            iconoPuesto = "fas fa-square-full";
            break;
        case "M":
            iconoPuesto = "fas fa-motorcycle";
            break;
        case "C":
            iconoPuesto = "fas fa-car-side";
            break;
    }
    return iconoPuesto;
}


function guardarMatrix() {
    let arrayJson = JSON.stringify(Matrix);
    let arrayJson2 = JSON.stringify(MatrixIds);
    console.log("este es el array codificado nuev ccarlos", arrayJson);
    let objeto = {
        parqueadero: IdParqueadero,
        piso: PisoElejido,
        filas: NumFilas,
        columnas: NumColumas,
        matrixTipo: arrayJson,
        matrixIds: arrayJson2
    };
    $.ajax({
        method: "post",
        data: objeto,
        url: `${ruta}/RegistroParqueaderos/EditarMatrixPiso`,
        beforeSend: function() {
            Funciones.abrirModalCargando();
            $("#btn-guardar-matriz").prop('disabled', true);
            $("#btn-guardar-matriz").html("Guardando Información");
        },
        success: function(datos) {
            console.log(datos);
            if (datos.res) {
                alertify.success(`<center><b style="color:white;">${datos.msg}</b></center>`);
            } else {
                alertify.error(`<center><b style="color:white;">${datos.msg}</b></center>`);
            }
            $("#btn-guardar-matriz").prop('disabled', false);
            $("#btn-guardar-matriz").html('<i class="fas fa-save"></i> Guardar Diseño Piso');
            Funciones.cerrarModalCargando();
        },
        error: function(msj) {
            console.log(`<center><b style='color:white;'>${msj.responseText}</b></center>`);
            Funciones.cerrarModalCargando();
            $("#btn-guardar-matriz").prop('disabled', false);
            $("#btn-guardar-matriz").html('<i class="fas fa-save"></i> Guardar Diseño Piso');
            alertify.error("<center><b style='color:white;'>Error, se presento un problema en el servidor al realizar la acción, intentelo de nuevo</b></center>");
        }
    });
}