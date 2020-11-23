<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title><?= NOMBRE_APP; ?></title>
	<link href="<?php echo RUTA_URL ?>/public/css/cargando.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/bootstrap.min.css">
	<link href="<?php echo RUTA_URL ?>/public/alertifyjs/css/alertify.min.css" rel="stylesheet">
	<script src="<?php echo RUTA_URL ?>/public/js/jquery-3.2.1.min.js"></script>
	<script src="<?php echo RUTA_URL ?>/public/js/popper.min.js"></script>
	<script src="<?php echo RUTA_URL ?>/public/js/bootstrap.min.js"></script>
	<script src="https://kit.fontawesome.com/5ab2600c94.js" crossorigin="anonymous"></script>
	<script src="<?php echo RUTA_URL ?>/public/alertifyjs/alertify.min.js"></script>

	<?php if($datos['tituloModulo']=='Registro Ingreso Vehiculos' ): ?>
		<link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL?>/RegistroIngreso/files?css=Assets/css/registroIngreso.css">
	<?php endif; ?>
	
	<?php if( $datos['tituloModulo']=='Registro Salida' || $datos['tituloModulo']=='Registro Ingreso Vehículos' ): ?>
		<link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL ?>/public/DataTables/datatables.css">
		<link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL ?>/public/DataTables/responsivedataTablesmin.css">
		<!-- libreiras dataTable -->
		<script type="text/javascript" charset="utf8" src="<?php echo RUTA_URL ?>/public/DataTables/datatables.js"></script>
		<script type="text/javascript" charset="utf8" src="<?php echo RUTA_URL ?>/public/DataTables/dataTablesresponsivemin.js"></script>
		<!-- librerias para los botones de javascript -->
		<script src="<?php echo RUTA_URL ?>/public/DataTables/response/dataTables.buttons.min.js"></script>
		<script src="<?php echo RUTA_URL ?>/public/DataTables/response/jszip.min.js"></script>
		<script src="<?php echo RUTA_URL ?>/public/DataTables/response/pdfmake.min.js"></script>
		<script src="<?php echo RUTA_URL ?>/public/DataTables/response/vfs_fonts.js"></script>
		<script src="<?php echo RUTA_URL ?>/public/DataTables/response/buttons.html5.min.js"></script>
		<script src="<?php echo RUTA_URL ?>/public/DataTables/buttons.print.min.js"></script>
  	<?php endif; ?>
</head>

<body>

<!--
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
	
	-->