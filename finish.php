<?php
require 'database.php';

$isDeleteRequest = $_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_method'] === 'finish');

if ($isDeleteRequest) {
    $id = $_POST['id'];

    $query = 'UPDATE `to_do_list`.`list` SET `status` = 0 WHERE (`Id` = :id);';

    $statement = $pdo->prepare($query);

    $params = ['id' => $id];

    $statement->execute($params);

    header('Location: list.php');
    exit;
}
