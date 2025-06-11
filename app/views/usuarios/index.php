<?php
ob_start();
$usuario = new Usuario();
$usuarios = $usuario->getUsuarios(
    isset($_GET['page']) ? (int)$_GET['page'] : 1,
    10
);
?>

<div class="container">
    <div>
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Lista de usuarios</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>Nombre</th>
                            <th>Nick</th>
                            <th>Caja</th>
                            <th width="20%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($usuarios)): ?>
                            <?php foreach ($usuarios as $index => $usuario): ?>
                                <tr class="align-middle">
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['nick']); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['caja']); ?></td>
                                    <td>
                                        <a href="/usuarios/editar/<?php echo $usuario['id_usuario']; ?>" class="btn btn-link-primary btn-sm">Editar</a>
                                        <a href="/usuarios/eliminar/<?php echo $usuario['id_usuario']; ?>" class="btn btn-link-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este usuario?')">Eliminar</a>
                                        <a href="/usuarios/ver/<?php echo $usuario['id_usuario']; ?>" class="btn btn-link-success btn-sm">Ver</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">No hay usuarios registrados</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-end">
                    <?php if ($page > 1): ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>">&laquo;</a></li>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <?php if ($page < $totalPages): ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>">&raquo;</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once BASE_PATH . '/app/views/layout/app.layout.php';
?>