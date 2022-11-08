<?php
    session_start();

    if(!$_SESSION['user']){
        header('location: autorizastion.php');
      }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/account.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="icon" href="../main/img/favicon-32x32.png">
    <title>Личный кабинет</title>
</head>
<body>
    <div class="wrapper">
        <div class="content">
            <div class="header">
                <div class="header__avatar">
                    <img class="avatar-img" src="<?= $_SESSION['user']['avatar']?>" alt="Аватар пользователя">
                </div>
                <div class="header__user">
                    <div class="email-text text"><?= $_SESSION['user']['email']?></div>
                    <div class="login-text text"><?= $_SESSION['user']['login']?></div>
                    <div class="button-exit">
                        <a href="includes/logout.php" class="logout btn_style">Выход</a>
                    </div>
                </div>
            </div>
            <div class="all-my-cash">
                <div class="over-cash">
                    <p>Список избранного</p>
                </div>
                <a href="../index.html" class="stock-catalog btn_style">В каталог</a>
            </div>
            <div class="stock-list">

            </div>
        </div>
    </div>
    <script src="js/script.js"></script>
    <script src="https://kit.fontawesome.com/5e7d10999a.js" crossorigin="anonymous"></script>
</body>
</html>