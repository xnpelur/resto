<div class="options">
    <?php
    $form = new App\Widgets\Form('/set-options', 'POST');

    $form->field('Название', 'options-name', ['value' => $options->site_name]);
    $form->field('Телефонный номер', 'options-phone', ['value' => $options->phone]);
    $form->field('Email', 'options-email', ['value' => $options->email]);
    $form->field('Ссылка на Facebook', 'options-facebook', ['value' => $options->facebook_link]);
    $form->field('Ссылка на Instagram', 'options-instagram', ['value' => $options->instagram_link]);
    $form->field('Ссылка на Вконтакте', 'options-vk', ['value' => $options->vk_link]);

    $form->buttons('form-submit');
    
    $form->end();
    ?>
</div>