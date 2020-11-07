<?php require(RUTA_APP . '/Views/inc/header_2.php'); ?>

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
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-3">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-sort-numeric-up"></i></span>
                        </div>
                        <select id="tipo-input" name="tipo-input" class="form-control">
                            <option value="">Seleccione el piso</option>
                        </select>
                    </div>
                </div>
            </div>
            
          </div>
    </div>
</div>


<?php require(RUTA_APP . '/Views/inc/cargando.php'); ?>
<script src="<?php echo RUTA_URL?>/RegistroIngreso/files?js=Assets/js/ingreso.js"></script>



<?php require(RUTA_APP . '/Views/inc/footer.php'); ?>
