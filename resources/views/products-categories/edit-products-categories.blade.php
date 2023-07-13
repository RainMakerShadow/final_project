<div>
    <h1 class="mb-4  font-extrabold text-gray-500 dark:text-white md:text-2xl lg:text-3xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Редагування категорії</span> </h1>
    <form wire:submit.prevent="submit" enctype="multipart/form-data" class="shadow-xl">
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Назва</label>
                <input wire:model="title" wire:input="handleInputTitle" type="text" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required value="{{$product_category->title}}">
                @error('title') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Опис категорії</label>
                <input wire:model="description" type="text" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required value="{{$product_category->description}}">
                @error('title') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>

        </div>
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="link" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Посилання</label>
                <input wire:model="link" type="text" id="link" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required value="{{$product_category->link}}">
                @error('title') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="keywords" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ключові слова</label>
                <input wire:model="keywords" type="text" id="keywords" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required value="{{$product_category->keywords}}">
                @error('title') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>
        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Пункт меню</label>

                <select wire:model="selected" wire:click="handleSelectMenu($event.target.value)" id="selected" name="selected" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach($menu as $menu_item)
                        <option value="{{$menu_item->id}}" @if($menu_item->id===$product_category->menus_id) selected @endif>{{$menu_item->title}}</option>
                    @endforeach
                </select>
                {{--                    --}}
                @error('categories') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>

            </div>
        </div>
        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <div class="mb-6">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Назва зображення</label>
                    <input wire:model="img_title" type="text" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required value="{{$product_category->img_title}}">
                    @error('title') <span class="error text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-6">
                    <label for="img_alt" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ALT-атрибут зображення</label>
                    <input wire:model="img_alt" type="text" id="img_alt" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required value="{{$product_category->img_title}}">
                    @error('title') <span class="error text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-6">
                    <label for="img_descr" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Опис зображення</label>
                    <input wire:model="img_descr" type="text" id="img_descr" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required value="{{$product_category->img_title}}">
                    @error('title') <span class="error text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Обрати зображення</label>
                    <input wire:model='image' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="file_input" type="file">
                </div>
            </div>
            <div class="max-w-lg">
                @if (is_object($image))
                    <img class="h-auto max-w-xl rounded-lg shadow-xl dark:shadow-gray-800 mt-4 ml-20" src= "{{$image->temporaryUrl()}}"  alt="image description" width="50%">
                @else
                    <img class="h-auto max-w-xl rounded-lg shadow-xl dark:shadow-gray-800 mt-4 ml-20" src= "{{$imageUrl}}"  alt="image description" width="50%">
                @endif
            </div>
        </div>

        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Зберегти</button>
    </form>
</div>
