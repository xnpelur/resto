<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <title>Панель администратора</title>
</head>

<body id="admin-panel">
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="list-group list-group-flush my-3">
                
                <a href="../" class="logo"><i class="fas fa-utensils"></i>resto</a>
            
                <div class="menu-pages" id="page-buttons">
                    <button class="list-group-item list-group-item-action bg-transparent second-text fw-bold" data-page="orders" onclick="showPage(this)" id="first-page-button">
                        <i class="fa-solid fa-address-card"></i> Заказы
                    </button>
                    <button class="list-group-item list-group-item-action bg-transparent second-text fw-bold" data-page="menu"  onclick="showPage(this)">
                        <i class="fa-solid fa-cart-shopping"></i> Меню
                    </button>
                    <button class="list-group-item list-group-item-action bg-transparent second-text fw-bold" data-page="settings" onclick="showPage(this)">
                        <i class="fa-solid fa-gear"></i> Настройки
                    </button>
                </div>

                <a href="" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold">
                    <i class="fa-solid fa-power-off"></i> Выйти
                </a>
            </div>
        </div>
        
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0" id="page-title"></h2> 
                </div>

                <span class="admin-name"><i class="fas fa-user me-2"></i>Администратор</span>
            </nav>

            <div id="main-content-wrapper"></div>

        </div>
    </div>
    
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
    <script src="../js/admin.js"></script>
</body>

</html>