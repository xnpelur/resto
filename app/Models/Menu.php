<?php

namespace App\Models;

use App\Core\Model;
use App\Core\Session;

class Menu extends Model
{
    public function get(string $type = '*')
    {
        return $this->getFieldsFrom('menu', "type = '$type'");
    }

    public function getMeal(int $id)
    {
        return $this->getFieldsFrom('menu', "id = '$id'");
    }

    public function add(array $data)
    {
        if ($imagePath = $this->uploadImage($data['meal-image'])) {
            $args = [
                'title' => $data['meal-title'],
                'description' => $data['meal-description'],
                'price' => $data['meal-price'],
                'image' => $imagePath,
                'type' => $data['meal-type']
            ];
            $this->insertTo('menu', $args);

            Session::setFlashMessage('admin-success', 'Блюдо успешно добавлено в меню');
        } else {
            Session::setFlashMessage('admin-danger', 'Во время загрузки изображения возникла ошибка');
        }
    }

    public function change(array $data)
    {
        $args = [
            'title' => $data['meal-title'],
            'description' => $data['meal-description'],
            'price' => $data['meal-price']
        ];

        if ($imagePath = $this->uploadImage($data['meal-image'])) {
            $lastImage = $this->getMeal($data['meal-id'])[0]->image;
            $args['image'] = $imagePath;
        }

        $this->update('menu', $args, $data['meal-id']);

        if (isset($lastImage)) {
            $this->checkImage($lastImage);
        }

        Session::setFlashMessage('admin-success', 'Блюдо успешно изменено');
    }

    public function delete(int $id)
    {
        $image = $this->getMeal($id)[0]->image;
        $this->deleteFrom('menu', "id = $id");   
        $this->checkImage($image);

        Session::setFlashMessage('admin-success', 'Блюдо успешно удалено');
    }
}