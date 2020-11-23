// función que se inicia al empezar el archivo
function inicio() {
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

function resetForm() {
    $("#form-parqueaderos")[0].reset();
    $('#img-muestra').attr('src', "https://via.placeholder.com/150"); // Seteamos la imagen inicial

}

// función donde se guarda un determinado cliente
function accion_form(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    let objeto = new FormData($("#form-parqueaderos")[0]);
    $.ajax({
        method: "post",
        processData: false,
        contentType: false,
        cache: false,
        data: objeto,
        url: `${ruta}/RegistroParqueaderos/InsertarForm`,
        beforeSend: function() {
            Funciones.abrirModalCargando();
        },
        success: function(datos) {
            if (datos.res) {
                alertify.success(`<center><b style='color:white;'>${datos.msg}</b></center>`);
                resetForm();
            } else {
                alertify.error(`<center><b style='color:white;'>${datos.msg}</b></center>`);
            }
            Funciones.cerrarModalCargando();
        },
        error: function(msj) {
            console.log(`<center><b style='color:white;'>${msj.responseText}</b></center>`);
            console.log(msj);
            Funciones.cerrarModalCargando();
        }
    });
}