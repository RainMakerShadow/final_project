<div>
    <div class="p-4">
        <button wire:click="handleBottomBack" type="button" class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
            <svg class="w-3 h-3 ml-1 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="3 0 8 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 1 1.3 6.326a.91.91 0 0 0 0 1.348L7 13"/>
            </svg>
            <span class="sr-only">Icon description</span>
        </button>
    </div>
    <div class="p-4 pb-10">
        <h1 class="mb-4  font-extrabold text-gray-500 dark:text-white md:text-2xl lg:text-3xl">Редагування новини<span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400"> @if($title) "{{$title}}" @endif</span> </h1>
        <form wire:submit.prevent="submit" enctype="multipart/form-data">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Назва</label>
                    <input wire:model="title" wire:input="handleInputTitle" type="text" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                    @error('title') <span class="error text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Короткий опис</label>
                    <input wire:model="description" type="text" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" >
                    @error('title') <span class="error text-red-500">{{ $message }}</span> @enderror
                </div>

            </div>
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="link" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Посилання</label>
                    <input wire:model="link" type="text" id="link" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" value="" required>
                    @error('title') <span class="error text-red-500">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="keywords" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ключові слова</label>
                    <input wire:model="keywords" type="text" id="keywords" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" >
                    @error('title') <span class="error text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Пункт меню</label>

                    <select wire:model="category" id="selected" name="selected" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach($category_selected as $news_categories_item)
                            <option value="{{$news_categories_item->id}}" >{{$news_categories_item->title}}</option>
                        @endforeach
                    </select>
                    {{--                    --}}
                    @error('categories') <span class="error text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <div class="sm:col-span-2">
                <label for="comment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Текст статті</label>
                <textarea wire:model="content" id="comment" rows="14" class="block p-2.5 w-full text-base text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder=""></textarea>
            </div>
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <div class="mb-6">
                        <label for="img_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Назва зображення</label>
                        <input wire:model="img_title" type="text" id="img_title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="">
                        @error('title') <span class="error text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-6">
                        <label for="img_alt" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ALT-атрибут зображення</label>
                        <input wire:model="img_alt" type="text" id="img_alt" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="">
                        @error('title') <span class="error text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-6">
                        <label for="img_descr" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Опис зображення</label>
                        <input wire:model="img_descr" type="text" id="img_descr" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" >
                        @error('title') <span class="error text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Обрати зображення</label>
                        <input wire:loading.attr="disabled" wire:model='image' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="file_input" type="file">
                    </div>
                </div>
                <div class="grid justify-items-center content-center">
                    @if (is_object($image))
                        <img class="h-auto max-w-xl rounded-lg shadow-lg shadow-gray-700 dark:shadow-cyan-500/50" src= "{{$image->temporaryUrl()}}"  alt="" width="50%">
                    @else
                        <img class="h-auto max-w-xl rounded-lg shadow-lg shadow-gray-700 dark:shadow-cyan-500/50" src= "{{$imageUrl}}"  alt="" width="50%">
                    @endif
                </div>
            </div>

            <button wire:loading.remove type="submit" class="py-2.5 px-5 mr-2 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center shadow-md hover:shadow dark:shadow-neutral-600/50 shadow-blue-500/50">Зберегти</button>
            <button wire:loading disabled type="button" class="py-2.5 px-5 mr-2 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center">
                <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
                </svg>
                Завантаження...
            </button>
        </form>

    </div>
</div>
