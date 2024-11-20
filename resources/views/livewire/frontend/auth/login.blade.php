<section class="pt-20">
    <div class="justify-center flex">
        <div
            class="max-w-[500px] w-full m-auto p-6 bg-white dark:bg-slate-900 shadow-md dark:shadow-gray-800 rounded-md">
            <a class="flex justify-center mx-auto" href="{{ route('beranda') }}">
                <img src="{{ asset('images/cjip.png') }}" class="mx-auto flex justify-center w-16"
                    style="align-content: center" alt="">
            </a>
            <h5 class="mt-4 text-xl font-semibold flex justify-center">Login</h5>
            @if (session('error'))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <span class="font-medium">{{ session('error') }}
                </div>
            @endif
            <form class="text-start" wire:submit.prevent="loginAction">
                <div class="grid grid-cols-1">
                    <div class="mb-4">
                        <label class="font-semibold" for="LoginEmail">Email :</label>
                        <input id="LoginEmail" type="email" wire:model="email"
                            class="form-input mt-3 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded-lg outline-none border border-gray-200 focus:border-yellow-500 dark:border-gray-800 dark:focus:border-yellow-500 focus:ring-0"
                            placeholder="Email">
                        @error('email')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="font-semibold" for="LoginPassword">Password :</label>
                        <div class="relative">
                            <input id="LoginPassword" type="password" wire:model="password"
                                class="form-input mt-3 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded-lg outline-none border border-gray-200 focus:border-yellow-500 dark:border-gray-800 dark:focus:border-yellow-500 focus:ring-0"
                                placeholder="Password">
                            <button type="button" onclick="togglePasswordVisibility()"
                                class="absolute inset-y-0 right-0 flex items-center px-4 py-2 mt-3 text-sm font-medium text-gray-600 bg-transparent dark:text-slate-200 dark:bg-slate-900 rounded-r-lg focus:outline-none">
                                <i id="passwordIcon" class="fa fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-between mb-4">
                        <div class="flex items-center mb-0">
                            <input
                                class="form-checkbox rounded border-gray-200 dark:border-gray-800 text-yellow-500 focus:border-yellow-500 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50 me-2"
                                type="checkbox" value="" id="RememberMe">
                            <label class="form-checkbox-label text-slate-400" for="RememberMe">Remember me</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <button type="submit"
                            class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-green-600 hover:bg-yellow-500 border-green-600 hover:border-yellow-500 text-white rounded-md w-full"
                            wire:loading.attr="disabled">
                            <span class="text-white">Login</span>
                        </button>
                    </div>

                    <div class="text-center">
                        <span class="text-slate-400 me-2">Don't have an account ?</span> <a
                            href="{{ route('register') }}"
                            class="text-black dark:text-white font-bold inline-block hover:text-yellow-500">Register</a>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('LoginPassword');
            var icon = document.getElementById('passwordIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</section>
