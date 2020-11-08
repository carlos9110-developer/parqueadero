<?php
require(RUTA_APP . '/Views/inc/header_2.php');
?>

<style>
    #btn-ver-informacion {
    width: 100%;
    margin-bottom: 10px;
    margin-top: 20px;
    height: 50px;
}

#btn-configuracion-plano {
    width: 100%;
    height: 50px;
}

#img-muestra {
    width: 150px;
    height: 150px;
    margin-top: 10px;
}

.btn-config-pisos {
    width: 100%;
    height: 50px;
    margin-top: 20px;
    margin-bottom: 10px;
}

.btn-default {
    background: #dbe0e4;
}

.cursor {
    cursor: pointer;
}

#btn-ver-plano-completo {
    width: 100%;
    height: 50px;
    margin-top: 20px;
    margin-bottom: 10px;
}

.btn-columna {
    margin-right: 5px;
}

#div-btn-guardar-fila {
    margin-top: 10px;
}

#btn-guardar-filas-columnas-matrix {
    width: 80%;
    padding-bottom: 1px;
    padding-top: 5px;
}

.div-columna-matrix{
    width: 50px;
    height: 50px
}

.flex{
    display: flex;
}

.columna-matrix{
    width: 50px;
    height: 50px;
    border: 1px solid #af9d9d;
    padding-top: 2px;
    padding-right: 8px;
    padding-left: 8px;
}

#btn-guardar-matriz{
    margin-left: 20px;
}

#div-imprimir-matriz{
    margin-top: 1%;
    margin-left: 1%;
}

.span-contador-columna-fila
{
    font-size: 13px;
}
</style>

<div class="container-fluid">
    <div class="card">
          <div class="card-header">
            <?php   echo $datos['titulo_vista'] ?>
          </div>
          <div class="card-body">

            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-3">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-address-card"></i></span>
                        </div>
                        <input pattern="[0-9]+" type="number" class="form-control" placeholder="Documento Usuario" name="documento-input" id="documento-input" required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary" onclick="abrirRegistrarUsuario();"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-3">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                        </div>
                        <input  pattern="[A-Za-z]{3-50}" type="text" class="form-control" placeholder="Nombre del usuario" name="nombre-input" id="nombre-input" required>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-3">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-sort-alpha-down"></i></span>
                        </div>
                        <input  pattern="[A-Za-z]{3-50}" type="text" class="form-control" placeholder="Placa del vehículo" name="placa-input" id="placa-input" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-3">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-copyright"></i></span>
                        </div>
                        <select id="marca-input" name="marca-input" class="form-control">
                            <option value="">Seleccione la marca</option>
                            <?php foreach($datos['listaMarcas'] as $marca  ): ?>
                                <option value="<?= $marca->marca ?>"><?= $marca->marca ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-3">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-tachometer-alt"></i></span>
                        </div>
                        <select id="tipo-input" name="tipo-input" class="form-control">
                            <option value="">Seleccione tipo vehículo</option>
                            <option value="Moto">Moto</option>
                            <option value="Carro">Carro</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-3">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-sort-numeric-up"></i></span>
                        </div>
                        <select onchange="eleccionPiso(this.value);" id="tipo-input" name="tipo-input" class="form-control">
                            <option value="">Seleccione el piso</option>
                            <?php foreach($datos['listaPisos'] as $piso  ): ?>
                                <option value="<?= $piso->id ?>"><?= $piso->piso ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div id="div-imprimir-matriz"></div>
                </div>
            </div>
            
          </div>
    </div>
</div>


<?php require(RUTA_APP . '/Views/inc/cargando.php'); ?>
<script src="<?php echo RUTA_URL?>/RegistroIngreso/files?js=Assets/js/ingreso.js"></script>



<?php require(RUTA_APP . '/Views/inc/footer.php'); ?>
