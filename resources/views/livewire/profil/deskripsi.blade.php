<div>

    <!-- FEATURES START -->
    <section class="relative md:py-6 py-4">
        <div class="container relative md:mt-6 mt-4">
            <div class="grid md:grid-cols-12 grid-cols-1 items-center gap-[30px]">
                <div class="md:col-span-5">
                    <div class="relative">
                        <div class="pe-12">
                            <img src="https://images.pexels.com/photos/6109262/pexels-photo-6109262.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                                class="rounded-md w-full h-96 object-cover" alt="">
                        </div>

                        <div class="absolute bottom-16 end-0">
                            <img src="https://images.pexels.com/photos/6109262/pexels-photo-6109262.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                                class="rounded-md rounded-ee-[30px] shadow-lg w-56 h-56 object-cover" alt="">
                            {{-- <div class="absolute bottom-0 end-0 text-center">
                                <a href="#!" data-type="youtube" data-id="S_CGed6E610"
                                    class="lightbox h-14 w-14 rounded-full shadow-lg dark:shadow-gray-800 inline-flex items-center justify-center bg-indigo-600 text-white">
                                    <i class="mdi mdi-play inline-flex items-center justify-center text-xl"></i>
                                </a>
                            </div> --}}
                        </div>
                    </div>
                </div><!--end col-->

                <div class="md:col-span-7">
                    <div class="lg:ms-4 text-justify text-lg">
                        <p class="text-slate-400 max-w-2xl text-justify">
                            @if ($locale == 'id')
                                {!! $profil->jateng_desc !!}
                            @else
                                {!! $profil->jateng_desc_en !!}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
