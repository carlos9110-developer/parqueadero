<?php

class RegistroUsuariosAdministrador extends Controller
{
    private  $response = array();
    private  $usuarioModelo;
    private  $result;
    public   $nombreModulo;
    public function __construct()
    {
        // verifica que el usuario este logueado correctamente y esten definidos la sesiones
        $this->validadorSesion();
        $this->nombreModulo  = __CLASS__;
        $this->usuarioModelo = $this->modelo('RegistroUsuariosAdministradorModelo',$this->nombreModulo);
        
    }

    public function __destruct()
    {
        $this->response = null;
    }

    public function index()
    {
        $datos = [
            'titulo' => 'Registro Usuarios Administrador',
        ];

        $this->vista('RegistroUsuariosAdministrador', $datos, $this->nombreModulo);
    }

    public function files()
    {
        if(isset($_GET['img']) || isset($_GET['js']) || isset($_GET['css']) || isset($_GET['pdf'])){
            if(isset($_GET['img'])){
                 return $this->filesManager($_GET['img'], false, 'img');
            }
            if(isset($_GET['js'])){
             return $this->filesManager($this->nombreModulo, $_GET['js'], 'js');
            }
            if(isset($_GET['css'])){

            }
            if(isset($_GET['pdf'])){

            }
        }else{
            exit('Método no disponible');

        }
    }

    public function insertar()
    {
        if($this->validadorFormulario($_POST)){
            if($this->usuarioModelo->insertar($_POST)){
                $this->response['success'] = true;
            }else {
                $this->response['success'] = false;
                $this->response['caso']    = 2;
            }
            responderJson($this->response);
        }  else {
            $this->response['success'] = false;
            $this->response['caso']    = 1;
            responderJson($this->response);
        } 
    }

    // método donde se traen los datos de un determinado registro
    public function traerDatos(int $id)
    {
        responderJson($this->usuarioModelo->traerDatos($id));
    }

    // método donde se edita la información de un determinado usuario
    public function editar(int $id)
    {
        $exepciones  = ['celular'];
        $_POST['id'] = $id;
        if($this->validadorFormulario($_POST)){
            if($this->usuarioModelo->editar($_POST)){
                $this->response['success'] = true;
            }else {
                $this->response['success'] = false;
                $this->response['caso']    = 2;
            }
            responderJson($this->response);
        }  else {
            $this->response['success'] = false;
            $this->response['caso']    = 1;
            responderJson($this->response);
        }
    }

    // método donde se desactiva un determinado usuario
    function desactivarUsuario(int $id)
    {
        if($this->usuarioModelo->desactivarUsuario($id)){
            $this->response['success'] = true;
        }else {
            $this->response['success'] = false;
        }
        responderJson($this->response);
    }

    // método donde se activa un determinado usuario
    function activarUsuario(int $id)
    {
        if($this->usuarioModelo->activarUsuario($id)){
            $this->response['success'] = true;
        }else {
            $this->response['success'] = false;
        }
        responderJson($this->response);
    }

    /**
     * EL método listar se encarga de listar los usuarios, realizando paginación del lado del servidor utilizando la clase SSP de datatables
     * The list method is responsible for listing users, paging the server side using the SSP class of datatables
     * @return json con los registros obtenidos 
     */
    public function listar()
    {
        responderJson($this->usuarioModelo->listar());
    }  
    
    
}
