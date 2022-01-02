<?php

session_start();
global $pdo;

/*
 * Realizando a conexao com o banco de dados
 */
try {
    $pdo = new PDO("mysql:dbname=classificados;host=localhost", "root", "");

} catch (PDOException $e) {
    echo "Falhou: ".$e->getMessage();
    exit;
}

?>