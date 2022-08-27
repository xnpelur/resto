<?php

use App\Widgets\FlashMessage;
use App\Widgets\Form; ?>
<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="../favicon.png" type="image/x-icon">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
	<link rel="stylesheet" href="/style.css">
	<title>Войти как администратор</title>
</head>

<body>

	<div class="login-wrapper">

		<a href="../" class="logo"><i class="fas fa-utensils"></i>resto</a>

		<?php

		Form::open('/login', 'POST');

		Form::field('Логин', 'login', ['minimal' => true]);
		Form::field('Пароль', 'password', ['type' => 'password', 'minimal' => true]);
		FlashMessage::showError('login');
		
		Form::buttons('login-button', ['minimal' => true]);

		Form::end();
		?>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
	<script src="/script.js"></script>

</body>

</html>