<?php
class EntradaProductosModelo
{
    private $db;
    public  $result;

    public function __construct()
    {
        $this->db = new Base();
    }

    // método donde se listan las entradas de productos
    public function listarEntradas()
    {
        $table      = 'entrada_productos';
		// Table's primary key
        $primaryKey = 'id';
		// indexes
		$columns = array
		(
            array( 'db' =>'`ent`.`id`',           'dt' =>'id',           'field' =>'id'),
            array( 'db' =>'`ent`.`proveedor`',    'dt' =>'proveedor',    'field' =>'proveedor'),
            array( 'db' =>'`ent`.`fecha`',        'dt' =>'fecha',        'field' =>'fecha'),
            array( 'db' =>'`ent`.`observacion`',  'dt' =>'observacion',  'field' =>'observacion'),
            array( 'db' =>'`ent`.`total_compra`', 'dt' =>'total_compra', 'field' =>'total_compra')
        );

        $sql_details = array
		(
			'user' => DB_USER,
			'pass' => DB_PASS,
			'db'   => DB_NAME,
			'host' => DB_HOST
        );
        
        $joinQuery = "FROM `entrada_productos` AS `ent` ";
        $extraWhere= "";
        $groupBy = "";
		$having = "";
        return SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having );
    }

    // método donde se registra la entrada de productos
    public function registrarEntrada(array $datos)
    {
		try {  
			$this->db->con->beginTransaction();
			$this->registroEntradaProductos($datos);
            $this->db->con->commit();
            return true;
        } catch (Exception $e) {
            $this->db->con->rollBack();
            return false;
		}
	}
	
	// método para registrar la entrada de productos a la base de datos
	private function registroEntradaProductos(array $datos)
	{
		$fecha = date('Y-m-d');
		$this->db->query(" INSERT INTO  entrada_productos(proveedor,fecha,observacion,total_compra) VALUES(:proveedor,:fecha,:observacion,:total_compra)  ");
		$this->db->bind(':proveedor',$datos['proveedor']);
		$this->db->bind(':fecha',$fecha);
		$this->db->bind(':observacion',$datos['observacion']);
		$this->db->bind(':total_compra',$datos['input_total_compra']);
		$this->db->execute();
		$this->cicloDetalleEntradaProductos($this->db->con->lastInsertId(),$datos);
	}

	// método que recorre el array de los input y llama los metodos para registrar en las tablas detalle_entrada_productos y actualziar el inventario
	private function cicloDetalleEntradaProductos(int $id_entrada,array $datos)
	{
		$num_elementos=0;
		while ( ($num_elementos < count($datos['input_id_producto']))  )
		{
			$this->registarDetalleEntrada($id_entrada,$datos['input_id_producto'][$num_elementos],$datos['input_cantidad'][$num_elementos],str_replace(".","",$datos['input_precio_compra'][$num_elementos]));
			$this->actualizarInventarioProductos($datos['input_id_producto'][$num_elementos],$datos['input_cantidad'][$num_elementos]);
			$num_elementos=$num_elementos + 1;
		}
	}

	// metodo para registrar en la tabla detalle_entrada_productos
	private function registarDetalleEntrada(int $id_entrada,int $id_producto,float $cantidad,int $precio)
	{
		$this->db->query(" INSERT INTO  detalle_entrada_productos(id_entrada_productos,id_producto,cantidad,precio) VALUES(:id_entrada_productos,:id_producto,:cantidad,:precio) ");
		$this->db->bind(':id_entrada_productos',$id_entrada);
		$this->db->bind(':id_producto',$id_producto);
		$this->db->bind(':cantidad',$cantidad);
		$this->db->bind(':precio',$precio);
		$this->db->execute();
	}

	// metodo para actualizar el stock de productos
	private function actualizarInventarioProductos(int $id_producto,float $cantidad)
	{
		$this->db->query(" UPDATE productos SET cantidad= cantidad + :cantidad WHERE id=:id ");
		$this->db->bind(':cantidad',$cantidad);
		$this->db->bind(':id',$id_producto);
		$this->db->execute();
	}

	// método donde se listan los productos de una determinada entrada
    public function listarProductosEntrada(int $id)
    {
        $table      = 'detalle_entrada_productos';
		// Table's primary key
        $primaryKey = 'id';
		// indexes
		$columns = array
		(
            array( 'db' =>'`pro`.`nombre`',    'dt' =>'nombre',    'field' =>'nombre'),
			array( 'db' =>'`deta`.`cantidad`',  'dt' =>'cantidad',  'field' =>'cantidad'),
			array( 'db' =>'`pro`.`tipo_medida`',    'dt' =>'tipo_medida',    'field' =>'tipo_medida'),
			array( 'db' =>'`deta`.`precio`',  'dt' =>'precio',  'field' =>'precio')
        );

        $sql_details = array
		(
			'user' => DB_USER,
			'pass' => DB_PASS,
			'db'   => DB_NAME,
			'host' => DB_HOST
        );
        
        $joinQuery = "FROM `detalle_entrada_productos` AS `deta` JOIN `productos` AS `pro` ON (`deta`.`id_producto` = `pro`.`id`) ";
        $extraWhere = " `deta`.`id_entrada_productos`='".$id."' ";
        $groupBy = "";
		$having = "";
        return SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having );
	}
	
	// método donde se trae la información de un determinado registro
    public function traerDatosRegistro(int $id)
    {
		$this->db->query(" SELECT proveedor,observacion FROM entrada_productos WHERE id=:id ");
		$this->db->bind(':id',$id);
		$this->result = $this->db->registro();
		return $this->result;
	}
	
	// método donde se edita un determinado registro
	public function editarRegistro(array $datos)
	{
		try {  
			$this->db->con->beginTransaction();
			$this->db->query(" UPDATE entrada_productos SET  proveedor=:proveedor,observacion=:observacion WHERE id=:id ");
			$this->db->bind(':proveedor',$datos['proveedor']);
			$this->db->bind(':observacion',$datos['observacion']);
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