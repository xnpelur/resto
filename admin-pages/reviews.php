<?php

$db = require('../database.php');
$reviews = $db->query('SELECT * FROM reviews');

?>

<div class="review">

    <?php foreach ($reviews as $review) : ?>

        <div class="swiper-slide slide admin-review">
            <i class="fas fa-quote-right"></i>
            <div class="user">
                <img src="../<?= $review['image'] ?>" alt="">
                <div class="user-info">
                    <h3><?= $review['name'] ?></h3>
                    <div class="stars">
                        <i class="fa-star star <?= $review['stars'] == 1 ? 'active' : '' ?>"></i>
                        <i class="fa-star star <?= $review['stars'] == 2 ? 'active' : '' ?>"></i>
                        <i class="fa-star star <?= $review['stars'] == 3 ? 'active' : '' ?>"></i>
                        <i class="fa-star star <?= $review['stars'] == 4 ? 'active' : '' ?>"></i>
                        <i class="fa-star star <?= $review['stars'] == 5 ? 'active' : '' ?>"></i>
                    </div>
                </div>
            </div>
            <p><?= $review['text'] ?></p>
            <form action="../api/delete-review.php" method="POST">
                <input type="text" class="hidden" name="review-id" value="<?= $review['id'] ?>">
                <button type="submit" class="btn btn-danger">Удалить</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>