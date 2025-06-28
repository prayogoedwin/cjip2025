<div>
    <!-- Start Navbar -->
    <nav id="topnav" class="defaultscroll is-sticky">
        <div class="container relative py-2">
            <!-- Logo container-->
            <a class="logo" href="/">
                <span class="inline-block dark:hidden">
                    <img src="{{ asset('images/cjip.png') }}" class="l-dark w-9" height="9" alt="">
                    <img src="{{ asset('images/logowhite.png') }}" class="l-light w-9" height="9" alt="">
                </span>
                <img src="{{ asset('images/logowhite.png') }}" height="9" class=" w-9 hidden dark:inline-block"
                    alt="">
            </a>

            <!-- End Logo container-->
            <div class="menu-extras">
                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>

            <!--Login button Start-->
            <ul class="buy-button list-none mb-0">
                <li class="inline mb-0">
                    <div class="hs-dropdown relative inline-flex">

                        <button id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider"
                            class=" text-white hover:bg-yellow-500 focus:ring-1 focus:outline-none font-medium rounded-lg text-sm px-2 py-2.5 text-center inline-flex items-center dark:hover:bg-yellow-500 dark:focus:ring-yellow-500"
                            type="button">
                            @if ($locale == 'id')
                                <div><img class="inline rounded" width="25px" alt="Indonesia"
                                        src="http://purecatamphetamine.github.io/country-flag-icons/3x2/ID.svg" /></div>
                                <span class="menu-arrow"></span>
                            @else
                                <div><img class="inline rounded" width="25px" alt="English"
                                        src="http://purecatamphetamine.github.io/country-flag-icons/3x2/GB.svg" /></div>
                                <span class="menu-arrow"></span>
                            @endif
                        </button>

                        <div id="dropdownDivider"
                            class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownDividerButton">
                                <li>
                                    <div wire:click="changeLanguage('id')"
                                        class="block py-2 px-4 hover:bg-gray-100 text-black dark:hover:bg-gray-600 dark:hover:text-white">
                                        <img class="inline mr-1 rounded" width="30px" alt="Indonesia"
                                            src="http://purecatamphetamine.github.io/country-flag-icons/3x2/ID.svg" />
                                        ID
                                    </div>
                                </li>
                                <li>
                                    <div wire:click="changeLanguage('en')"
                                        class="block py-2 px-4 hover:bg-gray-100 text-black dark:hover:bg-gray-600 dark:hover:text-white">
                                        <img class="inline mr-1 rounded" width="30px" alt="English"
                                            src="http://purecatamphetamine.github.io/country-flag-icons/3x2/GB.svg" />
                                        EN
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                {{-- <li class="inline mb-0" wire:ignore>
                    <a href="#" id="theme-toggle" type="button"
                        class="inline-flex items-center  justify-center tracking-wide align-middle text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none rounded-lg text-sm p-2.5">
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </li> --}}

                <li class="inline mb-0">
                    <div class="relative inline-block">
                        @if (Route::has('login'))
                            @auth
                                @if (Auth::user()->profile_photo_path)
                                    <img class="w-8 h-8 inline-block rounded-full ring-2 cursor-pointer"
                                        style="--tw-ring-color: rgb(255 255 255);"
                                        src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt=""
                                        id="profileMenuButton">
                                @else
                                    <img class="w-8 h-8 inline-block rounded-full ring-2 cursor-pointer"
                                        style="--tw-ring-color: rgb(255 255 255);"
                                        src='https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png'
                                        alt="" id="profileMenuButton">
                                @endif
                            @else
                                <a href="{{ route('login') }}"
                                    class="bg-yellow-500 py-1 px-3 rounded text-gray-100 text-sm">Login</a>
                            @endauth
                        @endif

                        <div id="profileMenu"
                            class="hidden absolute right-0 mt-2 w-24 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
                            <div class="py-1" role="menu" aria-orientation="vertical"
                                aria-labelledby="profileMenuButton">
                                <a href="{{ route('dashboard.profile') }}"
                                    class="flex justify-between px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                    Profile</a>

                                <button wire:click="logout"
                                    class="w-full  flex justify-between text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><svg
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                    </svg>
                                    Logout
                                </button>

                            </div>
                        </div>
                    </div>
                </li>
            </ul>

            <!--Login button End-->

            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu nav-light">
                    <li><a href="{{ route('beranda') }}"
                            class="sub-menu-item">{{ __('navbar.beranda', [], $locale) }}</a></li>

                    <li><a href="{{ route('profil_jateng') }}"
                            class="sub-menu-item">{{ __('navbar.profile_jateng', [], $locale) }}</a></li>
                    <li class="has-submenu parent-menu-item">
                        <a href="javascript:void(0)">{{ __('navbar.project', [], $locale) }}</a><span
                            class="menu-arrow"></span>
                        <ul class="submenu">
                            <li><a href="{{ route('peluang_investasi') }}"
                                    class="sub-menu-item">{{ __('navbar.readiness', [], $locale) }}</a>
                            </li>
                            <li><a href="{{ route('sektor') }}"
                                    class="sub-menu-item">{{ __('navbar.sector', [], $locale) }}</a>
                            </li>
                            <li><a href="{{ route('peta') }}"
                                    class="sub-menu-item">{{ __('navbar.maps', [], $locale) }}</a></li>
                            {{-- <li><a href="{{ route('form_kajian_proyek') }}"
                                    class="sub-menu-item">{{ __('navbar.kajian', [], $locale) }}</a>
                            </li> --}}
                        </ul>
                    </li>

                    <li><a href="{{ route('kawasan') }}"
                            class="sub-menu-item">{{ __('navbar.kawasans', [], $locale) }}</a></li>

                    <li class="has-submenu parent-menu-item">
                        <a href="javascript:void(0)">{{ __('navbar.info', [], $locale) }}</a><span
                            class="menu-arrow"></span>
                        <ul class="submenu">
                            <li><a href="{{ route('berita') }}"
                            class="sub-menu-item">{{ __('navbar.news', [], $locale) }}</a></a>
                            </li>
                            <li><a href="{{ route('faq') }}"
                            class="sub-menu-item">{{ __('navbar.guide', [], $locale) }}</a></a>
                            </li>
                            <li><a href="{{ route('infografis') }}"
                                    class="sub-menu-item">{{ __('navbar.grafis', [], $locale) }}</a></li>
                            {{-- <li><a href="{{ route('form_kajian_proyek') }}"
                                    class="sub-menu-item">{{ __('navbar.kajian', [], $locale) }}</a>
                            </li> --}}
                        </ul>
                    </li>

                    {{-- <li><a href="{{ route('berita') }}"
                            class="sub-menu-item">{{ __('navbar.news', [], $locale) }}</a>
                    </li> --}}
                    {{-- <li><a href="{{ route('faq') }}"
                            class="sub-menu-item">{{ __('navbar.guide', [], $locale) }}</a>
                    </li> --}}
                    <li><a href="{{ route('peta') }}" class="sub-menu-item">{{ __('navbar.maps', [], $locale) }}</a>
                    </li>
                    <li><a href="{{ route('cjibf') }}" class="sub-menu-item"><b
                                class="bg-yellow-500 hover:bg-gray-500 py-1 px-3 rounded text-gray-100">CJIBF</b></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @push('js')
        {{-- <script>
            // On page load or when changing themes, best to add inline in `head` to avoid FOUC
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                    '(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark')
            }
        </script> --}}
        {{-- <script>
            var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
            var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

            // Change the icons inside the button based on previous settings
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                    '(prefers-color-scheme: dark)').matches)) {
                themeToggleLightIcon.classList.remove('hidden');
            } else {
                themeToggleDarkIcon.classList.remove('hidden');
            }

            var themeToggleBtn = document.getElementById('theme-toggle');

            themeToggleBtn.addEventListener('click', function() {

                // toggle icons inside button
                themeToggleDarkIcon.classList.toggle('hidden');
                themeToggleLightIcon.classList.toggle('hidden');

                // if set via local storage previously
                if (localStorage.getItem('color-theme')) {
                    if (localStorage.getItem('color-theme') === 'light') {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    }

                    // if NOT set via local storage previously
                } else {
                    if (document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    } else {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    }
                }

            });
        </script> --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var profileMenuButton = document.getElementById('profileMenuButton');
                var profileMenu = document.getElementById('profileMenu');

                profileMenuButton.addEventListener('click', function() {
                    profileMenu.classList.toggle('hidden');
                });

                window.addEventListener('click', function(event) {
                    if (!profileMenuButton.contains(event.target) && !profileMenu.contains(event.target)) {
                        profileMenu.classList.add('hidden');
                    }
                });
            });
        </script>
    @endpush
</div>
