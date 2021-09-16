<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todolist</title>
    <link rel="stylesheet" href="style.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Yusei+Magic&display=swap');
    </style>
    <script src="https://kit.fontawesome.com/e4011f0a8c.js" crossorigin="anonymous"></script>
</head>
<body>
<?php
session_start();
$self_url = $_SERVER['PHP_SELF'];
?>


<div class="form">
    <div class="img">
        <img src="todolist_top.png" alt="" width="180px">
    </div>
    <hr>
    <div class="top">    
        <form class="submit" action="<?php echo $self_url; ?>" method="post">
            <input id="sub" type="text" name="title" placeholder="enter the task">
            <button class="sub" type="submit" name="type" value="create"><i class="fas fa-edit"></i></button>
        </form>


        <?php
        if (isset($_POST['type'])) {
            if ($_POST['type'] === 'create') {
                $_SESSION['todos'][] = $_POST['title'];
                echo "新しいtask[<span> {$_POST['title']} </span>]が追加されました<br>";
            } elseif ($_POST['type'] === 'update') {
                $id = $_POST['id'];
                $_SESSION['todos'][$id] = $_POST['title'];
                echo "task[<span> {$_POST['title']} </span>]に変更されました<br>";
            } elseif ($_POST['type'] === 'delete') {
                $id = $_POST['id'];
                array_splice($_SESSION['todos'], $id, 1);
                echo "task[<span> {$_POST['title']} </span>]が削除されました<br>";
            }
        }

        if (empty($_SESSION['todos'])) {
            $_SESSION['todos'] = [];
            echo "taskはありません";
            die();
        }

        ?>
    </div>
    <hr>
    <ul>
        <?php
        for ($i = 0; $i < count($_SESSION['todos']); $i++) :
        ?>
            <li>
                <form action="<?php echo $self_url; ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo $i; ?>">
                    <input id="task-list" type="text" name="title" value="<?php echo $_SESSION['todos'][$i]; ?>">
                    <button class="del" type="submit" name="type" value="delete"><i class="fas fa-trash-alt"></i></button>
                    <button class="up" type="submit" name="type" value="update"><i class="fas fa-wrench"></i></button>
                </form>
            </li>

        <?php endfor; ?>
    </ul>
</div>
</body>
</html>
