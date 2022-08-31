<?php

namespace App\Widgets;

class Modal
{
    public static function open(string $title, string $id)
    {
        echo "<div class='modal top fade' id='$id' tabindex='-1' aria-labelledby='$id-label' aria-hidden='true' data-mdb-backdrop='true' data-mdb-keyboard='true'>
            <div class='modal-dialog modal-md'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='$id-label'>$title</h5>
                    </div>";
    }

    public static function end()
    {
        echo '</div></div></div>';
    }
}