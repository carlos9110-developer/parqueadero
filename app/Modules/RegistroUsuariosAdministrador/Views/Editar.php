<?php 
	$datos_form = $datos['datos_form'];
	$activado = "";
	$desactivado = "";
	if($datos_form['estado']=="Activado")
	{
		$activado = "selected";
	}
	else
	{
		$desactivado = "selected";
	}
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
                      	<form method="POST" action="<?php echo RUTA_URL ?>/RegistroUsuariosAdministrador/Editar/<?php echo $datos_form['id']; ?>">
                      		<div class="row">            
	                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
	                                <label for="cedula">Cédula</label>
	                                <div class="input-group mb-3">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-address-card"></i></span>
	                                    </div>
	                                    <input value="<?php echo $datos_form['cedula']; ?>" pattern="[0-9]+"   type="text" class="form-control" placeholder="Digite la cédula sin puntos" name="cedula" id="cedula" required>
	                                </div>
	                            </div>
	                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
	                                <label for="nombre">Nombre</label>
	                                <div class="input-group mb-3">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
	                                    </div>
	                                    <input value="<?php echo $datos_form['nombre']; ?>" pattern="[A-Za-z]{3-50}" type="text" class="form-control" placeholder="Nombre" name="nombre" id="nombre" required>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
	                                 <label for="telefono">Teléfono</label>
	                                <div class="input-group mb-3">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-address-card"></i></span>
	                                    </div>
	                                    <input value="<?php echo $datos_form['telefono']; ?>" pattern="[0-9]+"   type="text" class="form-control" placeholder="Digite el número de celular" name="telefono" id="telefono" required>
	                                </div>
	                            </div>
	                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
	                                <label for="correo">Correo</label>
	                                <div class="input-group mb-3">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
	                                    </div>
	                                    <input value="<?php echo $datos_form['correo']; ?>" type="email" class="form-control" placeholder="Digite el correo" name="correo" id="correo" required>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
	                                <label for="estado">Estado</label>
	                                <div class="input-group mb-3">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
	                                    </div>
	                                    <select class="form-control" id="estado" name="estado">
	                                    	<option <?php echo $activado; ?> value="Activado">Activado</option>
	                                    	<option <?php echo $desactivado; ?> value="Desactivado">Desactivado</option>
	                                    </select>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row">
	                        	<div class="col-lg-12 text-center">
	                        		<?php if(isset($datos['error_campos'])):  ?>
								        <div class="alert alert-danger alert-dismissible fade show" role="alert">
								            <strong><?php echo $datos['error_campos'];  ?></strong>
								            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								                <span aria-hidden="true">&times;</span>
								            </button>
								        </div>
								    <?php endif; ?> 
	                        	</div>
	                        </div>
	                        <div class="row">
	                        	<div class="col-lg-12 text-center">
	                        		<?php if(isset($datos['success'])):  ?>
								        <div class="alert alert-success alert-dismissible fade show" role="alert">
								            <strong><?php echo $datos['success'];  ?></strong>
								            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								                <span aria-hidden="true">&times;</span>
								            </button>
								        </div>
								    <?php endif; ?> 
	                        	</div>
	                        </div>
	                        <div class="row">
	                        	<div class="col-lg-12 text-center">
	                        		<button class="btn btn-warning btn-lg" type="submit"><i class="fas fa-edit"></i><b> Editar</b></button>
	                        	</div>
	                        </div>

	                        
                      	</form>
                      	
                      </div>
                </div>
            </div>
        </div>

        
    
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



?>