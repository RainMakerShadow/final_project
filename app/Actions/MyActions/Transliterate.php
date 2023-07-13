<?php


namespace App\Actions\MyActions;


use Livewire\WithFileUploads;

class Transliterate
{
    use WithFileUploads;

    public function transLiterate($string) //Транслитерация title для названия изображения, img_alt, img_descr
    {
        $converter = array(
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'e', 'ж' => 'zh',
            'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
            'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ь' => '', 'ы' => 'y', 'ъ' => '', 'э' => 'e', 'ю' => 'yu',
            'я' => 'ya', 'і' => 'i',
            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'E', 'Ж' => 'ZH',
            'З' => 'Z', 'И' => 'I', 'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
            'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
            'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'SCH', 'Ь' => '', 'Ы' => 'Y', 'Ъ' => '', 'Э' => 'E', 'Ю' => 'YU',
            'Я' => 'YA', 'і' => 'I',
        );

        $transliteratedTitle = strtr($string, $converter);
        $file_name = preg_replace('/\s+/', '-', $transliteratedTitle); // замена пробелов на дефисы
        $file_name = preg_replace('/[^a-zA-Z0-9\-]/', '', $file_name); // удаление всех символов, кроме латиницы, цифр и дефисов
        $file_name = strtolower($file_name);
        return [
            'transliteratedTitle'=> $transliteratedTitle,
            'file_name' => $file_name,
        ];

    }
}
