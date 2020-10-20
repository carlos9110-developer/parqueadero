<?php require(RUTA_APP . '/Views/inc/header.php'); ?>
<div id="wrapper">

    <?php require(RUTA_APP . '/Views/inc/sidebar.php'); ?>

    <div id="content-wrapper" class="d-flex flex-column">
    
      <!-- Main Content -->
        <div id="content">
            <?php require(RUTA_APP . '/Views/inc/navbar.php'); ?>
            <div class="container-fluid">
                <form method="post" id="form-usuarios" name="form-usuarios">
                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-6 d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800"><?php echo $datos['titulo']; ?></h1>
                            <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
                        </div>
                        <div class="col-lg-6 text-right">
                            <button onclick="abrirForm()" type="button" class="btn btn-info btn-abrir-registrar-usuario"><i class="fas fa-plus"></i> Registrar Usuario</button>
                            <button  id="btn_cerrar_formulario" class="btn btn-danger" onclick="cerrarForm()" type="button"><i class="fa fa-arrow-circle-left"></i> <b> Cancelar</b></button>
                            <button class="btn btn-success" type="submit" id="btn_guardar"></button>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div id="div-listado-usuarios" class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fas fa-fw fa-file-alt"></i> Listado Usuarios
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tbl_usuarios" style="font-size: 13px; width: 100%" class="display responsive  nowrap table table-striped table-bordered table-condensed table-hover">
                                            <thead>
                                                <tr class="active">
                                                    <th>ID</th>
                                                    <th>Cédula</th>
                                                    <th>Nombre</th>
                                                    <th>Telefóno</th>
                                                    <th>Correo</th>
                                                    <th>User</th>
                                                    <th>Estado</th>
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
                    <div id="div-form-usuarios" class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header" id="div-titulo-form">
                                </div>
                                <div class="card-body">

                                        <div class="row">
                                            
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mb-3">
                                                <label for="cedula">Cédula</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-address-card"></i></span>
                                                    </div>
                                                    <input pattern="[0-9]+"   type="text" class="form-control" placeholder="Digite la cédula sin puntos" name="cedula" id="cedula" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mb-3">
                                                <label for="nombre">Nombre</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                                    </div>
                                                    <input pattern="[A-Za-z]{3-50}" type="text" class="form-control" placeholder="Nombre" name="nombre" id="nombre" required>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    
                                    <div class="form-group row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                             <label for="telefono">Teléfono</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-address-card"></i></span>
                                                </div>
                                                <input pattern="[0-9]+"   type="text" class="form-control" placeholder="Digite el número de celular" name="telefono" id="telefono" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                            <label for="correo">Correo</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                                </div>
                                                <input  type="email" class="form-control" placeholder="Digite el correo" name="correo" id="correo" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL CONFIRMAR DESACTIVACIÓN -->
        <div id="modal_desactivar" class="modal" tabindex="-1" role="dialog" data-backdrop='static' data-keyboard='false'>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Desactivar Usuario</h5>
                        <button type="button" class="close" onclick="cerrar_modal_desactivar()"  aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <p>
                            Presione el botón para confirmar la desactivación del usuario
                        </p>
                        <button onclick="desactivar_usuario()" type="button" class="btn btn-success">Desactivar</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="cerrar_modal_desactivar()" style="font-weight: bold;" class="btn btn-danger btn-md">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL CONFIRMAR ACTIVACIÓN -->
        <div id="modal_activar" class="modal" tabindex="-1" role="dialog" data-backdrop='static' data-keyboard='false'>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Activar Usuario</h5>
                        <button type="button" class="close" onclick="cerrar_modal_activar()"  aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <p>
                            Presione el botón para confirmar la activación del usuario
                        </p>
                        <button onclick="activar_usuario()" type="button" class="btn btn-success">Activar</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="cerrar_modal_activar()" style="font-weight: bold;" class="btn btn-danger btn-md">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="<?php echo RUTA_URL?>/RegistroUsuariosAdministrador/files?js=Assets/js/registroUsuariosAdministrador.js"></script>
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