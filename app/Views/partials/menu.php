<?php
use App\Widgets\Form;
use App\Widgets\Modal;
?>
<div class="menu">

    <h3>Особые блюда</h3>
    <hr>

    <div class="box-container">

        <?php foreach ($specialMeals as $meal) : ?>

            <div class="box">
                <div class="image">
                    <img src="../<?= $meal->image ?>" alt="">
                </div>
                <div class="content">
                    <div class="menu-title-container">
                        <span class="menu-title"><?= $meal->title ?></span>
                        <span class="price">$<?= $meal->price ?></span>
                    </div>
                    <p><?= $meal->description ?></p>
                    <div class="btn-admin-container" data-id="<?= $meal->id ?>">
                        <button type="button" class="btn btn-danger btn-admin" onclick="showModal('delete', this)">
                            <i class="fa-solid fa-trash-can"></i> Удалить
                        </button>
                        <button type="button" class="btn btn-primary btn-admin" onclick="showModal('change', this)">
                            <i class="fa-solid fa-pencil"></i> Изменить
                        </button>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

        <button type="button" class="btn btn-secondary btn-admin-add" data-meal-type="special" onclick="showModal('add', this)">
            <i class="fa-solid fa-plus"></i> Добавить
        </button>

    </div>

    <h3>Основное меню</h3>
    <hr>

    <div class="box-container">

        <?php foreach ($regularMeals as $meal) : ?>

            <div class="box">
                <div class="image">
                    <img src="../<?= $meal->image ?>" alt="">
                </div>
                <div class="content">
                    <div class="menu-title-container">
                        <span class="menu-title"><?= $meal->title ?></span>
                        <span class="price">$<?= $meal->price ?></span>
                    </div>
                    <p><?= $meal->description ?></p>
                    <div class="btn-admin-container" data-id="<?= $meal->id ?>">
                        <button type="button" class="btn btn-danger btn-admin" onclick="showModal('delete', this)">
                            <i class="fa-solid fa-trash-can"></i> Удалить
                        </button>
                        <button type="button" class="btn btn-primary btn-admin" onclick="showModal('change', this)">
                            <i class="fa-solid fa-pencil"></i> Изменить
                        </button>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

        <button type="button" class="btn btn-secondary btn-admin-add" data-meal-type="regular" onclick="showModal('add', this)">
            <i class="fa-solid fa-plus"></i> Добавить
        </button>

    </div>
</div>

<?php

Modal::open('Вы уверены, что хотите удалить товар?', 'modal-delete');
Form::open('/delete-meal', 'POST');

Form::hiddenField('meal-id', 'delete-id');
Form::buttons('modal-delete');

Form::end();
Modal::end();

?>


<?php
Modal::open('Добавить товар', 'modal-add');
Form::open('', 'POST', containFiles: true, id: 'add-form');

echo '<div class="modal-body">';
Form::hiddenField('meal-id', 'change-id');
Form::hiddenField('meal-type');
Form::field('Название', 'meal-title', ['minimal' => true]);
Form::field('Описание', 'meal-description', ['type' => 'textarea', 'rows' => 4, 'minimal' => true]);
Form::field('Цена', 'meal-price', ['type' => 'number', 'step' => 0.01, 'minimal' => true]);
Form::field('Фото', 'meal-image', ['type' => 'file', 'minimal' => true]);
echo '</div>';

Form::buttons('modal-submit');

Form::end();
Modal::end();

?>