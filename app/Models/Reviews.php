<?php

namespace App\Models;

use App\Core\Session;
use App\Core\Model;

class Reviews extends Model
{
    public function get()
    {
        return $this->getFieldsFrom('reviews');
    }

    public function add(array $data)
    {
        if ($imagePath = $this->uploadImage($data['review-image'])) {
            $args = [
                'name' => $data['review-name'],
                'text' => $data['review-text'],
                'stars' => $data['review-stars'],
                'image' => $imagePath
            ];
            $this->insertTo('reviews', $args);

            Session::setFlashMessage('home-success', 'Отзыв успешно сохранен');
        } else {
            Session::setFlashMessage('home-danger', 'Во время загрузки изображения возникла ошибка');
        }
    }

    public function delete(int $id)
    {
        $image = $this->getFieldsFrom('reviews', "id = '$id'")[0]->image;
        $this->deleteFrom('reviews', "id = $id");   
        $this->checkImage($image);

        Session::setFlashMessage('admin-success', 'Отзыв успешно удалён');
    }
}