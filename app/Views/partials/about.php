<?php use App\Widgets\Form; ?>
<div class="options">
    <?php
    Form::open('/set-options', 'POST', true);

    Form::field('Фото', 'about-image', ['type' => 'file', 'required' => false]);
    Form::field('Заголовок', 'about-title', ['value' => $options->about_title]);
    Form::field('Текст', 'about-text', ['value' => $options->about_text, 'type' => 'textarea', 'rows' => 8]);

    Form::buttons('form-submit');

    Form::end();
    ?>
</div>