<?php
class FacturacionModelo
{
    private $db;
    public  $result;

    public function __construct()
    {
        $this->db = new Base();
        $this->result = null;
    }

    // método donde se listan las facturas
    public function listarFacturas()
    {
        $table      = 'facturas';
		// Table's primary key
        $primaryKey = 'id';
		// indexes
		$columns = array
		(
            array( 'db' =>'`fac`.`id`',                 'dt' =>'id',                'field' =>'id'),
            array( 'db' =>'`tra`.`telefono_cliente`',   'dt' =>'telefono_cliente',  'field' =>'telefono_cliente'),
            array( 'db' =>'`tra`.`placa`',        'dt' =>'placa',        'field' =>'placa'),
            array( 'db' =>'`tra`.`marca`',        'dt' =>'marca',        'field' =>'marca'),
            array( 'db' =>'`tra`.`cliente`',  'dt' =>'cliente',  'field' =>'cliente'),
			array( 'db' =>'`fac`.`fecha`', 'dt' =>'fecha', 'field' =>'fecha'),
			array( 'db' =>'`fac`.`precio`', 'dt' =>'precio', 'field' =>'precio'),
			array( 'db' =>'`fac`.`meses_garantia`', 'dt' =>'meses_garantia', 'field' =>'meses_garantia')
        );

        $sql_details = array
		(
			'user' => DB_USER,
			'pass' => DB_PASS,
			'db'   => DB_NAME,
			'host' => DB_HOST
        );
        
        $joinQuery = "FROM `facturas` AS `fac` JOIN `registro_trabajos` AS `tra` ON (`fac`.`id_trabajo` = `tra`.`id`) ";
        $extraWhere= "";
        $groupBy = "";
		$having = "";
        return SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having );
    }

    // método para ver una determinada factura
    public function verFactura(int $id)
    {   
        //Establecemos los datos de la empresa
        $logo = RUTA_LOGO;
        $ext_logo = "png";
        $empresa = "Auto Express";
        $direccion = "Carrera 12 # 31-35 Pereira";
        $telefono = "310 410 8186";
        $email = "fabio.zapata@autoexpressdecolombia.com";
        
        $this->result = $this->traerInfoFactura($id);
        //Establecemos la configuración de la factura
        $pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
        $pdf->AddPage();
        
        //Enviamos los datos de la empresa al método addSociete de la clase Factura
        $pdf->addSociete(utf8_decode($empresa),
                        utf8_decode("Dirección: ").utf8_decode($direccion)."\n".
                        utf8_decode("Celular: ").$telefono."\n" .
                        "Email : ".$email,$logo,$ext_logo);
        $pdf->temporaire( "" );
        $pdf->addDate( $this->result->fecha);
        
        
        //Enviamos los datos del cliente al método addClientAdresse de la clase Factura
        $pdf->addClientAdresse(utf8_decode($this->result->cliente),"Celular: ".$this->result->telefono_cliente);
        $pdf->SetXY( 10, 70 );
        $pdf->SetWidths(array(130,30,30));
        $pdf->Row(array(utf8_decode("DESCRIPCIÓN"),"MESES GARANTIA","VALOR"));
        $pdf->Row(array(utf8_decode($this->result->descripcion),$this->result->meses_garantia,"$ ".number_format($this->result->precio,0,",",".")));

        //Actualizamos el valor de la coordenada "y", que será la ubicación desde donde empezaremos a mostrar los datos
        $y= 89;
        $line = array( "CODIGO"=> "codigo",
                        "DESCRIPCION"=>"codigo",
                        "CANTIDAD"=> "codigo",
                        "P.U."=> "codigo",
                        "DSCTO" => "codigo",
                        "SUBTOTAL"=> "codigo");
                    $size = $pdf->addLine( $y, $line );
                    $y   += $size + 2;
        $pdf->Output('Reporte Facturas.pdf','I');
    }  
    
    // método donde se trae la información de la factura 
    private function traerInfoFactura(int $id)
    {
        $this->db->query(" SELECT facturas.fecha,registro_trabajos.cliente,registro_trabajos.telefono_cliente,registro_trabajos.descripcion,facturas.meses_garantia,facturas.precio  FROM facturas INNER JOIN registro_trabajos  ON facturas.id_trabajo=registro_trabajos.id  WHERE facturas.id=:id  ");
        $this->db->bind(':id',$id);
        $this->result = $this->db->registro();
        return $this->result;
    }

    // método donde se trae la información de un determinado registro
    public function traerDatosRegistro(int $id)
    {
        $this->db->query(" SELECT precio,meses_garantia FROM facturas WHERE id=:id  ");
        $this->db->bind(':id',$id);
        $this->result = $this->db->registro();
        return $this->result;
    }

    // método donde se edita una determinada factura
    public function editarFacturacion(array $datos)
    {
        try {  
			$this->db->con->beginTransaction();
			$this->editarFactura($datos);
            $this->db->con->commit();
            return true;
        } catch (Exception $e) {
            $this->db->con->rollBack();
            return false;
		}
    }

    // método donde se edita una determinada factura
    private function editarFactura(array $datos)
    {
        $datos['precio'] =  str_replace(".", "", $datos['precio']);
        $this->db->query(" UPDATE   facturas SET  meses_garantia=:meses_garantia,precio=:precio  WHERE id=:id ");
		$this->db->bind(':meses_garantia',$datos['meses_garantia']);
        $this->db->bind(':precio',$datos['precio']);
        $this->db->bind(':id',$datos['id']);
		$this->db->execute();
    }
    




}