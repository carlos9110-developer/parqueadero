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

}

