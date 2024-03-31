<?php
require 'database.php';

$isDeleteRequest = $_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_method'] === 'delete');

if ($isDeleteRequest) {
    $id = $_POST['id'];

    $query = 'DELETE FROM `to_do_list`.`list` WHERE (`Id` = :id);';

    $statement = $pdo->prepare($query);

    $params = ['id' => $id];

    $statement->execute($params);

    header('Location: list.php');
    exit;
}
