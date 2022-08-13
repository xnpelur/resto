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
    let firstPageButton = document.querySelector('[data-page]');
    showPage(firstPageButton);
}

function setDeleteButton(button) {
    document.getElementById('delete-card-button').dataset.cardId = button.dataset.cardId;
}

function deleteCard() {
    $.ajax({
        type: "POST",
        url: "../delete-card.php",
        data: {
            id: document.getElementById('delete-card-button').dataset.cardId
        },
        success: function () {
            showPage(document.querySelector('[data-page="menu"]'));
        },
        error: function (err) {
            console.log(err);
        }
    });
};