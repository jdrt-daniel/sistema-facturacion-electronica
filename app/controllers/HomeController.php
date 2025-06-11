<?php

class HomeController extends Controller {
    private $usuario;

    public function __construct() {
        require_once BASE_PATH . '/app/models/Usuario.php';
        $this->usuario = new Usuario();
    }

    public function index() {
        $usuarios = $this->usuario->getUsuarios();
        $this->view('home/index', ['usuarios' => $usuarios]);
    }
} 