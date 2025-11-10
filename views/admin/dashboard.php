<?php
require_once './logica/auth.php';
require_once './logica/data.php';

if (isset($_GET['logout'])) {
    logoutAdmin();
}

if (!isAdminLoggedIn()) {
    header('Location: /index.php?view=login');
    exit;
}

$usuario = $_SESSION['admin_usuario'];
$items = getAllItems();

require_once 'base/headerAdmin.php';
?>

<div class="container mt-5">
    <h2>Bienvenido, <?= stringGuard($usuario) ?> </h2>
    <p>Desde aquí podrás administrar el catálogo de relojes, usuarios y más.</p>

    <div class="table-responsive">
        <a href="index.php?view=admin/agregar" class="btn btn-success mb-3">Agregar nuevo reloj</a>

        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= stringGuard($item['id']) ?></td>
                        <td><?= stringGuard($item['nombre']) ?></td>
                        <td><?= stringGuard($item['marca']) ?></td>
                        <td><?= stringGuard($item['modelo']) ?></td>
                        <td>$<?= formatPrice($item['precio']) ?></td>
                        <td>
                            <a href="index.php?view=admin/editar&id=<?= $item['id'] ?>" class="btn btn-sm btn-warning me-1">Editar</a>
                            <a href="index.php?view=admin/eliminar&id=<?= $item['id'] ?>"
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('¿Seguro que deseas eliminar este reloj?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
