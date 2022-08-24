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
            <!-- <form action="/delete-review" method="POST">
                <input type="text" class="hidden" name="review-id" value="<?= $review->id ?>">
                <button type="submit" class="btn btn-danger">Удалить</button>
            </form> -->
            <div data-id="<?=$review->id?>">
                <button class="btn btn-danger" onclick="showModal('delete', this)">Удалить</button>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Modal-Delete -->
<div class="modal top fade modal-delete" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true" data-mdb-backdrop="true" data-mdb-keyboard="true">
    <div class="modal-dialog modal-md ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteLabel">Вы уверены, что хотите удалить отзыв?</h5>
            </div>
            <form action="/delete-review" method="POST">
                <input type="text" class="hidden" name="review-id" id="delete-id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Отмена
                    </button>
                    <button type="submit" class="btn btn-danger" id="delete-meal-button">Удалить</button>
                </div>
            </form>
        </div>
    </div>
</div>