
<?php

class LoginController extends Controller
{

    private $usuario;

    public function __construct()
    {
        require_once BASE_PATH . '/app/models/Usuario.php';
        $this->usuario = new Usuario();
    }

    public function index()
    {
        $this->view('login/index');
    }

    public function validar()
    {
        if (empty($_POST['nick']) || empty($_POST['clave'])) {
            $msg = "Existen campos vacíos";
            echo json_encode(['status' => 'error', 'msg' => $msg]);
            exit;
        } else {
            $nick = $_POST['nick'];
            $clave = $_POST['clave'];

            $usuario = $this->usuario->getUsuarioByNick($nick);

            if (!$usuario) {
                $msg = "Usuario no encontrado";
                echo json_encode(['status' => 'error', 'msg' => $msg]);
                exit;
            }

            if ($this->usuario->validatePassword($clave, $usuario['clave'])) {
                $_SESSION['usuario'] = $usuario;
                echo json_encode(['status' => 'ok', 'msg' => '']);
                exit;
            } else {
                $msg = "Contraseña incorrecta";
                echo json_encode(['status' => 'error', 'msg' => $msg]);
                exit;
            }
        }
    }

    public function logout()
    {
        session_destroy();
        echo json_encode(['status' => 'ok', 'msg' => '']);
        exit;
    }
}
