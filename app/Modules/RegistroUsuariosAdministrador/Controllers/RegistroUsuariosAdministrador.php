<?php

class RegistroUsuariosAdministrador extends Controller
{
    public  $response;
    private $usuarioModelo;
    public  $nombreModulo;
    public function __construct()
    {
        // verifica que el usuario este logueado correctamente y esten definidos la sesiones
        $this->validadorSesion();
        $this->nombreModulo  = __CLASS__;
        $this->usuarioModelo = $this->modelo('RegistroUsuariosAdministradorModelo',$this->nombreModulo);
        $this->response = array();
    }

    public function __destruct()
    {
        $this->response      = null;
        $this->usuarioModelo = null;
        $this->nombreModulo  = null;
    }

    
    public function index()
    {

        $datos = [
            'titulo' => 'Registro Usuarios Administrador',
            'titulo_vista' => 'Listado Usuarios'
        ];

        $this->vista('Listar', $datos, $this->nombreModulo);
    }

    // metodo donde se retorna la lista de los usuarios, en un formato json para ser listados en el datatable
    public function listar()
    {
        responderJson($this->usuarioModelo->listar());
    }

    // este metodo retorna la vista donde se insertan usuarios
    public function insertar()
    {
        $datos = [
            'titulo' => 'Registro Usuarios Administrador',
            'titulo_vista' => 'Registrar Usuario'
        ];
        $this->vista('Insertar', $datos, $this->nombreModulo);
    }

    // metodo donde se guarda un determinado usuario en la base de datos
    public function insertarForm()
    {
        if($this->validadorFormulario($_POST)){
            if($this->usuarioModelo->insertar($_POST)){
                $this->cargarArrayResponse(true,"Usuario registrado con exito");
            }else{
                $this->cargarArrayResponse(false,"Error, se presento un problema al registrar el usuario, por favor intentelo de nuevo y verifique que no exista un registro con la misma cédula");
            }
        }  else {
            $this->cargarArrayResponse(false,"Error, faltaron campos por diligenciar");
        }
        responderJson($this->response);
    }
   
    // metodo que retorna la vista para editar los registros de un usuario
    public function editar(int $id)
    {
        $this->response    = $this->usuarioModelo->traerInfoUsuario($id);
        $datos = [
            'titulo' => 'Registro Usuarios Administrador',
            'titulo_vista' => 'Editar Información Usuario',
            'estado_activado' => ($this->response->estado=="Activado") ?    "selected" :"",
            'estado_desactivado'=> ($this->response->estado=="Desactivado") ? "selected" :"",
            'info_usuario'=>$this->response
        ];
        $this->vista('Editar', $datos, $this->nombreModulo);
    }


    // metodo donde se procesa el formulario para editar la información de un usuario
    public function editarForm()
    {
        if($this->validadorFormulario($_POST)){
            if($this->usuarioModelo->editar($_POST)){
                $this->cargarArrayResponse(true,"Información actualizada con exito");
            }else{
                $this->cargarArrayResponse(false,"Error, se presento un problema al actualizar la información, por favor intentelo de nuevo y verifique que no exista otro registro con la misma cédula");
            }
        }  else {
            $this->cargarArrayResponse(false,"Error, faltaron campos por diligenciar");
        }
        responderJson($this->response);
    }

    // metodo donde se retorna la vista para asignar la administración de parqueaderos a un determinado usuario
    public function asignarAdministracionParqueaderos(int $id)
    {
        $this->response    = $this->usuarioModelo->traerInfoUsuarioParqueaderos($id);
        $datos = [
            'titulo' => 'Registro Usuarios Administrador',
            'titulo_vista' => 'Asignar Parqueaderos Usuario',
            'info_usuario'=>$this->response['infoUsuario'],
            'parqueaderos'=>$this->response['parqueaderos']
        ];
        $this->vista('AsignarParqueaderos', $datos, $this->nombreModulo);
    }

    // método donde se realiza la asignación de un parqueadero a un determinado usuario
    public function AsignarParqueadero()
    {

        switch ($this->usuarioModelo->AsignarParqueadero($_POST)) {
            case 1:
                $this->cargarArrayResponse(true,"Usuario asignado al parqueadero seleccionado");
            break;
            case 2:
                $this->cargarArrayResponse(false,"Error, se presento un problema en el servidor por favor intentelo de nuevo");
            case 3:
                $this->cargarArrayResponse(false,"Error, este usuario ya esta asignado al parqueadero seleccionado");
            break;
        }  
        responderJson($this->response);
    }

    // metodo donde se carga el array response
    public function cargarArrayResponse(bool $success,string $msg)
    {
        $this->response['success'] = $success;
        $this->response['msg']     = $msg;
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

    
}
