<?php
function openDb() {
    $db = new PDO('mysql:host=localhost;port=3306;dbname=demox3;charset=utf8', 'harjoitustyoUser', 'tIPOgJc85ThmqgJb');
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    return $db;
}

function returnError(PDOException $pdoex) {
    header('HTTP/1.1 500 Internal Server Error');
    $error = array('error' => $pdoex->getMessage());
    echo json_encode($error);
    exit;
}