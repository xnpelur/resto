let el = document.getElementById("wrapper");
let toggleButton = document.getElementById("menu-toggle");
let alertEl = document.getElementsByClassName('alert')[0];
let mainWrapper = document.getElementById("main-content-wrapper");

toggleButton.onclick = function () {
    el.classList.toggle("toggled");
};

if (alertEl) {
    setTimeout(() => {
        alertEl.classList.add('transparent');
    }, 5000);
}

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
            mainWrapper.innerHTML = response;
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
            setupModal(modalType);
            $('#modalAdd').modal('show');
            $('#card-title')[0].value = '';
            $('#card-description')[0].value = '';
            $('#card-price')[0].value = '';
            break;

        case 'change':
            $.ajax({
                type: 'GET',
                url: '../api/get-card.php',
                data: { id: button.parentNode.dataset.cardId },
                success: function (response) {
                    responseData = JSON.parse(response);
                    $('#card-title')[0].value = responseData.title;
                    $('#card-description')[0].value = responseData.description;
                    $('#card-price')[0].value = responseData.price;

                    setupModal(modalType);
                    $('#modalAdd').modal('show');

                    sessionStorage.setItem('cardToChange', button.parentNode.dataset.cardId);
                },
                error: function (err) {
                    console.log(err);
                }
            });
            break;

        case 'delete':
            $('#modalDelete').modal('show');
            sessionStorage.setItem('cardToDelete', button.parentNode.dataset.cardId);
            break;
    }
}

function setupModal(modalType) {
    if (modalType === 'add') {
        $('#modalAddLabel').text('Добавить товар');
        $('#card-image')[0].required = true;
        $('#add-form-submit')[0].type = 'submit';
        $('#add-form-submit').off('click');
    } else {
        $('#modalAddLabel').text('Изменить товар');
        $('#card-image')[0].required = false;
        $('#add-form-submit')[0].type = 'button';
        $('#add-form-submit').bind('click', changeCard);
    }
}

// function changeCard() {
//     let postData = {
//         'cardId': sessionStorage.getItem('cardToChange'),
//         'cardTitle': $('#card-title')[0].value,
//         'cardTitle': $('#card-description')[0].value,
//         'cardPrice': $('#card-price')[0].value,
//     }
//     sessionStorage.removeItem('cardToChange');
//     $.ajax({
//         type: 'POST',
//         url: '../api/change-card.php',
//         data: { id: cardId },
//         success: function (response) {
//             console.log(response);
//             // location.reload();
//         },
//         error: function (err) {
//             console.log(err);
//         }
//     });
// }

function deleteCard() {
    let cardId = sessionStorage.getItem('cardToDelete');
    sessionStorage.removeItem('cardToDelete');
    $.ajax({
        type: 'POST',
        url: '../api/delete-card.php',
        data: { id: cardId },
        success: function () {
            location.reload();
        },
        error: function (err) {
            console.log(err);
        }
    });
};