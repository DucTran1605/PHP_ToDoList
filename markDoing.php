<?php
require 'database.php';

$isDoingRequest = $_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_method'] === 'doing');

if ($isDoingRequest) {
    $id = $_POST['id'];

    $query = 'UPDATE `to_do_list`.`list` SET `status` = 1 WHERE (`Id` = :id);';

    $statement = $pdo->prepare($query);

    $params = ['id' => $id];

    $statement->execute($params);

    header('Location: list.php');
    exit;
}
