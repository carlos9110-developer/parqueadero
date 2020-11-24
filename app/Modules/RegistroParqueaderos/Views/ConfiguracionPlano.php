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
                    <div class="row">
                        <input type="hidden" id="input-id" value="<?= $datos['infoParqueadero']->id;?>">
                        <input type="hidden" id="input-pisos" value="<?= $datos['infoParqueadero']->pisos;?>">
                        <!-- INFORMACIÓN PISOS -->
                        <div class="col-lg-2">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="text-default text-center">Seleccione un piso</h4>
                                </div>
                            </div>
                            <!-- ESTE DIV SE CARGA DESDE EL ARCHIVO JAVASCRIPT -->
                            <div id="div-cargar-info-pisos">
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <ul id="list-config-pisos" class="list-group">
                                        </ul>
                                    </div>
                                </div>
                            </div>  
                        </div>
                        <!-- CONGIGURACIÓN FILAS Y COLUMNAS -->
                        <div id="div-matriz" class="col-lg-10">
                            <div  class="row">
                                <div class="col-lg-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"> #Filas</span>
                                        </div>
                                        <input   min="1" type="number"  class="form-control" placeholder="# Filas" id="num_filas">    
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"> # Columnas</span>
                                        </div>
                                        <input   min="1" type="number"  class="form-control" placeholder="# Columnas" id="num_columnas">
                                    </div>
                                </div>
                                <div class="col-lg-4 text-center">
                                    <button id="btn-guardar-filas-columnas-matrix" onclick="guardarInfoMatrix();" class="btn btn-success btn-lg"><i class="fas fa-save"></i></button>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <small class="text-default">Opciones Diseño</small>
                                </div>
                                <div class="col-lg-12">
                                    <div class="btn-group">
                                        <button id="btn-herramienta-moto" onclick="marcarHerramienta('M');" class="btn btn-default btn-md btn-herramienta"><i class="fas fa-motorcycle"></i></button>
                                        <button id="btn-herramienta-carro" onclick="marcarHerramienta('C');" class="btn btn-default btn-md btn-herramienta"><i class="fas fa-car-side"></i></button>
                                        <button id="btn-herramienta-libre" onclick="marcarHerramienta('L');" class="btn btn-default btn-md btn-herramienta"><i class="fas fa-square-full"></i></button>
                                    </div>
                                    <button onclick="guardarMatrix();" type="button" class="btn btn-success" id="btn-guardar-matriz"><i class="fas fa-save"></i> Guardar Diseño Piso</button>
                                    <button onclick="confirmarGuardarConfiguracionPlano();" type="button" class="btn btn-success" id="btn-guardar-matriz"><i class="fas fa-save"></i> Guardar Planos Parqueadero</button>
                                </div>
                                    
                                <div id="div-imprimir-matriz">          
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        
        <!-- MODALES -->
<div id="modal-confirmar" class="modal" tabindex="-1" role="dialog" data-backdrop='static' data-keyboard='false'>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Registro Planos</h5>
                <button type="button" class="close" onclick="cerrarModalConfirmar()"  aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <p>¿ Esta seguro de confirmar el registro de los planos, recuerde que ya no podra alterar el número de las columnas ni de las filas de los pisos ?</p>
               <div class="col-lg-12 text-center">
                    <button onclick="guardarPlano();" type="button" class="btn btn-success">Aceptar</button>
                    <button  onclick="cerrarModalConfirmar();" type="button" class="btn btn-danger">Cancelar</button>
               </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="cerrarModalConfirmar();" style="font-weight: bold;" class="btn btn-danger btn-md">Cerrar</button>
            </div>
        </div>
    </div>
</div>

         
        <?php require(RUTA_APP . '/Views/inc/cargando.php'); ?>
        <script src="<?php echo RUTA_URL?>/RegistroParqueaderos/files?js=Assets/js/configuracionPlano.js"></script>

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
