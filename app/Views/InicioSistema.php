<?php
require(RUTA_APP . '/Views/inc/header_2.php'); ?>

<style type="text/css">
	.caja-item-menu{
	    border: 1px solid black;
	    width: 200px;
	    padding-top: 15px;
	    padding-bottom: 15px;
	    display: flex;
	    /*cursor: pointer;*/
	    border-radius: 15px;
	}
	.caja-icono-item-menu-1{
		margin-left: 20px;
    	margin-top: 12px;
	}
	.icono-item-menu{
		font-size: 35px;
	}
	.caja-texto-item-menu-1{
		margin-left: 10px;
	}
	.span-item-menu, .a-item-menu{
		font-size: 20px;
	}
	.a-item-menu{
		color: black;
	}
</style>

<div class="container">
    <div class="card">
          <div class="card-header">
            <?php  echo $datos['titulo_vista']; ?>
          </div>
          <div class="card-body">
          		<div class="row">
          			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 text-center">
          				<div  class="caja-item-menu">
          					<div class="caja-icono-item-menu-1">
          						<i class="icono-item-menu fas fa-plus-square"></i>
          					</div>
          					<div class="caja-texto-item-menu-1">
          						<a class="a-item-menu" href="<?php echo RUTA_URL ?>/RegistroIngreso">Registrar Ingreso</a>
          					</div>
          				</div>
          			</div>
          			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 text-center">
          				<div  class="caja-item-menu">
          					<div class="caja-icono-item-menu-1">
          						<i class="icono-item-menu fas fa-plus-square"></i>
          					</div>
          					<div class="caja-texto-item-menu-1">
          						<span class="span-item-menu">Registrar Ingreso</span>
          					</div>
          				</div>
          			</div>
          			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 text-center">
          				<div  class="caja-item-menu">
          					<div class="caja-icono-item-menu-1">
          						<i class="icono-item-menu fas fa-plus-square"></i>
          					</div>
          					<div class="caja-texto-item-menu-1">
          						<span class="span-item-menu">Registrar Ingreso</span>
          					</div>
          				</div>
          			</div>
          		</div>

          </div>
    </div>
</div>


 <?php require(RUTA_APP . '/Views/inc/footer2.php'); ?>

</body>
</html>