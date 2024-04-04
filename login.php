<?php
require 'database.php';
session_start(); 
  
if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    $username = $_POST['username'];  
    $password = $_POST['password'];  
  
	$query = "SELECT * FROM account WHERE username = :username and password = :password";

    $statement = $pdo->prepare($query);  
    $params = [
        'username' => $username,
        'password' => $password
    ];

	$statement->execute($params);  
    $user = $statement->fetch();  
  
    if ($user && $password) {  
        $_SESSION['user_id'] = $user['id']; // Store user id in the session  
        header('Location: list.php');   
        exit();  
    } else {  
        echo 'Invalid username or password';  
    }  
}  
?>  

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
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
</body>

</html>