<div class="settings-container">
    <form action="../api/set-about.php" method="POST">
        <div class="settings-row">
            <label for="card">Заголовок</label>
            <input type="text" class="form-control" id="about-title" name="about-title" value="<?= $options->about_title ?>" required>
        </div>
        <hr>
        <div class="settings-row">
            <label for="card">Текст</label>
            <textarea class="form-control" id="about-text" name="about-text" rows="8" required><?= $options->about_text ?></textarea>
        </div>
        <hr>
        <div class="settings-buttons">
            <button type="button" class="btn btn-light" onclick="reloadPage()">Отменить</button>
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    </form>
</div>