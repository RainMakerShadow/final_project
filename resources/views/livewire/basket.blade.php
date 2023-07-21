<div>
    <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 @if ($hidden) hidden @else fixed top-0 left-0 right-0 z-50 -full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full justify-center items-center flex @endif -full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div  class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-gray-100 rounded-lg shadow dark:bg-gray-700  shadow-md shadow-gray-900/50">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-md bg-gray-200 dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Кошик
                    </h3>
                </div>
            <!-- Modal content -->

                <div class="overflow-x-auto">
                    @if(!$message)
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">Назва</th>
                        <th scope="col" class="px-4 py-3">Ціна</th>
                        <th scope="col" class="px-4 py-3">Кількість</th>
                        <th scope="col" class="px-4 py-3">Сума</th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                    </thead>
                    @if($orders)
                    <tbody>
                        @foreach($orders as $product)
                            @foreach($count as $item)
                                @if($item->product_id === $product->id )
                                    <tr class="border-b dark:border-gray-700" id="{{$product->id}}">
                                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$product->title}}&#34;</th>
                                        <td class="px-4 py-3">
                                            @if($product->discount)
                                                {{$product->price-($product->price*$product->discount)/100}}
                                            @else{{$product->price}}
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                                    <input wire:click="inputClick($event.target.id, $event.target.value)" id="{{$product->id}}" name="{{$product->id}}" type="number" value="{{$item->quantity}}" class="w-16 h-10">
                                        </td>
                                        <td class="px-4 py-3">₴
                                            @if($product->discount)
                                                {{($product->price-($product->price*$product->discount)/100)*$item->quantity}}
                                            @else
                                                {{$product->price*$item->quantity}}
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 flex items-center justify-end">
                                            <button wire:click="deleteItem($event.target.dataset.id)" id="delete-{{$product->id}}" data-id="{{$item->id}}" data-dropdown-toggle="apple-imac-27-dropdown" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                                Видалити
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                    @endif
                </table>
                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button wire:click="redirectTo" data-modal-hide="defaultModal" type="button" class="text-white bg-gray-600 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Оформити замовлення</button>
                </div>
                    @else
                        <h4 class="m-10">{{$message}}</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
