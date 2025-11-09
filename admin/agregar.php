<?php
require_once '../logica/auth.php';
require_once '../logica/data.php';

if (!isAdminLoggedIn()) {
    header('Location: login.php');
    exit;
}

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $marca = $_POST['marca'] ?? '';
    $modelo = $_POST['modelo'] ?? '';
    $precio = $_POST['precio'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $imagen_url = $_POST['imagen_url'] ?? '';

    if (createItem($nombre, $marca, $modelo, $precio, $descripcion, $imagen_url)) {
        $mensaje = 'Reloj agregado correctamente.';
        $_POST = [];
    } else {
        $mensaje = 'Ocurrió un error al agregar el reloj.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Reloj - Chronos Time</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark px-3">
        <a href="dashboard.php" class="navbar-brand">Chronos Time - Admin</a>
        <div class="d-flex">
            <a href="/logica/logout.php" class="btn btn-outline-light btn-sm">Cerrar sesión</a>
        </div>
    </nav>

    <div class="container mt-4">
        <a href="dashboard.php" class="btn btn-secondary mb-3">← Volver</a>
        <h2>Agregar nuevo reloj</h2>

        <?php if ($mensaje): ?>
            <div class="alert alert-info"><?= htmlspecialchars($mensaje) ?></div>
        <?php endif; ?>

        <form method="POST" class="card p-4 shadow-sm">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Marca</label>
                    <input type="text" name="marca" class="form-control" value="<?= htmlspecialchars($_POST['marca'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Modelo</label>
                    <input type="text" name="modelo" class="form-control" value="<?= htmlspecialchars($_POST['modelo'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Precio</label>
                    <input type="number" step="0.01" name="precio" class="form-control" value="<?= htmlspecialchars($_POST['precio'] ?? '') ?>" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3"><?= htmlspecialchars($_POST['descripcion'] ?? '') ?></textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">URL de Imagen</label>
                    <input type="text" name="imagen_url" class="form-control" value="<?= htmlspecialchars($_POST['imagen_url'] ?? '') ?>">
                    <small class="text-muted">Podés dejarlo vacío para usar el placeholder por defecto.</small>
                </div>
            </div>

            <button type="submit" class="btn btn-dark mt-3">Agregar reloj</button>
        </form>
    </div>
</body>
</html>
