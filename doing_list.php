<?php
require 'database.php';

//Prepare a Select statement
$statement = $pdo->prepare('Select * from list where status = 1');

//Execute the statment 
$statement->execute();

//Fetch result 
$results = $statement->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">


    <title>bs4 todo list - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body {
            margin-top: 20px;
            background: #f8f8f8;
        }

        .todo-nav {
            margin-top: 10px
        }

        .todo-list {
            margin: 10px 0
        }

        .todo-list .todo-item {
            padding: 15px;
            margin: 5px 0;
            border-radius: 0;
            background: #f7f7f7
        }

        .todo-list.only-active .todo-item.complete {
            display: none
        }

        .todo-list.only-active .todo-item:not(.complete) {
            display: block
        }

        .todo-list.only-complete .todo-item:not(.complete) {
            display: none
        }

        .todo-list.only-complete .todo-item.complete {
            display: block
        }

        .todo-list .todo-item.complete span {
            text-decoration: line-through
        }

        .remove-todo-item {
            color: #ccc;
            visibility: hidden
        }

        .remove-todo-item:hover {
            color: #5f5f5f
        }

        .todo-item:hover .remove-todo-item {
            visibility: visible
        }

        div.checker {
            width: 18px;
            height: 18px
        }

        div.checker input,
        div.checker span {
            width: 18px;
            height: 18px
        }

        div.checker span {
            display: -moz-inline-box;
            display: inline-block;
            zoom: 1;
            text-align: center;
            background-position: 0 -260px;
        }

        div.checker,
        div.checker input,
        div.checker span {
            width: 19px;
            height: 19px;
        }

        div.checker,
        div.radio,
        div.uploader {
            position: relative;
        }

        div.button,
        div.button *,
        div.checker,
        div.checker *,
        div.radio,
        div.radio *,
        div.selector,
        div.selector *,
        div.uploader,
        div.uploader * {
            margin: 0;
            padding: 0;
        }

        div.button,
        div.checker,
        div.radio,
        div.selector,
        div.uploader {
            display: -moz-inline-box;
            display: inline-block;
            zoom: 1;
            vertical-align: middle;
        }

        .card {
            padding: 25px;
            margin-bottom: 20px;
            border: initial;
            background: #fff;
            border-radius: calc(.15rem - 1px);
            box-shadow: 0 1px 15px rgba(0, 0, 0, 0.04), 0 1px 6px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>

<body>
    <form action="process.php" method="POST">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-white">
                        <div class="card-body">
                            <a href="create.php" class="btn btn-primary">Create To Do</a>
                            <ul class="nav nav-pills todo-nav">
                                <li role="presentation" class="nav-item all-task active"><a href="list.php" class="nav-link">All</a></li>
                                <li role="presentation" class="nav-item active-task"><a href="doing.php" class="nav-link">Doing</a></li>
                                <li role="presentation" class="nav-item completed-task"><a href="completed.php" class="nav-link">Completed</a></li>
                            </ul>
                            <?php foreach ($results as $result) : ?>
                                <div class="todo-list">
                                    <div class="todo-item">
                                        <span>Title: <a href="edit.php?id=<?= $result['id'] ?>"><?= $result['title'] ?></a><br></span>
                                        <span>Description: <?= $result['description'] ?><br></span>
                                        <span>Create Date: <?= $result['date_create'] ?><br></span>
                                        <span>Status: <?= $result['status'] ? 'Doing' : 'Finish' ?><br></span>
                                        <div class="button-group d-flex">
                                            <!-- Delete button -->
                                            <form action="delete.php" method="POST">
                                                <input type="hidden" name="_method" value="delete">
                                                <input type="hidden" name="id" value="<?= $result['id'] ?>">
                                                <button type="submit" name="submit" class="btn btn-danger mr-2">Delete</button>
                                            </form>
                                            <!-- Mark as Finish button -->
                                            <form action="markFinish.php" method="POST">
                                                <input type="hidden" name="_method" value="finish">
                                                <input type="hidden" name="id" value="<?= $result['id'] ?>">
                                                <button type="submit" name="submit" class="btn btn-info mr-2">Mark as Finish</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>