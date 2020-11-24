<?php 
	require(RUTA_APP . '/Views/inc/header.php'); 
?>
<div id="wrapper">
    <?php require(RUTA_APP . '/Views/inc/sidebar.php'); ?>
    <div id="content-wrapper" class="d-flex flex-column">
    
      <!-- Main Content -->
        <div id="content">
            <?php require(RUTA_APP . '/Views/inc/navbar.php'); ?>
            <div class="container-fluid">
            	<div class="col-lg-12 text-right">
                    <a class="btn btn-info" href="<?php echo RUTA_URL ?>/RegistroUsuariosAdministrador"><i class="fas fa-reply"></i> Listado Usuarios</a>
                </div>
                <div class="card">
                      <div class="card-header">
                        <?php  echo $datos['titulo_vista']; ?>
                      </div>
                      <div class="card-body">
                      	<form method="POST" id="form-asignar" name="form-asignar">
                      		<input type="hidden" name="id" id="id" value="<?php echo $datos['info_usuario']->id; ?>">
                      		<div class="row">   
							  	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
	                                <label for="nombre">Usuario</label>
	                                <div class="input-group mb-3">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
	                                    </div>
	                                    <input value="<?php echo $datos['info_usuario']->nombre; ?>" pattern="[A-Za-z]{3-50}" type="text" class="form-control" placeholder="Nombre" name="nombre" id="nombre" disabled>
	                                </div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
	                                <label for="parqueadero">Parqueadero</label>
	                                <div class="input-group mb-3">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-home"></i></span>
	                                    </div>
	                                    <select class="form-control" name="parqueadero" id="parqueadero">
											<option value="">Seleccione un parqueadero:</option>
											<?php foreach($datos['parqueaderos'] as $park):  ?>
												<option value="<?= $park->id; ?>"><?= $park->nombre; ?></option>
											<?php endforeach;  ?>
										</select>
	                                </div>
								</div>
                      		</div>
	                        <div class="row">
	                        	<div class="col-lg-12 text-center">
	                        		<button class="btn btn-success btn-lg" type="submit"><i class="fas fa-save"></i><b> Guardar</b></button>
	                        	</div>
	                        </div>  
                      	</form>
                      	
                      </div>
                </div>
            </div>
        </div>
        <?php require(RUTA_APP . '/Views/inc/cargando.php'); ?>
        <script src="<?php echo RUTA_URL ?>/RegistroUsuariosAdministrador/files?js=Assets/js/asignarParqueadero.js"></script>

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



?>