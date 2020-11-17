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
	<?php if( $datos['tituloModulo']=='Registro Salida'): ?>
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
    