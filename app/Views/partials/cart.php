<form action="">

    <?php if (count($cart) === 0) : ?>
        <div class="empty-cart">
            <h3>В вашей корзине пусто</h3>
            <a href="#menu" class="btn-custom">Перейти к меню</a>
        </div>
    <?php else : ?>
        <!-- <pre>
        <?php var_dump($cart); ?>
        </pre> -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" width="12%">Фото</th>
                    <th scope="col" width="28%">Название</th>
                    <th scope="col" width="10%">Количество</th>
                    <th scope="col" width="20%">Цена</th>
                    <th scope="col" width="30%"></th>
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
    <?php endif; ?>

    <!-- <div class="inputBox">
            <div class="input">
                <span>Ваше имя</span>
                <input type="text" placeholder="enter your name">
            </div>
        </div>
        <div class="inputBox">
            <div class="input">
                <span>Ваш номер телефона</span>
                <input type="text" placeholder="enter food name">
            </div>
        </div>
        <div class="inputBox">
            <div class="input">
                <span>Ваш адрес</span>
                <input type="number" placeholder="how many orders">
            </div>
        </div>
        <div class="inputBox">
            <div class="input">
                <span>Ваш заказ</span>
                <textarea name="" placeholder="enter your message" id="" cols="30" rows="10"></textarea>
            </div>
        </div>

        <input type="submit" value="order now" class="btn-custom"> -->



</form>