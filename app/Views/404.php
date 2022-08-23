<!DOCTYPE html>
<html lang="ru">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link type="text/css" rel="stylesheet" href="/css/style.css">
    <title>Страница не найдена</title>
</head>

<body>
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h1>404</h1>
            </div>
            <h2>Упс! Ничего не найдено</h2>
            <p>
                Страница, которую вы ищите, могла быть удалена, переименована или временно недоступна.
                <a href="/">Вернуться на главную</a>
            </p>
            <div class="notfound-social">
                <a href="<?= $options->facebook_link ?>"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="<?= $options->instagram_link ?>"><i class="fa-brands fa-instagram"></i></a>
                <a href="<?= $options->vk_link ?>"><i class="fa-brands fa-vk"></i></a>
            </div>
        </div>
    </div>

</body>

</html>