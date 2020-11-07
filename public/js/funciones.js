const ruta = document.getElementById("ruta_app").value;
var Funciones = (function() {
    return {
        cerrarModalCargando: function() {
            setTimeout(function() {
                $("#cargando").modal("hide");
            }, 1000);
        },
        abrirModalCargando: function() {
            $("#cargando").modal("show");
        },
        mensajeCerroSesion: function() {
            alertify.error(
                "<center><b style='color:white;'>Error, ha caducado la sesión, ingrese nuevamente</b></center>"
            );
            setTimeout(function() {
                window.location.href = "Login/cerrarSession";
            }, 3000);
        },
        retornarUrl: function() {
            return "http://localhost/adminsoft";
        }
    };
})();