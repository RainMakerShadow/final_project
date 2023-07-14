<?php


namespace App\Actions\MyActions;

use Livewire\WithFileUploads;

class UpLoadImage
{
    use WithFileUploads;

    public function upLoadImage($path, $img_file_name,$image ) //Сохранение файла на сервер
    {
        $image->storeAs($path, $img_file_name.'.'.$image->getClientOriginalExtension()); // Путь, где будет сохранен файл
    }
}
