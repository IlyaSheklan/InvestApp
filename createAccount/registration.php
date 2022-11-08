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
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="../Main/img/favicon-32x32.png" type="image/x-icon">
    <title>Регистрация</title>
</head>
<body>
    <div class="wrapper">
        <div class="block-wrapper">
          <div class="content">
            <div class="container">
              <div class="header">
                <div class="header__text"><a href="../index.html">Регистрация</a></div>
              </div>
              <form action="includes/signup.php" method="post" class="form__regis" enctype="multipart/form-data">
                <div class="regis__email">
                  <div class="email__text text">Почта</div>
                  <input type="email" class="email__emailfield field border_style" name="email">
                </div>
                <div class="regis__login">
                  <div class="login__text text">Логин</div>
                  <input type="text" class="login__loginfield field border_style" name="login">
                </div>
                <div class="regis__password">
                  <div class="password__text text">Пароль</div>
                  <input type="password" class="password__passfield field border_style" name="password">
                </div>
                <div class="regis__password-again">
                  <div class="password-again__text text">Повторите пароль</div>
                  <input type="password" class="password__again-passfield field border_style" name="password_again">
                </div>
                <div class="regis__img">
                  <div class="img__text text">Изображение профиля</div>
                  <input type="file" class="img__picture" name="avatar">
                </div>
                <div class="regis-button">
                  <button class="regis__btn border_style" type="submit">Зарегистрироваться</button>
                </div>
                <div class="regis-account">
                  <a class="not-acc-text" href="autorizastion.php">У меня уже есть аккаунт</a>
                </div>
                <div class="message__pass">

                  <!-- Окно для всплывающего сообщения -->
                  <?php
                    if($_SESSION['message']){
                      echo '<p class="msg _msg_color-false">' .  $_SESSION['message'] . '</p>';
                    }
                    unset($_SESSION['message']);
                  ?>
                  
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
</body>
</html>