<section class="pt-20">
    <div class="flex justify-center">
        <div class="max-w-[500px] w-full m-auto p-6 bg-white dark:bg-slate-900 shadow-md dark:shadow-gray-800 rounded-md">
            <a class="justify-center flex" href="{{ route('beranda') }}">
                <img src="{{ asset('images/cjip.png') }}" class="l-dark w-16" alt="Logo">
            </a>
            <h5 class="mt-4 text-xl font-semibold flex justify-center">Register Akun Baru</h5>
            <p class="text-slate-400 mt-2 text-center">Silakan isi form di bawah untuk membuat akun.</p>

            @if (session()->has('error'))
                <div class="p-4 my-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <span class="font-medium">Error!</span> {{ session('error') }}
                </div>
            @endif

            <form wire:submit.prevent="register" class="text-start mt-6">
                {{-- This will render the entire Filament form --}}
                {{ $this->form }}

                <div class="mt-6 mb-4">
                    {{-- CHANGED: Corrected the button's loading state handling --}}
                    <button type="submit"
                            class="py-3 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-green-600 hover:bg-yellow-500 border-green-600 hover:border-yellow-500 text-white rounded-md w-full flex justify-center items-center h-12"
                            wire:loading.attr="disabled" wire:target="register">

                        <!-- Default state text. This is removed when the 'register' action is loading. -->
                        <span wire:loading.remove wire:target="register">
                            Register
                        </span>

                        <!-- Loading state text. This is only shown when the 'register' action is loading. -->
                        <span wire:loading wire:target="register">
                            Mendaftarkan...
                        </span>
                    </button>
                </div>

                <div class="text-center">
                    <span class="text-slate-400 me-2">Sudah punya akun?</span>
                    <a href="{{ route('login') }}" class="text-black dark:text-white font-bold inline-block hover:text-yellow-500">Login di sini</a>
                </div>
            </form>
        </div>
    </div>
</section>
