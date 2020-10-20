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
                    <div class="col-lg-6 text-right">
                        <button onclick="abrirForm()" type="button" class="btn btn-info btn-abrir-registrar-parqueadero"><i class="fas fa-plus"></i> Registrar Parqueadero</button>
                        <button  id="btn_cerrar_formulario" class="btn btn-danger" onclick="cerrarForm()" type="button"><i class="fa fa-arrow-circle-left"></i> <b> Volver al listado</b></button>
                        <button  id="btn_cerrar_configuracion_plano" class="btn btn-danger" onclick="verInformacion()" type="button"><i class="fa fa-arrow-circle-left"></i> <b> Cerrar Configuración Plano</b></button>
                    </div>
                </div>


                <!-- Content Row -->
                <div id="div-listado-parqueaderos" class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-fw fa-file-alt"></i> Listado Parqueaderos
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
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
                <div id="div-form-parqueaderos" class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" id="div-titulo-form">
                            </div>
                            <div class="card-body">
                                <form enctype="multipart/form-data" method="post" id="form-parqueaderos" name="form-registro-parqueaderos">
                                    <!-- DIV CONFIGURACIÓN INFORMACIÓN -->
                                    <div id="div-informacion-parqueadero">
                                        <div class="row">
                                        <!-- ESPACIO PARA SELECCIONAR LA IMAGEN -->
                                            <div class="col-lg-4">
                                                <div class="row">
                                                    <div class="col-lg-12 text-center">
                                                        <img id="img-muestra" src="https://via.placeholder.com/150" title="Logo Parqueadero" alt="Logo Parqueadero" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 text-center">
                                                        <label for="nit">Seleccionar Imagen</label>
                                                        <input id="logo" name="logo" type="file"  class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <button type="button" id="btn-ver-informacion" class="btn btn-primary" onclick="verInformacion()"><i class="fas fa-file-alt"></i> Ver Información</button><br/>
                                                        <button type="button"   id="btn-configuracion-plano"   class="btn  btn-info"    onclick="verConfiguracionPlano()"><i class="fas fa-list"></i> Configuración Plano</button>
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
                                                            <input pattern="[0-9]+"   type="text" class="form-control" placeholder="Digite el Nit" name="nit" id="nit" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                        <label for="nombre">Nombre</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                                            </div>
                                                            <input pattern="[A-Za-z]{3-50}" type="text" class="form-control" placeholder="Digite el nombre" name="nombre" id="nombre" required>
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
                                                            <input pattern="[A-Za-z]{3-50}" type="text" class="form-control" placeholder="Digite la dirección" name="direccion" id="direccion" required>
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
                                                            <input pattern="[0-9]+" type="text" class="form-control" placeholder="Digite el teléfono" name="telefono" id="telefono" required>
                                                        </div>           
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                        <label for="pisos"># Pisos</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marker-alt"></i></span>
                                                            </div>
                                                            <input min="1" type="number" class="form-control" placeholder="Digite la cantidad de pisos" name="pisos" id="pisos" required>
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
                                                            <input  min="0" type="number" class="form-control" placeholder="Digite la capacidad de carros" name="capacidad_carros" id="capacidad_carros" required>
                                                        </div>           
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                        <label for="capacidad_motos"># Capacidad Motos</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-motorcycle"></i></span>
                                                            </div>
                                                            <input  min="0" type="number" class="form-control" placeholder="Digite la capacidad motos" name="capacidad_motos" id="capacidad_motos" required>
                                                        </div>
                                                    </div>                             
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 text-center" id="div-btn-registrar-editar-informacion">
                                                        <button class="btn btn-success" type="submit" id="btn_guardar"></button>
                                                    </div>
                                                </div>
                                            </div>   
                                        </div>
                                    </div>
                                </form>
                                    
                                <!-- DIV CONFIGURACIÓN PLANO -->
                                <div id="div-configuracion-plano">
                                    <div class="row">
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
                                            <div id="" class="row">
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
                                                    <button id="btn-guardar-filas-columnas-matrix" onclick="guardar_info_matrix();" class="btn btn-success btn-lg "><i class="fas fa-save"></i></button>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <small class="text-default">Opciones Diseño</small>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="btn-group">
                                                        <button id="btn-herramienta-moto" onclick="marcar_herramienta('M');" class="btn btn-default btn-md btn-herramienta"><i class="fas fa-motorcycle"></i></button>
                                                        <button id="btn-herramienta-carro" onclick="marcar_herramienta('C');" class="btn btn-default btn-md btn-herramienta"><i class="fas fa-car-side"></i></button>
                                                        <button id="btn-herramienta-libre" onclick="marcar_herramienta('L');" class="btn btn-default btn-md btn-herramienta"><i class="fas fa-square-full"></i></button>
                                                    </div>
                                                    <button onclick="guardar_matrix();" type="button" class="btn btn-success" id="btn-guardar-matriz"><i class="fas fa-save"></i> Guardar Diseño Piso</button>
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
                </div>
            </div>
        </div>

        
        <script src="<?php echo RUTA_URL?>/RegistroParqueaderos/files?js=Assets/js/registroParqueaderos.js"></script>
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