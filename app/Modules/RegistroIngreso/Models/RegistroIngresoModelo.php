<?php
class RegistroIngresoModelo
{
    private  $db;
    private  $result;
    public   $fechaActual;
    public   $response;

    public function __construct()
    {
        $this->db = new Base();
        $this->fechaActual =  date('Y-m-d');
        $this->response = array();
    }


    // metodo donde se retorna el listado de marcas de la base de datos
    public function listadoMarcas()
    {
        $this->db->query(" SELECT marca FROM marcas  ORDER BY marca ASC ");
        return $this->db->registros();
    }

     // metodo para traer los pisos del parqueadero
     public function listadoPisos(int $idParqueadero)
     {
         $this->db->query(" SELECT * FROM pisos WHERE id_parqueadero=:id_parqueadero ORDER BY piso ASC ");
         $this->db->bind(':id_parqueadero',$idParqueadero);
         return $this->db->registros();
     }

     // metodo donde se retorna la información de un determinado usuario, si este existe
     public function consultarCliente(int $cedula)
     {
        if($this->issetCliente($cedula)){
            return $this->retornarInfoCliente($cedula);
        }else{
            return false;
        }
     }

     /**
     * EL método issetCliente se encarga de verificar que un cliente exista en la base de datos
     * The issetUser method is responsible for verifying that a user exists in the database
     * @param string $user       = contiene el usuario
     * @return boolean
     */
    private function issetCliente(int $cedula)
    {
        $this->db->query("SELECT * FROM usuarios WHERE cedula=:cedula  ");
        $this->db->bind(':cedula',$cedula);
        $this->db->execute();
        $this->result =  $this->db->rowCount();
        if($this->result === 1){
            return true;
        } else {
            return false;
        }
    }

    // metodo donde se retorna un objeto con la información de un determinado cliente
    private function retornarInfoCliente(int $cedula)
    {
        $this->db->query("SELECT * FROM usuarios WHERE cedula=:cedula  ");
        $this->db->bind(':cedula',$cedula);
        return  $this->db->registro();
    }


    // metodo donde se registra un determinado parquedo
    public function registroParqueo(array $datos)
    {
        if($this->issetCliente($datos['cedula'])){
            $idCliente = $this->retornarIdCliente($datos['cedula']);
            try {  
                $this->db->con->beginTransaction();
                $this->cambiarEstadoPuestoSelecionado($datos);
                $this->registroInformacionIngreso($datos,$idCliente);
                $this->db->con->commit();
                return 1;
            }
            catch (Exception $e) {
                $this->db->con->rollBack();
                return 2;
            }
        }else{
            return 3;
        }
    }
    
    // método donde se realiza el registro de un determinado parqueo
    private function retornarIdCliente(int $cedula)
    {
        $this->db->query("SELECT id FROM usuarios WHERE cedula=:cedula  ");
        $this->db->bind(':cedula',$cedula);
        $this->result =  $this->db->registro();
        return $this->result->id;
    }

    // metodo donde se registra la información de un ingreso de vehiculo
    private function registroInformacionIngreso(array $datos,$idCliente)
    {
        if (strlen(session_id()) < 1) 
        {
            session_start();
        }
        $arrayId    =  json_decode($datos["matriz_id"], true );
        $idPuesto   =   $arrayId[$datos["fila"]][$datos["columna"]];
        $this->db->query(" INSERT INTO ingresos(id_puesto,id_usuario,placa,marca,tipo,id_parqueadero) VALUES(:id_puesto,:id_usuario,:placa,:marca,:tipo,:id_parqueadero) ");
        $this->db->bind(':id_puesto',$idPuesto);
        $this->db->bind(':id_usuario',$idCliente);
        $this->db->bind(':placa',$datos['placa']);
        $this->db->bind(':marca',$datos['marca']);
        $this->db->bind(':tipo',$datos['tipo']);
        $this->db->bind(':id_parqueadero',$_SESSION['id_parqueadero'] );
        $this->db->execute();
    }

    // metodo donde se actualiza la el estado del puesto seleccionado
    private function cambiarEstadoPuestoSelecionado(array $datos)
    {
        $arrayId    =  json_decode($datos["matriz_id"], true );
        $idPuesto   =   $arrayId[$datos["fila"]][$datos["columna"]];
        $this->db->query(" UPDATE  puestos SET  estado=:estado WHERE id=:id  ");
        $this->db->bind(':estado',"O");
        $this->db->bind(':id',$idPuesto);
        $this->db->execute();
    }

    // metodod donde se retorna el listado de los ingresos de un determinado parqueadero
    public function ListarInformeIngresos(array $datos)
    {
        if (strlen(session_id()) < 1) 
        {
            session_start();
        }
        $table      = 'ingresos';
        // Table's primary key
        $primaryKey = 'id';
        // indexes
        $columns = array
        (
            array( 'db' => '`ing`.`id`',     'dt' => 'id',     'field' => 'id' ),
            array( 'db' => '`usu`.`cedula`', 'dt' => 'cedula', 'field' => 'cedula' ),
            array( 'db' => '`ing`.`tipo`',  'dt' => 'tipo',  'field' => 'tipo', 'formatter' => function( $tipo, $row )
			{
                if($tipo=="M"){
                    return "Moto";
                }else{
                    return "Carro";
                }
            }),
            array( 'db' => '`ing`.`placa`',  'dt' => 'placa',  'field' => 'placa' ),
            array( 'db' => '`ing`.`marca`',  'dt' => 'marca',  'field' => 'marca' ),
            array( 'db' => '`pis`.`piso`',   'dt' => 'piso',   'field' => 'piso' ),
            array( 'db' => '`ing`.`fecha_hora_entrada`',  'dt' => 'fecha_entrada',  'field' => 'fecha_hora_entrada'),
            array( 'db' => '`ing`.`fecha_hora_salida`',  'dt' => 'fecha_salida',  'field' => 'fecha_hora_salida'),
            array( 'db' => '`ing`.`horas`',  'dt' => 'horas',  'field' => 'horas'),
            array( 'db' => '`ing`.`precio`',  'dt' => 'precio',  'field' => 'precio')
        );
        $sql_details = array
        (
            'user' => DB_USER,
            'pass' => DB_PASS,
            'db'   => DB_NAME,
            'host' => DB_HOST
        );
        $joinQuery = "FROM `ingresos` AS `ing` JOIN `usuarios` AS `usu` ON (`ing`.`id_usuario` = `usu`.`id`) JOIN `puestos` AS `pues` ON (`ing`.`id_puesto` = `pues`.`id`) JOIN `pisos` AS `pis` ON (`pues`.`id_piso` = `pis`.`id`) ";
        $extraWhere= "`ing`.`id_parqueadero`='".$_SESSION['id_parqueadero']."' AND  (date(`ing`.`fecha_hora_entrada`) BETWEEN  '".$_GET['fechaInicio']."' AND  '".$_GET['fechaFinal']."')   ";
        $groupBy = "";
        $having = "";
        return SSP::simple($datos, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having );
    }


    


}

