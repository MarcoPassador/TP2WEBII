<?php
require_once './logica/auth.php';
require_once './logica/data.php';

if (!isAdminLoggedIn()) {
    header('Location: index.php?view=login');
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php?view=admin/dashboard');
    exit;
}

$item = getItemById($id);
if (!$item) {
    header('Location: index.php?view=admin/dashboard');
    exit;
}

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre      = trim($_POST['nombre'] ?? '');
    $marca       = trim($_POST['marca'] ?? '');
    $modelo      = trim($_POST['modelo'] ?? '');
    $precio      = trim($_POST['precio'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $imagen_url  = trim($_POST['imagen_url'] ?? '');

    if (updateItem($id, $nombre, $marca, $modelo, $precio, $descripcion, $imagen_url)) {
        $mensaje = 'Reloj actualizado correctamente.';
        $item = getItemById($id);
    } else {
        $mensaje = 'Error al actualizar el reloj.';
    }
}

$usuario = $_SESSION['admin_usuario'];

require_once 'base/headerAdmin.php';
?>

<div class="container mt-4">
    <a href="index.php?view=admin/dashboard" class="btn btn-secondary mb-3">← Volver</a>
    <h2>Editar Reloj #<?= stringGuard($item['id']) ?></h2>

    <?php if ($mensaje): ?>
        <div class="alert alert-info"><?= stringGuard($mensaje) ?></div>
    <?php endif; ?>

    <form method="POST" class="card p-4 shadow-sm">
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="<?= stringGuard($item['nombre']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Marca</label>
            <input type="text" name="marca" class="form-control" value<?= '="'.stringGuard($item['marca']).'"' ?> required>
        </div>
        <div class="mb-3">
            <label class="form-label">Modelo</label>
            <input type="text" name="modelo" class="form-control" value="<?= stringGuard($item['modelo']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" step="0.01" name="precio" class="form-control" value="<?= stringGuard($item['precio']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3"><?= stringGuard($item['descripcion'] ?? '') ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">URL de Imagen</label>
            <input type="text" name="imagen_url" class="form-control" value="<?= stringGuard($item['imagen_url'] ?? '') ?>">
        </div>
        <button type="submit" class="btn btn-dark">Guardar cambios</button>
    </form>
</div>
