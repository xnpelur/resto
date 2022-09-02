let section = $('section').toArray();
let navLinks = $('header .navbar a').toArray();
let menuBars = $('#menu-bars');
let navbar = $('.navbar');

fadeAllAlerts();
updateCart();

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
                    $('header .navbar a[href*=' + id + ']').addClass('active');
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
    let buttons = $('#page-buttons').children().toArray();
    
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
        type: 'POST',
        url: '/partial',
        data: { name: page },
        success: function (response) {
            $('#main-content-wrapper').html(response);
            $('#page-title').text(pageTitles[page]);
            resetActivePage();
            button.classList.add('active');
            fadeAllAlerts();
        },
        error: function (err) {
            console.log(err);
        },
    });
}

function showModal(modalType, button = null) {
    switch (modalType) {
        case 'review':
            $('#modal-review').modal('show');
            break;

        case 'order':
            $('#modal-order').modal('show');
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
                type: 'POST',
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

function addToCart(meal) {
    $.ajax({
        type: 'POST',
        url: '/add-to-cart',
        data: { 
            id: meal['id'],
            title: meal['title'],
            description: meal['description'],
            price: meal['price'],
            image: meal['image'],
        },
        success: function () {
            updateCart();
        },
        error: function (err) {
            console.log(err);
        },
    });
}

function updateCart()
{
    $.ajax({
        type: 'POST',
        url: '/get-cart',
        success: function (response) {
            $('#cart-wrapper').html(response);
            getCartTotalAmount();
            getCartTotalSum();
        },
        error: function (err) {
            console.log(err);
        },
    });
}

function getCartTotalAmount()
{
    $.ajax({
        type: 'POST',
        url: '/get-cart-total-amount',
        success: function (response) {
            $('.cart-count').text(response);
            if (parseInt(response) === 0) {
                $('.empty-cart').removeClass('hidden');
                $('.filled-cart').addClass('hidden');
            } else {
                $('.empty-cart').addClass('hidden');
                $('.filled-cart').removeClass('hidden');
            }
        },
        error: function (err) {
            console.log(err);
        },
    });
}

function getCartTotalSum()
{
    $.ajax({
        type: 'POST',
        url: '/get-cart-total-sum',
        success: function (response) {
            $('.cart-sum').text(response);
        },
        error: function (err) {
            console.log(err);
        },
    });
}

function changeCount(button, operator)
{
    let number = 0;
    if (operator === '+') {
        number = 1;
    } else if (operator === '-') {
        number = -1;
    }
    
    $.ajax({
        type: 'POST',
        url: '/change-cart-count',
        data: {
            'id': button.parentNode.parentNode.parentNode.dataset.mealId,
            'number': number
        },
        success: function () {
            updateCart();
        },
        error: function (err) {
            console.log(err);
        },
    });
}

function deleteCartMeal(button)
{
    $.ajax({
        type: 'POST',
        url: '/delete-cart-meal',
        data: {
            'id': button.parentNode.parentNode.dataset.mealId
        },
        success: function () {
            updateCart();
        },
        error: function (err) {
            console.log(err);
        },
    });
}

function deleteOrder(id) {
    $.ajax({
        type: 'POST',
        url: '/delete-order',
        data: {
            'id': id
        },
        success: function () {
            initAdminPages();
        },
        error: function (err) {
            console.log(err);
        },
    });
}