<div>

    <form wire:submit.prevent="submit" enctype="multipart/form-data">
        <input wire:model="id" type="text" id="id" value="@if(isset($user)) {{$user->id}} @endif" hidden>
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ім'я</label>
                <input wire:model="name"type="text" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required >
                @error('name') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Пошта</label>
                <input wire:model="email" type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="example@com" required>
                @error('email') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Пароль</label>
                <input wire:model="password" type="password" id="company" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="********" required>
                @error('password') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="roles" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Роль</label>
                <select wire:model="selected" id="roles" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach($roles as $role)
                    <option value="{{$role->id}}" @if(isset($user))@if($role->id==$user->$role) selected @endif @endif>{{$role->name}}</option>
                    @endforeach
                </select>
                @error('role') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Обрати зображення</label>
                <input wire:model='image' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="file_input" type="file">
            </div>
            <div class="max-w-lg">
                @if (is_object($image))
                    <img class="h-auto max-w-xl rounded-lg shadow-xl dark:shadow-gray-800 mt-4 ml-20" src= "{{$image->temporaryUrl()}}"  alt="" width="50%">
                @else
                    <img class="h-auto max-w-xl rounded-lg shadow-xl dark:shadow-gray-800 mt-4 ml-20" src= "{{$imageUrl}}"  alt="" width="50%">
                @endif
            </div>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Зберегти</button>
    </form>


</div>
