@extends('livewire.frontend.master-dashboard')
@section('content-pengguna')
    <div class="flex flex-col rounded-2xl w-full bg-[#ffffff] mb-3">
        <h2 class="text-lg font-semibold mb-4">Form Pengajuan</h2>
        <div class="flex flex-row justify-between">
            <form wire:submit.prevent="cariNib">
                {{-- <label for="simple-search" class="sr-only">Search</label>
            <div class="relative w-full">
                <input type="text" id="simple-search" wire:model="nib"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                    placeholder="Search nib..." required />
            </div> --}}
                <table class="w-full">
                    <tr>
                        <td class="w-48">
                            <label for="" class="text-sm font-medium text-gray-900 dark:text-white">Search Nib</label>
                        </td>
                        <td>
                            <div class="flex flex-row">
                                <div class="relative w-full">
                                    <input type="text" id="simple-search" wire:model="nib"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                        placeholder="Search NIB ..." required />
                                </div>
                                <button type="submit"
                                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 ml-2 py-3 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                    <span class="sr-only">Search</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                </table>
                {{-- <button type="submit"
                class="p-2.5 ms-2 text-sm font-medium text-white bg-green-700 rounded-lg border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
                <span class="sr-only">Search</span>
            </button> --}}
            </form>
            @if (session()->has('message'))
                <div id="alert-2"
                    class="flex items-center text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        {{ session('message') }}
                    </div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                        data-dismiss-target="#alert-2" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif
            @if (session()->has('berhasil'))
                <div class="flex items-center text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">{{ session('berhasil') }}!</span>
                    </div>
                </div>
            @endif
        </div>
        <div class="mt-3">
            <form wire:submit.prevent="updateFill">
                <table class="mb-3 w-full">
                    <tr>
                        <td class="pr-2 w-48"><label for="nama_perusahaan"
                                class="text-sm font-medium text-gray-900 dark:text-white">Nama Perusahaan</label></td>
                        <td><input type="text" id="nama_perusahaan" wire:model="nama_perusahaan"
                                class="border border-gray-300 px-2 py-1 w-full rounded-md focus:outline-none focus:border-green-500 mb-3"
                                placeholder="" required></td>
                    </tr>
                    <tr>
                        <td class="pr-2 w-48"><label for="alamat_perusahaan"
                                class="text-sm font-medium text-gray-900 dark:text-white">Alamat Perusahaan</label></td>
                        <td><input type="text" id="alamat_perusahaan" wire:model="alamat_perusahaan"
                                class="border border-gray-300 px-2 py-1 w-full rounded-md focus:outline-none focus:border-green-500 mb-3"
                                placeholder="" required></td>
                    </tr>
                    <tr>
                        <td class="pr-2 w-48"><label for="telp_perusahaan"
                                class="text-sm font-medium text-gray-900 dark:text-white">Telepon Perusahaan</label></td>
                        <td><input type="text" id="telp_perusahaan" wire:model="telp_perusahaan"
                                class="border border-gray-300 px-2 py-1 w-full rounded-md focus:outline-none focus:border-green-500 mb-3"
                                placeholder="" required></td>
                    </tr>
                    <tr>
                        <td class="pr-2 w-48"><label for="nama_pimpinan"
                                class="text-sm font-medium text-gray-900 dark:text-white">Nama Pimpinan</label></td>
                        <td><input type="text" id="nama_pimpinan" wire:model="nama_pimpinan"
                                class="border border-gray-300 px-2 py-1 w-full rounded-md focus:outline-none focus:border-green-500 mb-3"
                                placeholder="" required></td>
                    </tr>
                    <tr>
                        <td class="pr-2 w-48"><label for="alamat_pimpinan"
                                class="text-sm font-medium text-gray-900 dark:text-white">Alamat Pimpinan</label></td>
                        <td><input type="text" id="alamat_pimpinan" wire:model="alamat_pimpinan"
                                class="border border-gray-300 px-2 py-1 w-full rounded-md focus:outline-none focus:border-green-500 mb-3"
                                placeholder="" required></td>
                    </tr>
                    <tr>
                        <td class="pr-2 w-48"><label for="telp_pimpinan"
                                class="text-sm font-medium text-gray-900 dark:text-white">Telepon Pimpinan</label></td>
                        <td><input type="text" id="telp_pimpinan" wire:model="telp_pimpinan"
                                class="border border-gray-300 px-2 py-1 w-full rounded-md focus:outline-none focus:border-green-500 mb-3"
                                placeholder="" required></td>
                    </tr>
                </table>
                <div class="flex justify-center">
                    <button type="submit" wire:loading.remove
                        class="w-48 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                        wire:loading.attr="disabled">
                        <span>Upload Dokumen</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if ($uploadSection)
        <div class="flex flex-col rounded-2xl w-full bg-[#ffffff]">
            <div class="items-center">
                <form wire:submit.prevent="store" enctype="multipart/form-data">
                    <div class="mb-3">

                        <label class="block text-md font-medium text-gray-900 dark:text-white" for="">Upload
                            dokumen pakta integritas</label>
                        <a href="{{ route('pakta-integritas') }}?nama={{ $nama_perusahaan }}&alamat_perusahaan={{ $alamat_perusahaan }}&telp_perusahaan={{ $telp_perusahaan }}&nama_pimpinan={{ $nama_pimpinan }}&alamat_pimpinan={{ $alamat_pimpinan }}&telp_pimpinan={{ $telp_pimpinan }}"
                            target="_blank" class="text-sm underline hover:no-underline mb-2 text-red-600">Download
                            template dokumen</a>
                        <input wire:model="pakta_integritas" accept="application/pdf" required
                            class="block w-full text-sm text-gray-900 border border-gray-300 @error('pakta_integritas') border-red-500 @enderror rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="file_input_help" id="" type="file">
                        @error('pakta_integritas')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">{{ $message }}</span></p>
                        @enderror

                    </div>

                    {{-- <div class="mb-3">
                    <label class="block text-md font-medium text-gray-900 dark:text-white" for="">Upload
                        dokumen tidak sedang menerima insentif</label>
                    <a href="{{ route('pernyataan-tidak-menerima-intensif') }}?nama={{ $nama_perusahaan }}&alamat_perusahaan={{ $alamat_perusahaan }}&telp_perusahaan={{ $telp_perusahaan }}&nama_pimpinan={{ $nama_pimpinan }}&alamat_pimpinan={{ $alamat_pimpinan }}&telp_pimpinan={{ $telp_pimpinan }}"
                        target="_blank" class="text-sm underline hover:no-underline mb-2 text-red-600">Download
                        template dokumen</a>
                    <input wire:model="tidak_menerima_intensif" accept="application/pdf" required
                        class="block w-full text-sm text-gray-900 border border-gray-300 @error('tidak_menerima_intensif') border-red-500 @enderror rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="file_input_help" id="" type="file">
                    @error('tidak_menerima_intensif')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-500"><span
                                class="font-medium">{{ $message }}</span></p>
                    @enderror
                </div> --}}

                    <div class="mb-3">
                        <label class="block text-md font-medium text-gray-900 dark:text-white" for="">Upload file
                            ktp <span class="text-sm hover:no-underline mb-2 text-red-600">*pdf</span>
                        </label>

                        <input wire:model="file_ktp" accept="application/pdf" required
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 @error('file_ktp') border-red-500 @enderror dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="file_input_help" id="" type="file">
                        @error('file_ktp')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">{{ $message }}</span></p>
                        @enderror
                    </div>
                    <div class="mb-3">

                        <label class="block text-md font-medium text-gray-900 dark:text-white" for="">Upload file
                            permohonan direktur ke kepala DPMPTSP <span
                                class="text-sm hover:no-underline mb-2 text-red-600">*pdf</span>
                        </label>
                        <input wire:model="file_permohonan_direktur" accept="application/pdf" required
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 @error('file_permohonan_direktur') border-red-500 @enderror dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="file_input_help" id="" type="file">
                        @error('file_permohonan_direktur')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">{{ $message }}</span></p>
                        @enderror
                    </div>
                    <div class="flex justify-center">
                        <button type="submit" wire:loading.remove
                            class="focus:outline-none w-48 mt-3 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                            wire:loading.attr="disabled">
                            <span>Simpan</span>
                        </button>
                        <button wire:loading class="btn btn-primary rounded-md shadow-md my-2 px-5 mt-5"
                            wire:loading.attr="disabled">
                            <span>Loading...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection
