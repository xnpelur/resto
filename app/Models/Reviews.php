<?php

namespace App\Models;

use App\Core\Application;
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

            Application::$app->session->setFlashMessage('home-success', 'Отзыв успешно сохранен');
        } else {
            Application::$app->session->setFlashMessage('home-danger', 'Во время загрузки изображения возникла ошибка, попробуйте ещё раз');
        }
    }

    public function delete(int $id)
    {
        $image = $this->getFieldsFrom('reviews', "id = '$id'")[0]->image;
        $this->deleteFrom('reviews', "id = $id");   
        $this->checkImage($image);

        Application::$app->session->setFlashMessage('admin-success', 'Отзыв успешно удалён');
    }
}