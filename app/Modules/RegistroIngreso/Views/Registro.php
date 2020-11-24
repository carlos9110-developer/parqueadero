<?php
    require(RUTA_APP . '/Views/inc/header_2.php');
?>
<div class="container-fluid">
    <div class="col-lg-12 text-right">
        <a class="btn btn-info" href="<?php echo RUTA_URL ?>/Inicio/InicioSistema"><i class="fas fa-reply"></i> Menú</a>
    </div>
    <div class="card">
        <div class="card-header">
            <?php   echo $datos['titulo_vista'] ?>
        </div>
        <div class="card-body">
            <form  name="form-registro-parqueo" id="form-registro-parqueo"  method="POST">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-address-card"></i></span>
                            </div>
                            <input onkeyup="digitacionDocumento();" pattern="[0-9]+" type="number" class="form-control" placeholder="Documento Usuario" name="documento-input" id="documento-input" required>
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
                            <select id="marca-input" name="marca-input" class="form-control" required>
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
                                <option value="M">Moto</option>
                                <option value="C">Carro</option>
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
                <div class="col-lg-12 text-center">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Registrar Ingreso</button>
                </div>
            </form>                    

            <div class="row" id="div-plano">
                <div class="col-lg-3">
                    <div class="card" style="width: 200px;">
                        <div class="card-header">
                            Colores Estados
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item columna-libre">Libre</li>
                            <li class="list-group-item columna-seleccionada">Seleccionado</li>
                            <li class="list-group-item columna-ocupada">Ocupado</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div id="div-imprimir-matriz"></div>
                </div>
            </div>
            
        </div>
    </div>
</div>


<!-- MODALES -->
<div id="modal-registrar-cliente" class="modal" tabindex="-1" role="dialog" data-backdrop='static' data-keyboard='false'>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registro Cliente</h5>
                <button type="button" class="close" onclick="cerrarModalRegistroCliente()"  aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  id="form-usuarios"  method="POST" name="form-usuarios">
                    <div class="row">            
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                            <label for="cedula">Cédula</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-address-card"></i></span>
                                </div>
                                <input  pattern="[0-9]+"   type="text" class="form-control" placeholder="Digite la cédula sin puntos" name="cedula" id="cedula" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                            <label for="nombre">Nombre</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                                <input  pattern="[A-Za-z]{3-50}" type="text" class="form-control" placeholder="Nombre" name="nombre" id="nombre" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                <label for="telefono">Teléfono</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-address-card"></i></span>
                                </div>
                                <input  pattern="[0-9]+"   type="text" class="form-control" placeholder="Digite el número de celular" name="telefono" id="telefono" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                            <label for="correo">Correo</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="email" class="form-control" placeholder="Digite el correo" name="correo" id="correo" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <button id="btn-submit" class="btn btn-success btn-lg" type="submit"><i class="fas fa-save"></i><b> Guardar</b></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="cerrarModalRegistroCliente()" style="font-weight: bold;" class="btn btn-danger btn-md">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?php require(RUTA_APP . '/Views/inc/cargando.php'); ?>
<?php require(RUTA_APP . '/Views/inc/footer2.php'); ?>
<script src="<?php echo RUTA_URL?>/RegistroIngreso/files?js=Assets/js/ingreso.js"></script>

