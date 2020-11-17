<?php
class RegistroSalidaModelo
{
    private  $db;
    private  $result;
    public   $fechaHoraActual;
    public   $response;

    public function __construct()
    {
        $this->db = new Base();
        $this->fechaHoraActual =  date('Y-m-d H:i:s');
        $this->response = array();
    }

    // metodo donde se retorna un json con los datos necesarios para cargar el dataTable de la vista
    public function listar()
    {
        $table      = 'ingresos';
        // Table's primary key
        $primaryKey = 'id';
        // indexes
        $columns = array
        (
            array( 'db' => '`ing`.`id`',     'dt' => 'id',     'field' => 'id' ),
            array( 'db' => '`usu`.`cedula`', 'dt' => 'cedula', 'field' => 'cedula' ),
            array( 'db' => '`ing`.`placa`',  'dt' => 'placa',  'field' => 'placa' ),
            array( 'db' => '`ing`.`tipo`',   'dt' => 'tipo',   'field' => 'tipo' ),
            array( 'db' => '`ing`.`marca`',  'dt' => 'marca',  'field' => 'marca' ),
            array( 'db' => '`pis`.`piso`',   'dt' => 'piso',   'field' => 'piso' ),
            array( 'db' => '`ing`.`fecha_hora_entrada`',  'dt' => 'fecha',  'field' => 'fecha_hora_entrada', 'formatter' => function( $d, $row )
			{
                return date("Y-m-d", strtotime($d));
            }),
            array( 'db' => '`ing`.`fecha_hora_entrada`',  'dt' => 'hora',  'field' => 'fecha_hora_entrada', 'formatter' => function( $d, $row )
			{
                return  date("H:i:s", strtotime($d));
            })
        );
        $sql_details = array
        (
            'user' => DB_USER,
            'pass' => DB_PASS,
            'db'   => DB_NAME,
            'host' => DB_HOST
        );
        $joinQuery = "FROM `ingresos` AS `ing` JOIN `usuarios` AS `usu` ON (`ing`.`id_usuario` = `usu`.`id`) JOIN `puestos` AS `pues` ON (`ing`.`id_puesto` = `pues`.`id`) JOIN `pisos` AS `pis` ON (`pues`.`id_piso` = `pis`.`id`) ";
        $extraWhere= "`ing`.`id_parqueadero`='".$_SESSION['id_parqueadero']."' AND  (date(`ing`.`fecha_hora_entrada`) BETWEEN  '".$_GET['fechaInicio']."' AND  '".$_GET['fechaFinal']."') AND `ing`.`salida`='0'  ";
        $groupBy = "";
        $having = "";
        return SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having );
    }

    
    // metodo se relizan los llamados necesarios para calcular cuanto debe de pagar un determinado vehículo
    public function TraerInfoParaSalida(int $id, string $tipo)
    {
        return $this->RetornarInfoSalida($this->DiferenciaMinutosEntradaSalida($this->RetornarFechaIngresoRegistro($id)),$this->ConsultarValorHoraParqueadero($tipo));
    }

    // metodo donde se consulta tarifa por horas del parqueadero donde esta logueado un determinado usuario
    private function ConsultarValorHoraParqueadero(string $tipo)
    {
        if (strlen(session_id()) < 1) 
        {
            session_start();
        }
        $this->db->query(" SELECT  ".$this->RetornarCampoConsultaSegunVehiculo($tipo)." AS precio_hora  FROM configuracion_parqueaderos  WHERE id_parqueadero=:id_parqueadero AND tarifa=:tarifa");
        $this->db->bind(':id_parqueadero',$_SESSION['id_parqueadero']);
        $this->db->bind(':tarifa','Hora');
        $this->result =  $this->db->registro();
        return $this->result->precio_hora;
    }


    // metodo donde se retorna el campo de la consulta, según sea el tipo de vehiculo
    private function RetornarCampoConsultaSegunVehiculo(string $tipo)
    {
        $campoConsulta = "";
        if($tipo=="M"){
            $campoConsulta = "precio_moto";
        }else{
            $campoConsulta = "precio_carro";
        }
        return $campoConsulta;
    }


    // metodo donde se retorna la fecha de ingreso de un determinado registro
    private function RetornarFechaIngresoRegistro(int $id)
    {
        $this->db->query(" SELECT fecha_hora_entrada FROM ingresos  WHERE id=:id");
        $this->db->bind(':id',$id);
        $this->result =  $this->db->registro();
        return $this->result->fecha_hora_entrada;
    }

    // metodo donde se calcula la diferencia de minutos entre la fecha de ingreso y la fecha de salida
    private function DiferenciaMinutosEntradaSalida(string $fechaEntrada)
    {
        $minutos = (strtotime($fechaEntrada)-strtotime($this->fechaHoraActual))/60;
        $minutos = abs($minutos); 
        $minutos = floor($minutos);
        return $minutos;
    }

    // metodo que retorna la información para confirmar la salida de un determinado vehículo
    private function RetornarInfoSalida(int $minutos, int $precioHora)
    {
        $this->response['horas'] = $this->RetornarNumHorasIngreso($minutos);
        $this->response['valor'] = $this->RetornarValorIngreso($this->response['horas'],$precioHora);
        return $this->response;
    }

    // metodo donde se retorna el precio de un determinado parqueo
    private function RetornarValorIngreso(int $horas,int $precioHora)
    {
        return $horas * $precioHora;
    }

    // metodo donde se retorna el número de horas que estuvo un determinado vehículo en el parqueadero
    private function RetornarNumHorasIngreso(int $minutos)
    {
        $cont = 0;
        while($minutos > 0)
        {
            $minutos = $minutos - 60;
            $cont++;
        }
        return $cont;
    }



}

