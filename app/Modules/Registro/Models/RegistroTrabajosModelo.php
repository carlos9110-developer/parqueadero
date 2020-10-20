<?php
class RegistroTrabajosModelo
{
    private $db;
    public  $result;

    public function __construct()
    {
        $this->db = new Base();
    }

    // método donde se listan los trabajos realizados
    public function listarTrabajos()
    {
        $table      = 'registro_trabajos';
		// Table's primary key
        $primaryKey = 'id';
		// indexes
		$columns = array
		(
            array( 'db' =>'`tra`.`id`',           'dt' =>'id',           'field' =>'id'),
            array( 'db' =>'`tra`.`placa`',    'dt' =>'placa',    'field' =>'placa'),
            array( 'db' =>'`tra`.`marca`',        'dt' =>'marca',        'field' =>'marca'),
            array( 'db' =>'`tra`.`cliente`',  'dt' =>'cliente',  'field' =>'cliente'),
			array( 'db' =>'`tra`.`telefono_cliente`', 'dt' =>'telefono_cliente', 'field' =>'telefono_cliente'),
			array( 'db' =>'`tra`.`correo_cliente`', 'dt' =>'correo_cliente', 'field' =>'correo_cliente'),
			array( 'db' =>'`tra`.`fecha`', 'dt' =>'fecha', 'field' =>'fecha'),
			array( 'db' =>'`us`.`nombre`', 'dt' =>'tecnico', 'field' =>'nombre'),
			array( 'db' =>'`tra`.`estado`', 'dt' =>'estado', 'field' =>'estado')
        );

        $sql_details = array
		(
			'user' => DB_USER,
			'pass' => DB_PASS,
			'db'   => DB_NAME,
			'host' => DB_HOST
        );
        
        $joinQuery = "FROM `registro_trabajos` AS `tra` JOIN `users` AS `us` ON (`tra`.`id_tecnico` = `us`.`id`) ";
        $extraWhere= "";
        $groupBy = "";
		$having = "";
        return SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having );
    }

	// método donde se listan los técnicos de la base de datos
    public function traerTecnicos()
    {
        $this->db->query(" SELECT id,nombre FROM users WHERE tipo_usuario=:tipo_usuario AND estado=:estado ");
		$this->db->bind(':tipo_usuario','Técnico');
		$this->db->bind(':estado','Activado');
		$this->result = $this->db->registros();
		return $this->result;
    }

	// método donde se realiza el registro de un detemrinado 
	public function registrarTrabajo(array $datos)
	{
		try {  
			$this->db->con->beginTransaction();
			$this->registroTrabajos($datos);
            $this->db->con->commit();
            return true;
        } catch (Exception $e) {
            $this->db->con->rollBack();
            return false;
		}
	}

	// método donde se realiza el registro de un determinado trabajo
	private function registroTrabajos(array $datos)
	{
		$fecha = date('Y-m-d');
		$this->db->query(" INSERT INTO  registro_trabajos(placa,marca,cliente,correo_cliente,fecha,descripcion,id_tecnico,telefono_cliente) VALUES(:placa,:marca,:cliente,:correo_cliente,:fecha,:descripcion,:id_tecnico,:telefono_cliente)  ");
		$this->db->bind(':placa',$datos['placa']);
		$this->db->bind(':marca',$datos['marca']);
		$this->db->bind(':cliente',$datos['cliente']);
		$this->db->bind(':correo_cliente',$datos['email_cliente']);
		$this->db->bind(':fecha',$fecha);
		$this->db->bind(':descripcion',$datos['observacion']);
		$this->db->bind(':id_tecnico',$datos['tecnico']);
		$this->db->bind(':telefono_cliente',$datos['telefono_cliente']);
		$this->db->execute();
		$this->cicloDetalleTrabajo($this->db->con->lastInsertId(),$datos);
	}

	// método donde se realiza la actualización de un determinado registro
	public function editarRegistroTrabajo(array $datos)
	{
		try {  
			$this->db->con->beginTransaction();
			$this->db->query(" UPDATE registro_trabajos SET  placa=:placa,marca=:marca,cliente=:cliente,correo_cliente=:correo_cliente,descripcion=:descripcion,id_tecnico=:id_tecnico,
			telefono_cliente=:telefono_cliente WHERE id=:id ");
			$this->db->bind(':placa',$datos['placa']);
			$this->db->bind(':marca',$datos['marca']);
			$this->db->bind(':cliente',$datos['cliente']);
			$this->db->bind(':correo_cliente',$datos['email_cliente']);
			$this->db->bind(':descripcion',$datos['observacion']);
			$this->db->bind(':id_tecnico',$datos['tecnico']);
			$this->db->bind(':telefono_cliente',$datos['telefono_cliente']);
			$this->db->bind(':id',$datos['id']);
			$this->db->execute();
            $this->db->con->commit();
            return true;
        } catch (Exception $e) {
            $this->db->con->rollBack();
            return false;
		}
	}

	// método que recorre el array de los input y llama los metodos para registrar en las tablas productos_trabajos y actualizar el inventario
	private function cicloDetalleTrabajo(int $id_trabajo,array $datos)
	{
		if(isset($datos['input_id_producto'])){
			$num_elementos=0;
			while ( ($num_elementos < count($datos['input_id_producto']))  )
			{
				$this->registarDetalleTrabajo($id_trabajo,$datos['input_id_producto'][$num_elementos],$datos['input_cantidad'][$num_elementos]);
				$this->actualizarInventarioProductos($datos['input_id_producto'][$num_elementos],$datos['input_cantidad'][$num_elementos]);
				$num_elementos=$num_elementos + 1;
			}
		}
	}

	// metodo para registrar en la tabla productos_trabajos
	private function registarDetalleTrabajo(int $id_trabajo,int $id_producto,float $cantidad)
	{
		$this->db->query(" INSERT INTO  productos_trabajos(id_trabajo,id_producto,cantidad) VALUES(:id_trabajo,:id_producto,:cantidad) ");
		$this->db->bind(':id_trabajo',$id_trabajo);
		$this->db->bind(':id_producto',$id_producto);
		$this->db->bind(':cantidad',$cantidad);
		$this->db->execute();
	}

	// metodo para actualizar el stock de productos
	private function actualizarInventarioProductos(int $id_producto,float $cantidad)
	{
		$this->db->query(" UPDATE productos SET cantidad=cantidad - :cantidad WHERE id=:id ");
		$this->db->bind(':cantidad',$cantidad);
		$this->db->bind(':id',$id_producto);
		$this->db->execute();
	}

	// método donde se listan los productos utilizados en un determinado trabajo
    public function listarProductosUtilizados(int $id)
    {
        $table      = 'productos_trabajos';
		// Table's primary key
        $primaryKey = 'id';
		// indexes
		$columns = array
		(
            array( 'db' =>'`pro`.`nombre`',    'dt' =>'nombre',    'field' =>'nombre'),
			array( 'db' =>'`tra`.`cantidad`',  'dt' =>'cantidad',  'field' =>'cantidad'),
			array( 'db' =>'`pro`.`tipo_medida`',    'dt' =>'tipo_medida',    'field' =>'tipo_medida'),
        );

        $sql_details = array
		(
			'user' => DB_USER,
			'pass' => DB_PASS,
			'db'   => DB_NAME,
			'host' => DB_HOST
        );
        
        $joinQuery = "FROM `productos_trabajos` AS `tra` JOIN `productos` AS `pro` ON (`tra`.`id_producto` = `pro`.`id`) ";
        $extraWhere = " `tra`.`id_trabajo`='".$id."' ";
        $groupBy = "";
		$having = "";
        return SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having );
	}
	
	// método donde se trae la información de un determinado registro
    public function traerDatosRegistro(int $id)
    {
        $this->db->query(" SELECT placa,marca,cliente,descripcion,id_tecnico,telefono_cliente,correo_cliente FROM registro_trabajos WHERE id=:id ");
		$this->db->bind(':id',$id);
		$this->result = $this->db->registro();
		return $this->result;
	}
	
	// método donde se realiza el registro de la facturación 
    public function registrarFacturacion(array $datos)
    {
        try {  
			$this->db->con->beginTransaction();
			$this->registroFactura($datos);
			$this->actualizarEstadoTrabajo($datos['id']);
            $this->db->con->commit();
            return true;
        } catch (Exception $e) {
            $this->db->con->rollBack();
            return false;
		}
	}
	
	// método donde se hace el registro en la tabla facturación
	private function registroFactura(array $datos)
	{
		$fecha = date('Y-m-d');
		$datos['precio'] =  str_replace(".", "", $datos['precio']);
		$this->db->query(" INSERT INTO  facturas(id_trabajo,meses_garantia,precio,fecha) VALUES(:id_trabajo,:meses_garantia,:precio,:fecha) ");
		$this->db->bind(':id_trabajo',$datos['id']);
		$this->db->bind(':meses_garantia',$datos['meses_garantia']);
		$this->db->bind(':precio',$datos['precio']);
		$this->db->bind(':fecha',$fecha);
		$this->db->execute();
	}

	// método donde se actualiza el estado del registro de trabajo cuando se ha registrado la facturación
	private function actualizarEstadoTrabajo(int $id)
	{	
		$this->db->query(" UPDATE registro_trabajos SET  estado=:estado WHERE id=:id ");
		$this->db->bind(':estado','2');
		$this->db->bind(':id',$id);
		$this->db->execute();
	}	

}