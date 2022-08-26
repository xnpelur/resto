<?php
use App\Widgets\Form;
use App\Widgets\Modal;
?>
<div class="review">
    <?php foreach ($reviews as $review) : ?>

        <div class="swiper-slide slide admin-review">
            <i class="fas fa-quote-right"></i>
            <div class="user">
                <img src="../<?= $review->image ?>" alt="">
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
            <div data-id="<?= $review->id ?>">
                <button class="btn btn-danger" onclick="showModal('delete', this)">Удалить</button>
            </div>
        </div>
    <?php endforeach; ?>
</div>


<?php
Modal::open('Вы уверены, что хотите удалить товар?', 'modal-delete');
Form::open('/delete-review', 'POST');

Form::hiddenField('review-id', 'delete-id');
Form::buttons('modal-delete');

Form::end();
Modal::end();
?>