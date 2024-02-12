<div>
    <!-- Start Navbar -->
    <nav id="topnav" class="defaultscroll is-sticky">
        <div class="container relative py-2">
            <!-- Logo container-->
            <a class="logo" href="index.html">
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
                            class="text-white hover:bg-yellow-500 focus:ring-1 focus:outline-none font-medium rounded-lg text-sm px-2 py-2.5 text-center inline-flex items-cente dark:hover:bg-yellow-500 dark:focus:ring-yellow-500"
                            type="button">
                            @if ($locale == 'id')
                                <div><img class="inline rounded" width="25px" alt="Indonesia"
                                        src="http://purecatamphetamine.github.io/country-flag-icons/3x2/ID.svg" /></div>
                                <span class="menu-arrow"></span>
                            @else
                                <div><img class="inline rounded" width="25px" alt="english"
                                        src="http://purecatamphetamine.github.io/country-flag-icons/3x2/GB.svg" /></div>
                                <span class="menu-arrow"></span>
                            @endif
                        </button>

                        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 w-10 hidden z-10 mt-2 min-w-[7rem] bg-white shadow-md rounded-lg p-2 dark:bg-gray-800 dark:border dark:border-gray-700 dark:divide-gray-700"
                            aria-labelledby="hs-dropdown-basic">
                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownDividerButton">
                                <li>
                                    <div wire:click="changeLanguage('id')" onclick="changeLanguage('id')"
                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        <img class="inline mr-1 rounded" width="30px" alt="Indonesia"
                                            src="http://purecatamphetamine.github.io/country-flag-icons/3x2/ID.svg" />
                                        ID
                                    </div>

                                </li>
                                <li>
                                    <div wire:click="changeLanguage('en')" onclick="changeLanguage('en')"
                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        <img class="inline mr-1 rounded" width="30px" alt="english"
                                            src="http://purecatamphetamine.github.io/country-flag-icons/3x2/GB.svg" />
                                        EN
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="inline  mb-0">
                    <button type="button"
                        class="hs-dark-mode-active:hidden inline-flex justify-center tracking-wide align-middle hs-dark-mode group items-center  text-gray-500 hover:text-yellow-500 font-medium dark:text-gray-400 dark:hover:text-gray-500"
                        data-hs-theme-click-value="dark">
                        <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z" />
                        </svg>
                    </button>
                    <button type="button"
                        class="hs-dark-mode-active:inline-block hidden inline-flex justify-center tracking-wide align-middle hs-dark-mode group items-center text-gray-600 hover:text-yellow-500 font-medium dark:text-gray-400 dark:hover:text-gray-500"
                        data-hs-theme-click-value="light">
                        <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="4" />
                            <path d="M12 8a2 2 0 1 0 4 4" />
                            <path d="M12 2v2" />
                            <path d="M12 20v2" />
                            <path d="m4.93 4.93 1.41 1.41" />
                            <path d="m17.66 17.66 1.41 1.41" />
                            <path d="M2 12h2" />
                            <path d="M20 12h2" />
                            <path d="m6.34 17.66-1.41 1.41" />
                            <path d="m19.07 4.93-1.41 1.41" />
                        </svg>
                    </button>
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
                        </ul>
                    </li>

                    <li><a href="{{ route('kawasan') }}"
                            class="sub-menu-item">{{ __('navbar.kawasans', [], $locale) }}</a></li>
                    <li><a href="{{ route('berita') }}"
                            class="sub-menu-item">{{ __('navbar.news', [], $locale) }}</a>
                    </li>
                    <li><a href="{{ route('faq') }}"
                            class="sub-menu-item">{{ __('navbar.guide', [], $locale) }}</a>
                    </li>
                    <li><a href="{{ route('peta') }}" class="sub-menu-item">{{ __('navbar.maps', [], $locale) }}</a>
                    </li>
                    <li><a href="{{ route('cjibf') }}" class="sub-menu-item"><b
                                class="bg-yellow-500 hover:bg-gray-500 py-1 px-3 rounded text-gray-100">CJIBF</b></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
