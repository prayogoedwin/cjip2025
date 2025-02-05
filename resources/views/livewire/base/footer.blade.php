<!-- Footer Start -->
<footer class="relative text-gray-200 dark:text-gray-200 bg-green-600">
    <div class="container relative">
        <div class="grid grid-cols-12">
            <div class="col-span-12">
                <div class="py-[60px] px-0">
                    <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px]">
                        <div class="lg:col-span-6 md:col-span-12">
                            <a href="{{ route('beranda') }}" class="focus:outline-none mb-2">
                                <img src="{{ asset('images/logo.png') }}" alt="">
                            </a>
                            <h5 class="mt-6 tracking-[1px] text-gray-100 font-normal uppercase ">
                                {{ __('navbar.contact', [], $locale) }}<span class="font-bold"> Dinas Penanaman
                                    Modal dan Pelayanan Terpadu Satu Pintu
                                    Provinsi Jawa Tengah :</span></h5>
                            <ul class="list-none footer-list mt-6">
                                <li><a href="#"
                                        class="text-gray-300 hover:text-gray-400 duration-500 ease-in-out"><i
                                            class="uil uil-angle-right-b"></i>
                                        @if ($locale == 'id')
                                            {{ $footer->alamat }}
                                        @else
                                            {{ $footer->alamat_en }}
                                        @endif
                                    </a></li>
                                <li class="mt-[10px]"><a href="#"
                                        class="text-gray-300 hover:text-gray-400 duration-500 ease-in-out"><i
                                            class="uil uil-angle-right-b"></i>
                                        @if ($locale == 'id')
                                            {{ $footer->email }}
                                        @else
                                            {{ $footer->email_en }}
                                        @endif
                                    </a></li>
                                <li class="mt-[10px]"><a href="#"
                                        class="text-gray-300 hover:text-gray-400 duration-500 ease-in-out"><i
                                            class="uil uil-angle-right-b"></i>
                                        @if ($locale == 'id')
                                            {{ $footer->contact }}
                                        @else
                                            {{ $footer->contact_en }}
                                        @endif
                                        (WhatsApp Only)
                                    </a></li>
                            </ul>
                            <ul class="list-none mt-6">
                                <li class="inline"><a href="https://www.youtube.com/channel/UCjAtDv9NUaCo9jNytDZm8hw"
                                        target="_blank"
                                        class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border border-gray-300 rounded-md hover:border-primary-600 dark:hover:border-primary-600 hover:bg-yellow-500 dark:hover:bg-primary-600"><i
                                            class="uil uil-youtube align-middle" title="youtube"></i></a></li>
                                <li class="inline"><a href="https://dpmptsp.jatengprov.go.id/" target="_blank"
                                        class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border border-gray-300 rounded-md hover:border-primary-600 dark:hover:border-primary-600 hover:bg-yellow-500 dark:hover:bg-primary-600"><i
                                            class="uil uil-globe align-middle" title="website"></i></a></li>
                                <li class="inline"><a href="https://www.facebook.com/dpmptspjateng/" target="_blank"
                                        class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border border-gray-300 rounded-md hover:border-primary-600 dark:hover:border-primary-600 hover:bg-yellow-500 dark:hover:bg-primary-600"><i
                                            class="uil uil-facebook-f align-middle" title="facebook"></i></a></li>
                                <li class="inline"><a href="https://www.instagram.com/centraljavainvest/"
                                        target="_blank"
                                        class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border border-gray-300 rounded-md hover:border-primary-600 dark:hover:border-primary-600 hover:bg-yellow-500 dark:hover:bg-primary-600"><i
                                            class="uil uil-instagram align-middle" title="instagram"></i></a></li>
                                <li class="inline"><a href="https://twitter.com/PPID_PTSPJateng" target="_blank"
                                        class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border border-gray-300 rounded-md hover:border-primary-600 dark:hover:border-primary-600 hover:bg-yellow-500 dark:hover:bg-primary-600"><i
                                            class="uil uil-twitter align-middle" title="twitter"></i></a></li>
                                <li class="inline"><a href="mailto:{{ $footer->email }}"
                                        class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border border-gray-300 rounded-md hover:border-primary-600 dark:hover:border-primary-600 hover:bg-yellow-500 dark:hover:bg-primary-600"><i
                                            class="uil uil-envelope align-middle" title="email"></i></a></li>
                            </ul>
                        </div>
                        <div class="lg:col-span-3 md:col-span-4">
                            <h5 class="tracking-[1px] text-gray-100 font-semibold">{{ __('navbar.link', [], $locale) }}
                            </h5>
                            <ul class="list-none footer-list mt-6">
                                @foreach ($footer->links as $link)
                                    <li class="mt-2">
                                        <a href="{{ $link['url'] }}" target="blank"
                                            class="text-gray-200 hover:text-gray-400 transition-all duration-500 ease-in-out"><i
                                                class="uil uil-angle-right-b me-1"></i>{{ $link['name'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="lg:col-span-3 md:col-span-4">
                            <form>
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.2186673397573!2d110.40506971015228!3d-6.983501668357905!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708b4927db6189%3A0x439c487706e546a4!2sDPMPTSP%20Central%20Java!5e0!3m2!1sid!2sid!4v1738738220765!5m2!1sid!2sid"
                                    height="250" style="border:0;" allowfullscreen=""
                                    class="w-full rounded-xl shadow-lg" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-[20px] px-0 border-t border-gray-800">
        <div class="text-center">
            <div class="items-center">
                <div class="text-center px-2">
                    <p class="mb-0">©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> {{ $footer->copyright }}
                        {{-- <i class="mdi mdi-heart text-danger-600"></i>
                        <a href="#" target="_blank" class="text-reset">All Rights Reserved</a>. --}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer End -->
