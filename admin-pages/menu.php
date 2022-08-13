<?php

require_once('../utils.php');
$db = require('../database.php');

session_start();

$cards = $db->query('SELECT * FROM menu');

if (isset($_SESSION['upload_message'])) {
    $message = $_SESSION['upload_message'];
    $message_type = $_SESSION['upload_message_type'];
    unset($_SESSION['upload_message']);
}

if (isset($_POST['card-title'])) {
    
    if ($path = upload_image($_FILES['card-image'])) {
        $sql = $db->prepare('INSERT INTO menu (title, description, price, image) VALUES (?, ?, ?, ?)');
        $sql->bind_param('ssss', $title, $description, $price, $image);

        $title = $_POST['card-title'];
        $description = $_POST['card-description'];
        $price = $_POST['card-price'];
        $image = $path;

        $sql->execute();

        $_SESSION['upload_message'] = 'Блюдо успешно добавлено в меню';
        $_SESSION['upload_message_type'] = 'success';
    } else {
        $_SESSION['upload_message'] = 'Во время загрузки изорбражения возникла ошибка, попробуйте позже';
        $_SESSION['upload_message_type'] = 'danger';
    }

    header('Location: ./');
}

?>

<div class="menu">

    <?php if (isset($message)): ?>
        <div class="alert alert-message alert-<?=$message_type?>" role="alert">
            <?=$message?>
        </div>
    <?php endif; ?>

    <div class="box-container">

        <?php foreach ($cards as $card): ?>

        <div class="box">
            <div class="image">
                <img src="../<?=$card['image']?>" alt="">
            </div>
            <div class="content">
                <div class="menu-title-container">
                    <span class="menu-title"><?=$card['title']?></span>
                    <span class="price">$<?=$card['price']?></span>
                </div>
                <p><?=$card['description']?></p>
                <div class="btn-admin-container">
                    <button type="button" class="btn btn-danger btn-admin" data-bs-toggle="modal" data-bs-target="#modalDelete" data-card-id="<?=$card['id']?>" onclick="setDeleteButton(this)">
                        <i class="fa-solid fa-trash-can"></i> Удалить
                    </button>
                    <button type="button" class="btn btn-primary btn-admin">
                        <i class="fa-solid fa-pencil"></i> Изменить
                    </button>
                </div>
            </div>
        </div>

        <?php endforeach; ?>

        <button type="button" class="btn btn-secondary btn-admin-add" style="opacity: 0.5" data-bs-toggle="modal" data-bs-target="#modalAdd">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Отмена
                </button>
                <button type="button" class="btn btn-danger" id="delete-card-button" onclick="deleteCard()">Удалить</button>
            </div>
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
            <form action="./" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="card">Название</label>
                        <input type="text" class="form-control" name="card-title" id="card-title" required>
                    </div>
                    <div class="form-group">
                        <label for="card-description">Описание</label>
                        <textarea class="form-control" name="card-description" id="card-description" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="card-price">Цена</label>
                        <input type="number" class="form-control" name="card-price" id="card-price" step=0.01 required>
                    </div>
                    <div class="form-group">
                        <label for="card-image">Фото</label>
                        <input type="file" class="form-control" name="card-image" id="card-image" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Отмена
                    </button>
                    <button type="submit" class="btn btn-primary">Подтвердить</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../js/menu.js"></script>