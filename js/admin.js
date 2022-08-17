let wrapper = $('#wrapper');
let toggleButton = $("#menu-toggle");
let mainWrapper = $("#main-content-wrapper");

toggleButton.click(function () {
    wrapper.toggleClass("toggled");
});

function resetActivePage() {
    let buttons = Array.from(document.getElementById('page-buttons').children);
    buttons.forEach(button => {
        button.classList.remove('active');
    });
}

function showPage(button) {
    let pageTitles = {
        'orders': 'Заказы',
        'menu': 'Меню',
        'settings': 'Настройки'
    }

    let page = button.dataset.page;
    sessionStorage.setItem('adminPage', page);

    $.ajax({
        type: "GET",
        url: '../admin-pages/' + page + '.php',
        success: function (response) {
            mainWrapper.html(response);
            document.getElementById('page-title').textContent = pageTitles[page];
            resetActivePage();
            button.classList.add('active');
        },
        error: function (err) {
            console.log(err);
        }
    });
}

if (mainWrapper) {
    let page = 'orders';
    if (sessionStorage.getItem('adminPage')) {
        page = sessionStorage.getItem('adminPage');
    }
    
    let firstPageButton = $('[data-page=' + page + ']')[0];
    showPage(firstPageButton);
}

function showModal(modalType, button) {
    switch (modalType) {

        case 'add':
            $('#modalAddLabel').text('Добавить товар');
            $('#card-image')[0].required = true;
            $('#add-form').attr('action', '../api/add-card.php');
            $('#card-type').val(button.dataset.cardType);

            $('#card-title')[0].value = '';
            $('#card-description')[0].value = '';
            $('#card-price')[0].value = '';

            $('#modalAdd').modal('show');
            break;

        case 'change':
            $.ajax({
                type: 'GET',
                url: '../api/get-card.php',
                data: { id: button.parentNode.dataset.cardId },
                success: function (response) {
                    responseData = JSON.parse(response);
                    $('#card-id-change').val(button.parentNode.dataset.cardId);
                    $('#card-title').val(responseData.title);
                    $('#card-description').val(responseData.description);
                    $('#card-price').val(responseData.price);

                    $('#modalAddLabel').text('Изменить товар');
                    $('#card-image')[0].required = false;
                    $('#add-form').attr('action', '../api/change-card.php');
                    
                    $('#modalAdd').modal('show');
                },
                error: function (err) {
                    console.log(err);
                }
            });
            break;

        case 'delete':
            $('#modalDelete').modal('show');
            $('#card-id-delete').val(button.parentNode.dataset.cardId);
            break;
    }
}