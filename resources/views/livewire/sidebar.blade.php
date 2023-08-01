<div>
    <form wire:submit.prevent="submit" id="drawer-example">
        @csrf
        <div class="flex flex-col justify-between flex-1">
            <div class="space-y-6">
                <!-- Categories -->
                <div class="space-y-2">
                    <h6 class="text-base font-medium text-black dark:text-white">
                        Категорії товару
                    </h6>
                    @foreach($categories as $category)
                        <div class="flex items-center">
                            <input wire:click="handleCheckboxFilter($event.target.id, $event.target.checked)" id="{{$category->id}}" type="checkbox" value=""
                                   class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                   @if($inputChecked)
                                        @foreach($inputChecked as $item)
                                            @if ($item == $category->id)
                                                checked
                                            @endif
                                        @endforeach
                                    @endif
                            />

                            <label for="{{$category->id}}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                {{$category->title}}
                            </label>
                        </div>
                    @endforeach

                </div>
                @error('checkedBox') <span class="error text-red-500">{{ $message }}</span> @enderror
                <!-- Prices -->
                <div class="space-y-2">
                    <h6 class="text-base font-medium text-black dark:text-white">
                        Ціна
                    </h6>
                    <div class="flex items-center justify-between flex-col lg:flex-row space-x-3">
                        <div class="w-full mt-3">
                            <label for="min-experience-input"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Від
                            </label>

                            <input wire:model="priceMin" type="number" id="price-from" value="{{$priceMin}}" min="1" max="10000"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   placeholder="" required>
                        </div>

                        <div class="w-full mt-3">
                            <label for="price-to"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                До
                            </label>

                            <input wire:model="priceMax" type="number" id="max-experience-input" value="{{$priceMax}}" min="1" max="10000"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   placeholder="" required>
                        </div>
                    </div>
                </div>

                <!-- Rating -->

                <button type="submit"
                        class="w-full px-5 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    Примінити фільтр
                </button>

            </div>

        </div>
    </form>
</div>
