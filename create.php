<?php
require 'database.php';

session_start();  
  
$account_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);

    $query = "INSERT INTO list (title, status, account_Id, description, date_create) VALUES (:title, '1', :account_id, :description, CURDATE());";

    $statement = $pdo->prepare($query);

    $params = [
        'title' => $title,
        'description' => $description,
        'account_id' => $account_id
    ];

    $statement->execute($params);

    header('Location: list.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Todo</title>
</head>

<body>
    <h1>Create a Todo</h1>
    <form method="POST">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>

        <input type="submit" name="submit" value="Create Todo">
    </form>
</body>

</html>