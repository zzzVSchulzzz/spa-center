<?php
// Получить список пользователей и их паролей. Функция возвращает массив логин - пароль
function getUsersList() {
    return [
        'user1' => password_hash('password1', PASSWORD_DEFAULT), // тут мы с помощью password_hash('пароль', алгоритм хэширования)
        'user2' => password_hash('password2', PASSWORD_DEFAULT),
        'user3' => password_hash('password3', PASSWORD_DEFAULT),
    ];
}

// Проверить, существует ли пользователь
function existsUser($login) {
    $users = getUsersList(); //вызываем функцию, которая возвращает массив пользователей
    return array_key_exists($login, $users); //проверяем, существует ли пользователь через array_key_exists(), проверяем есть ли ключ $login в массиве $users
}

// Проверить пароль пользователя
function checkPassword($login, $password) {
    $users = getUsersList(); //вызываем функцию, которая возвращает массив пользователей
    if (existsUser($login)) {
        return password_verify($password, $users[$login]); //проверяем пароль пользователя через password_verify(), соответствует ли введенный пароль $password хэшу пароля $users[$login] (где [$login] — это значение в массиве пользователей, соответствующее логину).
    } 
    return false;
}

// Получить текущего пользователя
function getCurrentUser() {
    return isset($_SESSION['user']) ? $_SESSION['user'] : null; //  проверяем, была ли установлена переменная и не равна ли она null
}
?>
