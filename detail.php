<?php
require 'database.php';

$id = $_GET['id'] ?? null;


if (!$id) {
    header('Location: list.php');
    exit;
}

$query = "Select * from list where id = :id";

$statement = $pdo->prepare($query);

$params = ['id' => $id];

$statement->execute($params);

$result = $statement->fetch();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo Details</title>
</head>

<body>
    <h1>Todo Details</h1>

    <div>
        <label for="title">Title:</label>
        <p id="title"><?= $result['title'] ?></p>
    </div>

    <div>
        <label for="description">Description:</label>
        <p id="description"><?= $result['description'] ?></p>
    </div>

    <div>
        <label for="due_date">Due Date:</label>
        <p id="due_date"><?= $result['date_create'] ?></p>
    </div>

    <!-- Add more details as needed -->
    <a href="list.php">Go Back</a>
    <a href="/edit_todo">Edit</a>
    <a href="/delete_todo">Delete</a>
</body>

</html>