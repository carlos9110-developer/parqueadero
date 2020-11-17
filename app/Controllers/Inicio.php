<?php

class Inicio extends Controller
{

    public function __construct()
    {
        $this->validadorSesion();
    }

    public function index()
    {
        $datos = [
            'titulo' => 'Inicio',
        ];

        $this->vista('Inicio', $datos);
    }


    public function InicioSistema()
    {
        $datos = [
            'tituloModulo' => 'Menú',
            'titulo_vista' => 'Menú del Sistema'
        ];
        $this->vista('InicioSistema', $datos);
    }

}   