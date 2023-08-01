<div>
    <!-- Main modal -->
    <div id="defaultModal-2" tabindex="-1" aria-hidden="true" class="{{$hidden}}">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative p-4 rounded-lg bg-gray-200 dark:bg-gray-600 sm:p-5 shadow-md shadow-gray-400/50">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Кошик
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal-2">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="overflow-x-auto">

                    @if(!$message)
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                            <thead class="text-xs text-white uppercase bg-gray-600 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-1 py-2 rounded-l-lg text-center">Назва</th>
                                <th scope="col" class="px-1 py-2 text-center">Ціна</th>
                                <th scope="col" class="px-1 py-2 text-center">Кількість</th>
                                <th scope="col" class="px-1 py-2 text-center">Сума</th>
                                <th scope="col" class="px-1 py-2 rounded-r-lg">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                            </thead>
                                <tbody>
                                @foreach($orders as $product)
                                            <tr class="border-b dark:border-gray-700" id="{{$product->id}}">
                                    @foreach($count as $item)
                                        @if($item->product_id === $product->id )
                                                <th scope="row" class="px-2 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">{{$product->title}}&#34;</th>
                                                <td class="px-2 py-2 text-center">
                                                    @if($product->discount)
                                                        {{number_format($product->price-($product->price*$product->discount)/100, 2, '.', ' ')}}
                                                    @else{{number_format($product->price, 2, '.', ' ')}}
                                                    @endif
                                                </td>
                                                <td class="px-2 py-2 text-center flex flex-row justify-items-center items-center justify-center">
                                                    <button wire:click.prevent="qtyMinus($event.target.dataset.id, $event.target.dataset.value)" data-id="{{$product->id}}" data-value="{{$item->quantity}}" @if(!$item->quantity) disabled @endif class="text-center mr-2">
                                                        <svg wire:click.prevent="qtyMinus($event.target.dataset.id, $event.target.dataset.value)" data-id="{{$product->id}}" data-value="{{$item->quantity}}" class="w-3 h-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                            <path wire:click.prevent="qtyMinus($event.target.dataset.id, $event.target.dataset.value)" data-id="{{$product->id}}" data-value="{{$item->quantity}}" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                                        </svg>
                                                    </button>
                                                    <input wire:change="inputClick($event.target.id)" id="{{$product->id}}" name="{{$product->id}}" type="number" value="{{$item->quantity}}" class="text-center p-0 sm:p-2 w-6 sm:w-16 h-10  rounded-lg">
                                                    <button wire:click.prevent="qtyPlus($event.target.dataset.id, $event.target.dataset.value)" data-id="{{$product->id}}" data-value="{{$item->quantity}}" class="text-center ml-2">
                                                        <svg wire:click.prevent="qtyPlus($event.target.dataset.id, $event.target.dataset.value)" data-id="{{$product->id}}" data-value="{{$item->quantity}}" class="w-3 h-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                            <path wire:click.prevent="qtyPlus($event.target.dataset.id, $event.target.dataset.value)" data-id="{{$product->id}}" data-value="{{$item->quantity}}" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                                        </svg>
                                                    </button>
                                                </td>
                                                <td class="px-2 py-2 text-center">₴
                                                    @if($product->discount)
                                                        {{number_format(($product->price-($product->price*$product->discount)/100)*$item->quantity, 2, '.', ' ')}}
                                                    @else
                                                        {{number_format($product->price*$item->quantity, 2, '.', ' ')}}
                                                    @endif
                                                </td>
                                                <td class="px-1 py-2">
                                                        <svg wire:click.prevent="deleteItem($event.target.dataset.id)" id="delete-{{$product->id}}" data-id="{{$item->id}}" class="w-4 h-4 text-gray-800 dark:text-white hover:cursor-pointer" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                                            <path wire:click.prevent="deleteItem($event.target.dataset.id)" id="delete-{{$product->id}}" data-id="{{$item->id}}" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                                                        </svg>
                                                </td>
                                        @endif
                                    @endforeach
                                            </tr>
                                @endforeach
                                </tbody>
                            <tfoot>
                            <tr class="font-semibold text-gray-900 dark:text-white">
                                <th scope="row" class="px-6 py-3 text-base">Всього</th>
                                <td class="px-6 py-3"></td>
                                <td class="px-6 py-3"></td>
                                <td class="px-1 py-1">₴ {{number_format($summ,2,',',' ')}}</td>
                            </tr>
                            </tfoot>
                        </table>
                        <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button wire:click.prevent="redirectTo" data-modal-hide="defaultModal" type="button" class="text-white bg-gray-600 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Оформити замовлення</button>

                        </div>
                    @else
                        <h4 class="m-10 dark:text-white text-black">{{$message}}</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
