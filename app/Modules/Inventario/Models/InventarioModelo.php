<?php
class InventarioModelo
{
    private $db;
    public  $result;

    public function __construct()
    {
        $this->db = new Base();
    }

    public function insertar(array $datos)
    {
        try {  
            $this->db->con->beginTransaction();
            $this->registrarProducto($datos);
            $this->db->con->commit();
            return true;
        } catch (Exception $e) {
            $this->db->con->rollBack();
            return false;
        } 
    }

    // método para registrar cuando la medida es metros
    private function registrarProducto(array $datos)
    {
        $this->db->query(" INSERT INTO  productos(nombre,tipo_medida,cantidad_alarma) VALUES(:nombre,:tipo_medida,:cantidad_alarma)  ");
        $this->db->bind(':nombre',$datos['producto']);
        $this->db->bind(':tipo_medida',$datos['tipo_medida']);
        $this->db->bind(':cantidad_alarma',$datos['cantidad_alarma']);
        $this->db->execute();
    }

    

    // método que lista los productos que hay en la base de datos
    public function listar()
    {
        $table      = 'productos';
		// Table's primary key
        $primaryKey = 'id';
		// indexes
		$columns = array
		(
            array( 'db' =>'`pro`.`id`',                            'dt' =>'id',                            'field' =>'id'),
            array( 'db' =>'`pro`.`nombre`',                        'dt' =>'nombre',                        'field' =>'nombre'),
            array( 'db' =>'`pro`.`tipo_medida`',                   'dt' =>'tipo_medida',                   'field' =>'tipo_medida'),
            array( 'db' =>'`pro`.`cantidad`',             'dt' =>'cantidad',             'field' =>'cantidad'),
            array( 'db' =>'`pro`.`cantidad_alarma`',      'dt' =>'cantidad_alarma',      'field' =>'cantidad_alarma')
        );
        $sql_details = array
		(
			'user' => DB_USER,
			'pass' => DB_PASS,
			'db'   => DB_NAME,
			'host' => DB_HOST
        );
        
        $joinQuery = "FROM `productos` AS `pro` ";
        $extraWhere= "";
        $groupBy = "";
		$having = "";
        return SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having );
    }
    
    // método para traer la información de un determinado producto
    public function traerInfoProducto(int $id)
    {   
        $this->db->query(" SELECT * FROM productos WHERE id=:id  ");
        $this->db->bind(':id',$id);
        $this->result = $this->db->registro();
        return $this->result;
    }

    // método para editar un determinado producto 
    public function editar(array $datos)
    {
        try {  
            $this->db->con->beginTransaction();
            $this->editarProducto($datos);
            $this->db->con->commit();
            return true;
        } catch (Exception $e) {
            $this->db->con->rollBack();
            return false;
        }
    }

    // método para editar un producto cuando es con medidad metros
    private function editarProducto(array $datos)
    {
        $this->db->query(" UPDATE productos SET nombre=:nombre,tipo_medida=:tipo_medida,cantidad_alarma=:cantidad_alarma WHERE id=:id   ");
        $this->db->bind(':nombre',$datos['producto']);
        $this->db->bind(':tipo_medida',$datos['tipo_medida']);
        $this->db->bind(':cantidad_alarma',$datos['cantidad_alarma']);
        $this->db->bind(':id',$datos['id']);
        $this->db->execute();
    }





}