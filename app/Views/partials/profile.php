<?php use App\Widgets\Form; ?>
<div class="options">
    <?php
    Form::open('/set-admin', 'POST');

    Form::field('Логин', 'admin-login', ['value' => $profile->login]);
    Form::field('Новый пароль', 'admin-password', ['type' => 'password', 'required' => false]);
    Form::field('Подтвердите новый пароль', 'admin-password-confirm', ['type' => 'password', 'required' => false]);

    Form::buttons('form-submit');
    
    Form::end();
    ?>
</div>