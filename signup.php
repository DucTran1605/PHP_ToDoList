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
    <link rel="stylesheet" href="https://www.phptutorial.net/app/css/style.css">
    <title>Login</title>
</head>

<body>
    <main>
        <form method="POST">
            <h1>Register</h1>
            <div>
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <section>
                <button type="submit" name="submit">Register</button>
                <a href="signup.php">Register</a>
            </section>
        </form>
    </main>
</body>

</html>