<?php
session_start();
include 'functions.php';

$user = getCurrentUser();
if (!$user) { // если пользователь не авторизован, переводим назад на главную
    header('Location: login.php');
    exit;
}

$timeLeft = 24 * 60 * 60 - (time() - $_SESSION['login_time']); //время до истечении сессии
    /** 
     * 24 * 60 * 60 — это общее количество секунд в 24 часах (то есть 86400 секунд)
     * time() — функция, которая возвращает текущее время в секундах
     * $_SESSION['login_time'] — это время входа пользователя в систему, которое было сохранено при аутентификации
     * Мы из суток вычитаем время, которое прошло с момента входа, чтобы получить время, оставшееся до истечения сессии в секундах!
     */
$hours = floor($timeLeft / 3600); //часы 
$minutes = floor(($timeLeft % 3600) / 60); //минуты
$seconds = $timeLeft % 60; //секунды

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // был ли запрос отправлен методом POST
    $_SESSION['birthday'] = $_POST['birthday']; // сохраняем значение поля формы с именем birthday в сессии
}

$birthdayMessage = ''; //сюда будет писаться сообщение, исходя из контекста
if (!empty($_SESSION['birthday'])) {
    $birthday = new DateTime($_SESSION['birthday']); // Введенная дата рождения
    $today = new DateTime(); // Сегодняшняя дата

    // Устанавливаем день рождения на текущий год
    $birthday->setDate($today->format('Y'), $birthday->format('m'), $birthday->format('d'));

    // Проверка на день рождения сегодня
    if ($birthday === $today) {
        $birthdayMessage = "С Днем Рождения! У вас персональная скидка 5% на все услуги!";
    } else {
        // Если день рождения уже прошел в этом году, добавляем 1 год
        if ($birthday < $today) {
            $birthday->modify('+1 year');
        }

        // Рассчитываем разницу в днях
        $diff = $today->diff($birthday);
        $birthdayMessage = "До вашего дня рождения осталось: {$diff->days} дней.";
    }
}
/**
     * Функция format() в PHP является методом класса DateTime. 
     * Она используется для форматирования экземпляра даты и времени в строку по заданному формату. 
     * Эта функция позволяет получить представление даты и времени в различных форматах
     * 
     * Символ -> в PHP используется для доступа к свойствам и методам объектов. 
     * Он указывает на то, что идет обращение к элементу (свойству или методу) конкретного объекта, 
     * созданного с помощью класса.
*/
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет Здоровья</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Добро пожаловать, <?php echo htmlspecialchars($user); ?>!</h1>

        <p class="timer">
            До конца вашей персональной скидки осталось: 
            <?php echo "$hours часов $minutes минут $seconds секунд"; ?>
        </p>

        <?php if ($birthdayMessage): ?>
            <div class="birthday-message">
                <?php echo $birthdayMessage; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <label for="birthday">Введите дату рождения:</label>
            <input type="date" id="birthday" name="birthday" required>
            <button type="submit">Сохранить</button>
        </form>

        <a href="logout.php" class="logout">Выйти</a>
    </div>
</body>
</html>
