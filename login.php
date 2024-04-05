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
	<title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>

<body>
	<h1>Login</h1>
	<form action="login.php" method="POST">
		<label for="title">Username:</label><br>
		<input type="text" id="username" name="username" required><br><br>

		<label for="description">Password:</label><br>
		<input type="password" id="password" name="password" required><br><br>

		<input type="submit" name="submit" value="Login">
	</form>
    <a type = "button" href = "signup.php">Sign Up</a>
</body>

</html>