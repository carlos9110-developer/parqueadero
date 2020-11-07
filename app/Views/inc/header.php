<!DOCTYPE html>
<html lang="en">
<input hidden id="ruta_app" value="<?php  echo RUTA_URL?>">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= NOMBRE_APP; ?></title>
  
  <!-- Custom fonts for this template-->
  <link href="<?php echo RUTA_URL ?>/public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template, ya contiene bootstrap-->
  <link href="<?php echo RUTA_URL ?>/public/css/sb-admin-2.css" rel="stylesheet">
  <link href="<?php echo RUTA_URL ?>/public/css/estilos.css" rel="stylesheet">
  <link href="<?php echo RUTA_URL ?>/public/css/cargando.css" rel="stylesheet">
  <link href="<?php echo RUTA_URL ?>/public/alertifyjs/css/alertify.min.css" rel="stylesheet">
  <script src="<?php echo RUTA_URL ?>/public/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo RUTA_URL ?>/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo RUTA_URL ?>/public/alertifyjs/alertify.min.js"></script>
  <script src="<?php echo RUTA_URL ?>/public/js/funciones.js"></script>



  <?php if($datos['titulo']=='Login'): ?>
      <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/login.css">
  <?php endif; ?>

  <?php if($datos['titulo']=='Registro Parqueaderos'): ?>
  <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL?>/RegistroParqueaderos/files?css=Assets/css/registroParqueaderos.css">
  <?php endif; ?>
  
  <?php if( $datos['titulo']=='Registro Usuarios Administrador' ||  $datos['titulo']=='Registro Parqueaderos'): ?>
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

<body id="page-top">