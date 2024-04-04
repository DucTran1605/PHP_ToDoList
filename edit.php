<?php
require 'database.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    header('Location: list.php');
    exit;
}

$query = "Select * from list where id = :id";

$statement = $pdo->prepare($query);

$params = ['id' => $id];

$statement->execute($params);

$result = $statement->fetch();

//Check for form submit
$isPutRequest = $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'put';  

if($isPutRequest){
	$title = htmlspecialchars(isset($_POST['title']) ? $_POST['title'] : '');
	$description = htmlspecialchars(isset($_POST['description']) ? $_POST['description'] : '');
	
	$query = 'UPDATE `to_do_list`.`list` SET `title` = :title, `description` = :description, `date_create` = CURDATE() WHERE (`id` = :id);';

	$statement = $pdo->prepare($query);
	
	$params = [
		'title' => $title,
		'description' => $description,
		'id' => $id,
	];
	
	$statement->execute($params);

	header('Location: list.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Todo</title>
</head>

<body>
    <h1>Edit a Todo</h1>
    <form method="POST">
		<input type="hidden" name="_method" value="put">
        <input type="hidden" name="id" value="<?= $result['id'] ?>">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="<?=$result['title']?>" required><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50" required><?=$result['description']?></textarea><br><br>
		<a href="list.php">Go Back</a>
        <input type="submit" name="submit" value="Edit Todo">
    </form>
</body>

</html>