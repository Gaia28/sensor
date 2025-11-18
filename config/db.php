<?php
define('DB_FILE', __DIR__ . '/../users.sqlite');


function getDbConnection() {
    try {
        $db = new PDO('sqlite:' . DB_FILE);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        // Em um ambiente real, você logaria o erro.
        die("Erro de conexão com o banco de dados: " . $e->getMessage());
    }
}
?>