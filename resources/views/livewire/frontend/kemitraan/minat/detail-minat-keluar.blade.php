@extends('livewire.frontend.master-dashboard')
@section('content-pengguna')
    <div>
        <div class="bg-white p-6 rounded-lg flex flex-col md:flex-row gap-4">
            <div class="w-full md:w-1/2 flex flex-col items-center">
                <div class="w-full h-max-[400px] mb-4">
                    <img id="mainImage" src="{{ $imageMain ?? $product->gambar }}" alt="Product Image"
                        class="w-full object-cover rounded-lg h-full" style="height: 450px;">
                </div>
            </div>

            <!-- Kolom Keterangan Produk -->
            <div class="w-full md:w-1/2 mt-6 md:mt-0 md:ml-6 flex flex-col justify-between">
                <div>
                    <h2 class="text-3xl font-bold mb-4">{{ $product->name }}</h2>
                    <p class="text-gray-700 mb-4">{!! str($product->description)->markdown()->sanitizeHtml() !!}</p>
                </div>
                <!-- Informasi Pemilik Produk -->
                <div class="flex flex-row justify-between">
                    <div class="flex items-center mt-4">
                        <div class="relative w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                            <img class="mr-2 w-10 h-10 rounded-full"
                                src="{{ asset('storage/' . $product->user->profile_photo_path) }}" alt="Profile Picture">
                        </div>
                        <div class="flex flex-col">
                            <span class="ml-3 text-gray-700 dark:text-gray-300">{{ $product->user->name }}</span>
                            <b class="ml-3">Pemilik Produk</b>
                        </div>
                    </div>
                    <div class="flex items-center mt-4">
                        <div class="relative w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                            <img class="mr-2 w-10 h-10 rounded-full"
                                src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="Profile Picture">
                        </div>
                        <div class="flex flex-col">
                            @foreach ($product->productMinat as $user)
                                @if ($user->peminat_id == auth()->user()->id)
                                    <span
                                        class="ml-3 text-gray-700 dark:text-gray-300">{{ $user->userPeminat->name }}</span>
                                    <b class="ml-3">Peminat Produk</b>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($product->productMinat[0]->status == 1)
            <section class="bg-white dark:bg-gray-900 py-3 lg:py-16 antialiased">
                <div class="max-w-2xl mx-auto px-2">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Discussion
                            ({{ $jumlahDiskusi }})</h2>
                    </div>
                    <form class="mb-6" wire:submit.prevent="postComment">
                        <div
                            class="py-2 px-4 mb-4 bg-white dark:bg-gray-800 rounded-lg rounded-t-lg border border-gray-200 dark:border-gray-700">
                            <label for="comment" class="sr-only">Your comment</label>
                            <textarea id="comment" rows="6"
                                class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                placeholder="Write a comment..." required wire:model="comment"></textarea>
                        </div>
                        <button type="submit"
                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 w-full">
                            Post comment
                        </button>
                    </form>
                    @foreach ($comments as $item)
                        @if ($item->user->id == Auth::user()->id)
                            <article
                                class="p-6 mb-3 text-base bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 flex flex-col items-end text-right">
                                <footer class="flex items-center mb-2">
                                    <p class="inline-flex items-center text-sm text-gray-900 dark:text-white font-semibold">
                                        <img class="mr-2 w-6 h-6 rounded-full"
                                            src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                                            alt="Profile Picture">{{ $item->user->name }}
                                    </p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 ml-3">
                                        <time pubdate datetime="{{ $item->created_at->toDateString() }}"
                                            title="{{ $item->created_at->format('F jS, Y') }}">
                                            {{ $item->created_at->format('M. j, Y') }}
                                        </time>
                                    </p>
                                </footer>
                                <p class="text-gray-500 dark:text-gray-400">{{ $item->comment }}</p>
                            </article>
                        @else
                            <article
                                class="p-6 mb-3 text-base bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                                <footer class="flex items-center mb-2">
                                    <p class="inline-flex items-center text-sm text-gray-900 dark:text-white font-semibold">
                                        <img class="mr-2 w-6 h-6 rounded-full"
                                            src="{{ asset('storage/' . $item->user->profile_photo_path) }}"
                                            alt="Profile Picture">{{ $item->user->name }}
                                    </p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 ml-3">
                                        <time pubdate datetime="{{ $item->created_at->toDateString() }}"
                                            title="{{ $item->created_at->format('F jS, Y') }}">
                                            {{ $item->created_at->format('M. j, Y') }}
                                        </time>
                                    </p>
                                </footer>
                                <p class="text-gray-500 dark:text-gray-400">{{ $item->comment }}</p>
                            </article>
                        @endif
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection
