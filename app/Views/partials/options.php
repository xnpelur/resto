<form action="/set-options" method="POST">
    <div class="settings-container">
        <label for="options-name">Название</label>
        <input type="text" class="form-control" id="options-name" name="options-name" value="<?= $options->site_name ?>" required>
        <hr>
        <label for="options-phone">Телефонные номера</label>
        <input type="text" class="form-control" id="options-phone" name="options-phone" value="<?= $options->phone ?>" required>
        <hr>
        <label for="options-email">Email</label>
        <input type="text" class="form-control" id="options-email" name="options-email" value="<?= $options->email ?>" required>
        <hr>
        <label for="options-facebook">Ссылка на Facebook</label>
        <input type="text" class="form-control" id="options-facebook" name="options-facebook" value="<?= $options->facebook_link ?>" required>
        <hr>
        <label for="options-instagram">Ссылка на Instagram</label>
        <input type="text" class="form-control" id="options-instagram" name="options-instagram" value="<?= $options->instagram_link ?>" required>
        <hr>
        <label for="options-vk">Ссылка на Вконтакте</label>
        <input type="text" class="form-control" id="options-vk" name="options-vk" value="<?= $options->vk_link ?>" required>
        <hr>
    </div>
    <div class="settings-buttons">
        <button type="button" class="btn btn-light" onclick="reloadPage()">Отменить</button>
        <button type="submit" class="btn btn-success">Сохранить</button>
    </div>
</form>