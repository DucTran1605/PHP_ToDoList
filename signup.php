<?php
require 'database.php';

// Function to check if a username already exists in the database  
function isUsernameTaken($username)
{
    global $pdo; // Assuming $pdo is your database connection object  

    $query = 'SELECT COUNT(*) as count FROM account WHERE username = :username';
    $statement = $pdo->prepare($query);
    $statement->execute(['username' => $username]);

    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result['count'] > 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Check if the username already exists  
    if (isUsernameTaken($username)) {
        // Redirect or show an error message indicating that the username is already taken  
        echo "Username already exists. Please choose a different username.";
    } else {
        // Proceed with inserting the user into the database  
        $query = "INSERT INTO `account` (`username`, `password`) VALUES (:username, :password);";

        $statement = $pdo->prepare($query);

        $params = [
            'username' => $username,
            'password' => $password
        ];

        $statement->execute($params);

        header('Location: login.php');
        exit;
    }
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

    <a type="button" href="login.php">Back to login</a>
</body>

</html>