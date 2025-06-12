<?php
ob_start();
$usuario = new Usuario();
?>

<div class="container">
    <div>
        <div class="card mb-4">
            <div class="card-header ">
                <div class="d-flex justify-content-between align-items-center">

                    <h3 class="card-title">Lista de usuarios</h3>

                    <div>
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Nuevo usuario
                        </button>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table">
                    <thead class="table-dark">
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
                                        <a href="/usuarios/editar/<?php echo $usuario['id_usuario']; ?>" class="btn btn-light btn-sm">Editar</a>
                                        <a href="/usuarios/eliminar/<?php echo $usuario['id_usuario']; ?>" class="btn btn-light btn-sm" onclick="return confirm('¿Está seguro de eliminar este usuario?')">Eliminar</a>
                                        <a href="/usuarios/ver/<?php echo $usuario['id_usuario']; ?>" class="btn btn-light btn-sm">Ver</a>
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
                <div class="float-start d-flex align-items-center m-0">
                    <p class="text-dark mb-0 pt-2">
                        Página <?php echo $pagination['page']; ?> de <?php echo $pagination['totalPages']; ?>
                    </p>
                </div>
                <div class="float-end d-flex align-items-center m-0">
                    <p class="text-dark mb-0 pt-1 me-2">
                        <?php echo $totalUsuarios; ?> registros
                    </p>
                    <div class="mx-2">
                        <select class="form-select" aria-label="Select"
                            onchange="window.location.href = '?page=1&limit=' + this.value;">
                            <option value="10" <?= $pagination['rowsPerPage'] == 10 ? 'selected' : '' ?>>10</option>
                            <option value="20" <?= $pagination['rowsPerPage'] == 20 ? 'selected' : '' ?>>20</option>
                            <option value="30" <?= $pagination['rowsPerPage'] == 30 ? 'selected' : '' ?>>30</option>
                            <option value="40" <?= $pagination['rowsPerPage'] == 40 ? 'selected' : '' ?>>40</option>
                            <option value="50" <?= $pagination['rowsPerPage'] == 50 ? 'selected' : '' ?>>50</option>
                        </select>
                    </div>
                    <ul class="pagination m-0">
                        <?php if ($pagination['page'] > 1): ?>
                            <li class="page-item "><a class="page-link" href="?page=<?php echo $pagination['page'] - 1; ?>">Anterior</a></li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $pagination['totalPages']; $i++): ?>
                            <li class="page-item <?php echo ($i == $pagination['page']) ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                        <?php if ($pagination['page'] < $pagination['totalPages']): ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $pagination['page'] + 1; ?>">Siguiente</a></li>
                        <?php endif; ?>
                    </ul>
                </div>

            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$title = 'Usuarios';

// Definir los scripts específicos de este módulo
$scripts = [
    '/app/js/usuarios.js',
];

require_once BASE_PATH . '/app/views/layout/app.layout.php';
?>