<?php
$link = false;

function openDB()
{
    global $link;

    $link = mysqli_connect("localhost", "root", "", "glazko_portfolio");
    mysqli_query($link, "SET NAMES UTF8");
}

function closeDB()
{
    global $link;
    $link = false;
}

function getAboutMe()
{
    global $link;
    openDB();

    $result = mysqli_query($link, "SELECT * FROM about_me");
    $about_me = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $finfo = finfo_open(FILEINFO_MIME_TYPE); // Инициализация функции для определения MIME-типа
    $imageType = finfo_buffer($finfo, $about_me[0]['photo'], FILEINFO_MIME_TYPE);
    $imageBase64 = base64_encode($about_me[0]['photo']);
    $about_me[0]['photo'] = [
        'id' => $about_me[0]['id'],
        'src' => 'data:' . $imageType . ';base64,' . $imageBase64, // Формируем строку для src
        'type' => $imageType // Сохраняем тип изображения (опционально)
    ];
    closeDB();
    return $about_me;
}

function getGames()
{
    global $link;
    openDB();

    $result = mysqli_query($link, "SELECT * FROM games");
    if ($result->num_rows > 0) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE); // Инициализация функции для определения MIME-типа

        while ($row = $result->fetch_assoc()) {
            // Определяем MIME-тип изображения
            $imageType = finfo_buffer($finfo, $row['game_image'], FILEINFO_MIME_TYPE);

            // Преобразуем BLOB в Base64 и сохраняем в массив
            $imageBase64 = base64_encode($row['game_image']);
            $games[] = [
                'id' => $row['id'],
                'src' => 'data:' . $imageType . ';base64,' . $imageBase64, // Формируем строку для src
                'name' => $row['game_name'],
                'type' => $imageType // Сохраняем тип изображения (опционально)
            ];
        }

        finfo_close($finfo); // Закрываем ресурс
    } else {
        $games = []; // Если фотографий нет
    }

    closeDB();
    return $games;
}

function getSkills()
{
    global $link;
    openDB();

    $result = mysqli_query($link, "SELECT * FROM skills");
    if ($result->num_rows > 0) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE); // Инициализация функции для определения MIME-типа

        while ($row = $result->fetch_assoc()) {
            // Определяем MIME-тип изображения
            $imageType = finfo_buffer($finfo, $row['skill_img'], FILEINFO_MIME_TYPE);

            // Преобразуем BLOB в Base64 и сохраняем в массив
            $imageBase64 = base64_encode($row['skill_img']);
            $skills[] = [
                'id' => $row['id'],
                'src' => 'data:' . $imageType . ';base64,' . $imageBase64, // Формируем строку для src
                'name' => $row['skill_name'],
                'level' => $row['knowledge_level'],
                'type' => $imageType // Сохраняем тип изображения (опционально)
            ];
        }

        finfo_close($finfo); // Закрываем ресурс
    } else {
        $skills = []; // Если фотографий нет
    }

    closeDB();
    return $skills;
}

?>