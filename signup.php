<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $query = "INSERT INTO account (username, password) VALUES (:username, :password);";

    $statement = $pdo->prepare($query);

    $params = [
        'username' => $username,
        'password' => $password
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
    <title>Sign Up</title>
</head>

<body>
    <h1>Sign Up</h1>
    <form method="POST">
        <label for="title">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="description">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
		
        <input type="submit" name="submit" value="Sign Up">
    </form>
</body>

</html>