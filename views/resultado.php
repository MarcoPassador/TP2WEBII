<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $nombre = trim($_POST['nombre'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $check = isset($_POST['check']);

    $_SESSION['contacto_result'] = [
        'data' => compact('email', 'nombre', 'descripcion', 'check'),
    ];

    header('Location: index.php?view=resultado');
    exit;
}

$result = $_SESSION['contacto_result'] ?? null;
unset($_SESSION['contacto_result']);
?>

<h2 class="mb-3">Datos recibidos</h2>

<?php if ($result === null): ?>
  <div class="alert alert-warning">No se recibieron datos.</div>
  <a href="index.php?view=contacto" class="btn btn-secondary">Volver</a>

<?php else:
  $d = $result['data']; ?>
  <table class="table table-bordered">
    <tbody>
      <tr>
        <th>Email</th>
        <td><?= stringGuard($d['email']) ?></td>
      </tr>
      <tr>
        <th>Nombre completo</th>
        <td><?= stringGuard($d['nombre']) ?></td>
      </tr>
      <tr>
        <th>Descripción</th>
        <td><?= nl2br(stringGuard($d['descripcion'])) ?></td>
      </tr>
      <tr>
        <th>Términos y Condiciones</th>
        <td><?= $d['check'] ? 'Sí' : 'No' ?></td>
      </tr>
    </tbody>
  </table>
  <a href="index.php?view=home" class="btn btn-primary">Volver al inicio</a>
<?php endif; ?>
