<?php

$db = require('database.php');
$options = require('options.php');

$specialCards = $db->query('SELECT * FROM menu WHERE type = "special"');
$regularCards = $db->query('SELECT * FROM menu WHERE type = "regular"');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$options['site_name']?></title>

    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<header>

    <a href="./" class="logo"><i class="fas fa-utensils"></i><?=$options['site_name']?></a>

    <nav class="navbar">
        <a class="active" href="#home">Главная</a>
        <a href="#menu">Меню</a>
        <a href="#about">О нас</a>
        <a href="#review">Отзывы</a>
        <a href="#order">Заказать</a>
    </nav>

    <div class="icons">
        <i class="fas fa-bars" id="menu-bars"></i>
        <a href="#order" class="fas fa-shopping-cart"></a>
    </div>

</header>

<section class="home" id="home">

    <div class="swiper-container home-slider">

        <div class="swiper-wrapper wrapper">

        <?php foreach ($specialCards as $card): ?>

            <div class="swiper-slide slide">
                <div class="content">
                    <span>Наше особое блюдо</span>
                    <h3><?=$card['title']?></h3>
                    <p><?=$card['description']?></p>
                    <div class="slider-button-container">
                        <span class="slider-price">$<?=$card['price']?></span>
                        <div><a href="#" class="btn-custom">Добавить в корзину</a></div>
                    </div>
                </div>
                <div class="image">
                    <img src="<?=$card['image']?>">
                </div>
            </div>

        <?php endforeach; ?>

        </div>

        <div class="swiper-pagination transparent"></div>

    </div>

</section>

<section class="menu" id="menu">

    <h1 class="heading">Наше меню</h1>

    <div class="box-container">

        <?php foreach ($regularCards as $card): ?>

        <div class="box">
            <div class="image">
                <img src="<?=$card['image']?>">
            </div>
            <div class="content">
                <div class="menu-title-container">
                    <span class="menu-title"><?=$card['title']?></span>
                    <span class="price">$<?=$card['price']?></span>
                </div>
                <p><?=$card['description']?></p>
                <button class="btn-custom">Добавить в корзину</button>
            </div>
        </div>

        <?php endforeach; ?>

    </div>

</section>

<section class="about" id="about">

    <h1 class="heading">О нас</h1>

    <div class="row">

        <div class="image">
            <img src="images/about-img.png" alt="">
        </div>

        <div class="content">
            <h3><?=$options['about_title']?></h3>
            <p><?=nl2br($options['about_text'])?></p>
            <div class="icons-container">
                <div class="icons">
                    <i class="fas fa-shipping-fast"></i>
                    <span>Бесплатная доставка</span>
                </div>
                <div class="icons">
                    <i class="fas fa-dollar-sign"></i>
                    <span>Быстрые платежи</span>
                </div>
                <div class="icons">
                    <i class="fas fa-headset"></i>
                    <span>Сервис 24/7</span>
                </div>
            </div>
        </div>

    </div>

</section>

<section class="review" id="review">

    <h1 class="heading">Отзывы</h1>

    <div class="swiper-container review-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide slide">
                <i class="fas fa-quote-right"></i>
                <div class="user">
                    <img src="images/pic-1.png" alt="">
                    <div class="user-info">
                        <h3>john deo</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit fugiat consequuntur repellendus aperiam deserunt nihil, corporis fugit voluptatibus voluptate totam neque illo placeat eius quis laborum aspernatur quibusdam. Ipsum, magni.</p>
            </div>

            <div class="swiper-slide slide">
                <i class="fas fa-quote-right"></i>
                <div class="user">
                    <img src="images/pic-2.png" alt="">
                    <div class="user-info">
                        <h3>john deo</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit fugiat consequuntur repellendus aperiam deserunt nihil, corporis fugit voluptatibus voluptate totam neque illo placeat eius quis laborum aspernatur quibusdam. Ipsum, magni.</p>
            </div>

            <div class="swiper-slide slide">
                <i class="fas fa-quote-right"></i>
                <div class="user">
                    <img src="images/pic-3.png" alt="">
                    <div class="user-info">
                        <h3>john deo</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit fugiat consequuntur repellendus aperiam deserunt nihil, corporis fugit voluptatibus voluptate totam neque illo placeat eius quis laborum aspernatur quibusdam. Ipsum, magni.</p>
            </div>

            <div class="swiper-slide slide">
                <i class="fas fa-quote-right"></i>
                <div class="user">
                    <img src="images/pic-4.png" alt="">
                    <div class="user-info">
                        <h3>john deo</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit fugiat consequuntur repellendus aperiam deserunt nihil, corporis fugit voluptatibus voluptate totam neque illo placeat eius quis laborum aspernatur quibusdam. Ipsum, magni.</p>
            </div>

        </div>

    </div>
    
</section>

<section class="order" id="order">

    <h1 class="heading">Заказать</h1>

    <form action="">

        <!-- <div class="inputBox">
            <div class="input">
                <span>Ваше имя</span>
                <input type="text" placeholder="enter your name">
            </div>
        </div>
        <div class="inputBox">
            <div class="input">
                <span>Ваш номер телефона</span>
                <input type="text" placeholder="enter food name">
            </div>
        </div>
        <div class="inputBox">
            <div class="input">
                <span>Ваш адрес</span>
                <input type="number" placeholder="how many orders">
            </div>
        </div>
        <div class="inputBox">
            <div class="input">
                <span>Ваш заказ</span>
                <textarea name="" placeholder="enter your message" id="" cols="30" rows="10"></textarea>
            </div>
        </div>

        <input type="submit" value="order now" class="btn-custom"> -->

        <div class="empty-cart">
            <h3>В вашей корзине пусто</h3>
            <a href="#menu" class="btn-custom">Перейти к меню</a>
        </div>

    </form>

</section>

<section class="footer">

    <div class="box-container">

        <div class="box">
            <h3>Контактная информация</h3>
            <a href="tel:<?=$options['phone']?>"><?=$options['phone']?></a>
            <a href="mailto:<?=$options['email']?>"><?=$options['email']?></a>
        </div>

        <div class="box">
            <h3>Социальные сети</h3>
            <a href="<?=$options['facebook_link']?>">Facebook</a>
            <a href="<?=$options['instagram_link']?>">Instagram</a>
            <a href="<?=$options['vk_link']?>">ВКонтакте</a>
        </div>

    </div>

    <div class="credit"> Copyright @ 2021 by <span>Mr. Web Designer</span> </div>

</section>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

</body>
</html>