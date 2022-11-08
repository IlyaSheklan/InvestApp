<?php
  session_start();

  if($_SESSION['user']){
    header('location: personalAccount.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Main/img/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reset.css">
    <title>Авторизация</title>
</head>
<body>
    <div class="wrapper">
        <div class="block-wrapper">
          <div class="content">
            <div class="container">
              <div class="header">
                <div class="header__text"><a href="../index.html">Авторизация</a></div>
              </div>
              <form action="includes/signin.php" method="post" class="form__authorization">
                <div class="autho__login">
                  <div class="autho__text text">Логин</div>
                  <input type="text" class="login__loginfield field border_style" name="login">
                </div>
                <div class="autho__password">
                  <div class="autho__text text">Пароль</div>
                  <input type="password" class="password__passfield field border_style" name="password">
                </div>
                <div class="regis-button autho-button">
                  <button type="submit" class="regis__btn border_style">Войти</button>
                </div>
              </form>
              <div class="regis-account">
                <a class="not-acc-text" href="registration.php">Создать аккаунт</a>
              </div>

              <?php
                    if($_SESSION['message']){
                      echo '<p class="msg _msg_color-true">' .  $_SESSION['message'] . '</p>';
                    }
                    unset($_SESSION['message']);
              ?>
            </div>
          </div>
        </div>
      </div>
</body>
</html>
