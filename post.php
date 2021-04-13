<?php
require_once 'inc/functions.php';
require_once 'inc/headers.php';

$input = json_decode(file_get_contents('php://input'));
$astunnus = filter_var($input->astunnus, FILTER_SANITIZE_STRING);
$asnimi = filter_var($input->asnimi, FILTER_SANITIZE_STRING);
$yhteyshlo = filter_var($input->yhteyshlo, FILTER_SANITIZE_STRING);
$postinro = filter_var($input->postinro, FILTER_SANITIZE_NUMBER_INT);
$postitmp = filter_var($input->postitmp, FILTER_SANITIZE_STRING);
$asvuosi = filter_var($input->asvuosi, FILTER_SANITIZE_NUMBER_INT);

try {
    $db = openDb();
    $query = $db->prepare('insert into asiakas(astunnus, asnimi, yhteyshlo, postinro, postitmp, asvuosi) values (:astunnus, :asnimi, :yhteyshlo, :postinro, :postitmp, :asvuosi)');
    $query->bindValue(':astunnus', $astunnus, PDO::PARAM_STR);
    $query->bindValue(':asnimi', $asnimi, PDO::PARAM_STR);
    $query->bindValue(':yhteyshlo', $yhteyshlo, PDO::PARAM_STR);
    $query->bindValue(':postinro', $postinro, PDO::PARAM_INT);
    $query->bindValue(':postitmp', $postitmp, PDO::PARAM_STR);
    $query->bindValue(':asvuosi', $asvuosi, PDO::PARAM_INT);
    $query->execute();
    header('HTTP/1.1 200 OK');
    $data = array('astunnus' => $astunnus, 'asnimi' => $asnimi, 'yhteyshlo' => $yhteyshlo, 'postinro' => $postinro, 'postitmp' => $postitmp, 'asvuosi' => $asvuosi);
    echo json_encode($data);
} catch (PDOException $pdoex) {
    returnError($pdoex);
}
