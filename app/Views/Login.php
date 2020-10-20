<?php require(RUTA_APP . '/Views/inc/header_2.php'); ?>
<style>
    .div-fila {
    margin-top: 15%;
}
</style>
    <?php if(isset($_GET['psBad'])):  ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error</strong> La contraseña es incorrecta.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?> 

    
    
    <?php if(isset($_GET['userBad'])):  ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error</strong> El usuario no existe.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?> 

    <?php if(isset($_GET['logout'])):  ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Ok</strong> Se ha cerrado la sesión.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?> 


    <div class="container">
        <div class="row div-fila">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <img class="img-fluid" src="<?php echo RUTA_URL ?>/public/img/logo_parking.jpg" alt="">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <form id="form-login" action="<?php echo RUTA_URL ?>/Login/iniciarSesion" method="POST">
                    <input type="hidden" name="op" id="op" value="login">
                    <div class="form-group">
                        <label for="user">Email</label>
                        <input type="text" class="form-control" id="user" name="user" aria-describedby="email-input" placeholder="Digite el usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Digite la clave" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg" id="btn-login">Ingresar</button>
                </form>
            </div>
        </div>
    </div>

    <?php require(RUTA_APP . '/Views/inc/footer.php'); ?>