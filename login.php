<?php
session_start(); // Start the session  
  
require 'database.php'; // Include the database configuration file  
  
if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    $username = $_POST['username'];  
    $password = $_POST['password'];  
  
    // Prepare a SELECT statement to fetch user from the database based on the input username  
    $statement = $pdo->prepare('SELECT * FROM account WHERE username = :username');  
    $statement->execute(array(':username' => $username));  
    $user = $statement->fetch();  
  
    if ($user && $password) {  
        // Authentication successful  
        $_SESSION['user_id'] = $user['id']; // Store user id in the session  
        header('Location: list.php'); // Redirect to the dashboard page  
        exit();  
    } else {  
        // Authentication failed  
        echo 'Invalid username or password';  
    }  
}  
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.phptutorial.net/app/css/style.css">
    <title>Login</title>
</head>
<body>
<main>
    <form method="post">
        <h1>Login</h1>
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <section>
            <button type="submit" name="submit">Login</button>
            <a href="signup.php">Register</a>
        </section>
    </form>
</main>
</body>
</html>