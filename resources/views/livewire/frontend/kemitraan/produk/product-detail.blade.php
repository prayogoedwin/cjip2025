@extends('livewire.frontend.master-dashboard')
@section('content-pengguna')
    <div>
        <div class="bg-gray-100 dark:bg-slate-900">
            <div class="bg-white dark:bg-slate-900 p-6 rounded-lg flex flex-col lg:flex-row">
                <!-- Kolom Gambar Produk -->
                <div class="w-full lg:w-1/2 flex flex-col items-center mb-6 lg:mb-0">
                    <div class="w-full h-max-[400px] mb-4">
                        <img id="mainImage" src="{{ $imageMain ?? $product->gambar }}" alt="Product Image"
                            class="w-full object-cover rounded-lg h-full">
                    </div>
                    <div class="w-full flex overflow-x-auto space-x-2 mt-4">
                        @if ($imageProduct && is_array($imageProduct))
                            @foreach ($imageProduct as $images)
                                <img src="{{ Storage::url($images) }}" alt="Gallery Image {{ $loop->index + 1 }}"
                                    class="object-cover rounded-lg cursor-pointer" style="width: 150px; height: 100px;"
                                    wire:click="changeImage('{{ Storage::url($images) }}')">
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Kolom Keterangan Produk -->
                <div class="w-full lg:w-1/2 lg:ml-6">
                    <h2 class="text-3xl font-bold mb-4">{{ $product->name }}</h2>
                    <p class="text-lg mb-4">{!! str($product->description)->markdown()->sanitizeHtml() !!}</p>
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <span class="font-semibold text-xl">{{ $product->user->userperusahaan->nama_perusahaan }}</span>
                        </div>
                    </div>

                    <!-- Button Minat Bermitra -->
                    @if (!$isOwner && $show)
                        <button wire:click="minatProduct({{ $product->id }})"
                            class="items-center px-6 py-3 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 transition duration-300 w-full">
                            Minat Bermitra
                        </button>
                    @endif
                    <button onclick="window.history.back()"
                        class="items-center px-6 py-3 text-sm font-medium text-center mt-2 text-white bg-gray-700 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800 transition duration-300 w-full">
                        Kembali
                    </button>

                    <!-- Button jika pemilik produk -->
                    @if ($isOwner)
                        <div class="mt-4">
                            <button class="bg-gray-500 text-white font-bold py-2 px-4 rounded-lg w-full" disabled>
                                Anda adalah pemilik produk ini
                            </button>
                        </div>
                    @endif

                    <!-- Button jika sudah minat -->
                    @if ($showAcc)
                        <div class="mt-4">
                            <button
                                class="bg-green-500 text-white font-bold py-2 px-4 cursor-pointer rounded-lg hover:bg-green-700 transition duration-300 w-full">
                                Kamu sudah minat dengan produk ini, tunggu admin acc
                            </button>
                        </div>
                    @endif

                    <!-- Pesan Success -->
                    @if (session()->has('message'))
                        <div id="toast-success"
                            class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-green-500 rounded-lg dark:text-gray-400 dark:bg-gray-800"
                            role="alert">
                            <div
                                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                </svg>
                            </div>
                            <div class="ms-3 text-white text-sm font-normal">{{ session('message') }}</div>
                            <button type="button"
                                class="ms-auto -mx-1.5 -my-1.5 bg-green-500 text-gray-400 hover:text-gray-100 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                                data-dismiss-target="#toast-success" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection
