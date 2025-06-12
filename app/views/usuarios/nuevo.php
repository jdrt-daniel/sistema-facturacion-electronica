<?php
ob_start();
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1>Nuevo Usuario</h1>
            <form action="/usuarios/guardar" method="post">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$title = 'Nuevo Usuario';
require_once BASE_PATH . '/app/views/layout/app.layout.php';
?>