<?php

    session_start();

    require_once 'connect.php';

    $email = $_POST['email'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $password_again = $_POST['password_again'];

    if($password === $password_again){

        //загрузка картинки
        $path = 'img/' . time() . $_FILES['avatar']['name'];
        if(!move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path)){
            $_SESSION['message'] = 'Ошибка при загрузки картинки';
            header('location: ../registration.php');
        }

        //Добавление в БД

        $password = md5($password);

        mysqli_query($connect, "INSERT INTO 
                            `users` (`id`, `email`, `login`, `password`, `avatar`) 
                             VALUES (NULL, '$email', '$login', '$password', '$path')
        ");

        $_SESSION['message'] = 'регистрация прошла успешно';
        header('location: ../autorizastion.php');

    } else{
        $_SESSION['message'] = 'Пароли не совпадают';
        header('location: ../registration.php');
    }

?>
