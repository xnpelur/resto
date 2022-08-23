<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $options->site_name ?></title>

    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">

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
        </div>

    </header>

    <section class="home" id="home">

        <div class="swiper-container home-slider">

            <div class="swiper-wrapper wrapper">

                <?php foreach ($specialCards as $card) : ?>

                    <div class="swiper-slide slide">
                        <div class="content">
                            <span>Наше особое блюдо</span>
                            <h3><?= $card->title ?></h3>
                            <p><?= $card->description ?></p>
                            <div class="slider-button-container">
                                <span class="slider-price">$<?= $card->price ?></span>
                                <div><a href="#" class="btn-custom">Добавить в корзину</a></div>
                            </div>
                        </div>
                        <div class="image">
                            <img src="<?= $card->image ?>">
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

            <?php foreach ($regularCards as $card) : ?>

                <div class="box">
                    <div class="image">
                        <img src="<?= $card->image ?>">
                    </div>
                    <div class="content">
                        <div class="menu-title-container">
                            <span class="menu-title"><?= $card->title ?></span>
                            <span class="price">$<?= $card->price ?></span>
                        </div>
                        <p><?= $card->description ?></p>
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

        <div class="modal top fade" id="modalReview" tabindex="-1" aria-labelledby="modalReviewLabel" aria-hidden="true" data-mdb-backdrop="true" data-mdb-keyboard="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalReviewLabel">Оставить отзыв</h5>
                    </div>
                    <form action="api/add-review.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="review-image">Фото</label>
                                <input type="file" class="form-control" id="review-image" name="review-image" required>
                            </div>
                            <div class="form-group">
                                <label for="eview-name">Имя</label>
                                <input type="text" class="form-control" id="review-name" name="review-name" required>
                            </div>
                            <div class="form-group">
                                <label for="review-text">Отзыв</label>
                                <textarea class="form-control" id="review-text" name="review-text" rows="5" required></textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" class="hidden" name="review-stars" id="review-stars" value="5">
                                <div class="stars">
                                    <i class="fa-star star" data-rate="1"></i>
                                    <i class="fa-star star" data-rate="2"></i>
                                    <i class="fa-star star" data-rate="3"></i>
                                    <i class="fa-star star" data-rate="4"></i>
                                    <i class="fa-star star active" data-rate="5"></i>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Отмена
                            </button>
                            <button type="submit" class="btn btn-primary" id="add-form-submit">Подтвердить</button>
                        </div>
                    </form>
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

    <!-- <?php if (isset($_SESSION['alert_message_index'])) : ?>

    <div class="alert alert-message alert-<?= $_SESSION['alert_message_type_index'] ?>" role="alert">
        <?= $_SESSION['alert_message_index'] ?>
    </div>
    <script>
        setTimeout(() => {
            $('.alert-message').addClass('transparent');
        }, 3000);
    </script>

    <?php
                unset($_SESSION['alert_message_index']);
                unset($_SESSION['alert_message_type_index']);
            endif;
    ?> -->

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
    <script src="/js/script.js"></script>

</body>

</html>