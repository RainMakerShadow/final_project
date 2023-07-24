<div>
    <div class="bg-white dark:bg-gray-900">
        <div class="mx-auto p-6 max-w-2xl px-4 sm:px-6 sm:py-2 lg:max-w-7xl lg:px-8">
            <h2 class="sr-only">Products</h2>

            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8 ">
                @foreach($products as $product)
                    <form wire:submit.prevent="submit({{$product->id}})" id="{{$product->id}}">
                    <div class="">
                        <a wire:click="showProduct($event.target.dataset.id)" data-id="{{$product->id}}" data-modal-toggle="defaultModal-3" class="group">
    {{--                        <a href="{{route('product.link', $product->id)}}" class="group">--}}
                            <div class=" rounded-lg bg-gray-200 max-h-40 h-fit shadow-md dark:shadow-neutral-600 shadow-gray-800 relative">
                                <img data-id="{{$product->id}}" src="{{Illuminate\Support\Facades\Storage::url('image/products/'.$product->img) }}" alt="{{$product->img}}" class="rounded-lg h-40 w-full object-cover object-center group-hover:opacity-75 ">
                                @if($product->sale)
                                    <h3 data-id="{{$product->id}}" class="absolute -top-3 -right-3 text-gray-700 text-xs dark:text-gray-900 rounded-full bg-gray-100 p-2 shadow-lg shadow-gray-900/50">Розпродаж!</h3>
                                @endif
                                @if($product->new)
                                    <h3 data-id="{{$product->id}}" class="absolute -bottom-3 -left-3 text-gray-700 text-xs dark:text-gray-900  rounded-full bg-white p-2 shadow-lg shadow-gray-900/50 shadow-md dark:shadow-neutral-400/70" >Новинка!</h3>
                                @endif
                                @if($product->discount)
                                    <h3 data-id="{{$product->id}}" class="absolute -top-2 -left-2 text-gray-700 text-xs dark:text-gray-900  rounded-full bg-gray-100 p-2 shadow-lg shadow-gray-900/50 shadow-md dark:shadow-neutral-400/70">-{{$product->discount}}%</h3>
                                @endif
                            </div>
                            <h3 data-id="{{$product->id}}" class="mt-4 text-sm text-gray-700 dark:text-gray-400 h-10">{{$product->title}}</h3>
                            <p data-id="{{$product->id}}" class="mt-1 text-lg font-medium text-gray-900 dark:text-gray-400 mb-2"> @if($product->discount) <s class="text-xs text-gray-900 dark:text-white">₴ {{$product->price}}</s> ₴ {{number_format(($product->price-(($product->price*$product->discount)/100)), 2,'.',' ')}}@else₴ {{$product->price}} @endif</p>
                        </a>
                        <div class="flex flex-col space-y-4">
                            <button
{{--                                wire:click="AddToBasket($event.target.id)"--}}
                                id="{{$product->id}}"
                                type="submit"
                                class="{{(!$product->available) ? 'text-center py-2.5 px-5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 shadow-sm dark:shadow-neutral-400/70 shadow-gray-400/50 ' : 'text-center py-2.5 px-5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 shadow-md hover:shadow dark:shadow-neutral-600/70 shadow-gray-800/50 focus:shadow-inner'}}"
                                @if(!$product->available)
                                    disabled
                                @endif>
                                @if(!$product->available)
                                    Немає у наявності
                                @else
                                <p wire:loading.remove>
                                    Додати у кошик
                                </p>
                                    <p wire:loading disabled >
                                        <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
                                        </svg>
                                    </p>
                                @endif
                            </button>
                        </div>
                    </div>
                    </form>
                @endforeach
            </div>
        </div>
    </div>

    <div id="defaultModal-3" tabindex="-1" aria-hidden="true" class="{{$hidden}}">
        <div class="relative p-4 w-full max-w-lg h-screen">
            <!-- Modal content -->
            <div class="relative p-4 bg-gray-100 rounded-lg shadow-lg shadow-gray-400/50 dark:bg-gray-600 sm:p-5 overflow-y-auto ">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-1 mb-2 rounded-t sm:mb-2 dark:border-gray-600">
                    <h3 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                        {{($productInfo)?$productInfo->title:''}}
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal-3">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                @if($productInfo)
                <!-- Modal body -->
                    <div class="w-full bg-gray-200 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 pb-4">
                        <div class="m-auto p-3">
                            <div class="rounded-lg overflow-hidden max-w-xs text-center  m-auto">
                                <img class="" src="{{Illuminate\Support\Facades\Storage::url('image/products/'.$productInfo->img)}}" alt="{{$productInfo->img_alt}}"/>
                            </div>
                        </div>
                        <div class="px-5 pb-5">
                            <div class="mb-3 text-lg text-gray-500 md:text-xl dark:text-gray-400">
                                {{$productInfo->description}}
                            </div>
                            <div class="flex items-center mt-2.5 mb-5">

                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-3xl font-bold text-gray-900 dark:text-white">@if($productInfo->discount) <s class="text-base text-gray-900 dark:text-white">₴ {{$productInfo->price}}</s> ₴ {{number_format(($productInfo->price-(($productInfo->price*$productInfo->discount)/100)), 2,'.',' ')}}@else₴ {{$productInfo->price}} @endif</span>
                            </div>
                        </div>
                        <div class="grid justify-items-center">
                            <button
                                wire:click="submit({{$productItem->id}})"
                                id="{{$product->id}}"
                                type="submit"
                                class="{{(!$product->available) ? ' text-center py-2.5 px-5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 shadow-sm dark:shadow-neutral-400/70 shadow-gray-400/50 ' : 'text-center py-2.5 px-5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 shadow-md hover:shadow dark:shadow-neutral-600/70 shadow-gray-800/50 focus:shadow-inner'}}"
                                @if(!$productInfo->available)
                                disabled
                                @endif>
                                @if(!$productInfo->available)
                                    Немає у наявності
                                @else
                                    <p wire:loading.remove>
                                        {{(count(\App\Models\OrderItem::query()->where('user_id',Session::get('user_id'))->where('done', false)->where('product_id',$productInfo->id)->get()))?"Товар вже є у кошику":'Додати у кошик'}}
                                    </p>
                                    <p wire:loading disabled >
                                        <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
                                        </svg>
                                    </p>
                                @endif
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
