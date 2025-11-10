<?php
require_once './logica/auth.php';
require_once './logica/data.php';

if (!isAdminLoggedIn()) {
    header('Location: index.php?view=login');
    exit;
}

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $marca = trim($_POST['marca'] ?? '');
    $modelo = trim($_POST['modelo'] ?? '');
    $precio = trim($_POST['precio'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $imagen_url = trim($_POST['imagen_url'] ?? '');

    if (createItem($nombre, $marca, $modelo, $precio, $descripcion, $imagen_url)) {
        $mensaje = 'Reloj agregado correctamente.';
        $_POST = [];
    } else {
        $mensaje = 'Ocurrió un error al agregar el reloj.';
    }
}

$usuario = $_SESSION['admin_usuario'];

require_once 'base/headerAdmin.php';
?>

<div class="container mt-4">
    <a href="index.php?view=admin/dashboard" class="btn btn-secondary mb-3">← Volver</a>
    <h2>Agregar nuevo reloj</h2>

    <?php if ($mensaje): ?>
        <div class="alert alert-info"><?= stringGuard($mensaje) ?></div>
    <?php endif; ?>

    <form method="POST" class="card p-4 shadow-sm">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" 
                       value="<?= stringGuard($_POST['nombre'] ?? '') ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Marca</label>
                <input type="text" name="marca" class="form-control" 
                       value="<?= stringGuard($_POST['marca'] ?? '') ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Modelo</label>
                <input type="text" name="modelo" class="form-control" 
                       value="<?= stringGuard($_POST['modelo'] ?? '') ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Precio</label>
                <input type="number" step="0.01" name="precio" class="form-control" 
                       value="<?= stringGuard($_POST['precio'] ?? '') ?>" required>
            </div>
            <div class="col-12">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="3"><?= stringGuard($_POST['descripcion'] ?? '') ?></textarea>
            </div>
            <div class="col-12">
                <label class="form-label">URL de Imagen</label>
                <input type="text" name="imagen_url" class="form-control" 
                       value="<?= stringGuard($_POST['imagen_url'] ?? '') ?>">
                <small class="text-muted">Podés dejarlo vacío para usar el placeholder por defecto.</small>
            </div>
        </div>

        <button type="submit" class="btn btn-dark mt-3">Agregar reloj</button>
    </form>
</div>
