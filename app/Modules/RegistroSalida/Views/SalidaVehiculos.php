<?php
    require(RUTA_APP . '/Views/inc/header_2.php');
?>
<style>
.container-fluid{
    margin-top: 30px;
}
</style>

<div class="container-fluid">
    <div class="col-lg-12 text-right">
        <a class="btn btn-info" href="<?php echo RUTA_URL ?>/Inicio/InicioSistema"><i class="fas fa-reply"></i> Menú</a>
    </div>
    <div class="card">
        <div class="card-header">
            <?php   echo $datos['titulo_vista'] ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                    <label for="fecha-inicio-input">Fecha Inicio Filtro</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-filter"></i></span>
                        </div>
                        <input onchange="cambioFecha();" value="<?= $datos['fechaInicioFiltro']; ?>"  type="date" class="form-control"  name="fecha-inicio-input" id="fecha-inicio-input">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                    <label for="fecha-fin-input">Fecha Fin Filtro</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-filter"></i></span>
                        </div>
                        <input onchange="cambioFecha();" value="<?= $datos['fechaFinFiltro']; ?>" type="date" class="form-control"  name="fecha-fin-input" id="fecha-fin-input">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table id="tbl_ingresos" style="font-size: 13px; width: 100%" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="active">
                                <th>ID</th>
                                <th>Documento</th>
                                <th>Placa</th>
                                <th>Marca</th>
                                <th>Piso</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- MODALES -->
<div id="modal-confirmar-salida" class="modal" tabindex="-1" role="dialog" data-backdrop='static' data-keyboard='false'>
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Información Salida</h5>
                <button type="button" class="close" onclick="cerrarModalConfirmacionSalida()"  aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">    
                    <div class="col-lg-12 text-center" id="div-cargar-info-salida">

                    </div>        
                </div>
                <div class="row">
                    <div class="col-lg-6 text-center">
                        <button type="button" onclick="cerrarModalConfirmacionSalida()"  class="btn btn-danger btn-md">Cancelar</button>
                    </div>
                    <div class="col-lg-6 text-center">
                        <button onclick="registrarSalidaVehiculo();"  class="btn btn-success" type="button">Aceptar</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<?php require(RUTA_APP . '/Views/inc/cargando.php'); ?>
<?php require(RUTA_APP . '/Views/inc/footer2.php'); ?>
<script src="<?php echo RUTA_URL?>/RegistroSalida/files?js=Assets/js/salida.js"></script>

