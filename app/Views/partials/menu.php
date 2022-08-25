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

<!-- Modal-Delete -->
<div class="modal top fade modal-delete" id="modal-delete" tabindex="-1" aria-labelledby="modal-delete-label" aria-hidden="true" data-mdb-backdrop="true" data-mdb-keyboard="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-delete-label">Вы уверены, что хотите удалить товар?</h5>
            </div>
            <?php
            $form = new App\Widgets\Form('/delete-meal', 'POST', isModal: true);

            $form->hiddenField('meal-id', 'delete-id');
            $form->buttons('modal-delete');

            $form->end();
            ?>
        </div>
    </div>
</div>

<!-- Modal-Add/Change -->
<div class="modal top fade modal-add" id="modal-add" tabindex="-1" aria-labelledby="modal-add-label" aria-hidden="true" data-mdb-backdrop="true" data-mdb-keyboard="true">
    <div class="modal-dialog modal-md ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-add-label">Добавить товар</h5>
            </div>
            <?php
            $form = new App\Widgets\Form('', 'POST', containFiles: true, id: 'add-form', isModal: true);
            echo '<div class="modal-body">';

            $form->hiddenField('meal-id', 'change-id');
            $form->hiddenField('meal-type');
            $form->field('Название', 'meal-title');
            $form->field('Описание', 'meal-description', ['type' => 'textarea', 'rows' => 4]);
            $form->field('Цена', 'meal-price', ['type' => 'number', 'step' => 0.01]);
            $form->field('Фото', 'meal-image', ['type' => 'file']);

            echo '</div>';
            $form->buttons('modal-submit');

            $form->end();
            ?>
        </div>
    </div>
</div>