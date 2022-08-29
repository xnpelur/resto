<?php

use App\Widgets\Form;
use App\Widgets\Modal;
use App\Widgets\FlashMessage;
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $options->site_name ?></title>

    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="/style.css">

</head>

<body>

    <header>

        <a href="./" class="logo"><i class="fas fa-utensils"></i><?= $options->site_name ?></a>

        <nav class="navbar">
            <a class="active" href="#home">Главная</a>
            <a href="#menu">Меню</a>
            <a href="#about">О нас</a>
            <a href="#review">Отзывы</a>
            <a href="#order">Заказать</a>
        </nav>

        <div class="icons">
            <i class="fas fa-bars" id="menu-bars" onclick="toggleMenu()"></i>
            <a href="#order" class="fas fa-shopping-cart"></a>
            <span id="cart-counter"></span>
        </div>

    </header>

    <section class="home" id="home">

        <div class="swiper-container home-slider">

            <div class="swiper-wrapper wrapper">

                <?php foreach ($specialMeals as $meal) : ?>

                    <div class="swiper-slide slide">
                        <div class="content">
                            <span>Наше особое блюдо</span>
                            <h3><?= $meal->title ?></h3>
                            <p><?= $meal->description ?></p>
                            <div class="slider-button-container">
                                <span class="slider-price">$<?= $meal->price ?></span>
                                <div><button class="btn-custom" onclick='addToCart(<?= json_encode($meal) ?>)'>Добавить в корзину</button></div>
                            </div>
                        </div>
                        <div class="image">
                            <img src="<?= $meal->image ?>">
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

            <?php foreach ($regularMeals as $meal) : ?>

                <div class="box">
                    <div class="image">
                        <img src="<?= $meal->image ?>">
                    </div>
                    <div class="content">
                        <div class="menu-title-container">
                            <span class="menu-title"><?= $meal->title ?></span>
                            <span class="price">$<?= $meal->price ?></span>
                        </div>
                        <p><?= $meal->description ?></p>
                        <button class="btn-custom" onclick='addToCart(<?= json_encode($meal) ?>)'>Добавить в корзину</button>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>

    </section>

    <section class="about" id="about">

        <h1 class="heading">О нас</h1>

        <div class="row">

            <div class="image">
                <img src="<?= $options->about_image ?>" alt="">
            </div>

            <div class="content">
                <h3><?= $options->about_title ?></h3>
                <p><?= nl2br($options->about_text) ?></p>
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

                <?php foreach ($reviews as $review) : ?>

                    <div class="swiper-slide slide">
                        <i class="fas fa-quote-right"></i>
                        <div class="user">
                            <img src="<?= $review->image ?>" alt="">
                            <div class="user-info">
                                <h3><?= $review->name ?></h3>
                                <div class="stars">
                                    <i class="fa-star star <?= $review->stars == 1 ? 'active' : '' ?>"></i>
                                    <i class="fa-star star <?= $review->stars == 2 ? 'active' : '' ?>"></i>
                                    <i class="fa-star star <?= $review->stars == 3 ? 'active' : '' ?>"></i>
                                    <i class="fa-star star <?= $review->stars == 4 ? 'active' : '' ?>"></i>
                                    <i class="fa-star star <?= $review->stars == 5 ? 'active' : '' ?>"></i>
                                </div>
                            </div>
                        </div>
                        <p><?= $review->text ?></p>
                    </div>

                <?php endforeach; ?>

            </div>

        </div>

        <div class="review-button-wrapper" onclick="showModal('review', this)">
            <button class="btn-custom">Оставить отзыв</button>
        </div>

        <?php
        Modal::open('Оставить отзыв', 'modal-review');
        Form::open('/add-review', 'POST', containFiles: true);
        echo '<div class="modal-body">';

        Form::field('Фото', 'review-image', ['type' => 'file', 'minimal' => true]);
        Form::field('Имя', 'review-name', ['minimal' => true]);
        Form::field('Отзыв', 'review-text', ['type' => 'textarea', 'rows' => 5, 'minimal' => true]);

        echo '<div class="form-group">';
        Form::hiddenField('review-stars', value: 5);
        echo '<div class="stars">
                    <i class="fa-star star" data-rate="1"></i>
                    <i class="fa-star star" data-rate="2"></i>
                    <i class="fa-star star" data-rate="3"></i>
                    <i class="fa-star star" data-rate="4"></i>
                    <i class="fa-star star active" data-rate="5"></i>
                </div>
            </div>
        </div>';

        Form::buttons('modal-submit');
        Form::end();
        Modal::end();
        ?>

    </section>

    <section class="order" id="order">

        <h1 class="heading">Заказать</h1>

        <div id="cart-wrapper"></div>

    </section>

    <section class="footer">

        <div class="box-container">

            <div class="box">
                <h3>Контактная информация</h3>
                <a href="tel:<?= $options->phone ?>"><?= $options->phone ?></a>
                <a href="mailto:<?= $options->email ?>"><?= $options->email ?></a>
            </div>

            <div class="box">
                <h3>Социальные сети</h3>
                <a href="<?= $options->facebook_link ?>">Facebook</a>
                <a href="<?= $options->instagram_link ?>">Instagram</a>
                <a href="<?= $options->vk_link ?>">ВКонтакте</a>
            </div>

        </div>

        <div class="credit"> Copyright @ 2021 by <span>Mr. Web Designer</span> </div>

    </section>

    <?php FlashMessage::show('home') ?>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
    <script src="/script.js"></script>

</body>

</html>