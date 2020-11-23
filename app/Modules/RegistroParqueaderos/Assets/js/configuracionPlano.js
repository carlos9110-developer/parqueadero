var NumPisos;
var IdParqueadero;
var NumColumas = 0;
var NumFilas = 0;
var PisoElejido = 0;
var Matrix = null;
var HerramientaSeleccionada;

function inicio() {
    IdParqueadero = $("#input-id").val();
    NumPisos = $("#input-pisos").val();
    cargar_pisos_inicial(NumPisos);
}

inicio();

function cargar_pisos_inicial(pisos) {
    $("#list-config-pisos").html('');
    for (let index = 1; index <= pisos; index++) {
        let html = `<li id="item-piso-${index}" onclick="eleccionPiso('${index}')" class="list-group-item cursor">Piso #${index}</li>`;
        $("#list-config-pisos").append(html);
    }
}

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

function iniciarMatriz(columnas, filas) {
    Matrix = new Array(filas);
    //Bucle para en cada posición del array crear otro array del número de columnas
    for (var f = 0; f < filas; f++) {
        Matrix[f] = new Array(columnas);
    }
    // Ciclo anidado donde se le asigna el valor L a todos los campos de la matrix
    // Ciclo #1 donde se recorren las filas de la matriz
    for (var f = 0; f < Matrix.length; f++) {
        // Ciclo #2 donde se recorren las columnas de la matriz
        for (var c = 0; c < Matrix[f].length; c++) {
            Matrix[f][c] = "L";
        }
    }
    imprimirMatrizInicio();
}

function imprimirMatrizInicio() {
    $("#div-imprimir-matriz").show();
    let html = "";
    let cont = 1;
    // Ciclo anidado donde se le asigna el valor L a todos los campos de la matrix
    for (var f = 0; f < Matrix.length; f++) {
        html = html + '<div class="flex">';
        //Bucle que recorre el array que está en la posición i
        for (var c = 0; c < Matrix[f].length; c++) {
            html += `<div id="div_fila_${f}_columna_${c}"  onclick="columnaSeleccionada('${f}','${c}');" class="columna-matrix">` +
                `<span id="span_icono_fila_${f}_columna_${c}"><i class="fas fa-square-full"></i></span><br/>` +
                `<span class="span-contador-columna-fila" id="span_cont_fila_${f}_columna_${c}">${cont}</span>` +
                '</div>';
            cont++;
        }
        html += '</div>';
        $("#div-imprimir-matriz").append(html);
        html = "";
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
    habilitarFilasColumnas();
}

function habilitarFilasColumnas() {
    $("#num_filas").prop('disabled', false);
    $("#num_columnas").prop('disabled', false);
    $("#btn-guardar-filas-columnas-matrix").prop('disabled', false);
}


function guardarMatrix() {
    let arrayJson = JSON.stringify(Matrix);
    console.log("este es el array codificado nuev ccarlos", arrayJson);
    let objeto = {
        parqueadero: IdParqueadero,
        piso: PisoElejido,
        filas: NumFilas,
        columnas: NumColumas,
        matrix: arrayJson
    };
    $.ajax({
        method: "post",
        data: objeto,
        url: `${ruta}/RegistroParqueaderos/GuardarMatrixPiso`,
        beforeSend: function() {
            Funciones.abrirModalCargando();
            $("#btn-guardar-matriz").prop('disabled', true);
            $("#btn-guardar-matriz").html("Guardando Información");
        },
        success: function(datos) {
            console.log(datos);
            if (datos.success) {
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