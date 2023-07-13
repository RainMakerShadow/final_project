<?php


namespace App\Actions\MyActions;


class UpLoadImage
{

    public function upLoadImage($path, $img_file_name,$image ) //Сохранение файла на сервер
    {

        $image->storeAs($path, $img_file_name.'.'.$image->getClientOriginalExtension()); // Путь, где будет сохранен файл

    }
}
