
<?php

class UsuarioController extends Controller
{
    private $usuario;

    public function __construct()
    {
        require_once BASE_PATH . '/app/models/Usuario.php';
        $this->usuario = new Usuario();
    }

    public function index()
    {
        require_once BASE_PATH . '/app/models/Usuario.php';
        $usuarioModel = new Usuario();

        $limit = 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $usuarios = $usuarioModel->getUsuarios($offset, $limit);
        $totalUsuarios = $usuarioModel->getTotalUsuarios();
        $totalPages = ceil($totalUsuarios / $limit);

        $this->view('usuarios/index', [
            'usuarios' => $usuarios,
            'page' => $page,
            'totalPages' => $totalPages
        ]);
    }

    public function nuevo()
    {
        $this->view('usuarios/nuevo');
    }

    public function editar($id)
    {
        $usuario = $this->usuario->getUsuario($id);
        $this->view('usuarios/editar', ['usuario' => $usuario]);
    }

    public function ver($id)
    {
        $usuario = $this->usuario->getUsuario($id);
        $this->view('usuarios/ver', ['usuario' => $usuario]);
    }

    public function guardar()
    {

        $datos = [
            'nombre' => $_POST['nombre'],
            'email' => $_POST['email'],
            'fecha_nacimiento' => $_POST['fecha_nacimiento']
        ];

        $usuario = $this->usuario->crear($datos);

        $this->redirect('/usuarios');
    }

    public function eliminar($id)
    {
        $usuario = $this->usuario->getUsuario($id);
        $usuario->delete();

        $this->redirect('/usuarios');
    }
}
