@extends('livewire.frontend.master-dashboard')
@section('content-pengguna')
    <div>
        <div class="relative mb-5">
            <h2 class="text-lg font-bold mb-4">Semua Produk</h2>
            <form class="flex max-w-sm" wire:submit.prevent="cariProduct">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <input type="text" id="simple-search" wire:model="search" autocomplete="off"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                        placeholder="Search Product ..." required />
                </div>
                <button type="submit"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 ml-2 py-3 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </form>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 gap-4">
            @foreach ($products as $product)
                <div class="blog relative rounded-md shadow-md dark:shadow-gray-700 overflow-hidden mb-4">
                    <img src="{{ $product->gambar }}" alt="" class="object-cover"
                        style="height: 230px; width: 100%;">

                    <div class="content p-3">
                        <a href="{{ route('detail.product', $product->slug) }}"
                            class="title h5 text-xl font-semibold hover:text-green-900 text-green-600 transition duration-500 text-justify">
                            {{ $product->name }}</a>
                        <p class="desc text-gray-500">
                            {!! Str::limit(str($product->description)->markdown()->sanitizeHtml(), 150) !!}
                        </p>
                        <div class="flex flex-col justify-between h-full">
                            <p class="text-gray-900 mt-2">{{ $product->user->userperusahaan->nama_perusahaan }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-10">
            {{ $products->links() }}
        </div>
    </div>
@endsection
