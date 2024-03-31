<?php
$host = 'localhost';
$port = 3306;
$dbName = 'to_do_list';
$username = 'root';
$password = '12345678';

$dsn = "mysql:host={$host};port={$port};dbname={$dbName};charset=utf8";

try {
    //Create PDO instance
    $pdo = new PDO($dsn, $username, $password);

    //Set PDO to throw exception on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Fetch as Assoc array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    //If there is an error, catch it 
    echo 'Connection Faile: ' . $e->getMessage();
}
