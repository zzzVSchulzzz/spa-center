<?php
session_start();
include 'functions.php';

// Если пользователь уже вошёл, перенаправляем на главную страницу
if (getCurrentUser()) {
    header('Location: index.php'); // header('Location: ') отправляем на страницу
    exit; //останавливаем функцию
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') { //был ли запрос отправлен методом POST
    $login = $_POST['username']; //извлечение значений логина из массива $_POST
    $password = $_POST['password']; //извлечение значений пароля из массива $_POST.

    if (checkPassword($login, $password)) { //проверяем соответствие введенного логина и пароля и значений массива
        $_SESSION['user'] = $login; //сохраняем логин пользователя в сессии, указывая, что пользователь вошел в систему
        $_SESSION['login_time'] = time(); // Запоминаем время входа
        header('Location: index.php'); // header('Location: ') отправляем на страницу
        exit; //останавливаем функцию
    } else {
        $error = "Неверный логин или пароль!";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Культура Здоровья</title>
  <link rel="stylesheet" href="styles.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&family=Open+Sans:wght@300;400;600;700;800&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <!-- Подключение jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Подключение Slick Carousel -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
</head>
<body>
    <header class="header">
        <nav class="navigation">
            <!-- Логотип -->
            <div class="logo">
                <img src="https://assets.onecompiler.app/42wr46r35/42wqtaxsr/image-31-10-24-03-22.jpeg" alt="logo" />
            </div>

            <!-- Навигация -->
            <div class="nav1">
                <a href="#services">Массажи</a>
                <a href="#">Акции</a>
                <a href="#abonements">Абонементы</a>
                <a href="#contact">Контакты</a>
                <!-- Иконка логина -->
                <a href="#" class="login" id="login-icon">
                    <img src="assets/log_in.png" alt="log_in" />
                </a>
                <!-- Всплывающее окно -->
                <div id="login-modal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Вход в личный кабинет</h2>
                    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?> // вывод ошибки
                    <form method="POST" action="login.php">
                        <label for="username">Логин:</label>
                        <input type="text" id="username" name="username" required>
                        <label for="password">Пароль:</label>
                        <input type="password" id="password" name="password" required>
                        <button type="submit">Войти</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    
    <main>
        <section id="services">
        <div class="product-grid, product-carousel">
            <div class="product-card">
                        <img src="https://assets.onecompiler.app/42wr46r35/42wqtaxsr/image-03-11-24-08-41-2.png" alt="Массаж стоп" />
                        <h3>МАССАЖ СТОП</h3>
                        <p class="description">
                        Рефлекторные точки, расположенные на стопах, отвечают за состояние организма 
                        в целом – позвоночник, глаза, уши, зубы и десны, нос. Массаж подошвы стоп положительно влияет на мышцы,
                        кожу и опорно-двигательный аппарат. Массирование нижних конечностей нормализует работу организма, 
                        избавляет от головных болей, улучшает работу сердечно-сосудистой системы, 
                        укрепляет иммунитет и регулирует гормональный фон. Массаж ног отличается от других процедур тем, 
                        что воздействие происходит не на конкретные мышцы, а на весь организм.
                        </p>
                        <p class="price">30 минут - 1300 ₽</p>
            </div>
            <div class="product-card">
                        <img src="https://assets.onecompiler.app/42wr46r35/42wqtaxsr/image-03-11-24-08-41-2.png" alt="МАССАЖ ШЕЙНО-ВОРОТНИКОВОЙ ЗОНЫ" />
                        <h3>МАССАЖ ШЕЙНО-ВОРОТНИКОВОЙ ЗОНЫ</h3>
                        <p class="description">
                        Массаж шейно-воротниковой зоны расслабляет мышцы шеи, улучшает кровообращение 
                        и обмен веществ в шейном отделе, ускоряет отток лимфы, улучшает питание органов шеи и головы. 
                        С помощью массажа снимают локальные мышечные затвердения и болезненные ощущения в шейном отделе. 
                        Это очень эффективный способ избавиться от болей в области лопаток и плеч, забыть о мышечных болях 
                        в спине и напряжении мышц шеи, позволяет снять отечность и припухлость.
                        </p>
                        <p class="price">30 минут - 1300 ₽</p>
            </div>
            <div class="product-card">
                    <img src="https://assets.onecompiler.app/42wr46r35/42wqtaxsr/image-03-11-24-08-41-2.png" alt="ВИСЦЕРАЛЬНЫЙ МАССАЖ" />
                    <h3>ВИСЦЕРАЛЬНЫЙ МАССАЖ</h3>
                    <p class="description">
                        Висцеральный массаж – это техника глубокого ручного массажа внутренних органов 
                        (кишечник, печень и почки) через переднюю брюшную стенку с целью улучшения состояния ЖКТ,
                        перистальтики кишечника и всего организма в целом.
                        Висцеральная терапия налаживает и гармонизирует связь между внутренними органами, лимфатической системой,
                        дыхательной системой и кровообращением.
                    </p>
                    <p class="price">30 минут - 1300 ₽</p>
            </div>
            <div class="product-card">
                    <img src="https://assets.onecompiler.app/42wr46r35/42wqtaxsr/image-03-11-24-08-41-2.png" alt="КЛАССИЧЕСКИЙ МАССАЖ ЛИЦА" />
                    <h3>КЛАССИЧЕСКИЙ МАССАЖ ЛИЦА</h3>
                    <p class="description">
                        Эффективная мануальная процедура, главная задача которой – продлить молодость и сияние кожи, 
                        разгладить морщины и возрастные складки. Процедура активизирует кровоснабжение, 
                        улучшает интенсивность обмена веществ в тканях. Массаж лица убирает спастичность мышц или где это нужно повышает их тонус. 
                        В результате курсового применения этой процедуры лицевой овал подтягивается, 
                        уходят отеки, складки кожи становятся менее глубокими.
                    </p>
                    <p class="price">30 минут - 1300 ₽</p>
                    <p class="price">60 минут - 2300 ₽</p>
            </div>
            <div class="product-card">
                    <img src="https://assets.onecompiler.app/42wr46r35/42wqtaxsr/image-03-11-24-08-41-2.png" alt="КОБИДО" />
                    <h3>ЯПОНСКИЙ МАССАЖ ЛИЦА "КОБИДО"</h3>
                    <p class="description">
                        Благотворный эффект массажа кобидо достигается благодаря релаксации мышц лица и шеи, 
                        а также активизации регенерационных процессов в клетках кожи. 
                        Кровообращение и лимфоотток становятся более интенсивными, 
                        благодаря чему в тканях запускается процесс самоомоложения. Данная техника массажа лица прорабатывает 
                        не только поверхностный слой кожи, но и более глубинные ткани. Это одна из немногих методик, 
                        при которых активизация выработки коллагена в тканях осуществляется без применения инъекций 
                        либо высокотехнологичной аппаратуры. Пользуясь только собственными руками, 
                        мастер приводит в кожу в такое состояние, что она начинает с помощью собственных ресурсов ускоренно 
                        избавляться от токсинов и омертвевших клеток.
                    </p>
                    <p class="price">30 минут - 1500 ₽</p>
                    <p class="price">60 минут - 2500 ₽</p>
            </div>
            <div class="product-card">
                    <img src="https://assets.onecompiler.app/42wr46r35/42wqtaxsr/image-03-11-24-08-41-2.png" alt="КЛАССИЧЕСКИЙ МАССАЖ" />
                    <h3>КЛАССИЧЕСКИЙ МАССАЖ</h3>
                    <p class="description">
                        Классический массаж тела способствует укреплению иммунитета, помогает уменьшить боль в теле, 
                        снять отеки, улучшить кровообращение, регенерировать поврежденные ткани, 
                        а также восстановить душевное равновесие.
                    </p>
                    <p class="price">60 минут - 2800 ₽</p>
                    <p class="price">90 минут - 3700 ₽</p>
            </div>
            <div class="product-card">
                    <img src="https://assets.onecompiler.app/42wr46r35/42wqtaxsr/image-03-11-24-08-41-2.png" alt="АНТИЦЕЛЛЮЛИТНЫЙ МАССАЖ" />
                    <h3>АНТИЦЕЛЛЮЛИТНЫЙ МАССАЖ</h3>
                    <p class="description">
                        Антицеллюлитный массаж – это механическое воздействие на кожу с помощью определенных техник, направленное на уменьшение и нормализацию обмена веществ в подкожно-жировом слое.
                        При воздействии на кожу с помощью профессионального массажа происходит улучшение местного
                        кровообращения и лимфотока; ускорение распада молочной кислоты; выведение шлаков, токсинов и лишней воды из подкожной клетчатки; 
                        нормализация клеточного метаболизма и удаление лишнего жира из тканей.
                    </p>
                    <p class="price">40 минут - 2300 ₽</p>
            </div>
            <div class="product-card">
                    <img src="https://assets.onecompiler.app/42wr46r35/42wqtaxsr/image-03-11-24-08-41-2.png" alt="РАССЛАБЛЯЮЩИЙ МАССАЖ" />
                    <h3>РАССЛАБЛЯЮЩИЙ МАССАЖ</h3>
                    <p class="description">
                    Главная цель расслабляющего массажа — расслабить организм, успокоить нервную систему от стресса и 
                    сделать все условия для внешнего и внутреннего восстановления.
                    </p>
                    <p class="price">60 минут - 2500 ₽</p>
                    <p class="price">90 минут - 3400 ₽</p>
            </div>
            <div class="product-card">
                    <img src="https://assets.onecompiler.app/42wr46r35/42wqtaxsr/image-03-11-24-08-41-2.png" alt="ЛИМФОДРЕНАЖНЫЙ МАССАЖ" />
                    <h3>ЛИМФОДРЕНАЖНЫЙ МАССАЖ</h3>
                    <p class="description">
                    Лимфодренажный массаж – методика механического и мануального (ручного) воздействия на организм, оказывающая влияние на движение лимфы по телу. 
                    Такой вид массажа оказывает не только косметический, но и оздоровительный эффект.
                    Способствует выведению лишней жидкости и токсинов, уменьшение отёчности, повышение тонуса мышц, насыщение тканей кислородом, снижение объемов тела.
                    </p>
                    <p class="price">60 минут - 3000 ₽</p>
                    <p class="price">90 минут - 3900 ₽</p>
            </div>
            <div class="product-card">
                    <img src="https://assets.onecompiler.app/42wr46r35/42wqtaxsr/image-03-11-24-08-41-2.png" alt="МАССАЖ СПИНЫ" />
                    <h3>МАССАЖ СПИНЫ</h3>
                    <p class="description">
                    Массаж спины – уникальный метод комплексной терапии заболеваний опорно-двигательного аппарата, 
                    при котором производится воздействие на область позвоночника и расположенных рядом мышц. 
                    Лечебный массаж позволяет снять избыточный тонус с мышечно-связочного корсета позвоночника, 
                    помогает восстановить эластичность мышц, связок и фасций, улучшить кровообращение во всех структурах 
                    спины и позвоночнике, устранить болевые ощущения.
                    </p>
                    <p class="price">40 минут - 1800 ₽</p>
            </div>
            <div class="product-card">
                        <img src="https://assets.onecompiler.app/42wr46r35/42wqtaxsr/image-03-11-24-08-41-2.png" alt="МАССАЖ ГОЛОВЫ И ШЕИ" />
                        <h3>МАССАЖ ГОЛОВЫ И ШЕИ</h3>
                        <p class="description">
                        Массаж головы и шеи усиливает микроциркуляцию в
                        воротниковой зоне, что способствует притоку кислорода, снятию напряжения в зоне воздействия. 
                        Это процедура механического и
                        рефлекторного воздействия на кожу, нервы, мышцы и
                        секреторный аппарат головы. Методика снимает стресс,
                        избавляет от головной боли и бессонницы, усиливает рост волос, улучшает обмен веществ.
                        </p>
                        <p class="price">30 минут - 1300 ₽</p>
            </div>
        </div>
        </section>


        <section id="abonements">
            <h2>Абонементы</h2>
            <div class="discount">
                <p>
                5 сеансов(срок действия 2 недели) <span>-10%</span>
                </p>
            </div>
            <div class="discount">
                <p>
                    10 сеансов(срок действия 4 недели) <span>-15%</span>
                </p>
            </div>
            <div class="discount">
                <p>
                    15 сеансов(срок действия 6 недели) <span>-20%</span>
                </p>
            </div>
        </section>

        <section id="contact">
            <h2>Контакты</h2>
            <p>Телефон: +7 (918) 082-77-88</p>
            <p>Email: info@kultura_zdorovia.ru</p>
        </section>
    </main>

  <footer>
    <p class = "copyright">&copy; 2024 Культура Здоровья</p>
  </footer>
    
  <script src="script.js"></script>
</body>
</html>
