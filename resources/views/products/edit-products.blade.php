<div>
    <form wire:submit.prevent="submit" enctype="multipart/form-data">
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Назва</label>
                <input wire:model="title" type="text" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required value="{{$product->title}}">
                 @error('title') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="keywords" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ключові слова</label>
                <input wire:model="keywords" type="text" id="keywords" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" value="{{$product->keywords}}">
            </div>
            <div class="">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Опис</label>
                <textarea wire:model="description" id="description" rows="6" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Опис товару" value="{{$product->description}}"></textarea>
            </div>
            <div class="grid gap-6 mb-6 lg:grid-cols-2 md:grid-cols-2">
                <div>
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ціна</label>
                    <input wire:model="price" type="number" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="грн." value="{{$product->price}}">
                </div>
                <div>
                    <label for="discount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Знижка</label>
                    <input wire:model="discount" type="number" id="discount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="%" value="{{$product->discount}}">
                </div>
                <div>
                    <label for="leftovers" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Наявність</label>
                    <input wire:model="leftovers" type="number" id="leftovers" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="шт." value="{{$product->leftovers}}">
                </div>
                <div>
                    <label for="selected" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Категорія</label>
{{--   Не работает Select нужно разобраться          --}}
                    <select wire:model="selected" id="selected" name="selected" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" @if($category->id===$product->category_id) selected @endif>{{$category->title}}</option>
                        @endforeach
                    </select>
                {{--                    --}}
                    @error('categories') <span class="error text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <label class="relative inline-flex items-center mb-5 cursor-pointer ml-1">
            <input wire:click="checkSale($event.target.checked, $event.target.id)" id="available" type="checkbox" value="" class="sr-only peer" @if($product->available) checked @endif>
            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">У наявності</span>
        </label>
        <label class="relative inline-flex items-center mb-5 cursor-pointer ml-1 mr-6">
            <input wire:click="checkSale($event.target.checked, $event.target.id)" id="new" type="checkbox" value="" class="sr-only peer" @if($product->new) checked @endif>
            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Новинка</span>
        </label>
        <label class="relative inline-flex items-center mb-5 cursor-pointer ml-1">
            <input wire:click="checkSale($event.target.checked, $event.target.id)" id="sale" type="checkbox" value="" class="sr-only peer" @if($product->sale) checked @endif>
            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Розпродаж</span>
        </label>
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Додати зображення</label>
                    <input wire:model='image' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="file_input" type="file">
                </div>
                <div class="mb-5">
                    <label for="img_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Назва зображення</label>
                    <input wire:model="img_title" type="text" id="img_title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" value="{{$product->img_title}}">
                </div>
                <div class="mb-5">
                    <label for="img_descr" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Опис зображення</label>
                    <input wire:model="img_descr" type="text" id="img_descr" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" value="{{$product->img_descr}}">
                </div>
                <div class="mb-5">
                    <label for="img_alt" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ALT-атрибут</label>
                    <input wire:model="img_alt" type="text" id="img_alt" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" value="{{$product->img_alt}}">
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Зберегти</button>
            </div>

            <div class="relative m:auto">
                @if (is_object($image))
                    <img class="h-auto max-w-lg rounded-lg" src= "{{$image->temporaryUrl()}}"  alt="image description" width="50%">
                @else
                    <img class="h-auto max-w-lg rounded-lg" src= "{{$imageUrl}}"  alt="image description" width="50%">
                @endif
            </div>
        </div>

    </form>
</div>
