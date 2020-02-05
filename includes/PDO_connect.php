<?php

date_default_timezone_set('Brazil/East');

$sid = "localhost";
$usuario = "root";
$senha = "";
$banco = "tlog";

$dsn = 'mysql:host=' . $sid . ';dbname=' . $banco;
$opcoes = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');

$conn = new PDO($dsn, $usuario, $senha, $opcoes);

function query($conn, $string, $array)
{
    try {
        $sql = $conn->prepare($string, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sql->execute($array);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo 'ERRO: ' . $e->getMessage();
    }
    return false;
}

function executa($conn, $string, $array)
{
    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = $conn->prepare($string);
        $result = $sql->execute($array);
        if ($result) return true;
    } catch (PDOException $e) {
        echo 'ERRO: ' . $e->getMessage();
    }
    return false;
}

function begin($conn)
{
    $conn->beginTransaction();
}

function commit($conn)
{
    $conn->commit();
}

function rollback($conn)
{
    $conn->rollBack();
}

function lastID($conn)
{
    return $conn->lastInsertId();
}