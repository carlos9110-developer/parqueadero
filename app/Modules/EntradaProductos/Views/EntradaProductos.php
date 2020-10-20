<?php require(RUTA_APP . '/Views/inc/header.php'); ?>
<div id="wrapper">

    <?php require(RUTA_APP . '/Views/inc/sidebar.php'); ?>

    <div id="content-wrapper" class="d-flex flex-column">
    
      <!-- Main Content -->
        <div id="content">
            <?php require(RUTA_APP . '/Views/inc/navbar.php'); ?>
            <div class="container-fluid">

                <form  method="post" name="form_registro_entrada_productos"  id="form_registro_entrada_productos" >
                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-6 d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800"><?php echo $datos['titulo']; ?></h1>
                            <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
                        </div>
                        <div class="col-lg-6 text-right">
                            <button id="btn-abrir-registrar-entrada-productos"  onclick="abrir_modal_registro_entrada_productos()" type="button" class="btn btn-info"><i class="fas fa-plus"></i> Registrar Entrada Producto</button>
                            <button  id="btn_cerrar_formulario" class="btn btn-danger" onclick="cerrar_modal_registro_entrada_productos()" type="button"><i class="fa fa-arrow-circle-left"></i> <b> Cancelar</b></button>
                            <button id="btn_abrir_registro_productos"  title="Agregar Producto" onclick="abrir_agregar_producto()"  type="button" class="btn btn-primary"><i class="fa fa-plus"></i> <b> Agregar Producto</b></button>
                            <button class="btn btn-success" type="submit" id="btn_guardar"></button>
                        </div>
                    </div>


                    <div id="div-listado-entrada-productos" class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fas fa-fw fa-file-alt"></i> Listado Entrada Productos
                                </div>
                                <div class="card-body">
                                    
                                    <div class="table-responsive">
                                        <table id="tbl_entrada_productos" style="font-size: 13px; width: 100%" class="display responsive  nowrap table table-striped table-bordered table-condensed table-hover">
                                            <thead>
                                                <tr class="active">
                                                    <th>ID</th>
                                                    <th>Proveedor</th>
                                                    <th>Fecha</th>
                                                    <th>Observación</th>
                                                    <th>Total Compra</th>
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

                    <div id="div-form-entradas" class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                        <a id="tituloForm" href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample"></a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="collapseCardExample">
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-3">
                                        <label for="proveedor">Proveedor</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input  type="text" name="proveedor" id="proveedor" placeholder="Digite el nombre del proveedor" class="form-control"   required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-3">
                                        <label for="observacion">Observación</label>
                                        <textarea class="form-control" placeholder="Digite la observación" name="observacion" id="observacion" cols="30" rows="2"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" style="height: 450px;overflow-y: auto;">
                        <table style="font-size: 12px" id="tbl_detalles" class="table table-striped  table-condensed table-hover">
                            <thead style="background-color:#A9D0F5;">
                                <tr>
                                    <th>Opciones</th>
                                    <th>Producto</th>
                                    <th>Cantidad (unidades o metros)</th>
                                    <th>Precio</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>TOTAL</th>
                                    <th></th>
                                    <th></th>
                                    <th>
                                        <h4 id="h4_total_compra"></h4>
                                        <input type="hidden" name="input_total_compra" id="input_total_compra">
                                    </th>
                                </tr>  
                            </tfoot>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </form>

                <!-- MODAL DETALLES ENTRADA -->
                <div id="modal_detalles_entrada" class="modal" tabindex="-1" role="dialog" data-backdrop='static' data-keyboard='false'>
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Agregar Productos</h5>
                                <button type="button" class="close" onclick="cerrar_modal_detalles_entrada()"  aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table id="tbl_productos" class="table table-striped table-bordered table-condensed table-hover" style="width: 99%; text-align: center;">
                                    <thead>
                                        <tr>
                                            <td>ID</td>
                                            <td>Opciones</td>
                                            <td>Producto</td>
                                            <td>Cantidad</td>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size: 12px;"> 
                                    </tbody>
                                </table>
                                <p>&nbsp;</p>
                            </div>
                            <div class="modal-footer">
                                <button onclick="cerrar_modal_detalles_entrada()" style="font-weight: bold;" class="btn btn-danger btn-md">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MODAL CONFIRMACIÓN REGISTRO -->
                <div id="modal_confirmacion" class="modal" tabindex="-1" role="dialog" data-backdrop='static' data-keyboard='false'>
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirmación Registro</h5>
                                <button type="button" class="close" onclick="cerrar_modal_confirmacion()"  aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="text-center modal-body">
                                <p>
                                    Esta seguro que estos son los productos y cantidades correctas, recuerde que estos no pueden ser modificados, si tiene dudas por favor verifique
                                    de lo contrario presione el botón Registrar
                                </p>
                                <button onclick="registrarEntradaProductos()" type="button" class="btn btn-success">Registrar</button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" onclick="cerrar_modal_confirmacion()" style="font-weight: bold;" class="btn btn-danger btn-md">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MODAL PRODUCTOS ENTRADA -->
                <div id="modal_productos_entrada" class="modal" tabindex="-1" role="dialog" data-backdrop='static' data-keyboard='false'>
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Productos Entrada</h5>
                                <button type="button" class="close" onclick="cerrar_modal_productos_entrada()"  aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table id="tbl_productos_entrada" class="table table-striped table-bordered table-condensed table-hover" style="width: 99%; text-align: center;">
                                    <thead>
                                        <tr>
                                            <td>Producto</td>
                                            <td>Cantidad</td>
                                            <td>Precio</td>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size: 12px;"> 
                                    </tbody>
                                </table>
                                <p>&nbsp;</p>
                            </div>
                            <div class="modal-footer">
                                <button onclick="cerrar_modal_productos_entrada()" style="font-weight: bold;" class="btn btn-danger btn-md">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <script src="<?php echo RUTA_URL?>/EntradaProductos/files?js=Assets/js/entradaProductos.js"></script>
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