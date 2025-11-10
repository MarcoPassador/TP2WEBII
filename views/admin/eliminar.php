<?php
require_once './logica/auth.php';
require_once './logica/data.php';

if (!isAdminLoggedIn()) {
    header('Location: index.php?view=login');
    exit;
}

$id = $_GET['id'] ?? null;

if ($id === null) {
    header('Location: index.php?view=admin/dashboard');
    exit;
}

if (deleteItem((int)$id)) {
    header('Location: index.php?view=admin/dashboard&msg=deleted');
    exit;
} else {
    header('Location: index.php?view=admin/dashboard&msg=delete_error');
    exit;
}
