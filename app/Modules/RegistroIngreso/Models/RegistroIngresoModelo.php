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
        $arrayId    =  json_decode($datos["matriz_id"], true );
        $idPuesto   =   $arrayId[$datos["fila"]][$datos["columna"]];
        $this->db->query(" INSERT INTO ingresos(id_puesto,id_usuario,placa,marca,tipo) VALUES(:id_puesto,:id_usuario,:placa,:marca,:tipo) ");
        $this->db->bind(':id_puesto',$idPuesto);
        $this->db->bind(':id_usuario',$idCliente);
        $this->db->bind(':placa',$datos['placa']);
        $this->db->bind(':marca',$datos['marca']);
        $this->db->bind(':tipo',$datos['tipo']);
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

    


}

