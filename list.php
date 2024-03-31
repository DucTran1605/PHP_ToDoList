<?php
require 'database.php';

//Prepare a Select statement
$statement = $pdo->prepare('Select * from list');

//Execute the statment 
$statement->execute();

//Fetch result 
$results = $statement->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Todos</title>
</head>

<body>
    <h1>List of Todos</h1>

    <ul>
        <?php foreach ($results as $result) : ?>
            <li>
                <strong>Title:</strong><a href="detail.php?id=<?= $result['Id'] ?>"><?= $result['title'] ?></a><br>
                <strong>Description:</strong><?= $result['description'] ?><br>
                <strong>Due Date:</strong><?= $result['date_create'] ?>
            </li>
        <?php endforeach ?>
    </ul>
    <a href="create.php">Create Todo</a>
</body>

</html>