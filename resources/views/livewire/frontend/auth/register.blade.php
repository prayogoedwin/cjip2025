<section class="pt-20">

    <div class="flex justify-center">
        <div
            class="max-w-[500px] w-full m-auto p-6 bg-white dark:bg-slate-900 shadow-md dark:shadow-gray-800 rounded-md">
            <a class="justify-center flex" href="{{ route('beranda') }}">
                <img src="{{ asset('images/cjip.png') }}" class="l-dark w-16" alt="">
            </a>
            <h5 class="mt-4 text-xl font-semibold flex justify-center">Register</h5>
            <form class="text-start" wire:submit.prevent="registerStore">
                <div class="grid grid-cols-1">
                    <div class="mb-4">
                        <label class="font-semibold" for="LoginEmail">Nama Lengkap :</label>
                        <input id="LoginEmail" type="text" wire:model="name"
                            class="form-input mt-3 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded-lg outline-none border border-gray-200 @error('name') border-red-500 @enderror focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                            placeholder="Nama Lengkap">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">{{ $message }}</span></p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="font-semibold" for="LoginEmail">Email :</label>
                        <input id="LoginEmail" type="email" wire:model="email"
                            class="form-input mt-3 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded-lg outline-none border border-gray-200 @error('email') border-red-500 @enderror focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                            placeholder="Email">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">{{ $message }}</span></p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="font-semibold" for="LoginPassword">Password :</label>
                        <div class="relative">
                            <input id="LoginPassword" type="password" wire:model="password"
                                class="form-input mt-3 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded-lg outline-none border border-gray-200 @error('password') border-red-500 @enderror focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                placeholder="Password">
                            <button type="button" onclick="togglePasswordVisibility()"
                                class="absolute inset-y-0 right-0 flex items-center mt-3 px-4 py-2 text-sm font-medium text-gray-600 bg-transparent dark:text-slate-200 dark:bg-slate-900 rounded-r-lg focus:outline-none">
                                <i id="passwordIcon" class="fa fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">{{ $message }}</span></p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <button type="submit"
                            class="py-3 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-green-600 hover:bg-yellow-500 border-green-600 hover:border-yellow-500 text-white rounded-md w-full"
                            wire:loading.attr="disabled">
                            <span>Register</span>
                        </button>

                    </div>

                    <div class="text-center">
                        <span class="text-slate-400 me-2">Already have an account ?</span> <a
                            href="{{ route('login') }}"
                            class="text-black dark:text-white font-bold inline-block hover:text-yellow-500">Login</a>
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
