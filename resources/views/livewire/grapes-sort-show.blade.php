<div>
    <section class="bg-white dark:bg-gray-900">
        <div class="px-4 mx-auto max-w-screen-xl lg:py-6 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
                <h2 class="mb-4 text:base lg:text-3xl tracking-tight text-gray-900 dark:text-white text-transparent bg-clip-text bg-gradient-to-r to-stone-700 from-slate-500" ></h2>
            </div>
            @for($i=0; $i<$paginate->count(); $i++)
                @if($i % 2 == 0)
                    <div class="grid gap-8 lg:grid-cols-2 mb-10">
                        @endif
                        <article class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                            <div class="flex justify-between items-center mb-5 text-gray-500">
                                <span class="text-sm">{{$paginate->items()[$i]->created_at}}</span>
                            </div>
                            <h2 class="mb-2 text-xl lg:text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-transparent bg-clip-text bg-gradient-to-r to-stone-700 from-slate-500"><a href="{{$paginate->items()[$i]->link}}">{{$paginate->items()[$i]->title}}</a></h2>
                            <div class="flex justify-between items-center flex-row justify-items-center">
                                <div class="items-center basis-1/2 ">
                                    <div class="w-3/4 rounded-full overflow-hidden">
                                        <img class="w-auto h-auto" src="{{ Illuminate\Support\Facades\Storage::url('image/grapes/'.$paginate->items()[$i]->img) }}" alt="{{$paginate->items()[$i]->img_alt}}" />
                                    </div>
                                </div>
                                <div class="basis-1/2">
                                    <p class="ml-5 mb-5 font-light text-gray-500 dark:text-gray-400">{{$paginate->items()[$i]->description}}</p>
                                </div>
                            </div>
                            <a href="{{$paginate->items()[$i]->link}}" class="mt-10 inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline text-black dark:text-white">
                                Читати далі
                                <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </a>
                        </article>
                        @if(($i+1) % 2 == 0)
                    </div>
                @endif
            @endfor
        </div>
    </section>
    @if($paginate->hasPages())
        <div>
            <nav aria-label="Page navigation example" class="flex justify-items-center justify-center">
                <ul class="flex items-center -space-x-px h-10 text-base">
                    @if(!$paginate->onFirstPage())
                        <li>
                            <a href="{{$paginate->previousPageUrl()}}" class="flex items-center justify-center px-4 h-10 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Previous</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="{{$paginate->url(1)}}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                        </li>
                    @else
                        <li>
                            <button disabled class="flex items-center justify-center px-4 h-10 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 ">
                                <span class="sr-only">Previous</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                </svg>
                            </button>
                        </li>
                    @endif

                    <li>
                        <a href="" aria-current="page" class="z-10 flex items-center justify-center px-4 h-10 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">{{$paginate->currentPage()}}</a>
                    </li>
                    @if($paginate->hasMorePages())
                        <li>
                            <a href="{{$paginate->url($paginate->lastPage())}}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{$paginate->lastPage()}}</a>
                        </li>
                        <li>
                            <a href="{{$paginate->nextPageUrl()}}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Next</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                            </a>
                        </li>
                    @else
                        <li>
                            <button disabled class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 ">
                                <span class="sr-only">Next</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                            </button>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    @endif
</div>
