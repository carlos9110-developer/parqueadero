<?php require(RUTA_APP . '/Views/inc/header.php'); ?>
<div id="wrapper">

    <?php require(RUTA_APP . '/Views/inc/sidebar.php'); ?>

    <div id="content-wrapper" class="d-flex flex-column">
    
      <!-- Main Content -->
        <div id="content">
            <?php require(RUTA_APP . '/Views/inc/navbar.php'); ?>
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-6 d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?php echo $datos['titulo']; ?></h1>
                        <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
                    </div>
                </div>

                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-informacion-personal-tab" data-toggle="tab" href="#nav-informacion-personal" role="tab" aria-controls="nav-informacion-personal" aria-selected="true">Información Personal</a>
                        <a class="nav-item nav-link" id="nav-cambiar-contrasena-tab" data-toggle="tab" href="#nav-cambiar-contrasena" role="tab" aria-controls="nav-cambiar-contrasena" aria-selected="false">Cambiar Contraseña</a>
                    </div>
                </nav>
                <div style="margin-top:30px;" class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-informacion-personal" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form  method="post" name="form_informacion_personal"  id="form_informacion_personal" >
                            <div class="form-group row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                    <label for="cedula">Cédula</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-address-card"></i></span>
                                        </div>
                                        <input pattern="[0-9]+"   type="text" class="form-control" placeholder="Digite la cédula sin puntos" name="cedula" id="cedula" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                    <label for="nombre">Nombre</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input pattern="[A-Za-z]{3-50}"   type="text" class="form-control" placeholder="Digite el nombre completo" name="nombre" id="nombre" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                    <label for="celular">Celular</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-mobile-alt"></i></span>
                                        </div>
                                        <input pattern="[0-9]+"   type="text" class="form-control" placeholder="Digite el celular" name="celular" id="celular" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                    <label for="correo">Correo</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
                                        </div>
                                        <input   type="email" class="form-control" placeholder="Digite el correo" name="correo" id="correo" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="text-center col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-save"></i>Actualizar Datos</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="nav-cambiar-contrasena" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <form  method="post" name="form_cambiar_clave"  id="form_cambiar_clave" >
                            <div class="form-group row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="clave_actual">Contraseña Actual</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input  type="password" class="form-control" placeholder="Digite la contraseña actual" name="clave_actual" id="clave_actual" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="nueva_clave">Nueva Contraseña</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input  type="password" class="form-control" placeholder="Digite la contraseña" name="nueva_clave" id="nueva_clave" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="nueva_clave_2">Nueva Contraseña</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input  type="password" class="form-control" placeholder="Digite la contraseña nuevamente" name="nueva_clave_2" id="nueva_clave_2" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="text-center col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-save"></i>Cambiar Contraseña</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>



            </div>
        </div>

        <script src="<?php echo RUTA_URL?>/Perfil/files?js=Assets/js/perfil.js"></script>
        <?php require(RUTA_APP . '/Views/inc/cargando.php'); ?>

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