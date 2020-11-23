<?php require(RUTA_APP . '/Views/inc/header.php'); ?>
<div id="wrapper">

    <?php require(RUTA_APP . '/Views/inc/sidebar.php'); ?>

    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
        <div id="content">
            <?php require(RUTA_APP . '/Views/inc/navbar.php'); ?>
            <div class="container-fluid">
                <div class="col-lg-12 text-right">
                    <a class="btn btn-info" href="<?php echo RUTA_URL ?>/RegistroParqueaderos"><i class="fas fa-reply"></i> Listado Parqueaderos</a>
                </div>
                <div class="card">
                    <div class="card-header">
                        <?php   echo $datos['titulo_vista'] ?>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" method="post" id="form-parqueaderos" name="form-registro-parqueaderos">
                        <input type="hidden" id="id" name="id" value="<?= $datos['infoParqueadero']->id; ?>">
                            <!-- DIV CONFIGURACIÓN INFORMACIÓN -->
                            <div id="div-informacion-parqueadero">
                                <div class="row">
                                <!-- ESPACIO PARA SELECCIONAR LA IMAGEN -->
                                    <div class="col-lg-4">
                                        <div class="row">
                                            <?php  if($datos['infoParqueadero']->registro_logo=="0" ):  ?>
                                            <div class="col-lg-12 text-center">
                                                <img id="img-muestra" src="https://via.placeholder.com/150" title="Logo Parqueadero" alt="Logo Parqueadero" />
                                            </div>
                                            <?php endif; ?>
                                            <?php  if($datos['infoParqueadero']->registro_logo=="1" ):  ?>
                                            <div class="col-lg-12 text-center">
                                                <img id="img-muestra" src="<?= RUTA_URL ?>/public/img/logos_parqueaderos/<?= $datos['infoParqueadero']->id.".jpg"; ?>" title="Logo Parqueadero" alt="Logo Parqueadero" />
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 text-center">
                                                <label for="nit">Seleccionar Imagen</label>
                                                <input id="logo" name="logo" type="file"  class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FIN ESPACIO PARA SELECCIONAR IMAGEN -->
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                <label for="nit">Nit</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-address-card"></i></span>
                                                    </div>
                                                    <input pattern="[0-9]+"   type="text" class="form-control" placeholder="Digite el Nit" name="nit" id="nit" value="<?= $datos['infoParqueadero']->nit; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                <label for="nombre">Nombre</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                                    </div>
                                                    <input pattern="[A-Za-z]{3-50}" type="text" class="form-control" placeholder="Digite el nombre" name="nombre" id="nombre" value="<?= $datos['infoParqueadero']->nombre; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-3">
                                                <label for="direccion">Dirección</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marker-alt"></i></span>
                                                    </div>
                                                    <input pattern="[A-Za-z]{3-50}" type="text" class="form-control" placeholder="Digite la dirección" name="direccion" id="direccion" value="<?= $datos['infoParqueadero']->direccion; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                <label for="telefono">Teléfono</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-mobile-alt"></i></span>
                                                    </div>
                                                    <input pattern="[0-9]+" type="text" class="form-control" placeholder="Digite el teléfono" name="telefono" id="telefono" value="<?= $datos['infoParqueadero']->telefono; ?>" required>
                                                </div>           
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                <label for="pisos"># Pisos</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marker-alt"></i></span>
                                                    </div>
                                                    <input min="1" type="number" class="form-control" placeholder="Digite la cantidad de pisos" name="pisos" id="pisos" value="<?= $datos['infoParqueadero']->pisos; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                <label for="capacidad_carros"># Capacidad Carros</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-car-side"></i></span>
                                                    </div>
                                                    <input  min="0" type="number" class="form-control" placeholder="Digite la capacidad de carros" name="capacidad_carros" id="capacidad_carros" value="<?= $datos['infoParqueadero']->capacidad_carros; ?>" required>
                                                </div>           
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                <label for="capacidad_motos"># Capacidad Motos</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-motorcycle"></i></span>
                                                    </div>
                                                    <input  min="0" type="number" class="form-control" placeholder="Digite la capacidad motos" name="capacidad_motos" id="capacidad_motos" value="<?= $datos['infoParqueadero']->capacidad_motos; ?>" required>
                                                </div>
                                            </div>                             
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 text-center" id="div-btn-registrar-editar-informacion">
                                                <button class="btn btn-success" type="submit" id="btn_guardar"><i class="fas fa-save"></i> <b> Editar Información</b></button>
                                            </div>
                                        </div>
                                    </div>   
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        
         
        <?php require(RUTA_APP . '/Views/inc/cargando.php'); ?>
        <script src="<?php echo RUTA_URL?>/RegistroParqueaderos/files?js=Assets/js/editar.js"></script>

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span><?php echo INFO_AUTOR; ?></span>
            </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
</div>
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<?php require(RUTA_APP . '/Views/inc/footer.php'); ?>
