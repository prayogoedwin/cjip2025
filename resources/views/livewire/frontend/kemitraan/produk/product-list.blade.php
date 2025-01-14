<div>
    <div
        class="relative overflow-hidden before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] before:bg-no-repeat before:bg-top before:bg-cover before:w-full before:h-full before:-z-[50] before:transform before:-translate-x-1/2 dark:before:bg-[url('https://preline.co/assets/svg/examples-dark/polygon-bg-element.svg')]">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 pt-14 pb-5">
            <h1 class="justify-center flex text-center text-3xl font-bold text-gray-800">Produk Kemitraan</h1>
            <div class="">
                <div class="relative lg:mx-20 md:mx-8 mt-10 px-8">
                    <form class="flex max-w-sm" wire:submit.prevent="cariProduct">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <input type="text" id="simple-search" wire:model="search" autocomplete="off"
                                class="bg-gray-100 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                placeholder="Search product..." required />
                        </div>
                        <button type="submit"
                            class="py-1 p-3 ms-2 ml-2 text-sm font-medium text-white bg-green-500 rounded-lg border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </form>
                </div>
                <section class="relative md:py-2 mt-3">
                    @isset($products)
                        <div class="lg:mx-20 md:mx-8 py-5 px-8">
                            <div class="grid grid-cols-1 lg:grid-cols-4 md:grid-cols-2 gap-[30px]">
                                @foreach ($products as $product)
                                    <div
                                        class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                        <a href="#">
                                            <img class="rounded-t-lg" src="{{ $product->gambar }}"
                                                style="height: 230px; width: 100%;" alt="" />
                                        </a>
                                        <div class="p-5">
                                            <a href="{{ route('product.detail', $product->slug) }}">
                                                <h5
                                                    class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                                    {{ $product->name }}</h5>
                                            </a>
                                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                                {{ \Illuminate\Support\Str::limit(strip_tags($product->description), 80, ' ...') }}
                                            </p>
                                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                                {{ $product->user->userperusahaan->nama_perusahaan }}</p>
                                            <a href="{{ route('product.detail', $product->slug) }}"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                Selengkapnya
                                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endisset
                    <div class="my-10">
                        {{ $products->links() }}
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
