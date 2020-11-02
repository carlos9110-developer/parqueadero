<?php

class RegistroUsuariosAdministrador extends Controller
{
    private  $response = array();
    private  $usuarioModelo;
    private  $result;
    public   $nombreModulo;
    private  $datosForm;
    public function __construct()
    {
        // verifica que el usuario este logueado correctamente y esten definidos la sesiones
        $this->validadorSesion();
        $this->nombreModulo  = __CLASS__;
        $this->usuarioModelo = $this->modelo('RegistroUsuariosAdministradorModelo',$this->nombreModulo);
        $this->datosForm =  array();
        
    }

    public function __destruct()
    {
        $this->response = null;
    }

    public function index()
    {
        $lista_usuarios = $this->usuarioModelo->listar();

        $datos = [
            'titulo' => 'Registro Usuarios Administrador',
            'titulo_vista' => 'Listado Usuarios',
            'lista_usuarios' => $lista_usuarios
        ];

        $this->vista('Listar', $datos, $this->nombreModulo);
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

    // este metodo retorna la vista donde se insertan usuarios
    public function insertar()
    {
        $this->setearDatosForm();
        $datos = [
            'titulo' => 'Registro Usuarios Administrador',
            'titulo_vista' => 'Registrar Usuario',
            'datos_form' => $this->datosForm
        ];
        $this->vista('Insertar', $datos, $this->nombreModulo);
    }

    // metodo donde se procesa el formulario para registrar usuarios
    public function insertarForm()
    {
        if($this->validadorFormulario($_POST)){
            $resultado = $this->usuarioModelo->insertar($_POST);
            if($resultado==true){
                $datos_form = array();
                $datos_form['cedula'] = '';
                $datos_form['nombre'] = '';
                $datos_form['telefono'] = '';
                $datos_form['correo'] = '';
                $datos = [
                'titulo' => 'Registro Usuarios Administrador',
                'titulo_vista' => 'Registrar Usuario',
                'registro_realizado' => 'Usuario registrado con exito',
                'datos_form' => $datos_form
                ];
                $this->vista('Insertar', $datos, $this->nombreModulo);
            }
        }else {
            $datos_form = array();
            $datos_form['cedula'] = $_POST['cedula'];
            $datos_form['nombre'] = $_POST['nombre'];
            $datos_form['telefono'] = $_POST['telefono'];
            $datos_form['correo'] = $_POST['correo'];
            $datos = [
            'titulo' => 'Registro Usuarios Administrador',
            'titulo_vista' => 'Registrar Usuario',
            'error_campos' => 'Error, se deben de diligenciar todos los campos',
            'datos_form' => $datos_form
            ];
            $this->vista('Insertar', $datos, $this->nombreModulo);
        }
    }



    // método donde se traen los datos de un determinado registro
    public function traerDatos(int $id)
    {
        responderJson($this->usuarioModelo->traerDatos($id));
    }

    // método donde se muestra la vista para editar un usuario
    public function editar(int $id)
    {
        $datos_usuario = $this->usuarioModelo->traerDatos($id);
        $datos_form = array();
        $datos_form['id'] =  $id;
        $datos_form['cedula'] =  $datos_usuario->cedula;
        $datos_form['nombre'] = $datos_usuario->nombre;
        $datos_form['telefono'] = $datos_usuario->telefono;
        $datos_form['correo'] = $datos_usuario->correo;
        $datos_form['estado'] = $datos_usuario->estado;
        $datos = [
            'titulo' => 'Registro Usuarios Administrador',
            'titulo_vista' => 'Editar Usuario',
            'datos_form' => $datos_form
        ];
        $this->vista('Editar', $datos, $this->nombreModulo);
    }

    //metodo donde se procesa el formulario para editar la información de un usuario
    public function editarForm(int $id)
    {
        $_POST['id'] = $id;
        if($this->validadorFormulario($_POST)){
            $resultado = $this->usuarioModelo->editar($_POST);
            if($resultado==true){
                $datos_form = array();
                $datos_form['cedula'] = $_POST['cedula'];
                $datos_form['nombre'] = $_POST['nombre'];
                $datos_form['telefono'] = $_POST['telefono'];
                $datos_form['correo'] = $_POST['correo'];
                $datos_form['estado'] = $_POST['estado'];
                $datos = [
                'titulo' => 'Registro Usuarios Administrador',
                'titulo_vista' => 'Editar Usuario',
                'success' => 'Información usuario editada con exito, recuerde que el nuevo usuario que tendra la persona para entrar a la base de datos sera el correo electronico diligenciado registrada y la nueva clave sera la cédula diligenciada',
                'datos_form' => $datos_form
                ];
                $this->vista('Editar', $datos, $this->nombreModulo);
            }
        }else {
            $datos_form = array();
            $datos_form['cedula'] = $_POST['cedula'];
            $datos_form['nombre'] = $_POST['nombre'];
            $datos_form['telefono'] = $_POST['telefono'];
            $datos_form['correo'] = $_POST['correo'];
            $datos_form['estado'] = $_POST['estado'];
            $datos = [
            'titulo' => 'Registro Usuarios Administrador',
            'titulo_vista' => 'Editar Usuario',
            'error_campos' => 'Error, se deben de diligenciar todos los campos',
            'datos_form' => $datos_form
            ];
            $this->vista('Editar', $datos, $this->nombreModulo);
        }
    }


    // método donde se  inicializa la variable $datosForm con los datos que se le pasan como parametro
    private function setearDatosForm(string $cedula = '', string $nombre = '', string $telefono = '', string $correo = '')
    {
        $this->datosForm['cedula']    = $cedula;
        $this->datosForm['nombre']    = $nombre;
        $this->datosForm['telefono']  = $telefono;
        $this->datosForm['correo']    = $correo;
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


    
}
