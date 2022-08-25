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
            <div data-id="<?=$review->id?>">
                <button class="btn btn-danger" onclick="showModal('delete', this)">Удалить</button>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Modal-Delete -->
<div class="modal top fade modal-delete" id="modal-delete" tabindex="-1" aria-labelledby="modal-delete-label" aria-hidden="true" data-mdb-backdrop="true" data-mdb-keyboard="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-delete-label">Вы уверены, что хотите удалить отзыв?</h5>
            </div>
            <?php
            $form = new App\Widgets\Form('/delete-review', 'POST', isModal: true);
            
            $form->hiddenField('review-id', 'delete-id');
            $form->buttons('modal-delete');

            $form->end();
            ?>
        </div>
    </div>
</div>