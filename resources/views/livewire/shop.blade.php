<div>
    <div class="bg-white dark:bg-gray-900">
        <div class="mx-auto p-6 max-w-2xl px-4 sm:px-6 sm:py-2 lg:max-w-7xl lg:px-8">
            <h2 class="sr-only">Products</h2>

            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8 ">
                @foreach($products as $product)
                    <div class="">
                        <a href="#" class="group">
    {{--                        <a href="{{route('product.link', $product->id)}}" class="group">--}}
                            <div class="overflow-hidden rounded-lg bg-gray-200 max-h-40 h-fit shadow-md dark:shadow-neutral-600 shadow-gray-800">
                                <img src="{{Illuminate\Support\Facades\Storage::url('image/products/'.$product->img) }}" alt="{{$product->img}}" class="h-40 w-full object-cover object-center group-hover:opacity-75 ">
                            </div>
                            <h3 class="mt-4 text-sm text-gray-700 dark:text-gray-400 h-10">{{$product->title}}</h3>
                            @if($product->new)
                                <h3>Новинка!</h3>
                            @endif
                            @if($product->discount)
                                <h3>{{$product->discount}}%</h3>
                            @endif
                            @if($product->sale)
                                <h3>Розпродаж!</h3>
                            @endif
                            <p class="mt-1 text-lg font-medium text-gray-900 dark:text-gray-400 mb-2"> @if($product->discount) <s>₴ {{$product->price}}</s> ₴ {{number_format(($product->price-(($product->price*$product->discount)/100)), 2,'.',' ')}}@else {{$product->price}} @endif</p>
                        </a>
                        <div class="flex flex-col space-y-4">
                            <button wire:click="AddToBasket($event.target.id)" id="{{$product->id}}" type="submit" class="{{(!$product->available) ? 'text-center py-2.5 px-5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 shadow-md dark:shadow-neutral-400/70 shadow-gray-400/50 ' : 'text-center py-2.5 px-5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 shadow-md hover:shadow dark:shadow-neutral-600/70 shadow-gray-800/50 focus:shadow-inner'}}" @if(!$product->available) disabled @endif>@if(!$product->available) Немає у наявності @else Додати у кошик @endif  </button>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
</div>
