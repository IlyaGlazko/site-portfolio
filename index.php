<?php
include "portfolio_db.php";
$about_me = getAboutMe();
$age = floor((strtotime(date('d-m-Y')) - strtotime($about_me[0]["date_of_birth"])) / (60 * 60 * 24 * 365.2421896));
$course_year = ceil((strtotime(date('d-m-Y')) - strtotime('01-09-2023')) / (60 * 60 * 24 * 365.2421896));
$games = getGames();
$skills = getSkills();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="reset.css">
    <title>Мой первый сайт</title>
</head>

<body>
    <section class="home" id="home">
        <div class="title">САЙТ-ВИЗИТКА ГЛАЗКО ИЛЬИ</div>
    </section>
    <div class="nav">
        <ul>
            <li><a href="#home">Начало</a></li>
            <li><a href="#author">Автор</a></li>
            <li><a href="#skills">Навыки</a></li>
            <li><a href="#games">Топ игры</a></li>
            <li><a href="#contacts">Контакты</a></li>
        </ul>
    </div>
    <section class="paragraph" id="author">
        <div class="title-1">АВТОР</div>
    </section>
    <section class="author">
        <div class="left">
            <img src="resources/загруженное.png" class="image-author">
        </div>
        <div class="right">
            <p class="author-title">Глазко Илья</p>
            <p class="author-info"> Мой возраст: <?php echo $age ?>.</p>
            <p class="author-info">Живу в городе Донецк.</p>
            <p class="author-info">Учился в школе №68. Затем учился на кафедре прикладной информатики в ДТПА.</p>
            <p class="author-info">Сейчас учусь на <?php echo $course_year ?> курсе кафедры прикладной информатики в
                ДонАУиГС.</p>
        </div>
    </section>
    <section class="paragraph" id="skills">
        <div class="title-1">НАВЫКИ</div>
    </section>
    <section class="skills">
        <?php
        for ($i = 0; $i < count($skills); $i++) {
            echo
                "<div>
                    <img src=" . $skills[$i]['src'] . " class='p-icon' width='150' height='150'>
                    <h1 class='bold'>" . $skills[$i]['name'] . "</h1>
                    <h2>" . $skills[$i]['level'] . "</h2>
                </div>";
        }
        ?>
    </section>
    <section class="paragraph" id="games">
        <div class="title-1">ТОП ИГРЫ</div>
    </section>
    <section class="games">
        <?php
        for ($i = 0; $i < count($games); $i++) {
            echo
                "<div>
                    <img src=" . $games[$i]['src'] . ">
                    <h1 class='names'>" . $games[$i]['name'] . "</h1>
                </div>";
        }
        ?>
    </section>
    <section class="paragraph" id="contacts">
        <div class="title-1">КОНТАКТЫ</div>
    </section>
    <section class="social-networks">
        <div>
            <a href="<?php echo $about_me[0]['tg_link'] ?>"><img src="resources/telegram.png"></a>
        </div>
    </section>
    </section>
    <div class="end">
        <h1>© <?php echo date('Y') ?> ГЛАЗКО ИЛЬЯ</h1>
    </div>
    </section>
</body>

</html>