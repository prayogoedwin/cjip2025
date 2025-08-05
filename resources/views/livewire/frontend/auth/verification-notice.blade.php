@extends('components.layouts.login')

@section('content')
    <section class="pt-20">
        <div class="flex justify-center">
            <div class="max-w-[550px] w-full m-auto p-8 bg-white dark:bg-slate-900 shadow-md dark:shadow-gray-800 rounded-md text-center">
                <a class="justify-center flex" href="{{ route('beranda') }}">
                    <img src="{{ asset('images/cjip.png') }}" class="l-dark w-16" alt="Logo">
                </a>
                <h5 class="mt-6 text-xl font-semibold">Verifikasi Alamat Email Anda</h5>

                <div class="mt-4">
                    @if (session('status') == 'verification-link-sent')
                        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                            Link verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.
                        </div>
                    @endif

                    <p class="text-slate-500">
                        Terima kasih telah mendaftar! Sebelum melanjutkan, bisakah Anda memverifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan melalui email kepada Anda?
                    </p>
                    <p class="text-slate-500 mt-2">
                        Jika Anda tidak menerima email tersebut, kami akan dengan senang hati mengirimkan email lainnya.
                    </p>

                    <div class="mt-6 flex items-center justify-center gap-x-6">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-green-600 hover:bg-yellow-500 border-green-600 hover:border-yellow-500 text-white rounded-md">
                                Kirim Ulang Email Verifikasi
                            </button>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="font-semibold leading-6 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
