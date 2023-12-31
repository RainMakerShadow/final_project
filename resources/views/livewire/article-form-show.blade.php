<div>
    <main class="pt-0 pb-16 lg:pt-1 lg:pb-24 bg-white dark:bg-gray-900 mb-3 lg:m-10">
        <div class="flex justify-between px-1 sm:px-4 mx-auto max-w-screen-xl ">
            <article class="mx-auto w-full max-w-5xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                <header class="mb-4 lg:mb-6 not-format">
                    <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">{{$article[0]->title}}</h1>
                </header>
                <p class=" text-sm sm:text-2xl lead dark:text-white text-black">{{$article[0]->content}}</p>
                <figure class="mt-10 text-center m-auto"><img class="text-center m-auto" src="{{ Illuminate\Support\Facades\Storage::url('image/articles/'.$article[0]->img) }}" alt="{{$article[0]->img_alt}}">
                    <figcaption class="text-sm sm:text-2xl lead dark:text-white text-black">{{$article[0]->img_descr}}</figcaption>
                </figure>
            </article>
        </div>
    </main>

    <aside aria-label="Related articles" class="py-8 lg:py-24 bg-gray-50 dark:bg-gray-800">
        <div class="px-4 mx-auto max-w-screen-xl">
            <h2 class="mb-8 text-2xl font-bold text-gray-900 dark:text-white">Схожі новини</h2>
            <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">
                @foreach($articles_list as $article)
                <article class="max-w-xs">
                    <a href="{{$article->link}}">
                        <img src="{{ Illuminate\Support\Facades\Storage::url('image/articles/'.$article->img) }}" class="mb-5 rounded-lg" alt="Image 1">
                    </a>
                    <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                        <a href="{{$article->link}}">{{$article->title}}</a>
                    </h2>
                    <p class="mb-4 font-light dark:text-white text-black text-gray-500 dark:text-gray-400">{{$article->description}}</p>
                    <a href="{{$article->link}}" class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline dark:text-white text-black">
                        Читати далі
                        <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                </article>
                @endforeach
            </div>
        </div>
    </aside>

</div>
