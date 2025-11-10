<?php
session_start();

require_once './logica/data.php';
require_once './logica/utils.php';
require_once './logica/paginacion.php';

$view = $_GET['view'] ?? 'home';
$viewPath = "./views/{$view}.php";

$noLayoutViews = ['login', 'admin', 'admin/dashboard', 'admin/editar', 'admin/agregar']; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Chronos Time</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php
    if (!in_array($view, $noLayoutViews)) {
        include './base/header.php';
    }
    ?>

    <main class="container my-4">
        <?php
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            http_response_code(404);
            require './views/404.php';
        }
        ?>
    </main>

    <?php
    if (!in_array($view, $noLayoutViews)) {
        include './base/footer.php';
    }
    ?>

</body>
</html>
