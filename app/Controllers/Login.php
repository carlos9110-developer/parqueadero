<?php
class Login extends Controller
{
    private $loginModelo;
    private $result;
    public function __construct()
    {
        $this->loginModelo = $this->modelo('LoginModelo');
    }

    // el metodo index carga la vista con un array que contiene los datos necesarios para ser utilizados
    public function index()
    {
        $datos = [
            'tituloModulo' => 'Ingreso Super Administrador',
            'titulo' => 'Login'
        ];
        $this->vista('Login', $datos);
    }

    // metodo que carga la vista del login para el inicio de sesion de los usuarios diferentes a super_administrador
    public function ingresar()
    {
        $datos = [
            'tituloModulo' => 'Ingreso Administrador',
            'titulo' => 'Login'
        ];
        $this->vista('Login2', $datos);
    }



    /**
     * EL método iniciarSesion se encarga de procesar el login, recibe los parametros por $_POST y si es correcto declara las variables de sesión y  redirecciona a la vista usuarios
     * The initSession method is responsible for processing the login, receives the parameters for $ _POST and if it is correct declares the session variables and redirects to the users view
     */
    public function iniciarSesion()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user']) && isset($_POST['pass']) && !empty($_POST['user']) && !empty($_POST['pass'])) {
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            switch ($this->loginModelo->login1($user,$pass)) {
                case 1:
                    session_start();
                    $_SESSION['user_login_status'] = 1;
                    $this->result = $this->loginModelo->infoUsuario($user);
                    $_SESSION['id_user']   = $this->result->id;
                    $_SESSION['name_user'] = $this->result->nombre;
                    //exit(print_r($_SESSION));
                    redireccionar('Inicio');
                break;

                case 2:
                    redireccionar('?userBad');
                    $_POST = array();
                break;

                case 3:
                    redireccionar('?psBad');
                    $_POST = array();
                break;
            }    
        }
    }

    public function iniciarSesion2()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['nit']) && !empty($_POST['user']) && !empty($_POST['pass']) && !empty($_POST['nit'])  ) {
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $nit  = $_POST['nit'];
            switch ($this->loginModelo->login2($user,$pass,$nit)) {
                case 1:
                    session_start();
                    $this->result = $this->loginModelo->infoUsuario2($user,$nit);
                    $_SESSION['user_login_status'] = 1;
                    $_SESSION['id_user']           = $this->result->id_usuario;
                    $_SESSION['name_user']         = $this->result->nombre;
                    $_SESSION['id_parqueadero']    = $this->result->id_parqueadero;
                    
                    redireccionar('Inicio/InicioSistema');
                break;
                case 2:
                    redireccionar('Login/ingresar?userBad');
                    $_POST = array();
                break;
                case 3:
                    redireccionar('Login/ingresar?psBad');
                    $_POST = array();
                break;
            }  
        }
    }

    /**
     * EL método cerrarSession se encarga de matar las sesiones y redirigir al login
     * The closeSession method is responsible for killing sessions and redirecting to login
     */
    public function cerrarSession()
    {
        session_start();
        session_unset();
        $_SESSION = array();
        if(session_destroy()){
            redireccionar('Login?logout');
        }
    }
}
