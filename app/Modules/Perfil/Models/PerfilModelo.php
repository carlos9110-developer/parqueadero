<?php
class PerfilModelo
{
    private $db;
    public  $result;

    public function __construct()
    {
        $this->db = new Base();
    }

	public function __destruct()
    {
        $this->db        = null;
        $this->result    = null;
    }
   

    // método donde se trae la información personal del usuario
    public function traerInfo()
    {
        if (strlen(session_id()) < 1) 
        {
            session_start();
        }
        $this->db->query("SELECT user,nombre,correo,celular FROM users WHERE id=:id  ");
        $this->db->bind(':id',$_SESSION['id_user']);
        $this->result =  $this->db->registro();
        return $this->result;
    }

    // método donde se edita la información del usuario que esta en sesion 
    public function actualizarDatos(array $datos)
    {
        if (strlen(session_id()) < 1) 
        {
            session_start();
        }
        try {  
            $this->db->con->beginTransaction();
            $this->editarInfo($datos);
            $this->db->con->commit();
            $_SESSION['name_user'] = $datos['nombre'];
            return true;
        } catch (Exception $e) {
            $this->db->con->rollBack();
            return false;
        }
    }

    // método donde se valida si se va cambiar la cédula del encuestador y se edita la información del usuario
    private function editarInfo(array $datos)
    {   
        $this->db->query(" UPDATE  users SET  user=:user,nombre=:nombre,correo=:correo,celular=:celular WHERE id=:id  ");
        $this->db->bind(':user',$datos['cedula']);
        $this->db->bind(':nombre',$datos['nombre']);
        $this->db->bind(':correo',$datos['correo']);
        $this->db->bind(':celular',$datos['celular']);
        $this->db->bind(':id',$datos['id']);
        $this->db->execute();
    }

    // método para validar que la contraseña ingresada coincida con la contraseña actual
    public function validarContrasenaActual(array $datos)
    {
        $this->db->query("SELECT pass FROM users WHERE id=:id  ");
        $this->db->bind(':id',$datos['id']);
        $this->result = $this->db->registro();
        if(password_verify($datos['clave_actual'],$this->result->pass)){
            return true;
        } else{
            return false;
        }
    }

    // método donde se cambia la contrasena del usuario que esta en la sesion
    public function cambiarContrasena(array $datos)
    {
        $clave = password_hash($datos['nueva_clave'],PASSWORD_DEFAULT);
        try {  
            $this->db->con->beginTransaction();
            $this->db->query(" UPDATE  users SET  pass=:pass  WHERE id=:id  ");
            $this->db->bind(':pass',$clave);
            $this->db->bind(':id',$datos['id']);
            $this->db->execute();
            $this->db->con->commit();
            return true;
        } catch (Exception $e) {
            $this->db->con->rollBack();
            return false;
        }
    }


   

}