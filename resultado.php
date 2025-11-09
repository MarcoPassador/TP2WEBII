<?php
$pageTitle = 'Datos enviados';
include './base/header.php';
?>

<div class="container mt-5">
    <h2>Datos recibidos</h2>
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Email</th>
                    <td><?= htmlspecialchars($_POST['email'] ?? '') ?></td>
                </tr>
                <tr>
                    <th>Nombre completo</th>
                    <td><?= htmlspecialchars($_POST['nombre'] ?? '') ?></td>
                </tr>
                <tr>
                    <th>Descripción</th>
                    <td><?= htmlspecialchars($_POST['descripcion'] ?? '') ?></td>
                </tr>
                <tr>
                    <th>Terminos y Condiciones</th>
                    <td><?= isset($_POST['check']) ? 'Sí' : 'No' ?></td>
                </tr>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-warning">No se recibieron datos.</div>
    <?php endif; ?>
    <a href="pagina3.php" class="btn btn-secondary">Volver</a>
</div>

<?php include './base/footer.php'; ?>
