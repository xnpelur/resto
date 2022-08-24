<form action="/set-options" method="POST">
    <div class="settings-container">
        <label for="about-title">Заголовок</label>
        <input type="text" class="form-control" id="about-title" name="about-title" value="<?= $options->about_title ?>" required>
        <hr>
        <label for="about-text">Текст</label>
        <textarea class="form-control" id="about-text" name="about-text" rows="8" required><?= $options->about_text ?></textarea>
        <hr>
    </div>
    <div class="settings-buttons">
        <button type="button" class="btn btn-light" onclick="reloadPage()">Отменить</button>
        <button type="submit" class="btn btn-success">Сохранить</button>
    </div>
</form>