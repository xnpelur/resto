let menu = document.querySelector('#menu-bars');
let navbar = document.querySelector('.navbar');

function toggleMenu() {
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
};

let section = document.querySelectorAll('section');
let navLinks = document.querySelectorAll('header .navbar a');

window.onscroll = () => {
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');

    section.forEach((sec) => {
        let top = window.scrollY;
        let height = sec.offsetHeight;
        let offset = sec.offsetTop - 150;
        let id = sec.getAttribute('id');

        if (top >= offset && top < offset + height) {
            navLinks.forEach((links) => {
                links.classList.remove('active');
                document
                    .querySelector('header .navbar a[href*=' + id + ']')
                    .classList.add('active');
            });
        }
    });
};

var swiper = new Swiper('.home-slider', {
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
        delay: 7500,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    loop: true,
});

var swiper = new Swiper('.review-slider', {
    spaceBetween: 20,
    centeredSlides: true,
    autoplay: {
        delay: 7500,
        disableOnInteraction: false,
    },
    loop: true,
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        640: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 2,
        },
        1024: {
            slidesPerView: 3,
        },
    },
});

$('.star').click((event) => {
    $('.form-group .star').removeClass('active');
    event.currentTarget.classList.add('active');
    $('#review-stars').val(event.currentTarget.dataset.rate);
});

function toggleSidebar() {
    $('#wrapper').toggleClass('toggled');
}

function initAdminPages() {
    let page = sessionStorage.getItem('adminPage') ?? 'orders';
    let pageButton = $('[data-page=' + page + ']')[0];
    showPage(pageButton);
}

function resetActivePage() {
    let buttons = Array.from(document.getElementById('page-buttons').children);
    buttons.forEach((button) => {
        button.classList.remove('active');
    });
}

function showPage(button) {
    let pageTitles = {
        orders: 'Заказы',
        menu: 'Меню',
        reviews: 'Отзывы',
        about: 'О нас',
        options: 'Настройки',
        profile: 'Профиль',
    };

    let page = button.dataset.page;
    sessionStorage.setItem('adminPage', page);

    $.ajax({
        type: 'GET',
        url: 'partial?name=' + page,
        success: function (response) {
            $('#main-content-wrapper').html(response);

            // if (page === 'options') {
            //     getOptionValues();
            // } else if (page === 'about') {
            //     getAboutValues();
            // }

            document.getElementById('page-title').textContent = pageTitles[page];
            resetActivePage();
            button.classList.add('active');
        },
        error: function (err) {
            console.log(err);
        },
    });
}

function showModal(modalType, button) {
    switch (modalType) {
        case 'review':
            $('#modalReview').modal('show');
            break;

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
                },
            });
            break;

        case 'delete':
            $('#modalDelete').modal('show');
            $('#card-id-delete').val(button.parentNode.dataset.cardId);
            break;
    }
}

function reloadPage() {
    location.reload();
}