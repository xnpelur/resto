<div class="container-fluid px-4">

    <div class="row my-5">
        <h3 class="fs-4 mb-3">Последние заказы</h3>
        <div class="col">
            <div class="bg-white rounded shadow-sm table-wrapper">
                <table class="table table-hover table-borderless order-table">
                    <thead>
                        <tr>
                            <th scope="col" width="10%">Имя</th>
                            <th scope="col" width="12%">Телефон</th>
                            <th scope="col" width="25%">Адрес</th>
                            <th scope="col" width="30%">Заказ</th>
                            <th scope="col" width="10%">Цена</th>
                            <th scope="col" width="13%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order) : ?>
                            <tr>
                                <td><?= $order->name ?></td>
                                <td><?= $order->phone ?></td>
                                <td><?= $order->adress ?></td>
                                <td><?= str_replace(', ', '<br>', $order->text) ?></td>
                                <td>$<?= $order->sum ?></td>
                                <td class="btn-wrapper"><button class="btn btn-success" onclick="deleteOrder(<?= $order->id ?>)">Готово</button></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>