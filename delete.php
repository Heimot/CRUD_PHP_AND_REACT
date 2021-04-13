<?php
require_once 'inc/functions.php';
require_once 'inc/headers.php';


$input = json_decode(file_get_contents('php://input'));
$astunnus = filter_var($input->astunnus, FILTER_SANITIZE_STRING);

try {
    $db = openDb();
    $query = $db->prepare('delete from asiakas where astunnus = :astunnus');
    $query->bindValue(':astunnus', $astunnus, PDO::PARAM_STR);
    $query->execute();
    header('HTTP/1.1 200 OK');
    $data = array('astunnus' => $astunnus);
    echo json_encode($data);
} catch (PDOException $pdoex) {
    returnError($pdoex);
}
