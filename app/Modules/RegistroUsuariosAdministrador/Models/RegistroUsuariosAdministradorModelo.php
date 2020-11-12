<?php
class RegistroUsuariosAdministradorModelo
{
    private $db;
    public  $result;
    private $fechaActual;
    

    public function __construct()
    {
        $this->db = new Base();
        $this->fechaActual =  date('Y-m-d');
    }

    public function insertar(array $datos)
    {
        try {  
            $this->db->query(" INSERT INTO  usuarios(cedula,nombre,telefono,correo,fecha_registro) VALUES(:cedula,:nombre,:telefono,:correo,:fecha_registro)  ");
            $this->db->bind(':cedula',$datos['cedula']);
            $this->db->bind(':nombre',$datos['nombre']);
            $this->db->bind(':telefono',$datos['telefono']);
            $this->db->bind(':correo',$datos['correo']);
            $this->db->bind(':fecha_registro',$this->fechaActual);
            $this->db->execute();
            return true;
        } catch (Exception $e) {
            return false;
        } 
    }


    public function listar()
    {
        $table      = 'usuarios';
        // Table's primary key
        $primaryKey = 'id';
        // indexes
        $columns = array
        (
            array( 'db' => '`us`.`id`',           'dt' => 'id',             'field' => 'id' ),
            array( 'db' => '`us`.`cedula`',          'dt' => 'cedula',            'field' => 'cedula' ),
            array( 'db' => '`us`.`nombre`',          'dt' => 'nombre',            'field' => 'nombre' ),
            array( 'db' => '`us`.`telefono`',           'dt' => 'telefono',             'field' => 'telefono' ),
            array( 'db' => '`us`.`correo`',          'dt' => 'correo',            'field' => 'correo' ),
            array( 'db' => '`us`.`estado`',          'dt' => 'estado',            'field' => 'estado' )

        );
        $sql_details = array
        (
            'user' => DB_USER,
            'pass' => DB_PASS,
            'db'   => DB_NAME,
            'host' => DB_HOST
        );
        
        $joinQuery = "FROM `usuarios` AS `us` ";
        $extraWhere= "";
        $groupBy = "";
        $having = "";
        return SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having );
    }
    

    // método donde se traen los datos de un determinado registro
    public function traerInfoUsuario(int $id)
    {
        $this->db->query("SELECT * FROM usuarios WHERE id=:id ");
        $this->db->bind(':id',$id);
        return  $this->db->registro();
    }

    // método donde se edita un determinado registro
    public function editar(array $datos)
    {
        try {  
            $this->db->query("UPDATE usuarios SET cedula=:cedula,nombre=:nombre,telefono=:telefono,correo=:correo,estado=:estado WHERE id=:id ");
            $this->db->bind(':cedula',$datos['cedula']);
            $this->db->bind(':nombre',$datos['nombre']);
            $this->db->bind(':telefono',$datos['telefono']);
            $this->db->bind(':correo',$datos['correo']);
            $this->db->bind(':estado',$datos['estado']);
            $this->db->bind(':id',$datos['id']);
            $this->db->execute();
            return true;
        } catch (Exception $e) {
            return false;
        } 
    }

    // método donde se desactiva un determinado usuario
    function desactivarUsuario(int $id)
    {
        try {  
            $this->db->con->beginTransaction();
            $this->db->query(" UPDATE users SET estado=:estado WHERE id=:id  ");
            $this->db->bind(':estado',"Desactivado");
            $this->db->bind(':id',$id);
            $this->db->execute();
            $this->db->con->commit();
            return true;
        } catch (Exception $e) {
            $this->db->con->rollBack();
            return false;
        }
    }

    // método donde se activa un determinado usuario
    function activarUsuario(int $id)
    {
        try {  
            $this->db->con->beginTransaction();
            $this->db->query(" UPDATE users SET estado=:estado WHERE id=:id  ");
            $this->db->bind(':estado',"Activado");
            $this->db->bind(':id',$id);
            $this->db->execute();
            $this->db->con->commit();
            return true;
        } catch (Exception $e) {
            $this->db->con->rollBack();
            return false;
        }
    }


}