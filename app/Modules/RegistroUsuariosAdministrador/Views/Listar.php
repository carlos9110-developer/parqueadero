<?php require(RUTA_APP . '/Views/inc/header.php'); ?>
<div id="wrapper">

    <?php require(RUTA_APP . '/Views/inc/sidebar.php'); ?>

    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
        <div id="content">
            <?php require(RUTA_APP . '/Views/inc/navbar.php'); ?>
            <div class="container-fluid">
                <div class="col-lg-12 text-right">
                    <a class="btn btn-info" href="<?php echo RUTA_URL ?>/RegistroUsuariosAdministrador/insertar"><i class="fas fa-plus"></i> Registrar Usuario</a>
                </div>
                <div class="card">
                      <div class="card-header">
                        <?php   echo $datos['titulo_vista'] ?>
                      </div>
                      <div class="card-body">
                        <table id="tbl_usuarios" style="font-size: 13px; width: 100%" class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <tr class="active">
                                    <th>ID</th>
                                    <th>Cédula</th>
                                    <th>Nombre</th>
                                    <th>Telefóno</th>
                                    <th>Correo</th>
                                    <th>User</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($datos['lista_usuarios'] as $usuario): ?>
                                    <tr>
                                        <td><?php echo $usuario->id; ?></td>
                                        <td><?php echo $usuario->cedula; ?></td>
                                        <td><?php echo $usuario->nombre; ?></td>
                                        <td><?php echo $usuario->telefono; ?></td>
                                        <td><?php echo $usuario->correo; ?></td>
                                        <td><?php echo $usuario->user; ?></td>
                                        <td><?php echo $usuario->estado; ?></td>
                                        <td class="text-center"><a href="<?php echo RUTA_URL ?>/RegistroUsuariosAdministrador/editar/<?php echo $usuario->id; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a></td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
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

<script type="text/javascript">
	$(document).ready(function() {
	  $('#tbl_usuarios').DataTable({
	    "language": {
	      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
	    }
	  });
	});
</script>

?>