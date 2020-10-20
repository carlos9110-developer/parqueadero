<?php
class RegistroUsuariosAdministradorModelo
{
    private $db;
    public  $result;

    public function __construct()
    {
        $this->db = new Base();
    }

    public function insertar(array $datos)
    {
        $clave = password_hash($datos['cedula'],PASSWORD_DEFAULT);
        try {  
            $this->db->con->beginTransaction();
            $this->db->query(" INSERT INTO  usuarios(cedula,nombre,telefono,correo,user,contrasena,estado,fecha_registro) VALUES(:cedula,:nombre,:telefono,:correo,:user,:contrasena,:estado,:fecha_registro)  ");
            $this->db->bind(':cedula',$datos['cedula']);
            $this->db->bind(':pass',$clave);
            $this->db->bind(':tipo_usuario',$datos['tipo_usuario']);
            $this->db->bind(':nombre',$datos['nombre']);
            $this->db->bind(':correo',$datos['correo']);
            $this->db->bind(':celular',$datos['celular']);
            $this->db->execute();
            $this->db->con->commit();
            return true;
        } catch (Exception $e) {
            $this->db->con->rollBack();
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
            array( 'db' => '`us`.`cedula`',         'dt' => 'cedula',           'field' => 'cedula' ),
            array( 'db' => '`us`.`nombre`', 'dt' => 'nombre',   'field' => 'nombre' ),
            array( 'db' => '`us`.`telefono`',       'dt' => 'telefono',         'field' => 'telefono' ),
            array( 'db' => '`us`.`correo`',       'dt' => 'correo',         'field' => 'correo' ),
            array( 'db' => '`us`.`user`',      'dt' => 'user',        'field' => 'user' ),
            array( 'db' => '`us`.`estado`',       'dt' => 'estado',         'field' => 'estado' ),
            array( 'db' => '`us`.`fecha_registro`',      'dt' => 'fecha_registro',        'field' => 'fecha_registro' )
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
    public function traerDatos(int $id)
    {
        $this->db->query(" SELECT * FROM users WHERE id=:id ");
        $this->db->bind(':id',$id);
        $this->result = $this->db->registro();
        return $this->result;
    }

    // método donde se edita un determinado registro
    public function editar(array $datos)
    {
        try {  
            $this->db->con->beginTransaction();
            $this->db->query("UPDATE users SET user=:user,tipo_usuario=:tipo_usuario,nombre=:nombre,correo=:correo,celular=:celular WHERE id=:id ");
            $this->db->bind(':user',$datos['cedula']);
            $this->db->bind(':tipo_usuario',$datos['tipo_usuario']);
            $this->db->bind(':nombre',$datos['nombre']);
            $this->db->bind(':correo',$datos['correo']);
            $this->db->bind(':celular',$datos['celular']);
            $this->db->bind(':id',$datos['id']);
            $this->db->execute();
            $this->db->con->commit();
            return true;
        } catch (Exception $e) {
            $this->db->con->rollBack();
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