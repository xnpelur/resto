<?php

namespace App\Widgets;

class Form
{
    public static function open(string $action, string $method, bool $containFiles = false, string $id = '')
    {
        if ($containFiles) {
            echo "<form action='$action' method='$method' id='$id' enctype='multipart/form-data'>";
        } else {
            echo "<form action='$action' method='$method' id='$id'>";
        }
    }

    public static function end()
    {
        echo '</form>';
    }

    public static function field(string $title, string $name, array $attrs = [])
    {
        $minimal = $attrs['minimal'] ?? false;
        $type = $attrs['type'] ?? 'text';
        $value = $attrs['value'] ?? '';
        $required = $attrs['required'] ?? true;

        $input = "<input class='form-control' id='$name' name='$name' type='$type' value='$value'*placeholder* required>";
        if ($type === 'textarea') {
            $input = "<textarea class='form-control' id='$name' name='$name'*placeholder* required>$value</textarea>";
        }

        if ($required === false) {
            $input = str_replace(' required', '', $input);
        }
        
        unset($attrs['type']);
        unset($attrs['value']);
        unset($attrs['required']);

        $additionalAttributes = "";
        foreach ($attrs as $key => $value) {
            $additionalAttributes .= ' ' . $key . '="' . $value . '"';
        }

        $input = str_replace('*placeholder*', $additionalAttributes, $input);

        if ($minimal) {
            echo "<div class='form-group'>
                <label for='$name'>$title</label>
                $input
            </div>";
        } else {
            echo "<div class='row'>
                <div class='col-lg-3'><label for='$name'>$title</label></div>
                <div class='col-lg-9 input-column'>$input</div>
            </div>
            <hr>";
        }

        unset($attrs['minimal']);
    }

    public static function hiddenField(string $attribute, string $id = '', string $value = '')
    {
        if ($id === '') {
            $id = $attribute;
        }
        echo "<input type='text' class='hidden' name='$attribute' id='$id' value='$value'>";
    }

    public static function buttons(string $preset)
    {
        switch ($preset) {
            case 'modal-delete':
                echo "<div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Отменить</button>
                    <button type='submit' class='btn btn-danger'>Удалить</button>
                </div>";
                break;
                
            case 'modal-submit':
                echo "<div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Отменить</button>
                    <button type='submit' class='btn btn-primary'>Подтвердить</button>
                </div>";
                break;

            case 'form-submit':
                echo "<div class='option-buttons'>
                    <button type='button' class='btn btn-light' onclick='reloadPage()'>Отменить</button>
                    <button type='submit' class='btn btn-success'>Сохранить</button>
                </div>";
                break;

            case 'login-button':
                    echo "<div class='button-wrapper'>
                    <button type='submit' class='btn btn-success btn-block'>Войти</button>
                </div>";
                break;
        }
    }
}
