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
    $birthday = date('Y-m-d', strtotime($_SESSION['birthday'])); // Введенная дата рождения
    $today = date('Y-m-d'); // Сегодняшняя дата

   // Извлекаем текущий год
   $currentYear = date('Y', strtotime($today));

   // Устанавливаем день рождения на текущий год
   $currentBirthday = date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($birthday)), date('d', strtotime($birthday)), $currentYear));

    // Проверка на день рождения сегодня
    if ($currentBirthday === $today) {
        $birthdayMessage = "С Днем Рождения! У вас персональная скидка 5% на все услуги!";
    } else {
        // Если день рождения уже прошел в этом году, добавляем 1 год
        if ($currentBirthday < $today) {
            $currentBirthday = date('Y-m-d', strtotime('+1 year', strtotime($currentBirthday)));
        }

        // Рассчитываем разницу в днях
        $diff = (strtotime($currentBirthday) - strtotime($today)) / (60 * 60 * 24);
        $birthdayMessage = "До вашего дня рождения осталось: {$diff} дней.";
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
     * 
     * !!! Но я это выпилила из-за бага, пусть будет как конспект. Теперь актуальное:
     * 
     * strtotime($_SESSION['birthday']) — преобразует эту строку в "временную метку" UNIX 
     * 
     * date('Y-m-d', ...) — превращает временную метку обратно в строку формата ГГГГ-ММ-ДД. 
     * Это делается, чтобы убедиться, что дата в нужном формате.
     * 
     * date('Y-m-d') возвращает текущую дату в формате ГГГГ-ММ-ДД
     * 
     * strtotime($today) преобразует текущую дату в временную метку UNIX.
     * date('Y', ...) извлекает из временной метки текущий год.
     * 
     * mktime(0, 0, 0, ...) создает временную метку для конкретного дня, месяца и года. Мы задаем:
     * 0, 0, 0 — часы, минуты, секунды, игнорируем их (всегда 00:00:00).
     * date('m', strtotime($birthday)) — берем месяц из даты рождения.
     * date('d', strtotime($birthday)) — берем день из даты рождения.
     * $currentYear — используем текущий год.
     * Таким образом, мы создаем дату дня рождения в текущем году.
     * date('Y-m-d', ...) преобразует временную метку в строку формата ГГГГ-ММ-ДД.
     * 
     * Если день рождения уже прошел, добавляем 1 год:
     * strtotime('+1 year', ...) сдвигает дату на 1 год вперед.
     *date('Y-m-d', ...) возвращает новую дату в формате ГГГГ-ММ-ДД
     * 
     * Вычисляем разницу между датами в днях:
     * strtotime($currentBirthday) и strtotime($today) дают временные метки двух дат.
     * (strtotime($currentBirthday) - strtotime($today)) возвращает разницу в секундах.
     * Делим на (60 * 60 * 24) (количество секунд в одном дне), чтобы получить разницу в днях.
     * 
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
