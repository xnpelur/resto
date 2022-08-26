<?php use App\Widgets\Form; ?>
<div class="options">
    <?php
    Form::open('/set-options', 'POST');

    Form::field('Название', 'options-name', ['value' => $options->site_name]);
    Form::field('Телефонный номер', 'options-phone', ['value' => $options->phone]);
    Form::field('Email', 'options-email', ['value' => $options->email]);
    Form::field('Ссылка на Facebook', 'options-facebook', ['value' => $options->facebook_link]);
    Form::field('Ссылка на Instagram', 'options-instagram', ['value' => $options->instagram_link]);
    Form::field('Ссылка на Вконтакте', 'options-vk', ['value' => $options->vk_link]);

    Form::buttons('form-submit');
    
    Form::end();
    ?>
</div>