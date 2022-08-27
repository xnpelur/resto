<?php

namespace App\Models;

use App\Core\Model;
use App\Core\Session;

class Options extends Model
{
    public function get(string $optionName = '')
    {
        $queryResult = $this->getFieldsFrom('options');
        $optionsArray = [];

        foreach ($queryResult as $element) {
            $optionsArray[$element->name] = $element->value;
        }

        $options = (object)$optionsArray;

        if ($optionName !== '') {
            return $options->$optionName; 
        }

        return $options; 
    }

    public function set(array $data)
    {
        $args = [
            'site_name' => $data['options-name'] ?? NULL,
            'phone' => $data['options-phone'] ?? NULL,
            'email' => $data['options-email'] ?? NULL,
            'facebook_link' => $data['options-facebook'] ?? NULL,
            'instagram_link' => $data['options-instagram'] ?? NULL,
            'vk_link' => $data['options-vk'] ?? NULL,
            'about_title' => $data['about-title'] ?? NULL,
            'about_text' => $data['about-text'] ?? NULL
        ];

        if (isset($data['about-image']) && $imagePath = $this->uploadImage($data['about-image'])) {
            $lastImage = $this->get('about_image');
            $args['about_image'] = $imagePath;
        }

        $this->updateColumns('options', $args);

        if (isset($lastImage)) {
            $this->checkImage($lastImage);
        }

        Session::setFlashMessage('admin-success', 'Настройки успешно обновлены');
    }
}