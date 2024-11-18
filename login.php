<?php
session_start();

// Если данные формы отправлены
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Простая проверка (замените на вашу логику)
    if ($username === 'admin' && $password === '12345') {
        $_SESSION['username'] = $username; // Сохраняем имя пользователя в сессии
        echo "Добро пожаловать, $username!";
    } else {
        echo "Неверный логин или пароль!";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Пример простой аутентификации
    if ($username === 'admin' && $password === '12345') {
        $_SESSION['username'] = $username;
        setcookie("username", $username, time() + (86400 * 30), "/"); // Cookie на 30 дней
        echo "Добро пожаловать, $username!";
    } else {
        echo "Неверный логин или пароль!";
    }
}


// //<?php
// session_start();
// if (!isset($_SESSION['username'])) {
//     header("Location: index.php"); // Перенаправление на страницу входа
//     exit();
// }
