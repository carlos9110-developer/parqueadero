<?php require(RUTA_APP . '/Views/inc/header.php'); ?>
<style>
    
</style>
<div id="wrapper">

    <?php require(RUTA_APP . '/Views/inc/sidebar.php'); ?>

    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
        <div id="content">
            <?php require(RUTA_APP . '/Views/inc/navbar.php'); ?>
            <div class="container-fluid">
                <div class="col-lg-12 text-right">
                    <a class="btn btn-info" href="<?php echo RUTA_URL ?>/RegistroParqueaderos/Insertar"><i class="fas fa-plus"></i> Nuevo Registro</a>
                </div>
                <div class="card">
                        <div class="card-header">
                            <?php   echo $datos['titulo_vista'] ?>
                        </div>
                        <div class="card-body">
                            <table id="tbl_parqueaderos" style="font-size: 13px; width: 100%" class="display responsive  nowrap table table-striped table-bordered table-condensed table-hover">
                                <thead>
                                    <tr class="active">
                                        <th>ID</th>
                                        <th>Nit</th>
                                        <th>Nombre</th>
                                        <th>Dirección</th>
                                        <th>Teléfono</th>
                                        <th>Pisos</th>
                                        <th>Capacidad Carros</th>
                                        <th>Capacidad Motos</th>
                                        <th>Fecha Registro</th>
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

        
         
        <?php require(RUTA_APP . '/Views/inc/cargando.php'); ?>
        <script src="<?php echo RUTA_URL?>/RegistroParqueaderos/files?js=Assets/js/listar.js"></script>

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
