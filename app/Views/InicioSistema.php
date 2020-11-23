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
	.container{
		margin-top: 30px;
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
          				<a class="a-item-menu" href="<?php echo RUTA_URL ?>/RegistroIngreso"><img src="<?php echo RUTA_URL ?>/public/img/registro_ingreso.jpg" alt=""></a>
          			</div>
          			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 text-center">
					  <a class="a-item-menu" href="<?php echo RUTA_URL ?>/RegistroSalida"><img src="<?php echo RUTA_URL ?>/public/img/registro_egreso.jpg" alt=""></a>
          			</div>
          			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 text-center">
					  	<a class="a-item-menu" href="<?php echo RUTA_URL ?>/RegistroIngreso/InformeIngresos"><img src="<?php echo RUTA_URL ?>/public/img/informe_ingresos.jpg" alt=""></a>
          			</div>
          		</div>

          </div>
    </div>
</div>


 <?php require(RUTA_APP . '/Views/inc/footer2.php'); ?>

</body>
</html>