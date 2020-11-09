/**VARIABLES PARA SABER CUAL FUE EL ULTIMO PUESTO SELECCIONADO */
var ultima_columna_elejida;
var ultima_fila_elejida;

var num_filas;
var num_columas;

/**MATRICES DONDE SE ALMACENAN EN UNA LOS ESTADOS Y EN OTRA LOS ID DE LOS PUESTOS */
var matriz_id;
var matriz_estado;

function eleccionPiso(piso) {
    traerInfoPiso(piso);
}


function traerInfoPiso(piso) {
    $.get("RegistroParqueaderos/traerInfoPiso/" + piso, function(datos) {
        num_columas = datos.info_piso.num_columnas;
        num_filas = datos.info_piso.num_filas;
        num_columas = parseInt(num_columas);
        num_filas = parseInt(num_filas);
        $("#num_filas").val(num_filas);
        $("#num_columas").val(num_columas);
        iniciarMatriz(num_columas, num_filas, datos.puestos_piso);
    });
}

function iniciarMatriz(columnas, filas, puestos) {
    matriz_id = new Array(filas);
    matriz_estado = new Array(filas);
    //Bucle para en cada posición del array crear otro array del número de columnas
    for (var f = 0; f < filas; f++) {
        matriz_id[f] = new Array(columnas);
        matriz_estado[f] = new Array(columnas);
    }
    let cont = 0;
    for (var f = 0; f < matriz_id.length; f++) {
        // Ciclo #2 donde se recorren las columnas de la matriz
        for (var c = 0; c < matriz_id[f].length; c++) {
            matriz_id[f][c] = puestos[cont].id;
            matriz_estado[f][c] = puestos[cont].estado;
            cont++;
        }
    }
    imprimirPlano(puestos);
    //imprimirPlano(puestos);
    console.log("asi quedo la matriz con los estados de los puestos", matriz_estado);
    console.log("asi quedo la matriz con los ids de los puestos", matriz_id);
}

// función donde se imprime el plano del parqueadero
function imprimirPlano(puestos) {
    $("#div-imprimir-matriz").show();
    $("#div-imprimir-matriz").html('');
    let html = "";
    let cont = 1;
    let contArray = 0;
    let iconoPuesto = "";
    let claseColor = "";
    for (var f = 0; f < matriz_estado.length; f++) {
        html = html + '<div class="flex">';
        //Bucle que recorre el array que está en la posición i
        for (var c = 0; c < matriz_estado[f].length; c++) {
            iconoPuesto = retornarIconoColumna(puestos[contArray].tipo_puesto);
            claseColor = retornarClaseColorColumna(puestos[contArray].estado);
            if (puestos[contArray].tipo_puesto == "L") {
                html = html + `<div id="div_fila_${f}_columna_${c}"  class="columna-matrix ${claseColor}"><span id="span_icono_fila_${f}_columna_${c}"><i class="${iconoPuesto}"></i></span><br/><span class="span-contador-columna-fila" id="span_cont_fila_${f}_columna_${c}">${cont}</span></div>`;
            } else {
                html = html + `<div id="div_fila_${f}_columna_${c}"  onclick="columna_seleccionada('${f}','${c}','${puestos[contArray].tipo_puesto}');" class="columna-matrix ${claseColor}"><span id="span_icono_fila_${f}_columna_${c}"><i class="${iconoPuesto}"></i></span><br/><span class="span-contador-columna-fila" id="span_cont_fila_${f}_columna_${c}">${cont}</span></div>`;
            }
            cont++;
            contArray++;
        }
        html = html + '</div>';
        $("#div-imprimir-matriz").append(html);
        html = "";
    }
}

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

function retornarClaseColorColumna(estado) {
    let claseColor = "";
    switch (estado) {
        case "L":
            claseColor = "columna-libre";
            break;
        case "O":
            claseColor = "columna-ocupada";
            break;
        case "M":
            claseColor = "columna-mensualidad";
            break;
    }
    return claseColor;
}

// función donde se selecciona un puesto para guardar un determinado
function columna_seleccionada(fila, columna, tipoPuesto) {
    if ($("#tipo-input").val() != "") {
        if (tipoPuesto == $("#tipo-input").val()) {
            if (matriz_estado[parseInt(fila)][parseInt(columna)] == "L") {
                ultima_columna_elejida = columna;
                ultima_fila_elejida = fila;
            } else {

            }
        } else {

        }
    } else {

    }
    console.log("fila  seleccionada ", parseInt(fila));
    console.log("columna  seleccionada ", columna);
    console.log("columna  estado ", estado);
}