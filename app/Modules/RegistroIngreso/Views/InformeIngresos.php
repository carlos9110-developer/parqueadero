<?php
    require(RUTA_APP . '/Views/inc/header_2.php');
?>
<style>
.container-fluid{
    margin-top: 30px;
}
</style>

<div class="container-fluid">
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
                                <th>Tipo Vehículo</th>
                                <th>Placa</th>
                                <th>Marca</th>
                                <th>Piso</th>
                                <th>Fecha Ingreso</th>
                                <th>Fecha Salida</th>
                                <th># Horas</th>
                                <th>Precio</th>
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




<?php require(RUTA_APP . '/Views/inc/cargando.php'); ?>
<?php require(RUTA_APP . '/Views/inc/footer2.php'); ?>
<script src="<?php echo RUTA_URL?>/RegistroIngreso/files?js=Assets/js/informeIngresos.js"></script>

