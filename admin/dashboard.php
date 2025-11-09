<?php
require_once '../logica/auth.php';

if (!isAdminLoggedIn()) {
    header('Location: ../login.php');
    exit;
}

if (isset($_GET['logout'])) {
    logoutAdmin();
}

if (!isAdminLoggedIn()) {
    header('Location: ../login.php');
    exit;
}

$usuario = $_SESSION['admin_usuario'];
require_once '../logica/data.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Chronos Time</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark px-3">
        <span class="navbar-brand mb-0 h1">Chronos Time - Admin</span>
        <div class="d-flex">
            <span class="text-white me-3">👤 <?= htmlspecialchars($usuario) ?></span>
            <a href="?logout=1" class="btn btn-outline-light btn-sm">Cerrar sesión</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Bienvenido, <?= htmlspecialchars($usuario) ?> 👋</h2>
        <p>Desde aquí podrás administrar el catálogo de relojes, usuarios y más.</p>

    <?php
    $items = getAllItems();
    ?>
        <div class="table-responsive">
            <a href="agregar.php" class="btn btn-success mb-3">Agregar nuevo reloj</a>

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
                            <td><?= htmlspecialchars($item['id']) ?></td>
                            <td><?= htmlspecialchars($item['nombre']) ?></td>
                            <td><?= htmlspecialchars($item['marca']) ?></td>
                            <td><?= htmlspecialchars($item['modelo']) ?></td>
                            <td>$<?= number_format($item['precio'], 2) ?></td>
                            <td>
                                <a href="editar.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-warning me-1">Editar</a>
                                <a href="eliminar.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este reloj?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
