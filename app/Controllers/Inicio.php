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

}   