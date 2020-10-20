<?php  require(RUTA_APP . '/Views/inc/header.php'); ?>
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
                    </div>
                </div>


                <div id="div-listado-facturas" class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-fw fa-file-alt"></i> Listado Facturas
                            </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table id="tbl_facturas" style="font-size: 13px; width: 100%" class="display responsive  nowrap table table-striped table-bordered table-condensed table-hover">
                                        <thead>
                                            <tr class="active">
                                                <th>ID</th>
                                                <th>Telefono Cliente Hide</th>
                                                <th>Placa</th>
                                                <th>Marca</th>
                                                <th>Cliente</th>
                                                <th>Fecha</th>
                                                <th>Precio</th>
                                                <th>Meses Garantia</th>
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

                    

                <!-- MODAL  FACTURACIÓN -->
                <div id="modal_facturacion" class="modal" tabindex="-1" role="dialog" data-backdrop='static' data-keyboard='false'>
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Editar Factura
                                </h5>
                                <button type="button" class="close" onclick="cerrar_modal_facturacion()"  aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form  method="post" name="form_facturacion"  id="form_facturacion" >
                                <div class="modal-body">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-3">
                                        <label for="precio">Precio</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>
                                            </div>
                                            <input id="precio" name="precio"  class="form-control"  type="text" onkeyup="format(this)" onchange="format(this)">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-3">
                                        <label for="meses_garantia">Meses Garantia</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                            </div>
                                            <select id="meses_garantia" name="meses_garantia"  class="form-control">
                                                <option value="">Elija una opción</option>
                                                <option value="No Aplica">No Aplica</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </div>
                                    </div>
                                    <p>&nbsp;</p>
                                </div>
                                <div class="modal-footer">
                                    <button  type="submit" class="btn btn-success"><i class="fas fa-fw fa-save"></i> Editar</button> <button type="button" onclick="cerrar_modal_facturacion()" style="font-weight: bold;" class="btn btn-danger btn-md"><i class="fas fa-fw fa-times"></i>Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <script src="<?php echo RUTA_URL?>/Facturacion/files?js=Assets/js/facturacion.js"></script>
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