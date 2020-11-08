<?php
class LoginModelo
{
    private $db;
    public  $result;

    public function __construct()
    {
        $this->db = new Base();
    }

    public function login1($user, $pass)
    {
        // el codigo de resultado va ser 1 si el usuario existe y la contraseña coincide
        // 2 = ni existe el usuario
        // 3 = contraseña incorrecta
        
        if($this->issetUsuario($user)){
            if($this->passwordVerify($user,$pass,"usuarios_super_administradores")){
                return 1;
            } else {
                return 3;
            }
        } else{
            return 2;
        }
    }

    public function login2(string $user,string $pass,string $nit)
    {
        // valores a retornar
        // el codigo de resultado va ser 1 si el usuario existe y la contraseña coincide
        // 2 = el usuario no existe o se encuentra inactivo
        // 3 = contraseña incorrecta

        if($this->verificarEstadoUsuario($user,$nit)){
            if($this->passwordVerify($user,$pass,"usuarios_parqueadero")){
                return 1;
            } else {
                return 3;
            }
        } else{
            return 2;
        }
        
    }

    /**
     * EL método issetUsuario se encarga de verificar que un usuario exista en la base de datos
     * The issetUser method is responsible for verifying that a user exists in the database
     * @param string $user       = contiene el usuario
     * @return boolean
     */
    public function issetUsuario($user)
    {
        $this->db->query("SELECT * FROM usuarios_super_administradores WHERE user=:user  ");
        $this->db->bind(':user',$user);
        $this->db->execute();
        $this->result =  $this->db->rowCount();
        if($this->result === 1){
            return true;
        } else {
            return false;
        }
    }

    /**
     * EL método passwordVerify se encarga de verificar que la contraseña ingresada sea correcta
     * The passwordVerify method is responsible for verifying that the password entered is correct
     * @param string $user       = contiene el usuario
     * @param string $pass       = contiene la contraseña
     * @return boolean
     */
    public function passwordVerify($user,$pass,$tabla)
    {
        $this->db->query("SELECT clave FROM ".$tabla." WHERE user=:user  ");
        $this->db->bind(':user',$user);
        $this->result = $this->db->registro();
        if(password_verify($pass, $this->result->clave)){
            return true;
        } else{
            return false;
        }
    }

    /**
     * EL método infoUsuario se encarga de retornar la información de un determinado usuario
     * The infoUsuario method is responsible for returning the information of a specific user
     * @param string $user       = contiene el usuario
     * @return object
     */
    public function infoUsuario($user)
    {

        $this->db->query("SELECT * FROM usuarios_super_administradores WHERE user=:user  ");
        $this->db->bind(':user',$user);
        $this->result = $this->db->registro();
        return $this->result;
    }

    // metodo donde se comprueba que un determinado usuario este activo o no en la base de datos
    public function verificarEstadoUsuario(string $user, string $nit)
    {
        $this->db->query("SELECT us_par.id FROM usuarios_parqueadero AS us_par INNER JOIN usuarios AS us ON us_par.id_usuario=us.id INNER JOIN parqueaderos AS par ON us_par.id_parqueadero=par.id  WHERE us_par.user=:user AND us_par.estado=:estado_1 AND us.estado=:estado_2 AND par.nit=:nit ");
        $this->db->bind(':user',$user);
        $this->db->bind(':estado_1',"Activado");
        $this->db->bind(':estado_2',"Activado");
        $this->db->bind(':nit',$nit);
        $this->db->execute();
        $this->result =  $this->db->rowCount();
        if($this->result === 1){
            return true;
        } else {
            return false;
        }
    }

    // metodo donde se trae la información de un determinado usuario
    public function infoUsuario2(string $user, string $nit)
    {
        $this->db->query("SELECT us_par.id,us.nombre FROM usuarios_parqueadero AS us_par INNER JOIN usuarios AS us ON us_par.id_usuario=us.id INNER JOIN parqueaderos AS par ON us_par.id_parqueadero=par.id  WHERE us_par.user=:user AND us_par.estado=:estado_1 AND us.estado=:estado_2 AND par.nit=:nit ");
        $this->db->bind(':user',$user);
        $this->db->bind(':estado_1',"Activado");
        $this->db->bind(':estado_2',"Activado");
        $this->db->bind(':nit',$nit);
        $this->result = $this->db->registro();
        return $this->result;
    }
}
