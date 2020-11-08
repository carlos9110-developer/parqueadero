var ultimo_puesto_lejido; // esta variable sirve para saber a cual fue el ultimo puesto que se le asigno un vehiculo
var num_filas;
var num_columas;
var fila_elejida;
var columna_elejida;
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
            matriz_estado[f][c] = puestos[cont].tipo_puesto;
            cont++;
        }
    }
    imprimirMatriz();
    console.log("asi quedo la matriz con los estados de los puestos", matriz_estado);
    console.log("asi quedo la matriz con los ids de los puestos", matriz_id);
}

function imprimirMatriz() {
    $("#div-imprimir-matriz").show();
    $("#div-imprimir-matriz").html('');
    let html = "";
    let cont = 1;
    // Ciclo anidado donde se le asigna el valor L a todos los campos de la matrix
    for (var f = 0; f < matriz_estado.length; f++) {
        html = html + '<div class="flex">';
        //Bucle que recorre el array que está en la posición i
        for (var c = 0; c < matriz_estado[f].length; c++) {
            if (matriz_estado[f][c] == "L") {
                html = html + '<div id="div_fila_' + f + '_columna_' + c + '"  onclick="columna_seleccionada(' + f + ',' + c + ');" class="columna-matrix"><span id="span_icono_fila_' + f + '_columna_' + c + '"><i class="fas fa-square-full"></i></span><br/><span class="span-contador-columna-fila" id="span_cont_fila_' + f + '_columna_' + c + '">' + cont + '</span></div>';
            } else if (matriz_estado[f][c] == "M") {
                html = html + '<div id="div_fila_' + f + '_columna_' + c + '"  onclick="columna_seleccionada(' + f + ',' + c + ');" class="columna-matrix"><span id="span_icono_fila_' + f + '_columna_' + c + '"><i class="fas fa-motorcycle"></i></span><br/><span class="span-contador-columna-fila" id="span_cont_fila_' + f + '_columna_' + c + '">' + cont + '</span></div>';
            } else if (matriz_estado[f][c] == "C") {
                html = html + '<div id="div_fila_' + f + '_columna_' + c + '"  onclick="columna_seleccionada(' + f + ',' + c + ');" class="columna-matrix"><span id="span_icono_fila_' + f + '_columna_' + c + '"><i class="fas fa-car-side"></i></span><br/><span class="span-contador-columna-fila" id="span_cont_fila_' + f + '_columna_' + c + '">' + cont + '</span></div>';
            }
            cont++;
        }
        html = html + '</div>';
        $("#div-imprimir-matriz").append(html);
        html = "";
    }
}