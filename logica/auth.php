<?php
require_once __DIR__ . '/data.php';
function loginAdmin($usuario, $contrasena) {
    $pdo = getPDO();
    $stmt = $pdo->prepare('SELECT * FROM administrador WHERE usuario = ? AND contrasena = ?');
    $stmt->execute([$usuario, $contrasena]);
    $admin = $stmt->fetch();

    if ($admin) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_usuario'] = $admin['usuario'];
        return true;
    }
    return false;
}

function logoutAdmin() {
    session_unset();
    session_destroy();
    header('Location: index.php?view=login');
    exit;
}


function isAdminLoggedIn() {
    return isset($_SESSION['admin_id']);
}
