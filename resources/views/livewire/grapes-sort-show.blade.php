<div>
    <section class="bg-white dark:bg-gray-900">
        <div class="px-4 mx-auto max-w-screen-xl lg:py-6 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
                <h2 class="mb-4 text:base lg:text-3xl tracking-tight text-gray-900 dark:text-white text-transparent bg-clip-text bg-gradient-to-r to-stone-700 from-slate-500" ></h2>
            </div>
            @for($i=0; $i<count($grapes); $i++)
                @if($i % 2 == 0)
                    <div class="grid gap-8 lg:grid-cols-2">
                        @endif
                        <article class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                            <div class="flex justify-between items-center mb-5 text-gray-500">
                                <span class="text-sm">{{$grapes[$i]->created_at}}</span>
                            </div>
                            <h2 class="mb-2 text-xl lg:text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-transparent bg-clip-text bg-gradient-to-r to-stone-700 from-slate-500"><a href="{{$grapes[$i]->link}}">{{$grapes[$i]->title}}</a></h2>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <img class="w-3/4 h-3/4 rounded-full" src="{{ Illuminate\Support\Facades\Storage::url('image/grapes/'.$grapes[$i]->img) }}" alt="{{$grapes[$i]->img_alt}}" />
                                </div>
                                <div>
                                    <p class="mb-5 font-light text-gray-500 dark:text-gray-400">{{$grapes[$i]->description}}</p>
                                </div>
                            </div>
                            <a href="{{$grapes[$i]->link}}" class="mt-10 inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline text-black dark:text-white">
                                Читати далі
                                <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </a>
                        </article>
                        @if($i % 2 == 0)
                    </div>
                @endif
            @endfor
        </div>
    </section>
</div>
