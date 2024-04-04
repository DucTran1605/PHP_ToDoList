<?php  
$host = 'localhost';  
$port = 3306; // Replace with the appropriate port number  
$dbName = 'todolist';  
$username = 'root';  
$password = '12345678';  
$charset = 'utf8'; // Replace with the appropriate charset  

$dsn = "mysql:host=$host;port=$port;dbname=$dbName;charset=$charset"; // Specify the charset in the DSN  
  
try {  
    // Create PDO instance with the charset specified  
    $pdo = new PDO($dsn, $username, $password, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset"]);  
  
    // Set PDO to throw exceptions on error  
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
  
    // Set fetch mode to associative array  
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);  
  
    echo 'Database connected';  
} catch (PDOException $e) {  
    // If there is an error, catch it  
    echo 'Connection Failed: ' . $e->getMessage();  
}  
?>  
