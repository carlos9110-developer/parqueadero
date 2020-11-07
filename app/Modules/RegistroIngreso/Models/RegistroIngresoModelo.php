<?php
class RegistroIngresoModelo
{
    private  $db;
    public   $result;
    public   $fechaActual;
    public   $response;

    public function __construct()
    {
        $this->db = new Base();
        $this->fechaActual =  date('Y-m-d');
        $this->response = array();
    }
}

