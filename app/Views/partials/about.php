<div class="options">
    <?php
    $form = new App\Widgets\Form('/set-options', 'POST', true);

    $form->field('Фото', 'about-image', ['type' => 'file']);
    $form->field('Заголовок', 'about-title', ['value' => $options->about_title]);
    $form->field('Текст', 'about-text', ['value' => $options->about_text, 'type' => 'textarea', 'rows' => 8]);

    $form->buttons('form-submit');

    $form->end();
    ?>
</div>