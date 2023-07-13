<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @livewireStyles

        <!-- Scripts -->
    </head>
    <body class="">

    @livewire('admin-navigation-menu')
        <div class="p-0 xl:ml-64">
            <div class="p-5 bg-white dark:bg-gray-900 antialiased">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-14">
                <main>
                    {{ $slot }}
                </main>
                </div>
            </div>
        </div>
        @stack('modals')

        @livewireScripts
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
