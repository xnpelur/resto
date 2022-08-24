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
<div class="modal top fade modal-delete" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true" data-mdb-backdrop="true" data-mdb-keyboard="true">
    <div class="modal-dialog modal-md ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteLabel">Вы уверены, что хотите удалить товар?</h5>
            </div>
            <form action="/delete-meal" method="POST">
                <input type="text" class="hidden" name="meal-id" id="delete-id">
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

<!-- Modal-Add/Change -->
<div class="modal top fade modal-add" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true" data-mdb-backdrop="true" data-mdb-keyboard="true">
    <div class="modal-dialog modal-md ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddLabel">Добавить товар</h5>
            </div>
            <form id="add-form" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="text" class="hidden" name="meal-id" id="meal-id-change">
                    <input type="text" class="hidden" name="meal-type" id="meal-type">
                    <div class="form-group">
                        <label for="meal">Название</label>
                        <input type="text" class="form-control" id="meal-title" name="meal-title" required>
                    </div>
                    <div class="form-group">
                        <label for="meal-description">Описание</label>
                        <textarea class="form-control" id="meal-description" name="meal-description" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="meal-price">Цена</label>
                        <input type="number" class="form-control" id="meal-price" name="meal-price" step=0.01 required>
                    </div>
                    <div class="form-group">
                        <label for="meal-image">Фото</label>
                        <input type="file" class="form-control" id="meal-image" name="meal-image" required>
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