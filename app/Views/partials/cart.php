<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col" width="12%">Фото</th>
            <th scope="col" width="28%">Название</th>
            <th scope="col" width="10%">Количество</th>
            <th scope="col" width="20%">Цена</th>
            <th scope="col" width="30%">Управление</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cart as $meal) : ?>
            <tr data-meal-id=<?= $meal->id ?>>
                <th><img src="<?= $meal->image ?>"></th>
                <td><?= $meal->title ?></td>
                <td>
                    <?= $meal->count ?>
                    <div class="count-buttons">
                        <i class="fas fa-minus" onclick="changeCount(this, '-')"></i>
                        <i class="fas fa-plus" onclick="changeCount(this, '+')"></i>
                    </div>
                </td>
                <td>$<?= $meal->price * $meal->count ?></td>
                <td><button type="button" class='btn btn-danger' onclick="deleteCartMeal(this)">Удалить</button></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>