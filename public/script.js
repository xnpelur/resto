let section = $('section').toArray();
let navLinks = $('header .navbar a').toArray();
let menuBars = $('#menu-bars');
let navbar = $('.navbar');

if (typeof(Swiper) !== 'undefined') {
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

    window.onscroll = () => {
        menuBars.removeClass('fa-times');
        navbar.removeClass('active');
    
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
}

function toggleMenu() {
    $('#menu-bars').toggleClass('fa-times');
    $('.navbar').toggleClass('active');
};

function fadeAllAlerts() {
    setTimeout(() => {
        $('.alert-message').addClass('transparent');
    }, 3000);
}

fadeAllAlerts();

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
            document.getElementById('page-title').textContent = pageTitles[page];
            resetActivePage();
            button.classList.add('active');
            fadeAllAlerts();
        },
        error: function (err) {
            console.log(err);
        },
    });
}

function showModal(modalType, button) {
    switch (modalType) {
        case 'review':
            $('#modal-review').modal('show');
            break;

        case 'add':
            $('#modal-add-label').text('Добавить товар');
            $('#meal-image')[0].required = true;
            $('#add-form').attr('action', '/add-meal');
            $('#meal-type').val(button.dataset.mealType);

            $('#meal-title')[0].value = '';
            $('#meal-description')[0].value = '';
            $('#meal-price')[0].value = '';

            $('#modal-add').modal('show');
            break;

        case 'change':
            $.ajax({
                type: 'GET',
                url: '/get-meal',
                data: { id: button.parentNode.dataset.id },
                success: function (response) {
                    responseData = JSON.parse(response);
                    $('#change-id').val(button.parentNode.dataset.id);
                    $('#meal-title').val(responseData.title);
                    $('#meal-description').val(responseData.description);
                    $('#meal-price').val(responseData.price);

                    $('#modal-add-label').text('Изменить товар');
                    $('#meal-image')[0].required = false;
                    $('#add-form').attr('action', '/change-meal');

                    $('#modal-add').modal('show');
                },
                error: function (err) {
                    console.log(err);
                },
            });
            break;

        case 'delete':
            $('#modal-delete').modal('show');
            $('#delete-id').val(button.parentNode.dataset.id);
            break;
    }
}

function reloadPage() {
    location.reload();
}