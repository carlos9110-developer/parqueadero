/**VARIABLES PARA SABER CUAL FUE EL ULTIMO PUESTO SELECCIONADO */
var columna_elejida = false;
var fila_elejida = false;
var seleccionPuesto = false;

var num_filas;
var num_columas;

/**MATRICES DONDE SE ALMACENAN EN UNA LOS ESTADOS Y EN OTRA LOS ID DE LOS PUESTOS */
var matriz_id;
var matriz_estado;

function inicio() {
    $("#form-registro-parqueo").on("submit", function(e) {
        accion_form_parqueo(e);
    });
    $("#form-usuarios").on("submit", function(e) {
        accion_form_usuarios(e);
    });
}
inicio();

function eleccionPiso(piso) {
    $("#div-imprimir-matriz").html("");
    traerInfoPiso(piso);
}

function traerInfoPiso(piso) {
    $.get(`${ruta}/RegistroParqueaderos/traerInfoPiso/${piso}`, function(datos) {
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
}

// función donde se imprime el plano del parqueadero
function imprimirPlano(puestos) {
    $("#div-imprimir-matriz").show();
    $("#div-imprimir-matriz").html('');
    let html = "";
    let cont = 1;
    let contArray = 0;
    for (var f = 0; f < matriz_estado.length; f++) {
        html = html + '<div class="flex">';
        //Bucle que recorre el array que está en la posición i
        for (var c = 0; c < matriz_estado[f].length; c++) {
            if (puestos[contArray].tipo_puesto == "L") {
                html = html + `<div id="div_fila_${f}_columna_${c}"  class="columna-matrix ${retornarClaseColorColumna(puestos[contArray].estado)}"><span id="span_icono_fila_${f}_columna_${c}"><i class="${retornarIconoColumna(puestos[contArray].tipo_puesto)}"></i></span><br/><span class="span-contador-columna-fila" id="span_cont_fila_${f}_columna_${c}">${cont}</span></div>`;
            } else {
                html = html + `<div id="div_fila_${f}_columna_${c}"  onclick="columna_seleccionada('${f}','${c}','${puestos[contArray].tipo_puesto}');" class="columna-matrix ${retornarClaseColorColumna(puestos[contArray].estado)}"><span id="span_icono_fila_${f}_columna_${c}"><i class="${retornarIconoColumna(puestos[contArray].tipo_puesto)}"></i></span><br/><span class="span-contador-columna-fila" id="span_cont_fila_${f}_columna_${c}">${cont}</span></div>`;
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
                if (seleccionPuesto == true) {
                    quitarEstadoSeleccionadoPuesto(fila_elejida, columna_elejida);
                    quitarClaseColumnaSeleccionada(fila_elejida, columna_elejida);
                }
                asignarClaseColumnaSeleccionada(fila, columna);
                seleccionPuesto = true;
                fila_elejida = parseInt(fila);
                columna_elejida = parseInt(columna);
                matriz_estado[parseInt(fila)][parseInt(columna)] = "S";
                console.log(matriz_estado);
            } else if (matriz_estado[parseInt(fila)][parseInt(columna)] == "O") {
                alertify.error("<center><b style='color:white;'>Error, el puesto se encuentra ocupado</b></center>");
            } else if (matriz_estado[parseInt(fila)][parseInt(columna)] == "M") {
                alertify.error("<center><b style='color:white;'>Error, el puesto se encuentra reservado para mensualidad</b></center>");
            }
        } else {
            alertify.error("<center><b style='color:white;'>Error, el puesto elejido no coincide con el tipo de vehículo seleccionado</b></center>");
        }
    } else {
        alertify.error("<center><b style='color:white;'>Error, primero debe elejir el tipo de vehículo</b></center>");
    }
}


// función que se activa cuando digitan en el input documento-input
function digitacionDocumento() {
    let cedulaCliente = $("#documento-input").val();
    cedulaCliente = parseInt(cedulaCliente);
    $("#nombre-input").val("");
    if (cedulaCliente != "") {
        if (cedulaCliente >= 100000) {
            if (!isNaN(cedulaCliente)) {
                consultarExistenciaCliente(cedulaCliente);
            }
        }
    }
}

// función retornar valor consultado según cedula digitada
function consultarExistenciaCliente(cedula) {
    $.get(`${ruta}/RegistroIngreso/consultarCliente/${cedula}`, function(datos) {
        if (datos.res) {
            $("#nombre-input").val(datos.infoCliente.nombre);
            $("#placa-input").focus();
        }
    });
}

// función donde se asigna la clase columna-seleccionada
function asignarClaseColumnaSeleccionada(fila, columna) {
    $(`#div_fila_${fila}_columna_${columna}`).removeClass("columna-libre");
    $(`#div_fila_${fila}_columna_${columna}`).addClass("columna-seleccionada");
}

// función donde se quita la clase columna-seleccionada
function quitarClaseColumnaSeleccionada(fila, columna) {
    $(`#div_fila_${fila}_columna_${columna}`).removeClass("columna-seleccionada");
    $(`#div_fila_${fila}_columna_${columna}`).addClass("columna-libre");
}

// función donde se quita el estado de seleccionado "S" a una determinada columna, para asignarle el "L" de libre
function quitarEstadoSeleccionadoPuesto(fila, columna) {
    matriz_estado[fila][columna] = "L";
}

// función donde se abre el modal para registrar un determinado cliente
function abrirRegistrarUsuario() {
    $("#modal-registrar-cliente").modal("show");
}

// función donde se guarda un determinado cliente
function accion_form_usuarios(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    var objeto = new FormData($("#form-usuarios")[0]);
    $.ajax({
        method: "post",
        processData: false,
        contentType: false,
        cache: false,
        data: objeto,
        url: `${ruta}/RegistroUsuariosAdministrador/insertarForm`,
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
            console.log(datos);
            if (datos.success) {
                $("#nombre-input").val($("#nombre").val());
                $("#documento-input").val($("#cedula").val());
                $("#placa-input").focus();
                alertify.success("<center><b style='color:white;'>" + datos.msg + "</b></center>");
                cerrarModalRegistroCliente();
            } else {
                alertify.error("<center><b style='color:white;'>" + datos.msg + "</b></center>");
            }
            Funciones.cerrarModalCargando();
        },
        error: function(msj) {
            console.log(msj);
            Funciones.cerrarModalCargando();
        }
    });
}

// función donde se cierra el modal para registrar clientes
function cerrarModalRegistroCliente() {
    $("#modal-registrar-cliente").modal("hide");
    $("#form-usuarios")[0].reset();
}

// función donde se retorna el objeto para con la información para registrar un ingreso
function cargarObjetoRegistroIngreso() {
    let objetoRegistro = new Object();
    objetoRegistro.cedula = $("#documento-input").val();
    objetoRegistro.placa = $("#placa-input").val();
    objetoRegistro.marca = $("#marca-input").val();
    objetoRegistro.tipo = $("#tipo-input").val();
    objetoRegistro.fila = fila_elejida;
    objetoRegistro.columna = columna_elejida;
    objetoRegistro.matriz_estado = JSON.stringify(matriz_estado);
    objetoRegistro.matriz_id = JSON.stringify(matriz_id);
    console.log("este es el objeto", objetoRegistro);
    return objetoRegistro;
}


//función donde se procesa el submit del formulario para registrar ingreso de parqueaderos
function accion_form_parqueo(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    if (seleccionPuesto) {
        registroInformacionIngreso();
    } else {
        alertify.error("<center><b style='color:white;'>Error, debe seleccionar el puesto</b></center>");
    }
}

// función donde se envia la información al servidor para registrar el ingreso de un parqueadero por ajax
function registroInformacionIngreso() {
    $.ajax({
        method: "post",
        /*estos datos se deben de esconder cuando se envian estos objetos
        processData: false,
        contentType: false,
        cache: false,
        */
        data: cargarObjetoRegistroIngreso(),
        url: `${ruta}/RegistroIngreso/registroParqueo`,
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
            console.log(datos);
            if (datos.res) {
                alertify.success("<center><b style='color:white;'>" + datos.msg + "</b></center>");
                $("#div-imprimir-matriz").html("");
                $("#form-registro-parqueo")[0].reset();
                seleccionPuesto = false;
            } else {
                alertify.error("<center><b style='color:white;'>" + datos.msg + "</b></center>");
            }
            Funciones.cerrarModalCargando();
        },
        error: function(msj) {
            console.log(msj);
            Funciones.cerrarModalCargando();
        }
    });
}




/* otra forma de inicializar un objeto javascript
var myCar = {
make: 'Ford',
model: 'Mustang',
year: 1969
};
*/