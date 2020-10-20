<?php require(RUTA_APP . '/Views/inc/header.php'); ?>
<div id="wrapper">

    <?php require(RUTA_APP . '/Views/inc/sidebar.php'); ?>

    <div id="content-wrapper" class="d-flex flex-column">
    
      <!-- Main Content -->
        <div id="content">
            <?php require(RUTA_APP . '/Views/inc/navbar.php'); ?>
            <div class="container-fluid">
                <form method="post" id="form-productos" name="form-productos">
                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-6 d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800"><?php echo $datos['titulo']; ?></h1>
                        </div>
                        <div class="col-lg-6 text-right">
                            <button  onclick="abrirForm()" type="button" class="btn btn-info btn-abrir-registrar-producto"><i class="fas fa-plus"></i> Registrar Producto</button>
                            <button  id="btn_cerrar_formulario" class="btn btn-danger" onclick="cerrarForm()" type="button"><i class="fa fa-arrow-circle-left"></i> <b> Cancelar</b></button>
                            <button class="btn btn-success" type="submit" id="btn_guardar"></button>
                        </div>
                    </div>
                    
                    <!--COMO LLAMAR UNA IMAGEN-->
                    <!--<img src="<?php echo RUTA_URL?>/Usuarios/files?img=logo.png">-->
                    <!-- Content Row -->
                    <div id="div-listado-productos" class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fas fa-fw fa-file-alt"></i> Listado Productos
                                </div>
                                <div class="card-body">
                                    
                                    <div class="table-responsive">
                                        <table id="tbl_productos" style="font-size: 13px; width: 100%" class="display responsive  nowrap table table-striped table-bordered table-condensed table-hover">
                                            <thead>
                                                <tr class="active">
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th>Tipo Medida</th>
                                                    <th>Cantidad</th>
                                                    <th>Cantidad Minima</th>
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

                    <div id="div-form-productos" class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header" id="div-titulo-form">
                                </div>
                                <div class="card-body">
                                    
                                    <div class="form-group row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mb-3">
                                            <label for="producto">Producto</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-cube"></i></span>
                                                </div>
                                                <input  type="text" class="form-control" placeholder="Nombre Producto" name="producto" id="producto" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mb-3">
                                            <label for="tipo_medida">Tipo Medida</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-tachometer-alt"></i></span>
                                                </div>
                                                <select name="tipo_medida" id="tipo_medida"  class="form-control" required>
                                                    <option selected value="">Seleccione el tipo de medida</option>
                                                    <option value="Unidades">Unidades</option>
                                                    <option value="Metros">Metros</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mb-3">
                                            <label for="cantidad_alarma">Cantidad Minima</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-hashtag"></i></span>
                                                </div>
                                                <input  type="number" min="1" step="any" class="form-control" placeholder="Unidades o Metros" name="cantidad_alarma" id="cantidad_alarma" required>
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

        <script src="<?php echo RUTA_URL?>/Inventario/files?js=Assets/js/inventario.js"></script>
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