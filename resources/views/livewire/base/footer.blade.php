<!-- Footer Start -->
<footer class="footer bg-green-600 relative text-gray-200 dark:text-gray-200">
    <div class="container relative">
        <div class="grid grid-cols-12">
            <div class="col-span-12">
                <div class="py-[40px] px-0">
                    <div class="grid grid-cols-1 mt-2">
                        <div class="text-center">
                            <img src="{{ asset('images/logowhite.png') }}" class="w-20 block mx-auto" alt="">
                            <p class="max-w-xl mx-auto mt-6"> {{ __('navbar.contact', [], $locale) }}<span
                                    class="font-bold"> Dinas Penanaman
                                    Modal dan Pelayanan Terpadu Satu Pintu
                                    Provinsi Jawa Tengah :</span></p>
                        </div>

                        <ul class="list-none text-center mt-6">
                            
                            <li class="inline"><a href="https://dribbble.com/shreethemes" target="_blank"
                                    class="h-8 w-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base hover:text-green-500 text-center border-white rounded-md border hover:border-white dark:hover:border-indigo-600 hover:bg-white dark:hover:bg-green-600"><i
                                        class="uil uil-dribbble align-middle" title="website"></i></a></li>
                            <li class="inline"><a href="https://www.facebook.com/shreethemes" target="_blank"
                                    class="h-8 w-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base hover:text-green-500 text-center border-white rounded-md border hover:border-white dark:hover:border-indigo-600 hover:bg-white dark:hover:bg-green-600"><i
                                        class="uil uil-facebook-f align-middle" title="facebook"></i></a></li>
                            <li class="inline"><a href="https://www.instagram.com/shreethemes/" target="_blank"
                                    class="h-8 w-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base hover:text-green-500 text-center border-white rounded-md border hover:border-white dark:hover:border-indigo-600 hover:bg-white dark:hover:bg-green-600"><i
                                        class="uil uil-instagram align-middle" title="instagram"></i></a></li>
                            <li class="inline"><a href="https://twitter.com/shreethemes" target="_blank"
                                    class="h-8 w-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base hover:text-green-500 text-center border-white rounded-md border hover:border-white dark:hover:border-indigo-600 hover:bg-white dark:hover:bg-green-600"><i
                                        class="uil uil-twitter align-middle" title="twitter"></i></a></li>
                            <li class="inline"><a href="mailto:support@shreethemes.in"
                                    class="h-8 w-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base hover:text-green-500 text-center border-white rounded-md border hover:border-white dark:hover:border-indigo-600 hover:bg-white dark:hover:bg-green-600"><i
                                        class="uil uil-envelope align-middle" title="email"></i></a></li>
                        </ul><!--end icon-->
                    </div><!--end grid-->
                </div>
            </div>
        </div><!--end grid-->
    </div><!--end container-->

    <div class="py-[10px] px-0 border-t border-gray-300">
        <div class="container relative text-center">
            <div class="grid md:grid-cols-1">
                <p class="mb-0">©
                    <script>
                        document.write(new Date().getFullYear())
                    </script> {{ $footer->copyright }}
                    {{-- <i class="mdi mdi-heart text-danger-600"></i> --}}
                    <a href="#" target="_blank" class="text-reset"></a>.
                </p>
            </div><!--end grid-->
        </div><!--end container-->
    </div>
</footer><!--end footer-->
<!-- Footer End -->
