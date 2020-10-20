<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->


<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
  <div class="sidebar-brand-icon ">
    <img style="width: 80px;" src="<?php echo RUTA_URL ?>/public/img/logo.jpeg" alt="">
  </div>
  <!--<div class="sidebar-brand-text mx-3"><?php echo NOMBRE_APP; ?></div>-->
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">
<li class="nav-item">
  <a class="nav-link" href="Inicio">
    <i class="fas fa-fw fa-home"></i>
    <span>Inicio</span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link" href="RegistroParqueaderos">
    <i class="fas fa-fw fa-warehouse"></i>
    <span>Registro Parqueaderos</span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link" href="RegistroUsuariosAdministrador">
    <i class="fas fa-fw fa-user"></i>
    <span>Registro Usuarios</span>
  </a>
</li>
<hr class="sidebar-divider">
<!-- modulos 
<?php $modulos = getModules(RUTA_MODULOS)?>
<?php foreach($modulos as $modulo ): ?>
  <?php  if($modulo != "Perfil"): ?>
    <?php $infoModulo = parse_ini_file(RUTA_MODULOS.$modulo.SEPARADOR."adminsoft.ini"); ?>
      
    <li class="nav-item">
      <a class="nav-link" href="<?php echo RUTA_URL."/".$infoModulo['nombre']?>">
        <i class="<?php echo $infoModulo['icon']?>"></i>
        <span><?php echo $infoModulo['nombreMenu']?></span>
      </a>
    </li>
    <hr class="sidebar-divider">
  <?php endif; ?>
<?php endforeach;?>
-->

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- SIDEBAR -->


