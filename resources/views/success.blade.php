@extends('layouts.app')
@push('css')
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700&amp;display=swap" rel="stylesheet">
@endpush
@section('content')
    <div class="bg-gray-100 dark:bg-slate-900">
        <section class="relative table w-full py-3 lg:py-3"
            style="background: url('{{ asset('assets/images/slide.jpg') }}') center center no-repeat;">
            <div class="absolute inset-0 bg-black opacity-80"></div>
            <div class="container">
                <div class="grid grid-cols-1 pb-8 text-center mt-10">
                    {{-- <h3 class="md:text-4xl text-3xl md:leading-normal leading-normal font-medium text-white">Lokasi

            </h3> --}}
                </div>
                <!--end grid-->
            </div>
        </section>

        <div class="bg-slate-50 dark:bg-slate-900">
            <!-- Start -->
            <section class="relative md:py-18 py-10 mt-10">
                <div class="lg:mx-20 md:mx-8 py-5 px-8">
                    <table cellpadding="0" cellspacing="0"
                        style="font-family: Nunito, sans-serif; font-size: 15px; font-weight: 400; max-width: 600px; border: none; margin: 0 auto; border-radius: 6px; overflow: hidden; background-color: #fff; box-shadow: 0 0 3px rgba(60, 72, 88, 0.15);">

                        <tbody>
                            <tr>
                                <td
                                    style="padding: 48px 24px 0; color: #161c2d; font-size: 18px; font-weight: 600; text-align:center;">
                                    <h3>Terima Kasih Telah Melakukan Pengajuan Kepeminatan</h3>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 15px 24px 15px; color: #8492a6;">
                                    Silahkan cek email yang telah anda daftarkan untuk mendapatkan username dan password
                                </td>
                            </tr>

                            <tr>
                                <td style="padding: 15px 24px;">
                                    <a href="{{ url('/') }}"
                                        style="padding: 8px 20px; outline: none; text-decoration: none; font-size: 16px; letter-spacing: 0.5px; transition: all 0.3s; font-weight: 600; border-radius: 6px; background-color: #4f46e5; border: 1px solid #4f46e5; color: #ffffff;">Confirm
                                        Back To Home</a>
                                </td>
                            </tr>
                            </tr>

                            <tr>
                                <td
                                    style="padding: 16px 8px; color: #8492a6; background-color: #f8f9fc; text-align: center;">
                                    ©
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script> {{ env('APP_NAME') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
@endsection
