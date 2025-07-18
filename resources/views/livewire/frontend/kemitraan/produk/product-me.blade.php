@extends('livewire.frontend.master-dashboard')
@section('content-pengguna')
    <div>
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold mb-4">Produk Saya</h2>
            {{-- <a href="{{ route('add-product') }}"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Tambah Produk
            </a> --}}
            @if (empty(Auth::user()->userperusahaan->nama_perusahaan))
                {{-- <div class="alert alert-warning" role="alert">
                    Profil perusahaan belum lengkap. Silakan lengkapi profil Anda untuk menambahkan produk.
                </div> --}}
                <button wire:click.prevent="$dispatch('showModal')"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Tambah Produk
                </button>
            @else
                <button onclick="window.location.href='{{ route('add-product') }}'"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Tambah Produk
                </button>
            @endif



        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 gap-4">
            @foreach ($products as $product)
                <div class="blog relative rounded-md shadow-md dark:shadow-gray-700 overflow-hidden mb-4">
                    <img src="{{ $product->gambar }}" alt="" class="object-cover" style="height: 230px; width: 100%;">

                    <div class="content p-3">
                        <a href="{{ route('edit-product', $product->id) }}"
                            class="title h5 text-xl font-semibold hover:text-green-900 text-green-600 transition duration-500 text-justify">
                            {{ $product->name }}</a>
                        <p class="">
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

    <div class="fixed inset-0 flex items-center justify-center z-50"
        style="display: @if ($isOpen) flex @else none @endif;">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-lg font-semibold mb-4">Profil Tidak Lengkap</h2>
            <p class="mb-4">Silakan lengkapi profil perusahaan Anda terlebih dahulu sebelum menambahkan produk.</p>
            <a href="{{ route('dashboard.profile') }}"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-3 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Profil</a>
            <button wire:click="closeModal"
                class="focus:outline-none text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Tutup</button>
        </div>
    </div>
@endsection
