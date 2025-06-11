<?php
ob_start();
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1>Bienvenido a la aplicación de ventas</h1>
            <p>Esta es una aplicación de ejemplo para el desarrollo de una aplicación de ventas en PHP.</p>
            <p>Para acceder a la aplicación, por favor ingrese con el siguiente usuario:</p>
            <ul>
                <li>Usuario: admin</li>
                <li>Contraseña: 123456</li>
            </ul>
            <p>Si no tiene acceso a la aplicación, por favor contacte con el administrador.</p>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once BASE_PATH . '/app/views/layout/app.layout.php';
?>