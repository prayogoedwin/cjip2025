<x-filament::page>
    <div class="bg-white dark:bg-gray-900 p-2 rounded-lg shadow-lg flex flex-col md:flex-row">
        <div class="w-full md:w-1/2 flex flex-col items-center">
            <div class="w-full h-36 p-4">
                <img id="mainImage" src="{{ $imageMain ?? $product->product->gambar }}" alt="Product Image"
                    class="w-auto h-24 object-cover rounded-lg ">
            </div>
        </div>

        <!-- Kolom Keterangan Produk -->
        <div class="w-full md:w-1/2 mt-6 md:mt-0 md:ml-6 flex flex-col justify-between">
            <div>
                <h2 class="text-3xl font-bold mb-4 text-gray-900 dark:text-white">{{ $product->product->name }}</h2>
                <p class="text-gray-700 dark:text-gray-400 mb-4">{{ $product->product->description }}</p>
            </div>
            <!-- Informasi Pemilik Produk -->
            <div class="flex flex-row justify-between">
                <div class="flex items-center mt-4 gap-2">
                    <div class="relative w-10 h-10 overflow-hidden">
                        <svg class="absolute w-12 h-12 text-gray-400 dark:text-gray-200 -left-1" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="ml-3 text-gray-700 dark:text-gray-300">{{ $product->product->user->name }}</span>
                        <b class="ml-3 text-gray-900 dark:text-white">Pemilik Produk</b>
                    </div>
                </div>
                <div class="flex items-center mt-4 gap-2">
                    <div class="relative w-10 h-10 overflow-hidden">
                        <svg class="absolute w-10 h-10 text-gray-400 dark:text-gray-200 -left-1" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex flex-col space-x-3 mr-2">
                        <span class=" text-gray-700 dark:text-gray-300">{{ $product->userPeminat->name }}</span>
                        <b class=" text-gray-900 dark:text-white">Peminat Produk</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($statusMinat->status == 1)
        <section class="bg-white dark:bg-gray-900 py-3 lg:py-16 antialiased">
            <div class="max-w-2xl mx-auto px-2">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Discussion
                        ({{ $jumlahDiskusi }})
                    </h2>
                </div>
                <form class="mb-6" wire:submit.prevent="postComment">
                    <div
                        class="py-2 px-4 mb-4 bg-white dark:bg-gray-800 rounded-lg rounded-t-lg border border-gray-200 dark:border-gray-700">
                        <label for="comment" class="sr-only">Your comment</label>
                        <textarea id="comment" rows="6" required
                            class="px-0 w-full text-sm text-gray-900 dark:text-white border-0 focus:ring-0 focus:outline-none dark:placeholder-gray-400 dark:bg-gray-800"
                            placeholder="Write a comment..." required wire:model="comment"></textarea>
                    </div>
                    <x-filament::button
                        class="hover:bg-green-300 shadow-lg w-full btn-primary mb-2 mt-4 bg-green-500 px-6 py-3 rounded-md text-white"
                        type='submit'>
                        Post Comment
                    </x-filament::button>
                </form>
                @foreach ($comments as $item)
                    <article
                        class="p-6 mb-3 text-base bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
                        <footer class="flex justify-between items-center mb-2">
                            <div class="flex items-center gap-3">
                                <p
                                    class="inline-flex items-center mr-3 gap-2 text-sm text-gray-900 dark:text-white font-semibold">
                                    <img class="mr-2 w-6 h-6 rounded-full"
                                        src="https://flowbite.com/docs/images/people/profile-picture-3.jpg"
                                        alt="Bonnie Green">{{ $item->user->name }}
                                    @if ($item->user->roles[0]->name == 'super_admin')
                                        (Admin)
                                    @endif
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <time pubdate datetime="{{ $item->created_at->toDateString() }}"
                                        title="{{ $item->created_at->format('F jS, Y') }}">
                                        {{ $item->created_at->format('M. j, Y') }}
                                    </time>
                                </p>
                            </div>
                        </footer>
                        <p class="text-gray-500 dark:text-gray-400">{{ $item->comment }}</p>
                    </article>
                @endforeach
            </div>
        </section>
    @endif
</x-filament::page>
