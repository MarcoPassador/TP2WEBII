<?php
$host = 'localhost';
$db   = 'chronostime';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

function getPDO() {
    static $pdo = null;
    global $dsn, $user, $pass;

    if ($pdo === null) {
        try {
            $pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            die('Error de conexión: ' . $e->getMessage());
        }
    }
    return $pdo;
}

function getAllItems() {
    $pdo = getPDO();
    $stmt = $pdo->query('SELECT * FROM reloj ORDER BY id DESC');
    return $stmt->fetchAll();
}

function getItemById($id) {
    $pdo = getPDO();
    $stmt = $pdo->prepare('SELECT * FROM reloj WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function updateItem($id, $nombre, $marca, $modelo, $precio, $descripcion = null, $imagen_url = null) {
    $pdo = getPDO();
    $stmt = $pdo->prepare('
        UPDATE reloj
        SET nombre = ?, marca = ?, modelo = ?, precio = ?, descripcion = ?, imagen_url = ?
        WHERE id = ?
    ');
    return $stmt->execute([$nombre, $marca, $modelo, $precio, $descripcion, $imagen_url, $id]);
}

function deleteItem($id) {
    $pdo = getPDO();
    $stmt = $pdo->prepare('DELETE FROM reloj WHERE id = ?');
    return $stmt->execute([$id]);
}

function createItem($nombre, $marca, $modelo, $precio, $descripcion = null, $imagen_url = null) {
    $pdo = getPDO();
    $stmt = $pdo->prepare('
        INSERT INTO reloj (nombre, marca, modelo, precio, descripcion, imagen_url)
        VALUES (?, ?, ?, ?, ?, ?)
    ');
    return $stmt->execute([$nombre, $marca, $modelo, $precio, $descripcion, $imagen_url]);
}