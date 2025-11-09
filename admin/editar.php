<?php
require_once '../logica/auth.php';
require_once '../logica/data.php';

if (!isAdminLoggedIn()) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: dashboard.php');
    exit;
}

$item = getItemById($id);
if (!$item) {
    die('Reloj no encontrado.');
}

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $marca = $_POST['marca'] ?? '';
    $modelo = $_POST['modelo'] ?? '';
    $precio = $_POST['precio'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $imagen_url = $_POST['imagen_url'] ?? '';

    if (updateItem($id, $nombre, $marca, $modelo, $precio, $descripcion, $imagen_url)) {
        $mensaje = 'Reloj actualizado correctamente.';
        $item = getItemById($id);
    } else {
        $mensaje = 'Error al actualizar el reloj.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Reloj - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <a href="dashboard.php" class="btn btn-secondary mb-3">← Volver</a>
        <h2>Editar Reloj #<?= htmlspecialchars($item['id']) ?></h2>
        <?php if ($mensaje): ?>
            <div class="alert alert-info"><?= htmlspecialchars($mensaje) ?></div>
        <?php endif; ?>

        <form method="POST" class="card p-4 shadow-sm">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($item['nombre']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Marca</label>
                <input type="text" name="marca" class="form-control" value="<?= htmlspecialchars($item['marca']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Modelo</label>
                <input type="text" name="modelo" class="form-control" value="<?= htmlspecialchars($item['modelo']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input type="number" step="0.01" name="precio" class="form-control" value="<?= htmlspecialchars($item['precio']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="3"><?= htmlspecialchars($item['descripcion']) ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">URL de Imagen</label>
                <input type="text" name="imagen_url" class="form-control" value="<?= htmlspecialchars($item['imagen_url']) ?>">
            </div>
            <button type="submit" class="btn btn-dark">Guardar cambios</button>
        </form>
    </div>
</body>
</html>
