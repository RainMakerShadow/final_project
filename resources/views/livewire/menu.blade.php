<div>

    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="grid grid-cols-12 mx-auto max-w-screen-xl p-4 pb-0">
            <div class="mr-3 sm:col-span-5 lg:col-span-6 col-span-1 text-gray-500 dark:text-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                <a href="tel:5541251234" class="mr-6 text-sm text-gray-500 dark:text-white hover:underline"> </a>
            </div>
            <div class="sm:m-2 sm:col-span-2 col-span-2">
                <button id="theme-toggle" type="button" class="mr-3 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <div class="sm:m-2 sm:col-span-2 col-span-3">
                <livewire:card-menu />
            </div>
            <div  class="sm:m-2 sm:col-span-2 col-span-6 sm:mt-3 mb-5">
                <div class="flex items-center md:order-2 sm:mt-1">

                    <!-- Dropdown menu -->
                    @auth
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
                            <div class="px-4 py-3">
                                <span class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                                <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                            </div>
                            <ul class="py-2" aria-labelledby="user-menu-button">
                                <li>
                                    <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem" href="{{ route('orders') }}" :active="request()->routeIs('profile.show')">
                                        {{ __('Панель керування') }}
                                    </a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white" x-data>
                                        @csrf

                                        <button href="{{ route('logout') }}" class="">
                                            Вихід
                                        </button>
                                    </form>

                                </li>
                            </ul>
                        </div>
                    @endif
                    @if (Route::has('login'))
                        @auth
                            <button type="button" class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-8 h-8 rounded-full" src="{{ Illuminate\Support\Facades\Storage::url('image/users/'.Auth::user()->profile_photo_path)}}" alt="user photo">
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="py-2.5 px-5 mr-2 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center">Вхід</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 mr-1 md:mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Реєстрація</a>
                            @endif
                        @endif
                    @endif

                </div>
            </div>
        </div>
    </nav>
    <nav class="bg-gray-100 rounded-lg shadow dark:bg-gray-600 m-4 mt-0">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a data-collapse-toggle="navbar-user" href="#" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-user" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </a>
            <a href="/" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40px" height="40px" viewBox="0 0 40 40" version="1.1">
                    <defs>
                        <linearGradient id="linear0" gradientUnits="userSpaceOnUse" x1="47.2766" y1="4.1056" x2="47.2766" y2="44.4543" gradientTransform="matrix(0.112719,-0.291469,-0.291469,-0.112719,21.761937,25.210812)">
                            <stop offset="0.00614522" style="stop-color:rgb(40.784314%,62.352941%,21.960784%);stop-opacity:1;"/>
                            <stop offset="1" style="stop-color:rgb(61.176471%,80%,39.607843%);stop-opacity:1;"/>
                        </linearGradient>
                        <filter id="alpha" filterUnits="objectBoundingBox" x="0%" y="0%" width="100%" height="100%">
                            <feColorMatrix type="matrix" in="SourceGraphic" values="0 0 0 0 1 0 0 0 0 1 0 0 0 0 1 0 0 0 1 0"/>
                        </filter>
                        <mask id="mask0">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="40" height="40" style="fill:rgb(0%,0%,0%);fill-opacity:0.2;stroke:none;"/>
                            </g>
                        </mask>
                        <clipPath id="clip1">
                            <rect x="0" y="0" width="40" height="40"/>
                        </clipPath>
                        <g id="surface5" clip-path="url(#clip1)">
                            <path style=" stroke:none;fill-rule:nonzero;fill:rgb(25.882353%,25.882353%,25.882353%);fill-opacity:1;" d="M 23.453125 1.867188 C 24.121094 2.539062 25.398438 4.046875 25.398438 5.738281 C 25.398438 5.875 25.386719 6.015625 25.367188 6.171875 C 25.347656 6.347656 25.398438 6.523438 25.515625 6.65625 C 25.632812 6.789062 25.796875 6.867188 25.972656 6.875 C 26.855469 6.898438 27.683594 7.148438 28.191406 7.335938 C 27.863281 8.160156 27.078125 9.726562 25.703125 10.335938 L 25.683594 10.34375 C 25.660156 10.351562 25.632812 10.363281 25.605469 10.371094 C 25.445312 10.4375 25.320312 10.566406 25.257812 10.726562 C 25.195312 10.882812 25.203125 11.066406 25.277344 11.222656 C 25.289062 11.246094 25.304688 11.273438 25.316406 11.292969 L 25.320312 11.304688 C 25.929688 12.683594 25.457031 14.375 25.148438 15.203125 C 24.648438 15 23.867188 14.628906 23.195312 14.050781 C 23.082031 13.953125 22.933594 13.898438 22.789062 13.898438 C 22.761719 13.898438 22.738281 13.902344 22.710938 13.90625 C 22.535156 13.929688 22.378906 14.023438 22.273438 14.164062 C 22.183594 14.292969 22.097656 14.402344 22.003906 14.507812 C 20.859375 15.757812 18.863281 16.011719 17.957031 16.0625 C 17.914062 15.117188 17.992188 13.148438 19.136719 11.890625 C 19.320312 11.691406 19.535156 11.507812 19.796875 11.332031 C 20.042969 11.164062 20.136719 10.851562 20.023438 10.574219 C 19.929688 10.335938 19.695312 10.191406 19.445312 10.191406 C 19.40625 10.191406 19.367188 10.195312 19.328125 10.203125 C 18.992188 10.269531 18.671875 10.300781 18.375 10.300781 C 17.925781 10.300781 17.515625 10.226562 17.15625 10.078125 C 15.566406 9.429688 14.75 7.351562 14.460938 6.4375 C 15.101562 6.097656 16.410156 5.492188 17.707031 5.492188 C 18.160156 5.492188 18.570312 5.570312 18.933594 5.714844 C 19.5 5.945312 20.023438 6.386719 20.492188 7.023438 C 20.613281 7.191406 20.800781 7.28125 20.996094 7.28125 C 21.085938 7.28125 21.171875 7.261719 21.253906 7.226562 C 21.523438 7.101562 21.667969 6.808594 21.605469 6.523438 C 21.546875 6.246094 21.515625 5.992188 21.515625 5.746094 C 21.515625 4.054688 22.785156 2.542969 23.453125 1.867188 M 23.449219 1.007812 C 23.449219 1.007812 20.886719 3.132812 20.894531 5.742188 C 20.894531 6.054688 20.933594 6.355469 21 6.652344 C 20.535156 6.019531 19.9375 5.445312 19.175781 5.132812 C 18.703125 4.941406 18.207031 4.867188 17.710938 4.867188 C 15.699219 4.867188 13.730469 6.132812 13.730469 6.132812 C 13.730469 6.132812 14.539062 9.679688 16.921875 10.652344 C 17.390625 10.84375 17.882812 10.917969 18.375 10.917969 C 18.738281 10.917969 19.101562 10.878906 19.445312 10.808594 C 19.171875 10.996094 18.910156 11.210938 18.679688 11.464844 C 16.914062 13.398438 17.382812 16.691406 17.382812 16.691406 C 17.382812 16.691406 17.453125 16.695312 17.578125 16.695312 C 18.3125 16.695312 20.960938 16.574219 22.46875 14.921875 C 22.585938 14.792969 22.691406 14.660156 22.789062 14.523438 C 24 15.5625 25.492188 15.988281 25.492188 15.988281 C 25.492188 15.988281 26.867188 13.25 25.894531 11.050781 C 25.878906 11.015625 25.859375 10.980469 25.839844 10.945312 C 25.875 10.929688 25.914062 10.921875 25.945312 10.90625 C 28.148438 9.929688 28.972656 6.980469 28.972656 6.980469 C 28.972656 6.980469 27.578125 6.289062 25.984375 6.242188 C 26.007812 6.074219 26.019531 5.90625 26.015625 5.734375 C 26.019531 3.125 23.449219 1.007812 23.449219 1.007812 Z M 23.449219 1.007812 "/>
                        </g>
                        <radialGradient id="radial0" gradientUnits="userSpaceOnUse" cx="106.125" cy="121.5711" fx="106.125" fy="121.5711" r="16.1812" gradientTransform="matrix(-0.3125,0,0,0.3125,37.542625,0)">
                            <stop offset="0" style="stop-color:rgb(63.137255%,23.529412%,70.196078%);stop-opacity:1;"/>
                            <stop offset="0.3197" style="stop-color:rgb(60.392157%,21.568627%,69.019608%);stop-opacity:1;"/>
                            <stop offset="0.7881" style="stop-color:rgb(52.54902%,15.686275%,65.490196%);stop-opacity:1;"/>
                            <stop offset="1" style="stop-color:rgb(48.235294%,12.156863%,63.529412%);stop-opacity:1;"/>
                        </radialGradient>
                        <mask id="mask1">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="40" height="40" style="fill:rgb(0%,0%,0%);fill-opacity:0.2;stroke:none;"/>
                            </g>
                        </mask>
                        <clipPath id="clip2">
                            <rect x="0" y="0" width="40" height="40"/>
                        </clipPath>
                        <g id="surface8" clip-path="url(#clip2)">
                            <path style=" stroke:none;fill-rule:nonzero;fill:rgb(25.882353%,25.882353%,25.882353%);fill-opacity:1;" d="M 8.835938 30.625 L 8.835938 31.5625 C 9.179688 31.5625 9.523438 31.621094 9.855469 31.738281 C 10.640625 32.007812 11.273438 32.570312 11.632812 33.320312 C 11.992188 34.066406 12.039062 34.910156 11.769531 35.691406 C 11.335938 36.9375 10.15625 37.777344 8.835938 37.777344 C 8.488281 37.777344 8.144531 37.71875 7.8125 37.601562 C 7.027344 37.332031 6.398438 36.769531 6.039062 36.023438 C 5.675781 35.273438 5.628906 34.429688 5.898438 33.648438 C 6.335938 32.402344 7.511719 31.5625 8.835938 31.5625 L 8.835938 30.625 M 8.835938 30.625 C 7.164062 30.625 5.597656 31.671875 5.015625 33.339844 C 4.28125 35.449219 5.398438 37.753906 7.507812 38.488281 C 7.945312 38.640625 8.394531 38.710938 8.835938 38.710938 C 10.507812 38.710938 12.070312 37.664062 12.652344 35.996094 C 13.386719 33.886719 12.273438 31.585938 10.164062 30.851562 C 9.722656 30.695312 9.273438 30.625 8.835938 30.625 Z M 8.835938 30.625 "/>
                        </g>
                        <radialGradient id="radial1" gradientUnits="userSpaceOnUse" cx="87.0616" cy="56.7304" fx="87.0616" fy="56.7304" r="16.7446" gradientTransform="matrix(-0.311969,-0.0179687,-0.0179687,0.311969,38.616344,1.107469)">
                            <stop offset="0.2611" style="stop-color:rgb(65.490196%,24.705882%,72.54902%);stop-opacity:1;"/>
                            <stop offset="0.4753" style="stop-color:rgb(62.745098%,22.745098%,70.980392%);stop-opacity:1;"/>
                            <stop offset="0.789" style="stop-color:rgb(54.901961%,16.862745%,67.058824%);stop-opacity:1;"/>
                            <stop offset="1" style="stop-color:rgb(48.235294%,12.156863%,63.529412%);stop-opacity:1;"/>
                        </radialGradient>
                        <mask id="mask2">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="40" height="40" style="fill:rgb(0%,0%,0%);fill-opacity:0.2;stroke:none;"/>
                            </g>
                        </mask>
                        <clipPath id="clip3">
                            <rect x="0" y="0" width="40" height="40"/>
                        </clipPath>
                        <g id="surface11" clip-path="url(#clip3)">
                            <path style=" stroke:none;fill-rule:nonzero;fill:rgb(25.882353%,25.882353%,25.882353%);fill-opacity:1;" d="M 9.507812 13.101562 L 9.507812 14.039062 C 10 14.039062 10.488281 14.125 10.960938 14.289062 C 12.074219 14.675781 12.972656 15.476562 13.484375 16.539062 C 13.996094 17.601562 14.070312 18.800781 13.679688 19.914062 C 13.0625 21.6875 11.386719 22.882812 9.507812 22.882812 C 9.015625 22.882812 8.527344 22.796875 8.054688 22.632812 C 6.941406 22.246094 6.042969 21.445312 5.53125 20.382812 C 5.019531 19.320312 4.945312 18.121094 5.335938 17.007812 C 5.953125 15.234375 7.628906 14.039062 9.507812 14.039062 L 9.507812 13.101562 M 9.507812 13.101562 C 7.289062 13.101562 5.21875 14.492188 4.445312 16.699219 C 3.476562 19.492188 4.949219 22.546875 7.742188 23.519531 C 8.324219 23.722656 8.917969 23.820312 9.503906 23.820312 C 11.71875 23.820312 13.789062 22.429688 14.5625 20.222656 C 15.535156 17.429688 14.058594 14.375 11.265625 13.402344 C 10.683594 13.199219 10.089844 13.101562 9.507812 13.101562 Z M 9.507812 13.101562 "/>
                        </g>
                        <radialGradient id="radial2" gradientUnits="userSpaceOnUse" cx="84.9539" cy="115.3147" fx="84.9539" fy="115.3147" r="17.965" gradientTransform="matrix(-0.3125,0,0,0.3125,37.542625,0)">
                            <stop offset="0.1137" style="stop-color:rgb(63.529412%,15.686275%,70.980392%);stop-opacity:1;"/>
                            <stop offset="0.3427" style="stop-color:rgb(60.784314%,14.901961%,69.019608%);stop-opacity:1;"/>
                            <stop offset="0.6779" style="stop-color:rgb(52.941176%,13.333333%,63.529412%);stop-opacity:1;"/>
                            <stop offset="1" style="stop-color:rgb(43.137255%,10.980392%,56.862745%);stop-opacity:1;"/>
                        </radialGradient>
                        <mask id="mask3">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="40" height="40" style="fill:rgb(0%,0%,0%);fill-opacity:0.2;stroke:none;"/>
                            </g>
                        </mask>
                        <clipPath id="clip4">
                            <rect x="0" y="0" width="40" height="40"/>
                        </clipPath>
                        <g id="surface14" clip-path="url(#clip4)">
                            <path style=" stroke:none;fill-rule:nonzero;fill:rgb(25.882353%,25.882353%,25.882353%);fill-opacity:1;" d="M 14.148438 29.320312 L 14.148438 30.328125 C 14.507812 30.328125 14.867188 30.390625 15.210938 30.507812 C 16.03125 30.792969 16.6875 31.382812 17.066406 32.160156 C 17.445312 32.9375 17.492188 33.820312 17.210938 34.636719 C 16.757812 35.941406 15.523438 36.816406 14.148438 36.816406 C 13.785156 36.816406 13.429688 36.753906 13.082031 36.632812 C 11.394531 36.046875 10.496094 34.195312 11.085938 32.507812 C 11.539062 31.203125 12.769531 30.328125 14.148438 30.328125 L 14.148438 29.320312 M 14.148438 29.320312 C 12.390625 29.320312 10.746094 30.421875 10.132812 32.175781 C 9.363281 34.390625 10.535156 36.8125 12.75 37.585938 C 13.210938 37.742188 13.683594 37.820312 14.148438 37.820312 C 15.902344 37.820312 17.546875 36.722656 18.160156 34.96875 C 18.929688 32.753906 17.757812 30.332031 15.542969 29.558594 C 15.082031 29.398438 14.609375 29.320312 14.148438 29.320312 Z M 14.148438 29.320312 "/>
                        </g>
                        <mask id="mask4">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="40" height="40" style="fill:rgb(0%,0%,0%);fill-opacity:0.2;stroke:none;"/>
                            </g>
                        </mask>
                        <clipPath id="clip5">
                            <rect x="0" y="0" width="40" height="40"/>
                        </clipPath>
                        <g id="surface17" clip-path="url(#clip5)">
                            <path style=" stroke:none;fill-rule:nonzero;fill:rgb(25.882353%,12.941176%,4.313725%);fill-opacity:1;" d="M 28.441406 1.929688 L 30.050781 1.9375 C 30.0625 1.960938 30.070312 1.996094 30.070312 2.039062 C 30.078125 2.851562 29.859375 4.390625 29.222656 6.273438 C 28.535156 8.300781 27.5 10.332031 26.210938 12.179688 C 26.023438 12.007812 25.820312 11.835938 25.617188 11.675781 C 27.261719 8.792969 28.210938 5.515625 28.441406 1.929688 M 28.234375 1.304688 C 28.007812 1.304688 27.839844 1.515625 27.820312 1.808594 C 27.578125 5.859375 26.425781 9.164062 24.789062 11.851562 C 25.351562 12.21875 25.832031 12.667969 26.300781 13.132812 C 29.789062 8.414062 30.710938 3.800781 30.695312 2.03125 C 30.695312 1.648438 30.4375 1.316406 30.148438 1.3125 Z M 28.234375 1.304688 "/>
                        </g>
                        <radialGradient id="radial3" gradientUnits="userSpaceOnUse" cx="67.042" cy="37.1072" fx="67.042" fy="37.1072" r="15.028" gradientTransform="matrix(-0.309281,-0.0447813,-0.0447813,0.309281,39.303125,2.953531)">
                            <stop offset="0.2611" style="stop-color:rgb(65.490196%,24.705882%,72.54902%);stop-opacity:1;"/>
                            <stop offset="0.4753" style="stop-color:rgb(62.745098%,22.745098%,70.980392%);stop-opacity:1;"/>
                            <stop offset="0.789" style="stop-color:rgb(54.901961%,16.862745%,67.058824%);stop-opacity:1;"/>
                            <stop offset="1" style="stop-color:rgb(48.235294%,12.156863%,63.529412%);stop-opacity:1;"/>
                        </radialGradient>
                        <mask id="mask5">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="40" height="40" style="fill:rgb(0%,0%,0%);fill-opacity:0.2;stroke:none;"/>
                            </g>
                        </mask>
                        <clipPath id="clip6">
                            <rect x="0" y="0" width="40" height="40"/>
                        </clipPath>
                        <g id="surface20" clip-path="url(#clip6)">
                            <path style=" stroke:none;fill-rule:nonzero;fill:rgb(25.882353%,25.882353%,25.882353%);fill-opacity:1;" d="M 15.089844 7.695312 C 15.78125 7.695312 16.457031 7.839844 17.09375 8.128906 C 19.566406 9.234375 20.675781 12.148438 19.566406 14.617188 C 18.773438 16.378906 17.015625 17.519531 15.082031 17.519531 C 14.390625 17.519531 13.714844 17.375 13.078125 17.085938 C 10.605469 15.980469 9.496094 13.070312 10.605469 10.601562 C 11.398438 8.835938 13.15625 7.695312 15.089844 7.695312 M 15.089844 6.757812 C 12.855469 6.757812 10.726562 8.046875 9.75 10.21875 C 8.429688 13.164062 9.75 16.625 12.695312 17.945312 C 13.472656 18.292969 14.285156 18.460938 15.085938 18.460938 C 17.320312 18.460938 19.449219 17.171875 20.425781 15 C 21.742188 12.054688 20.425781 8.59375 17.476562 7.273438 C 16.699219 6.925781 15.886719 6.757812 15.089844 6.757812 Z M 15.089844 6.757812 "/>
                        </g>
                        <radialGradient id="radial4" gradientUnits="userSpaceOnUse" cx="83.1732" cy="81.4883" fx="83.1732" fy="81.4883" r="17.7078" gradientTransform="matrix(-0.311969,-0.0179687,-0.0179687,0.311969,38.616344,1.107469)">
                            <stop offset="0.2611" style="stop-color:rgb(65.490196%,24.705882%,72.54902%);stop-opacity:1;"/>
                            <stop offset="0.4753" style="stop-color:rgb(62.745098%,22.745098%,70.980392%);stop-opacity:1;"/>
                            <stop offset="0.789" style="stop-color:rgb(54.901961%,16.862745%,67.058824%);stop-opacity:1;"/>
                            <stop offset="1" style="stop-color:rgb(48.235294%,12.156863%,63.529412%);stop-opacity:1;"/>
                        </radialGradient>
                        <mask id="mask6">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="40" height="40" style="fill:rgb(0%,0%,0%);fill-opacity:0.2;stroke:none;"/>
                            </g>
                        </mask>
                        <clipPath id="clip7">
                            <rect x="0" y="0" width="40" height="40"/>
                        </clipPath>
                        <g id="surface23" clip-path="url(#clip7)">
                            <path style=" stroke:none;fill-rule:nonzero;fill:rgb(25.882353%,25.882353%,25.882353%);fill-opacity:1;" d="M 9.5 21.917969 L 9.5 22.855469 C 9.953125 22.855469 10.398438 22.929688 10.835938 23.085938 C 11.859375 23.441406 12.679688 24.175781 13.152344 25.148438 C 13.625 26.125 13.6875 27.226562 13.332031 28.25 C 12.761719 29.882812 11.226562 30.976562 9.5 30.976562 C 9.046875 30.976562 8.601562 30.898438 8.164062 30.746094 C 7.140625 30.390625 6.320312 29.65625 5.847656 28.679688 C 5.375 27.707031 5.3125 26.605469 5.667969 25.582031 C 6.234375 23.949219 7.773438 22.855469 9.5 22.855469 L 9.5 21.917969 M 9.5 21.917969 C 7.433594 21.917969 5.5 23.210938 4.785156 25.273438 C 3.878906 27.878906 5.257812 30.726562 7.859375 31.632812 C 8.402344 31.820312 8.957031 31.910156 9.5 31.910156 C 11.566406 31.910156 13.5 30.617188 14.214844 28.554688 C 15.121094 25.949219 13.742188 23.101562 11.140625 22.195312 C 10.597656 22.007812 10.042969 21.917969 9.5 21.917969 Z M 9.5 21.917969 "/>
                        </g>
                        <radialGradient id="radial5" gradientUnits="userSpaceOnUse" cx="49.688" cy="106.7312" fx="49.688" fy="106.7312" r="17.6537" gradientTransform="matrix(-0.3125,0,0,0.3125,37.542625,0)">
                            <stop offset="0.00614522" style="stop-color:rgb(60.784314%,22.745098%,67.058824%);stop-opacity:1;"/>
                            <stop offset="0.2662" style="stop-color:rgb(58.039216%,20.392157%,65.490196%);stop-opacity:1;"/>
                            <stop offset="0.6473" style="stop-color:rgb(50.196078%,14.509804%,61.176471%);stop-opacity:1;"/>
                            <stop offset="1" style="stop-color:rgb(40.784314%,7.058824%,56.078431%);stop-opacity:1;"/>
                        </radialGradient>
                        <mask id="mask7">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="40" height="40" style="fill:rgb(0%,0%,0%);fill-opacity:0.2;stroke:none;"/>
                            </g>
                        </mask>
                        <clipPath id="clip8">
                            <rect x="0" y="0" width="40" height="40"/>
                        </clipPath>
                        <g id="surface26" clip-path="url(#clip8)">
                            <path style=" stroke:none;fill-rule:nonzero;fill:rgb(25.882353%,25.882353%,25.882353%);fill-opacity:1;" d="M 20.910156 26.617188 L 20.910156 27.554688 C 21.324219 27.554688 21.734375 27.625 22.132812 27.765625 C 23.070312 28.089844 23.824219 28.765625 24.257812 29.660156 C 24.6875 30.554688 24.746094 31.5625 24.421875 32.5 C 23.902344 33.992188 22.492188 34.996094 20.910156 34.996094 C 20.492188 34.996094 20.085938 34.929688 19.6875 34.789062 C 18.75 34.460938 17.992188 33.789062 17.5625 32.894531 C 17.132812 32 17.070312 30.992188 17.398438 30.054688 C 17.914062 28.558594 19.328125 27.554688 20.910156 27.554688 L 20.910156 26.617188 M 20.90625 26.617188 C 18.980469 26.617188 17.179688 27.824219 16.507812 29.746094 C 15.664062 32.175781 16.945312 34.832031 19.378906 35.675781 C 19.882812 35.851562 20.398438 35.933594 20.910156 35.933594 C 22.835938 35.933594 24.636719 34.726562 25.304688 32.804688 C 26.148438 30.378906 24.867188 27.722656 22.4375 26.878906 C 21.929688 26.699219 21.414062 26.617188 20.90625 26.617188 Z M 20.90625 26.617188 "/>
                        </g>
                        <radialGradient id="radial6" gradientUnits="userSpaceOnUse" cx="64.8169" cy="81.2179" fx="64.8169" fy="81.2179" r="20.7872" gradientTransform="matrix(-0.3125,0,0,0.3125,37.542625,0)">
                            <stop offset="0" style="stop-color:rgb(65.490196%,24.705882%,72.54902%);stop-opacity:1;"/>
                            <stop offset="1" style="stop-color:rgb(48.235294%,12.156863%,63.529412%);stop-opacity:1;"/>
                        </radialGradient>
                        <mask id="mask8">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="40" height="40" style="fill:rgb(0%,0%,0%);fill-opacity:0.2;stroke:none;"/>
                            </g>
                        </mask>
                        <clipPath id="clip9">
                            <rect x="0" y="0" width="40" height="40"/>
                        </clipPath>
                        <g id="surface29" clip-path="url(#clip9)">
                            <path style=" stroke:none;fill-rule:nonzero;fill:rgb(25.882353%,25.882353%,25.882353%);fill-opacity:1;" d="M 14.953125 22.78125 L 14.953125 23.71875 C 15.410156 23.71875 15.863281 23.796875 16.300781 23.945312 C 18.433594 24.691406 19.566406 27.027344 18.820312 29.164062 C 18.25 30.808594 16.695312 31.914062 14.953125 31.914062 C 14.496094 31.914062 14.042969 31.835938 13.605469 31.683594 C 12.570312 31.324219 11.742188 30.585938 11.265625 29.601562 C 10.789062 28.617188 10.726562 27.503906 11.085938 26.46875 C 11.65625 24.820312 13.210938 23.71875 14.953125 23.71875 L 14.953125 22.78125 M 14.953125 22.78125 C 12.871094 22.78125 10.921875 24.085938 10.199219 26.164062 C 9.289062 28.789062 10.675781 31.65625 13.300781 32.570312 C 13.847656 32.761719 14.40625 32.851562 14.953125 32.851562 C 17.035156 32.851562 18.984375 31.550781 19.707031 29.472656 C 20.617188 26.847656 19.230469 23.976562 16.605469 23.0625 C 16.0625 22.871094 15.503906 22.78125 14.953125 22.78125 Z M 14.953125 22.78125 "/>
                        </g>
                        <radialGradient id="radial7" gradientUnits="userSpaceOnUse" cx="44.6503" cy="37.2109" fx="44.6503" fy="37.2109" r="13.2798" gradientTransform="matrix(-0.311969,-0.0179687,-0.0179687,0.311969,38.616344,1.107469)">
                            <stop offset="0.2611" style="stop-color:rgb(65.490196%,24.705882%,72.54902%);stop-opacity:1;"/>
                            <stop offset="0.4753" style="stop-color:rgb(62.745098%,22.745098%,70.980392%);stop-opacity:1;"/>
                            <stop offset="0.789" style="stop-color:rgb(54.901961%,16.862745%,67.058824%);stop-opacity:1;"/>
                            <stop offset="1" style="stop-color:rgb(48.235294%,12.156863%,63.529412%);stop-opacity:1;"/>
                        </radialGradient>
                        <mask id="mask9">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="40" height="40" style="fill:rgb(0%,0%,0%);fill-opacity:0.2;stroke:none;"/>
                            </g>
                        </mask>
                        <clipPath id="clip10">
                            <rect x="0" y="0" width="40" height="40"/>
                        </clipPath>
                        <g id="surface32" clip-path="url(#clip10)">
                            <path style=" stroke:none;fill-rule:nonzero;fill:rgb(25.882353%,25.882353%,25.882353%);fill-opacity:1;" d="M 22.507812 7.925781 L 22.507812 8.753906 C 22.992188 8.753906 23.46875 8.835938 23.929688 8.996094 C 25.023438 9.378906 25.90625 10.164062 26.414062 11.207031 C 26.914062 12.25 26.984375 13.429688 26.601562 14.523438 C 25.996094 16.265625 24.351562 17.433594 22.507812 17.433594 C 22.023438 17.433594 21.542969 17.351562 21.082031 17.191406 C 19.988281 16.808594 19.105469 16.023438 18.601562 14.980469 C 18.097656 13.9375 18.027344 12.757812 18.410156 11.664062 C 19.015625 9.921875 20.664062 8.753906 22.507812 8.753906 L 22.507812 7.925781 M 22.503906 7.925781 C 20.367188 7.925781 18.367188 9.261719 17.621094 11.394531 C 16.683594 14.085938 18.109375 17.035156 20.804688 17.972656 C 21.367188 18.167969 21.9375 18.257812 22.503906 18.257812 C 24.640625 18.257812 26.640625 16.921875 27.382812 14.789062 C 28.320312 12.097656 26.898438 9.148438 24.203125 8.210938 C 23.640625 8.019531 23.070312 7.925781 22.503906 7.925781 Z M 22.503906 7.925781 "/>
                        </g>
                        <radialGradient id="radial8" gradientUnits="userSpaceOnUse" cx="11.2837" cy="54.8094" fx="11.2837" fy="54.8094" r="20.5971" gradientTransform="matrix(-0.3125,0,0,0.3125,37.542625,0)">
                            <stop offset="0.2611" style="stop-color:rgb(65.490196%,24.705882%,72.54902%);stop-opacity:1;"/>
                            <stop offset="0.4753" style="stop-color:rgb(62.745098%,22.745098%,70.980392%);stop-opacity:1;"/>
                            <stop offset="0.789" style="stop-color:rgb(54.901961%,16.862745%,67.058824%);stop-opacity:1;"/>
                            <stop offset="1" style="stop-color:rgb(48.235294%,12.156863%,63.529412%);stop-opacity:1;"/>
                        </radialGradient>
                        <mask id="mask10">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="40" height="40" style="fill:rgb(0%,0%,0%);fill-opacity:0.2;stroke:none;"/>
                            </g>
                        </mask>
                        <clipPath id="clip11">
                            <rect x="0" y="0" width="40" height="40"/>
                        </clipPath>
                        <g id="surface35" clip-path="url(#clip11)">
                            <path style=" stroke:none;fill-rule:nonzero;fill:rgb(25.882353%,25.882353%,25.882353%);fill-opacity:1;" d="M 30.523438 13.769531 L 30.523438 14.707031 C 31.101562 14.707031 31.671875 14.804688 32.222656 14.996094 C 34.914062 15.933594 36.347656 18.890625 35.410156 21.585938 C 34.6875 23.664062 32.722656 25.058594 30.523438 25.058594 C 29.945312 25.058594 29.371094 24.960938 28.820312 24.769531 C 27.515625 24.316406 26.464844 23.378906 25.867188 22.132812 C 25.261719 20.890625 25.179688 19.488281 25.636719 18.179688 C 26.359375 16.101562 28.324219 14.707031 30.523438 14.707031 L 30.523438 13.769531 M 30.523438 13.769531 C 27.992188 13.769531 25.628906 15.351562 24.75 17.871094 C 23.640625 21.058594 25.324219 24.542969 28.511719 25.652344 C 29.179688 25.882812 29.855469 25.992188 30.523438 25.992188 C 33.050781 25.992188 35.414062 24.414062 36.292969 21.890625 C 37.402344 18.703125 35.71875 15.21875 32.53125 14.109375 C 31.867188 13.878906 31.1875 13.769531 30.523438 13.769531 Z M 30.523438 13.769531 "/>
                        </g>
                        <radialGradient id="radial9" gradientUnits="userSpaceOnUse" cx="68.7679" cy="56.7534" fx="68.7679" fy="56.7534" r="16.7446" gradientTransform="matrix(-0.311969,-0.0179687,-0.0179687,0.311969,38.616344,1.107469)">
                            <stop offset="0.2611" style="stop-color:rgb(65.490196%,24.705882%,72.54902%);stop-opacity:1;"/>
                            <stop offset="0.4753" style="stop-color:rgb(62.745098%,22.745098%,70.980392%);stop-opacity:1;"/>
                            <stop offset="0.789" style="stop-color:rgb(54.901961%,16.862745%,67.058824%);stop-opacity:1;"/>
                            <stop offset="1" style="stop-color:rgb(48.235294%,12.156863%,63.529412%);stop-opacity:1;"/>
                        </radialGradient>
                        <mask id="mask11">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="40" height="40" style="fill:rgb(0%,0%,0%);fill-opacity:0.2;stroke:none;"/>
                            </g>
                        </mask>
                        <clipPath id="clip12">
                            <rect x="0" y="0" width="40" height="40"/>
                        </clipPath>
                        <g id="surface38" clip-path="url(#clip12)">
                            <path style=" stroke:none;fill-rule:nonzero;fill:rgb(25.882353%,25.882353%,25.882353%);fill-opacity:1;" d="M 15.210938 13.441406 L 15.210938 14.378906 C 15.707031 14.378906 16.195312 14.460938 16.664062 14.625 C 18.964844 15.425781 20.1875 17.949219 19.386719 20.25 C 18.769531 22.023438 17.09375 23.21875 15.214844 23.21875 C 14.722656 23.21875 14.234375 23.132812 13.761719 22.972656 C 12.648438 22.585938 11.75 21.785156 11.238281 20.722656 C 10.726562 19.660156 10.652344 18.460938 11.039062 17.347656 C 11.660156 15.570312 13.335938 14.378906 15.210938 14.378906 L 15.210938 13.441406 M 15.210938 13.441406 C 12.996094 13.441406 10.925781 14.828125 10.152344 17.039062 C 9.179688 19.832031 10.65625 22.882812 13.449219 23.855469 C 14.03125 24.058594 14.625 24.15625 15.210938 24.15625 C 17.425781 24.15625 19.496094 22.769531 20.269531 20.558594 C 21.242188 17.765625 19.765625 14.710938 16.972656 13.742188 C 16.390625 13.535156 15.796875 13.4375 15.210938 13.441406 Z M 15.210938 13.441406 "/>
                        </g>
                        <radialGradient id="radial10" gradientUnits="userSpaceOnUse" cx="31.3786" cy="78.8717" fx="31.3786" fy="78.8717" r="15.1146" gradientTransform="matrix(-0.311969,-0.0179687,-0.0179687,0.311969,38.616344,1.107469)">
                            <stop offset="0.2611" style="stop-color:rgb(63.529412%,20.392157%,70.980392%);stop-opacity:1;"/>
                            <stop offset="0.4934" style="stop-color:rgb(60.784314%,18.823529%,69.411765%);stop-opacity:1;"/>
                            <stop offset="0.8338" style="stop-color:rgb(52.941176%,14.901961%,65.882353%);stop-opacity:1;"/>
                            <stop offset="1" style="stop-color:rgb(48.235294%,12.156863%,63.529412%);stop-opacity:1;"/>
                        </radialGradient>
                        <mask id="mask12">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="40" height="40" style="fill:rgb(0%,0%,0%);fill-opacity:0.2;stroke:none;"/>
                            </g>
                        </mask>
                        <clipPath id="clip13">
                            <rect x="0" y="0" width="40" height="40"/>
                        </clipPath>
                        <g id="surface41" clip-path="url(#clip13)">
                            <path style=" stroke:none;fill-rule:nonzero;fill:rgb(25.882353%,25.882353%,25.882353%);fill-opacity:1;" d="M 26.433594 21.136719 L 26.433594 22.074219 C 26.894531 22.074219 27.351562 22.152344 27.789062 22.304688 C 28.832031 22.667969 29.667969 23.414062 30.148438 24.40625 C 30.632812 25.398438 30.695312 26.519531 30.332031 27.558594 C 29.753906 29.21875 28.1875 30.332031 26.433594 30.332031 C 25.976562 30.332031 25.519531 30.253906 25.078125 30.101562 C 24.039062 29.738281 23.199219 28.992188 22.71875 28 C 22.238281 27.007812 22.175781 25.886719 22.539062 24.847656 C 23.117188 23.1875 24.679688 22.074219 26.4375 22.074219 L 26.433594 21.136719 M 26.433594 21.136719 C 24.335938 21.136719 22.378906 22.449219 21.648438 24.539062 C 20.730469 27.179688 22.128906 30.070312 24.769531 30.992188 C 25.320312 31.179688 25.882812 31.273438 26.433594 31.273438 C 28.53125 31.273438 30.492188 29.960938 31.21875 27.867188 C 32.136719 25.226562 30.742188 22.339844 28.101562 21.417969 C 27.550781 21.226562 26.988281 21.136719 26.433594 21.136719 Z M 26.433594 21.136719 "/>
                        </g>
                        <radialGradient id="radial11" gradientUnits="userSpaceOnUse" cx="49.8763" cy="59.6128" fx="49.8763" fy="59.6128" r="18.2239" gradientTransform="matrix(-0.311969,-0.0179687,-0.0179687,0.311969,38.616344,1.107469)">
                            <stop offset="0.2611" style="stop-color:rgb(65.490196%,24.705882%,72.54902%);stop-opacity:1;"/>
                            <stop offset="0.4753" style="stop-color:rgb(62.745098%,22.745098%,70.980392%);stop-opacity:1;"/>
                            <stop offset="0.789" style="stop-color:rgb(54.901961%,16.862745%,67.058824%);stop-opacity:1;"/>
                            <stop offset="1" style="stop-color:rgb(48.235294%,12.156863%,63.529412%);stop-opacity:1;"/>
                        </radialGradient>
                        <mask id="mask13">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="40" height="40" style="fill:rgb(0%,0%,0%);fill-opacity:0.2;stroke:none;"/>
                            </g>
                        </mask>
                        <clipPath id="clip14">
                            <rect x="0" y="0" width="40" height="40"/>
                        </clipPath>
                        <g id="surface44" clip-path="url(#clip14)">
                            <path style=" stroke:none;fill-rule:nonzero;fill:rgb(25.882353%,25.882353%,25.882353%);fill-opacity:1;" d="M 20.398438 15.054688 L 20.398438 15.992188 C 20.960938 15.992188 21.515625 16.085938 22.054688 16.273438 C 24.679688 17.183594 26.070312 20.066406 25.15625 22.691406 C 24.449219 24.714844 22.539062 26.074219 20.398438 26.074219 C 19.835938 26.074219 19.277344 25.980469 18.742188 25.792969 C 16.117188 24.882812 14.722656 22 15.636719 19.375 C 16.34375 17.351562 18.257812 15.992188 20.398438 15.992188 L 20.398438 15.054688 M 20.398438 15.054688 C 17.921875 15.054688 15.609375 16.601562 14.75 19.070312 C 13.664062 22.1875 15.3125 25.59375 18.429688 26.679688 C 19.082031 26.90625 19.742188 27.015625 20.398438 27.015625 C 22.871094 27.015625 25.183594 25.46875 26.042969 23 C 27.128906 19.882812 25.480469 16.476562 22.363281 15.386719 C 21.710938 15.164062 21.050781 15.054688 20.398438 15.054688 Z M 20.398438 15.054688 "/>
                        </g>
                        <linearGradient id="linear1" gradientUnits="userSpaceOnUse" x1="27.5706" y1="30.5723" x2="27.5706" y2="70.9211" gradientTransform="matrix(-0.3055,0.0657812,0.0657812,0.3055,34.386781,-2.25975)">
                            <stop offset="0.00614522" style="stop-color:rgb(40.784314%,62.352941%,21.960784%);stop-opacity:1;"/>
                            <stop offset="1" style="stop-color:rgb(61.176471%,80%,39.607843%);stop-opacity:1;"/>
                        </linearGradient>
                        <mask id="mask14">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="40" height="40" style="fill:rgb(0%,0%,0%);fill-opacity:0.2;stroke:none;"/>
                            </g>
                        </mask>
                        <clipPath id="clip15">
                            <rect x="0" y="0" width="40" height="40"/>
                        </clipPath>
                        <g id="surface47" clip-path="url(#clip15)">
                            <path style=" stroke:none;fill-rule:nonzero;fill:rgb(25.882353%,25.882353%,25.882353%);fill-opacity:1;" d="M 31.925781 7.195312 C 32.03125 7.722656 32.148438 8.574219 32.035156 9.460938 C 32.011719 9.632812 32.066406 9.808594 32.179688 9.945312 C 32.289062 10.078125 32.457031 10.15625 32.632812 10.164062 C 32.789062 10.167969 32.929688 10.179688 33.066406 10.203125 C 34.734375 10.46875 36.023438 11.960938 36.585938 12.726562 C 35.902344 13.21875 34.492188 14.074219 33.015625 14.074219 C 32.824219 14.074219 32.632812 14.058594 32.453125 14.03125 C 32.183594 13.988281 31.914062 13.910156 31.621094 13.789062 C 31.542969 13.757812 31.460938 13.742188 31.382812 13.742188 C 31.179688 13.742188 30.984375 13.835938 30.863281 14.015625 C 30.695312 14.261719 30.726562 14.589844 30.929688 14.804688 C 31.527344 15.417969 31.898438 16.054688 32.023438 16.6875 C 32.351562 18.375 31.0625 20.195312 30.457031 20.941406 C 30.152344 20.773438 29.71875 20.515625 29.265625 20.167969 C 28.535156 19.609375 27.617188 18.710938 27.398438 17.597656 C 27.28125 16.996094 27.363281 16.320312 27.640625 15.578125 C 27.742188 15.300781 27.640625 14.992188 27.390625 14.832031 C 27.289062 14.765625 27.171875 14.734375 27.054688 14.734375 C 26.894531 14.734375 26.730469 14.800781 26.609375 14.921875 C 26.414062 15.125 26.214844 15.289062 26.011719 15.421875 C 25.324219 15.875 24.429688 16.101562 23.359375 16.101562 C 22.703125 16.101562 22.109375 16.015625 21.710938 15.933594 C 21.90625 15.007812 22.464844 13.113281 23.878906 12.179688 C 23.992188 12.105469 24.117188 12.035156 24.257812 11.964844 C 24.414062 11.886719 24.53125 11.746094 24.582031 11.578125 C 24.632812 11.410156 24.605469 11.226562 24.511719 11.078125 C 24.046875 10.324219 23.800781 9.492188 23.679688 8.96875 C 24.058594 8.890625 24.605469 8.808594 25.207031 8.808594 C 26.152344 8.808594 26.945312 9.007812 27.554688 9.398438 L 27.570312 9.414062 C 27.589844 9.429688 27.613281 9.445312 27.632812 9.460938 C 27.742188 9.535156 27.863281 9.570312 27.988281 9.570312 C 28.03125 9.570312 28.074219 9.570312 28.117188 9.558594 C 28.289062 9.523438 28.433594 9.417969 28.523438 9.273438 C 28.539062 9.246094 28.550781 9.226562 28.5625 9.199219 L 28.570312 9.1875 C 29.386719 7.917969 31.0625 7.386719 31.925781 7.195312 M 32.390625 6.472656 C 32.390625 6.472656 29.351562 6.828125 28.042969 8.847656 C 28.023438 8.878906 28.007812 8.914062 27.988281 8.945312 C 27.957031 8.925781 27.929688 8.898438 27.894531 8.878906 C 27.058594 8.339844 26.070312 8.179688 25.199219 8.179688 C 23.960938 8.179688 22.953125 8.5 22.953125 8.5 C 22.953125 8.5 23.140625 10.042969 23.976562 11.402344 C 23.828125 11.476562 23.679688 11.5625 23.535156 11.65625 C 21.351562 13.09375 20.992188 16.398438 20.992188 16.398438 C 20.992188 16.398438 22.046875 16.726562 23.359375 16.726562 C 24.324219 16.726562 25.429688 16.550781 26.355469 15.941406 C 26.617188 15.769531 26.847656 15.570312 27.054688 15.351562 C 26.78125 16.089844 26.628906 16.90625 26.789062 17.710938 C 27.285156 20.238281 30.609375 21.710938 30.609375 21.710938 C 30.609375 21.710938 33.132812 19.089844 32.632812 16.5625 C 32.464844 15.699219 31.960938 14.960938 31.382812 14.363281 C 31.6875 14.492188 32.011719 14.589844 32.351562 14.648438 C 32.574219 14.679688 32.792969 14.695312 33.011719 14.695312 C 35.34375 14.695312 37.429688 12.859375 37.429688 12.859375 C 37.429688 12.859375 35.742188 9.992188 33.160156 9.582031 C 32.988281 9.554688 32.820312 9.539062 32.648438 9.535156 C 32.855469 7.953125 32.390625 6.472656 32.390625 6.472656 Z M 32.390625 6.472656 "/>
                        </g>
                    </defs>
                    <g id="surface1">
                        <path style=" stroke:none;fill-rule:nonzero;fill:url(#linear0);" d="M 26.023438 5.738281 C 26.023438 5.910156 26.007812 6.082031 25.992188 6.246094 C 27.585938 6.292969 28.976562 6.984375 28.976562 6.984375 C 28.976562 6.984375 28.152344 9.933594 25.953125 10.910156 C 25.917969 10.925781 25.882812 10.933594 25.847656 10.949219 C 25.863281 10.984375 25.882812 11.015625 25.898438 11.054688 C 26.871094 13.253906 25.5 15.992188 25.5 15.992188 C 25.5 15.992188 24.007812 15.566406 22.792969 14.523438 C 22.695312 14.664062 22.589844 14.796875 22.476562 14.925781 C 20.710938 16.855469 17.390625 16.695312 17.390625 16.695312 C 17.390625 16.695312 16.925781 13.398438 18.683594 11.46875 C 18.914062 11.210938 19.179688 11 19.453125 10.8125 C 18.632812 10.972656 17.742188 10.984375 16.925781 10.652344 C 14.539062 9.679688 13.734375 6.132812 13.734375 6.132812 C 13.734375 6.132812 16.792969 4.164062 19.175781 5.132812 C 19.9375 5.445312 20.535156 6.019531 21 6.652344 C 20.933594 6.359375 20.894531 6.054688 20.894531 5.742188 C 20.890625 3.132812 23.449219 1.007812 23.449219 1.007812 C 23.449219 1.007812 26.019531 3.125 26.023438 5.738281 Z M 26.023438 5.738281 "/>
                        <use xlink:href="#surface5" mask="url(#mask0)"/>
                        <path style=" stroke:none;fill-rule:nonzero;fill:url(#radial0);" d="M 12.878906 34.667969 C 12.878906 36.902344 11.066406 38.710938 8.835938 38.710938 C 6.601562 38.710938 4.789062 36.902344 4.789062 34.667969 C 4.789062 32.433594 6.601562 30.625 8.835938 30.625 C 11.066406 30.625 12.878906 32.433594 12.878906 34.667969 Z M 12.878906 34.667969 "/>
                        <use xlink:href="#surface8" mask="url(#mask1)"/>
                        <path style=" stroke:none;fill-rule:nonzero;fill:url(#radial1);" d="M 14.863281 18.460938 C 14.863281 21.417969 12.464844 23.816406 9.507812 23.816406 C 6.546875 23.816406 4.148438 21.417969 4.148438 18.460938 C 4.148438 15.5 6.546875 13.101562 9.507812 13.101562 C 12.464844 13.101562 14.863281 15.5 14.863281 18.460938 Z M 14.863281 18.460938 "/>
                        <use xlink:href="#surface11" mask="url(#mask2)"/>
                        <path style=" stroke:none;fill-rule:nonzero;fill:url(#radial2);" d="M 18.394531 33.570312 C 18.394531 35.917969 16.492188 37.820312 14.148438 37.820312 C 11.800781 37.820312 9.898438 35.917969 9.898438 33.570312 C 9.898438 31.226562 11.800781 29.324219 14.148438 29.324219 C 16.492188 29.324219 18.394531 31.226562 18.394531 33.570312 Z M 18.394531 33.570312 "/>
                        <use xlink:href="#surface14" mask="url(#mask3)"/>
                        <path style=" stroke:none;fill-rule:nonzero;fill:rgb(55.294118%,43.137255%,38.823529%);fill-opacity:1;" d="M 24.789062 11.851562 C 26.421875 9.164062 27.574219 5.859375 27.820312 1.808594 C 27.835938 1.515625 28.007812 1.304688 28.234375 1.304688 L 30.148438 1.316406 C 30.433594 1.320312 30.691406 1.652344 30.695312 2.035156 C 30.710938 3.804688 29.789062 8.414062 26.292969 13.132812 C 25.828125 12.664062 25.347656 12.21875 24.789062 11.851562 Z M 24.789062 11.851562 "/>
                        <use xlink:href="#surface17" mask="url(#mask4)"/>
                        <path style=" stroke:none;fill-rule:nonzero;fill:url(#radial3);" d="M 20.933594 12.609375 C 20.933594 15.839844 18.316406 18.457031 15.085938 18.457031 C 11.859375 18.457031 9.242188 15.839844 9.242188 12.609375 C 9.242188 9.378906 11.859375 6.761719 15.085938 6.761719 C 18.316406 6.761719 20.933594 9.378906 20.933594 12.609375 Z M 20.933594 12.609375 "/>
                        <use xlink:href="#surface20" mask="url(#mask5)"/>
                        <path style=" stroke:none;fill-rule:nonzero;fill:url(#radial4);" d="M 14.492188 26.914062 C 14.492188 29.671875 12.257812 31.910156 9.5 31.910156 C 6.742188 31.910156 4.507812 29.671875 4.507812 26.914062 C 4.507812 24.15625 6.742188 21.921875 9.5 21.921875 C 12.257812 21.921875 14.492188 24.15625 14.492188 26.914062 Z M 14.492188 26.914062 "/>
                        <use xlink:href="#surface23" mask="url(#mask6)"/>
                        <path style=" stroke:none;fill-rule:nonzero;fill:url(#radial5);" d="M 25.5625 31.273438 C 25.5625 33.847656 23.476562 35.929688 20.90625 35.929688 C 18.335938 35.929688 16.25 33.847656 16.25 31.273438 C 16.25 28.703125 18.335938 26.617188 20.90625 26.617188 C 23.476562 26.617188 25.5625 28.703125 25.5625 31.273438 Z M 25.5625 31.273438 "/>
                        <use xlink:href="#surface26" mask="url(#mask7)"/>
                        <path style=" stroke:none;fill-rule:nonzero;fill:url(#radial6);" d="M 19.988281 27.816406 C 19.988281 30.597656 17.734375 32.851562 14.953125 32.851562 C 12.171875 32.851562 9.917969 30.597656 9.917969 27.816406 C 9.917969 25.035156 12.171875 22.78125 14.953125 22.78125 C 17.734375 22.78125 19.988281 25.035156 19.988281 27.816406 Z M 19.988281 27.816406 "/>
                        <use xlink:href="#surface29" mask="url(#mask8)"/>
                        <path style=" stroke:none;fill-rule:nonzero;fill:url(#radial7);" d="M 27.671875 13.09375 C 27.671875 15.945312 25.359375 18.257812 22.507812 18.257812 C 19.652344 18.257812 17.339844 15.945312 17.339844 13.09375 C 17.339844 10.242188 19.652344 7.929688 22.507812 7.929688 C 25.359375 7.929688 27.671875 10.242188 27.671875 13.09375 Z M 27.671875 13.09375 "/>
                        <use xlink:href="#surface32" mask="url(#mask9)"/>
                        <path style=" stroke:none;fill-rule:nonzero;fill:url(#radial8);" d="M 36.632812 19.882812 C 36.632812 23.257812 33.898438 25.992188 30.523438 25.992188 C 27.144531 25.992188 24.410156 23.257812 24.410156 19.882812 C 24.410156 16.503906 27.144531 13.769531 30.523438 13.769531 C 33.898438 13.769531 36.632812 16.503906 36.632812 19.882812 Z M 36.632812 19.882812 "/>
                        <use xlink:href="#surface35" mask="url(#mask10)"/>
                        <path style=" stroke:none;fill-rule:nonzero;fill:url(#radial9);" d="M 20.570312 18.796875 C 20.570312 21.753906 18.171875 24.152344 15.210938 24.152344 C 12.253906 24.152344 9.855469 21.753906 9.855469 18.796875 C 9.855469 15.839844 12.253906 13.441406 15.210938 13.441406 C 18.171875 13.441406 20.570312 15.839844 20.570312 18.796875 Z M 20.570312 18.796875 "/>
                        <use xlink:href="#surface38" mask="url(#mask11)"/>
                        <path style=" stroke:none;fill-rule:nonzero;fill:url(#radial10);" d="M 31.5 26.207031 C 31.5 29.003906 29.230469 31.273438 26.433594 31.273438 C 23.636719 31.273438 21.367188 29.003906 21.367188 26.207031 C 21.367188 23.410156 23.636719 21.140625 26.433594 21.140625 C 29.230469 21.140625 31.5 23.410156 31.5 26.207031 Z M 31.5 26.207031 "/>
                        <use xlink:href="#surface41" mask="url(#mask12)"/>
                        <path style=" stroke:none;fill-rule:nonzero;fill:url(#radial11);" d="M 26.375 21.035156 C 26.375 24.335938 23.699219 27.011719 20.398438 27.011719 C 17.09375 27.011719 14.417969 24.335938 14.417969 21.035156 C 14.417969 17.734375 17.09375 15.054688 20.398438 15.054688 C 23.699219 15.054688 26.375 17.734375 26.375 21.035156 Z M 26.375 21.035156 "/>
                        <use xlink:href="#surface44" mask="url(#mask13)"/>
                        <path style=" stroke:none;fill-rule:nonzero;fill:url(#linear1);" d="M 23.535156 11.660156 C 23.679688 11.566406 23.828125 11.480469 23.976562 11.40625 C 23.140625 10.046875 22.953125 8.503906 22.953125 8.503906 C 22.953125 8.503906 25.871094 7.574219 27.894531 8.878906 C 27.925781 8.898438 27.953125 8.925781 27.988281 8.945312 C 28.007812 8.914062 28.023438 8.878906 28.042969 8.847656 C 29.351562 6.828125 32.390625 6.472656 32.390625 6.472656 C 32.390625 6.472656 32.855469 7.957031 32.652344 9.539062 C 32.820312 9.542969 32.992188 9.554688 33.164062 9.585938 C 35.742188 9.996094 37.429688 12.863281 37.429688 12.863281 C 37.429688 12.863281 34.933594 15.058594 32.351562 14.648438 C 32.011719 14.59375 31.691406 14.492188 31.382812 14.363281 C 31.964844 14.960938 32.464844 15.699219 32.632812 16.5625 C 33.132812 19.085938 30.609375 21.710938 30.609375 21.710938 C 30.609375 21.710938 27.285156 20.238281 26.789062 17.710938 C 26.628906 16.90625 26.777344 16.089844 27.054688 15.351562 C 26.847656 15.570312 26.617188 15.769531 26.355469 15.941406 C 24.175781 17.378906 20.992188 16.402344 20.992188 16.402344 C 20.992188 16.402344 21.351562 13.097656 23.535156 11.660156 Z M 23.535156 11.660156 "/>
                        <use xlink:href="#surface47" mask="url(#mask14)"/>
                    </g>
                </svg>
                <span class="self-center text-2xl m-3 text-black font-semibold whitespace-nowrap dark:text-white">{{strtoupper(config('app.name'))}}</span>
            </a>


            <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1" id="navbar-user">
                <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-100 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-gray-100 dark:bg-gray-600 md:dark:bg-gray-600 dark:border-gray-700">
                    @foreach ($menu as $item)
                        @if ($item->id === $articlesCategories[0]->menus_id)
                            <button id="dropdownNavbarLink-{{$item->id}}" data-dropdown-toggle="dropdownNavbar-{{$item->id}}" class="flex items-center justify-between w-full py-2 pl-3 pr-4  text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">{{$item->title}} <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                </svg></button>
                            <!-- Dropdown menu -->
                            <div id="dropdownNavbar-{{$item->id}}" class="z-10 hidden font-normal bg-gray-100 divide-y divide-gray-300 rounded-lg shadow w-80 dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton-{{$item->id}}">
                                    @foreach($articlesCategories as $articleCategory)
                                        @if($articleCategory->menus_id == $item->id)
                                            <li class="{{($articleCategory->link == '/'.request()->route()->uri()) ? 'cursor-default mt-2 mb-2 block ml-4 py-2 rounded text-gray-400 bg-gray-400 dark:bg-gray-700 md:bg-transparent md:text-gray-300 md:p-0 hover:rounded md:dark:text-gray-600':'block px-4 py-2 text-gray-700 hover:rounded hover:bg-gray-200 bg-gray-100 dark:hover:bg-gray-500 dark:text-gray-400 dark:bg-gray-700 cursor-pointer'}}">
                                                <a href="{{$articleCategory->link}}" style="{{($articleCategory->link == '/'.request()->route()->uri()) ? 'pointer-events: none;' :''}}" class="block">
                                                    {{$articleCategory->title}}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                                <div class="py-1 hover:bg-gray-200 dark:hover:bg-gray-500 hover:rounded">
                                    <a href="{{$item->link}}" class="block px-4 py-2 text-sm text-gray-700 dark:hover:bg-gray-500 dark:text-gray-400"> Всі розділи</a>
                                </div>
                            </div>
                        @elseif($item->id === $productsCategories[0]->menus_id)
                            <button id="dropdownNavbarLink-{{$item->id}}" data-dropdown-toggle="dropdownNavbar-{{$item->id}}" class="flex items-center justify-between w-full py-2 pl-3 pr-4  text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">{{$item->title}} <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                </svg></button>
                            <!-- Dropdown menu -->
                            <div id="dropdownNavbar-{{$item->id}}" class="z-10 hidden font-normal bg-gray-100 divide-y divide-gray-300 rounded-lg shadow w-80 dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton-{{$item->id}}">
                                    @foreach($productsCategories as $productCategory)
                                        @if($productCategory->menus_id==$item->id)
                                            <li class="{{($productCategory->link == '/'.request()->route()->uri()) ? 'cursor-default mt-2 mb-2 block ml-4 py-2 rounded text-gray-400 bg-gray-400 dark:bg-gray-700 md:bg-transparent md:text-gray-300 md:p-0 hover:rounded md:dark:text-gray-600':'block px-4 py-2 text-gray-700 hover:rounded hover:bg-gray-200 bg-gray-100 dark:hover:bg-gray-500 dark:text-gray-400 dark:bg-gray-700 cursor-pointer'}}">
                                                <a href="{{$productCategory->link}}" style="{{($productCategory->link == '/'.request()->route()->uri()) ? 'pointer-events: none;' :''}}" class="block">
                                                    {{$productCategory->title}}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                                <div class="py-1 hover:bg-gray-200 dark:hover:bg-gray-500 hover:rounded">
                                    <a href="{{$item->link}}" class="block px-4 py-2 text-sm text-gray-700 dark:hover:bg-gray-500 dark:text-gray-400"> Всі товари</a>
                                </div>
                            </div>
                        @elseif($item->id === $newsCategories[0]->menus_id)
                            <button id="dropdownNavbarLink-{{$item->id}}" data-dropdown-toggle="dropdownNavbar-{{$item->id}}" class="flex items-center justify-between w-full py-2 pl-3 pr-4  text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">{{$item->title}} <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                </svg></button>
                            <!-- Dropdown menu -->
                            <div id="dropdownNavbar-{{$item->id}}" class="z-10 hidden font-normal bg-gray-100 divide-y divide-gray-300 rounded-lg shadow w-80 dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton-{{$item->id}}">
                                    @foreach($newsCategories as $newsCategory)
                                        @if($newsCategory->menus_id==$item->id)
                                            <li class="{{($newsCategory->link == '/'.request()->route()->uri()) ? 'cursor-default mt-2 mb-2 block ml-4 py-2 rounded text-gray-400 bg-gray-400 dark:bg-gray-700 md:bg-transparent md:text-gray-300 md:p-0 hover:rounded md:dark:text-gray-600':'block px-4 py-2 text-gray-700 hover:rounded hover:bg-gray-200 bg-gray-100 dark:hover:bg-gray-500 dark:text-gray-400 dark:bg-gray-700 cursor-pointer'}}">
                                                <a href="{{$newsCategory->link}}" style="{{($newsCategory->link == '/'.request()->route()->uri()) ? 'pointer-events: none;' :''}}" class="block">
                                                    {{$newsCategory->title}}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                                <div class="py-1 hover:bg-gray-200 dark:hover:bg-gray-500 hover:rounded">
                                    <a href="{{$item->link}}" class="block px-4 py-2 text-sm text-gray-700 dark:hover:bg-gray-500 dark:text-gray-400"> Всі розділи</a>
                                </div>
                            </div>
                        @else
                            @if($item->link=='/')
                            <li>
                                <a href="{{$item->link}}" class="{{ $route === 'main.page' ? 'block py-2 pl-3 pr-4 text-gray-300 bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500 hover:rounded' : 'block py-2 pl-3 pr-4 text-gray-900 rounded hover:rounded hover:bg-gray-200 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }}" aria-current="page" >{{$item->title}}
                                </a>
                            </li>
                            @elseif($item->link=='/')
                                <li>
                                    <a href="{{$item->link}}" class="{{ $route === 'shop.page' ? 'block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500' : 'block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }}" aria-current="page" >{{$item->title}}
                                    </a>
                                </li>
                            @else

                                <li>
                                    <a href="{{$item->link}}" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700" aria-current="page" >{{$item->title}}
                                    </a>
                                </li>
                            @endif
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
</div>







