<div class="settings-container">
    <form action="../api/set-options.php" method="POST">
        <div class="settings-row">
            <label for="card">Название</label>
            <input type="text" class="form-control" id="options-name" name="options-name" value="<?= $options->site_name ?>" required>
        </div>
        <hr>
        <div class="settings-row">
            <label for="card">Телефонные номера</label>
            <input type="text" class="form-control" id="options-phone" name="options-phone" value="<?= $options->phone ?>" required>
        </div>
        <hr>
        <div class="settings-row">
            <label for="card">Email</label>
            <input type="text" class="form-control" id="options-email" name="options-email" value="<?= $options->email ?>" required>
        </div>
        <hr>
        <div class="settings-row">
            <label for="card">Ссылка на Facebook</label>
            <input type="text" class="form-control" id="options-facebook" name="options-facebook" value="<?= $options->facebook_link ?>" required>
        </div>
        <hr>
        <div class="settings-row">
            <label for="card">Ссылка на Instagram</label>
            <input type="text" class="form-control" id="options-instagram" name="options-instagram" value="<?= $options->instagram_link ?>" required>
        </div>
        <hr>
        <div class="settings-row">
            <label for="card">Ссылка на Вконтакте</label>
            <input type="text" class="form-control" id="options-vk" name="options-vk" value="<?= $options->vk_link ?>" required>
        </div>
        <hr>
        <div class="settings-buttons">
            <button type="button" class="btn btn-light" onclick="reloadPage()">Отменить</button>
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    </form>
</div>