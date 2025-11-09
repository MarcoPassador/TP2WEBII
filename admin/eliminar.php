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

if (deleteItem($id)) {
    header('Location: dashboard.php?msg=deleted');
    exit;
} else {
    echo 'Error al eliminar el reloj.';
}
