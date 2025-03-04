<x-filament::page>
    {{-- Detail Produk --}}
    <x-filament::section>
        <div class="bg-white dark:bg-gray-900 p-2 flex flex-col md:flex-row">
            <div class="w-full md:w-1/2 flex flex-col items-center">
                <div class="w-full h-36 p-4">
                    <img id="mainImage" src="{{ $imageMain ?? $product->product->gambar }}" alt="Product Image"
                        class="w-auto h-24 object-cover rounded-lg ">
                </div>
            </div>

            <!-- Kolom Keterangan Produk -->
            <div class="w-full md:w-1/2 mt-6 md:mt-0 md:ml-6 flex flex-col justify-between">
                <div>
                    <h2 class="text-3xl font-bold mb-4 text-gray-900 dark:text-white">
                        {{ $product->product->name }}</h2>
                    <p class="text-gray-700 dark:text-gray-400 mb-4">{!! str($product->product->description)->markdown()->sanitizeHtml() !!}
                    </p>
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
                            <span
                                class="ml-3 text-gray-700 dark:text-gray-300">{{ $product->product->user->name }}</span>
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
    </x-filament::section>

    {{-- Detail Pemilik Produk --}}
    <x-filament::section>
        <x-slot name="heading">
            Details Pemilik Produk
        </x-slot>

        <section x-data="{
            isCollapsed: false,
        }"
            x-on:collapse-section.window="if ($event.detail.id == $el.id) isCollapsed = true"
            x-on:expand="isCollapsed = false"
            x-on:open-section.window="if ($event.detail.id == $el.id) isCollapsed = false"
            x-on:toggle-section.window="if ($event.detail.id == $el.id) isCollapsed = ! isCollapsed"
            x-bind:class="isCollapsed & amp; & amp;
            'fi-collapsed'"
            class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10"
            id="informasi-pelaku-usaha">

            <header x-on:click="isCollapsed = ! isCollapsed"
                class="fi-section-header flex flex-col gap-3 cursor-pointer px-6 py-4">
                <div class="flex items-center gap-3">
                    <svg class="fi-section-header-icon self-start text-gray-400 dark:text-gray-500 fi-color-{$iconColor} h-6 w-6"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z">
                        </path>
                    </svg>
                    <div class="grid flex-1 gap-y-1">
                        <h3
                            class="fi-section-header-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                            Informasi Pelaku Usaha
                        </h3>
                    </div>
                    <button
                        style="--c-300:var(--gray-300);--c-400:var(--gray-400);--c-500:var(--gray-500);--c-600:var(--gray-600);"
                        class="fi-icon-btn relative flex items-center justify-center rounded-lg outline-none transition duration-75 focus-visible:ring-2 -m-2 h-9 w-9 text-gray-400 hover:text-gray-500 focus-visible:ring-primary-600 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:ring-primary-500 fi-color-gray rotate-180"
                        type="button" wire:loading.attr="disabled" x-on:click.stop="isCollapsed = ! isCollapsed"
                        x-bind:class="{ 'rotate-180': !isCollapsed }">
                        <svg class="fi-icon-btn-icon h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd"
                                d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </header>
            <div x-bind:aria-expanded="(!isCollapsed).toString()"
                x-bind:class="{
                    'invisible absolute h-0 overflow-hidden border-none': isCollapsed,
                }"
                class="fi-section-content-ctn border-t border-gray-200 dark:border-white/10" aria-expanded="true">
                <div class="fi-section-content p-6">
                    <dl>
                        <div style="--cols-default: repeat(1, minmax(0, 1fr));"
                            class="grid grid-cols-[--cols-default] fi-fo-component-ctn gap-6">
                            <div style="--col-span-default: 1 / -1;" class="col-[--col-span-default]">
                                <div>
                                    <dl>
                                        <div style="--cols-default: repeat(1, minmax(0, 1fr)); --cols-lg: repeat(2, minmax(0, 1fr));"
                                            class="grid grid-cols-[--cols-default] lg:grid-cols-[--cols-lg] fi-fo-component-ctn gap-6">
                                            <div style="--col-span-default: span 1 / span 1;"
                                                class="col-[--col-span-default]">
                                                <div class="fi-in-entry-wrp">
                                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                                        <div class="flex items-center gap-x-3 justify-between ">
                                                            <dt
                                                                class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                                <span
                                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                                    Pelaku Usaha :
                                                                </span>
                                                            </dt>
                                                        </div>
                                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                                            <dd class="">
                                                                <div class="fi-in-text w-full">
                                                                    <div class="fi-in-affixes flex">
                                                                        <div class="min-w-0 flex-1">
                                                                            <div class="flex ">
                                                                                <div class="flex max-w-max"
                                                                                    style="">
                                                                                    <div
                                                                                        class="fi-in-text-item inline-flex items-center gap-1.5">
                                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                                            style="">
                                                                                            {{ $product->product->user->name }}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </dd>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="--col-span-default: span 1 / span 1;"
                                                class="col-[--col-span-default]">
                                                <div class="fi-in-entry-wrp">
                                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                                        <div class="flex items-center gap-x-3 justify-between ">
                                                            <dt
                                                                class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                                <span
                                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                                    Email :
                                                                </span>
                                                            </dt>
                                                        </div>
                                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                                            <dd class="">
                                                                <div class="fi-in-text w-full">
                                                                    <div class="fi-in-affixes flex">
                                                                        <div class="min-w-0 flex-1">
                                                                            <div class="flex ">
                                                                                <div class="flex max-w-max"
                                                                                    style="">
                                                                                    <div
                                                                                        class="fi-in-text-item inline-flex items-center gap-1.5  ">
                                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                                            style="">
                                                                                            {{ $product->product->user->email }}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </dd>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="--col-span-default: span 1 / span 1;"
                                                class="col-[--col-span-default]">
                                                <div class="fi-in-entry-wrp">
                                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                                        <div class="flex items-center gap-x-3 justify-between ">
                                                            <dt
                                                                class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                                <span
                                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                                    No. Telepon :
                                                                </span>
                                                            </dt>
                                                        </div>
                                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                                            <dd class="">
                                                                <div class="fi-in-text w-full">
                                                                    <div class="fi-in-affixes flex">
                                                                        <div class="min-w-0 flex-1">
                                                                            <div class="flex ">
                                                                                <div class="flex max-w-max"
                                                                                    style="">
                                                                                    <div
                                                                                        class="fi-in-text-item inline-flex items-center gap-1.5  ">
                                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                                            style="">
                                                                                            {{ $product->product->user->no_hp }}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </dd>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="--col-span-default: span 1 / span 1;"
                                                class="col-[--col-span-default]">
                                                <div class="fi-in-entry-wrp">
                                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                                        <div class="flex items-center gap-x-3 justify-between ">
                                                            <dt
                                                                class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                                <span
                                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                                    Jabatan :
                                                                </span>
                                                            </dt>
                                                        </div>
                                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                                            <dd class="">
                                                                <div class="fi-in-text w-full">
                                                                    <div class="fi-in-affixes flex">
                                                                        <div class="min-w-0 flex-1">
                                                                            <div class="flex ">
                                                                                <div class="flex max-w-max"
                                                                                    style="">
                                                                                    <div
                                                                                        class="fi-in-text-item inline-flex items-center gap-1.5  ">
                                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                                            style="">
                                                                                            {{ $product->product->user->jabatan }}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </dd>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </dl>
                </div>
            </div>
        </section>

        <section x-data="{
            isCollapsed: false,
        }"
            class="fi-section rounded-xl mt-3 bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10"
            id="informasi-perusahaan">
            <header class="fi-section-header flex flex-col gap-3 px-6 py-4">
                <div class="flex items-center gap-3"><svg
                        class="fi-section-header-icon self-start text-gray-400 dark:text-gray-500 fi-color-{$iconColor} h-6 w-6"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z">
                        </path>
                    </svg>
                    <div class="grid flex-1 gap-y-1">
                        <h3
                            class="fi-section-header-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                            Informasi Perusahaan
                        </h3>
                    </div>
                </div>
            </header>


            <div class="fi-section-content-ctn border-t border-gray-200 dark:border-white/10">
                <div class="fi-section-content p-6">
                    <dl>
                        <div style="--cols-default: repeat(1, minmax(0, 1fr)); --cols-lg: repeat(2, minmax(0, 1fr));"
                            class="grid grid-cols-[--cols-default] lg:grid-cols-[--cols-lg] fi-fo-component-ctn gap-6">
                            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                                <div class="fi-in-entry-wrp">
                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                        <div class="flex items-center gap-x-3 justify-between ">
                                            <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                <span
                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                    Nama Perusahaan :
                                                </span>
                                            </dt>
                                        </div>
                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                            <dd class="">
                                                <div class="fi-in-text w-full">
                                                    <div class="fi-in-affixes flex">
                                                        <div class="min-w-0 flex-1">
                                                            <div class="flex ">
                                                                <div class="flex max-w-max" style="">
                                                                    <div
                                                                        class="fi-in-text-item inline-flex items-center gap-1.5  ">
                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                            style="">
                                                                            {{ $product->product->user->userperusahaan->nama_perusahaan }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </dd>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                                <div class="fi-in-entry-wrp">
                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                        <div class="flex items-center gap-x-3 justify-between ">
                                            <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                <span
                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                    Jenis Usaha :
                                                </span>
                                            </dt>
                                        </div>
                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                            <dd class="">
                                                <div class="fi-in-text w-full">
                                                    <div class="fi-in-affixes flex">
                                                        <div class="min-w-0 flex-1">
                                                            <div class="flex ">
                                                                <div class="flex max-w-max" style="">
                                                                    <div
                                                                        class="fi-in-text-item inline-flex items-center gap-1.5  ">
                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                            style="">
                                                                            {{ $product->product->user->userperusahaan->jenis_usaha }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </dd>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                                <div class="fi-in-entry-wrp">
                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                        <div class="flex items-center gap-x-3 justify-between ">
                                            <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                <span
                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                    Alamat Perusahaan :
                                                </span>
                                            </dt>
                                        </div>
                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                            <dd class="">
                                                <div class="fi-in-text w-full">
                                                    <div class="fi-in-affixes flex">
                                                        <div class="min-w-0 flex-1">
                                                            <div class="flex ">
                                                                <div class="flex max-w-max" style="">
                                                                    <div
                                                                        class="fi-in-text-item inline-flex items-center gap-1.5">
                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                            style="">
                                                                            {{ $product->product->user->userperusahaan->alamat_perusahaan }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </dd>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                                <div class="fi-in-entry-wrp">
                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                        <div class="flex items-center gap-x-3 justify-between ">
                                            <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                <span
                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                    NIB :
                                                </span>
                                            </dt>
                                        </div>
                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                            <dd class="">
                                                <div class="fi-in-text w-full">
                                                    <div class="fi-in-affixes flex">
                                                        <div class="min-w-0 flex-1">
                                                            <div class="flex ">
                                                                <div class="flex max-w-max" style="">
                                                                    <div
                                                                        class="fi-in-text-item inline-flex items-center gap-1.5  ">
                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                            style="">
                                                                            {{ $product->product->user->userperusahaan->nib }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </dd>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                                <div class="fi-in-entry-wrp">
                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                        <div class="flex items-center gap-x-3 justify-between ">
                                            <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                <span
                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                    Asal Negara :
                                                </span>
                                            </dt>
                                        </div>
                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                            <dd class="">
                                                <div class="fi-in-text w-full">
                                                    <div class="fi-in-affixes flex">
                                                        <div class="min-w-0 flex-1">
                                                            <div class="flex ">
                                                                <div class="flex max-w-max" style="">
                                                                    <div
                                                                        class="fi-in-text-item inline-flex items-center gap-1.5  ">
                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                            style="">
                                                                            {{ $product->product->user->userperusahaan->negara_asal }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </dd>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                                <div class="fi-in-entry-wrp">
                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                        <div class="flex items-center gap-x-3 justify-between ">
                                            <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                <span
                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                    Induk Perusahaan :
                                                </span>
                                            </dt>
                                        </div>
                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                            <dd class="">
                                                <div class="fi-in-text w-full">
                                                    <div class="fi-in-affixes flex">
                                                        <div class="min-w-0 flex-1">
                                                            <div class="flex ">
                                                                <div class="flex max-w-max" style="">
                                                                    <div
                                                                        class="fi-in-text-item inline-flex items-center gap-1.5  ">
                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                            style="">
                                                                            {{ $product->product->user->userperusahaan->induk_perusahaan }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </dd>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                                <div class="fi-in-entry-wrp">
                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                        <div class="flex items-center gap-x-3 justify-between ">
                                            <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                <span
                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                    Telepon Perusahaan :
                                                </span>
                                            </dt>
                                        </div>
                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                            <dd class="">
                                                <div class="fi-in-text w-full">
                                                    <div class="fi-in-affixes flex">
                                                        <div class="min-w-0 flex-1">
                                                            <div class="flex ">
                                                                <div class="flex max-w-max" style="">
                                                                    <div
                                                                        class="fi-in-text-item inline-flex items-center gap-1.5  ">
                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                            style="">
                                                                            {{ $product->product->user->userperusahaan->telepon_perusahaan }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </dd>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                                <div class="fi-in-entry-wrp">
                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                        <div class="flex items-center gap-x-3 justify-between ">
                                            <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                <span
                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                    Nama Pimpinan :
                                                </span>
                                            </dt>
                                        </div>
                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                            <dd class="">
                                                <div class="fi-in-text w-full">
                                                    <div class="fi-in-affixes flex">
                                                        <div class="min-w-0 flex-1">
                                                            <div class="flex ">
                                                                <div class="flex max-w-max" style="">
                                                                    <div
                                                                        class="fi-in-text-item inline-flex items-center gap-1.5">
                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white"
                                                                            style="">
                                                                            {{ $product->product->user->userperusahaan->nama_pimpinan }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </dd>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                                <div class="fi-in-entry-wrp">
                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                        <div class="flex items-center gap-x-3 justify-between ">
                                            <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                <span
                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                    Telepon Pimpinan :
                                                </span>
                                            </dt>
                                        </div>
                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                            <dd class="">
                                                <div class="fi-in-text w-full">
                                                    <div class="fi-in-affixes flex">
                                                        <div class="min-w-0 flex-1">
                                                            <div class="flex ">
                                                                <div class="flex max-w-max" style="">
                                                                    <div
                                                                        class="fi-in-text-item inline-flex items-center gap-1.5">
                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white"
                                                                            style="">
                                                                            {{ $product->product->user->userperusahaan->telepon_pimpinan }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </dd>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                                <div class="fi-in-entry-wrp">
                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                        <div class="flex items-center gap-x-3 justify-between ">
                                            <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                <span
                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                    Alamat Pimpinan :
                                                </span>
                                            </dt>
                                        </div>
                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                            <dd class="">
                                                <div class="fi-in-text w-full">
                                                    <div class="fi-in-affixes flex">
                                                        <div class="min-w-0 flex-1">
                                                            <div class="flex ">
                                                                <div class="flex max-w-max" style="">
                                                                    <div
                                                                        class="fi-in-text-item inline-flex items-center gap-1.5  ">
                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                            style="">
                                                                            {{ $product->product->user->userperusahaan->alamat_pimpinan }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </dd>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </dl>
                </div>
            </div>
        </section>

        {{-- Content --}}
    </x-filament::section>

    {{-- detail Peminat Produk --}}
    <x-filament::section>
        <x-slot name="heading">
            Details Peminat Produk
        </x-slot>

        <section x-data="{
            isCollapsed: false,
        }"
            x-on:collapse-section.window="if ($event.detail.id == $el.id) isCollapsed = true"
            x-on:expand="isCollapsed = false"
            x-on:open-section.window="if ($event.detail.id == $el.id) isCollapsed = false"
            x-on:toggle-section.window="if ($event.detail.id == $el.id) isCollapsed = ! isCollapsed"
            x-bind:class="isCollapsed & amp; & amp;
            'fi-collapsed'"
            class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10"
            id="informasi-pelaku-usaha">

            <header x-on:click="isCollapsed = ! isCollapsed"
                class="fi-section-header flex flex-col gap-3 cursor-pointer px-6 py-4">
                <div class="flex items-center gap-3">
                    <svg class="fi-section-header-icon self-start text-gray-400 dark:text-gray-500 fi-color-{$iconColor} h-6 w-6"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z">
                        </path>
                    </svg>
                    <div class="grid flex-1 gap-y-1">
                        <h3
                            class="fi-section-header-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                            Informasi Pelaku Usaha
                        </h3>
                    </div>
                    <button
                        style="--c-300:var(--gray-300);--c-400:var(--gray-400);--c-500:var(--gray-500);--c-600:var(--gray-600);"
                        class="fi-icon-btn relative flex items-center justify-center rounded-lg outline-none transition duration-75 focus-visible:ring-2 -m-2 h-9 w-9 text-gray-400 hover:text-gray-500 focus-visible:ring-primary-600 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:ring-primary-500 fi-color-gray rotate-180"
                        type="button" wire:loading.attr="disabled" x-on:click.stop="isCollapsed = ! isCollapsed"
                        x-bind:class="{ 'rotate-180': !isCollapsed }">
                        <svg class="fi-icon-btn-icon h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd"
                                d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </header>
            <div x-bind:aria-expanded="(!isCollapsed).toString()"
                x-bind:class="{
                    'invisible absolute h-0 overflow-hidden border-none': isCollapsed,
                }"
                class="fi-section-content-ctn border-t border-gray-200 dark:border-white/10" aria-expanded="true">
                <div class="fi-section-content p-6">
                    <dl>
                        <div style="--cols-default: repeat(1, minmax(0, 1fr));"
                            class="grid grid-cols-[--cols-default] fi-fo-component-ctn gap-6">
                            <div style="--col-span-default: 1 / -1;" class="col-[--col-span-default]">
                                <div>
                                    <dl>
                                        <div style="--cols-default: repeat(1, minmax(0, 1fr)); --cols-lg: repeat(2, minmax(0, 1fr));"
                                            class="grid grid-cols-[--cols-default] lg:grid-cols-[--cols-lg] fi-fo-component-ctn gap-6">
                                            <div style="--col-span-default: span 1 / span 1;"
                                                class="col-[--col-span-default]">
                                                <div class="fi-in-entry-wrp">
                                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                                        <div class="flex items-center gap-x-3 justify-between ">
                                                            <dt
                                                                class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                                <span
                                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                                    Pelaku Usaha :
                                                                </span>
                                                            </dt>
                                                        </div>
                                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                                            <dd class="">
                                                                <div class="fi-in-text w-full">
                                                                    <div class="fi-in-affixes flex">
                                                                        <div class="min-w-0 flex-1">
                                                                            <div class="flex ">
                                                                                <div class="flex max-w-max"
                                                                                    style="">
                                                                                    <div
                                                                                        class="fi-in-text-item inline-flex items-center gap-1.5">
                                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                                            style="">
                                                                                            {{ $product->userPeminat->name }}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </dd>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="--col-span-default: span 1 / span 1;"
                                                class="col-[--col-span-default]">
                                                <div class="fi-in-entry-wrp">
                                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                                        <div class="flex items-center gap-x-3 justify-between ">
                                                            <dt
                                                                class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                                <span
                                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                                    Email :
                                                                </span>
                                                            </dt>
                                                        </div>
                                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                                            <dd class="">
                                                                <div class="fi-in-text w-full">
                                                                    <div class="fi-in-affixes flex">
                                                                        <div class="min-w-0 flex-1">
                                                                            <div class="flex ">
                                                                                <div class="flex max-w-max"
                                                                                    style="">
                                                                                    <div
                                                                                        class="fi-in-text-item inline-flex items-center gap-1.5  ">
                                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                                            style="">
                                                                                            {{ $product->userPeminat->email }}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </dd>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="--col-span-default: span 1 / span 1;"
                                                class="col-[--col-span-default]">
                                                <div class="fi-in-entry-wrp">
                                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                                        <div class="flex items-center gap-x-3 justify-between ">
                                                            <dt
                                                                class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                                <span
                                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                                    No. Telepon :
                                                                </span>
                                                            </dt>
                                                        </div>
                                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                                            <dd class="">
                                                                <div class="fi-in-text w-full">
                                                                    <div class="fi-in-affixes flex">
                                                                        <div class="min-w-0 flex-1">
                                                                            <div class="flex ">
                                                                                <div class="flex max-w-max"
                                                                                    style="">
                                                                                    <div
                                                                                        class="fi-in-text-item inline-flex items-center gap-1.5  ">
                                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                                            style="">
                                                                                            {{ $product->userPeminat->no_hp }}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </dd>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="--col-span-default: span 1 / span 1;"
                                                class="col-[--col-span-default]">
                                                <div class="fi-in-entry-wrp">
                                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                                        <div class="flex items-center gap-x-3 justify-between ">
                                                            <dt
                                                                class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                                <span
                                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                                    Jabatan :
                                                                </span>
                                                            </dt>
                                                        </div>
                                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                                            <dd class="">
                                                                <div class="fi-in-text w-full">
                                                                    <div class="fi-in-affixes flex">
                                                                        <div class="min-w-0 flex-1">
                                                                            <div class="flex ">
                                                                                <div class="flex max-w-max"
                                                                                    style="">
                                                                                    <div
                                                                                        class="fi-in-text-item inline-flex items-center gap-1.5  ">
                                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                                            style="">
                                                                                            {{ $product->userPeminat->jabatan }}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </dd>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </dl>
                </div>
            </div>
        </section>

        <section x-data="{
            isCollapsed: false,
        }"
            class="fi-section rounded-xl mt-3 bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10"
            id="informasi-perusahaan">
            <header class="fi-section-header flex flex-col gap-3 px-6 py-4">
                <div class="flex items-center gap-3"><svg
                        class="fi-section-header-icon self-start text-gray-400 dark:text-gray-500 fi-color-{$iconColor} h-6 w-6"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z">
                        </path>
                    </svg>
                    <div class="grid flex-1 gap-y-1">
                        <h3
                            class="fi-section-header-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                            Informasi Perusahaan
                        </h3>
                    </div>
                </div>
            </header>

            <div class="fi-section-content-ctn border-t border-gray-200 dark:border-white/10">
                <div class="fi-section-content p-6">
                    <dl>
                        <div style="--cols-default: repeat(1, minmax(0, 1fr)); --cols-lg: repeat(2, minmax(0, 1fr));"
                            class="grid grid-cols-[--cols-default] lg:grid-cols-[--cols-lg] fi-fo-component-ctn gap-6">
                            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                                <div class="fi-in-entry-wrp">
                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                        <div class="flex items-center gap-x-3 justify-between ">
                                            <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                <span
                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                    Nama Perusahaan :
                                                </span>
                                            </dt>
                                        </div>
                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                            <dd class="">
                                                <div class="fi-in-text w-full">
                                                    <div class="fi-in-affixes flex">
                                                        <div class="min-w-0 flex-1">
                                                            <div class="flex ">
                                                                <div class="flex max-w-max" style="">
                                                                    <div
                                                                        class="fi-in-text-item inline-flex items-center gap-1.5  ">
                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                            style="">
                                                                            {{ $product->userPeminat->userperusahaan->nama_perusahaan }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </dd>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                                <div class="fi-in-entry-wrp">
                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                        <div class="flex items-center gap-x-3 justify-between ">
                                            <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                <span
                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                    Jenis Usaha :
                                                </span>
                                            </dt>
                                        </div>
                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                            <dd class="">
                                                <div class="fi-in-text w-full">
                                                    <div class="fi-in-affixes flex">
                                                        <div class="min-w-0 flex-1">
                                                            <div class="flex ">
                                                                <div class="flex max-w-max" style="">
                                                                    <div
                                                                        class="fi-in-text-item inline-flex items-center gap-1.5  ">
                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                            style="">
                                                                            {{ $product->userPeminat->userperusahaan->jenis_usaha }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </dd>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                                <div class="fi-in-entry-wrp">
                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                        <div class="flex items-center gap-x-3 justify-between ">
                                            <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                <span
                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                    Alamat Perusahaan :
                                                </span>
                                            </dt>
                                        </div>
                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                            <dd class="">
                                                <div class="fi-in-text w-full">
                                                    <div class="fi-in-affixes flex">
                                                        <div class="min-w-0 flex-1">
                                                            <div class="flex ">
                                                                <div class="flex max-w-max" style="">
                                                                    <div
                                                                        class="fi-in-text-item inline-flex items-center gap-1.5  ">
                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                            style="">
                                                                            {{ $product->userPeminat->userperusahaan->alamat_perusahaan }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </dd>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                                <div class="fi-in-entry-wrp">
                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                        <div class="flex items-center gap-x-3 justify-between ">
                                            <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                <span
                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                    NIB :
                                                </span>
                                            </dt>
                                        </div>
                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                            <dd class="">
                                                <div class="fi-in-text w-full">
                                                    <div class="fi-in-affixes flex">
                                                        <div class="min-w-0 flex-1">
                                                            <div class="flex ">
                                                                <div class="flex max-w-max" style="">
                                                                    <div
                                                                        class="fi-in-text-item inline-flex items-center gap-1.5  ">
                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                            style="">
                                                                            {{ $product->userPeminat->userperusahaan->nib }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </dd>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                                <div class="fi-in-entry-wrp">
                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                        <div class="flex items-center gap-x-3 justify-between ">
                                            <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                <span
                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                    Asal Negara :
                                                </span>
                                            </dt>
                                        </div>
                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                            <dd class="">
                                                <div class="fi-in-text w-full">
                                                    <div class="fi-in-affixes flex">
                                                        <div class="min-w-0 flex-1">
                                                            <div class="flex ">
                                                                <div class="flex max-w-max" style="">
                                                                    <div
                                                                        class="fi-in-text-item inline-flex items-center gap-1.5  ">
                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                            style="">
                                                                            {{ $product->userPeminat->userperusahaan->negara_asal }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </dd>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                                <div class="fi-in-entry-wrp">
                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                        <div class="flex items-center gap-x-3 justify-between ">
                                            <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                <span
                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                    Induk Perusahaan :
                                                </span>
                                            </dt>
                                        </div>
                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                            <dd class="">
                                                <div class="fi-in-text w-full">
                                                    <div class="fi-in-affixes flex">
                                                        <div class="min-w-0 flex-1">
                                                            <div class="flex ">
                                                                <div class="flex max-w-max" style="">
                                                                    <div
                                                                        class="fi-in-text-item inline-flex items-center gap-1.5  ">
                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                            style="">
                                                                            {{ $product->userPeminat->userperusahaan->induk_perusahaan }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </dd>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                                <div class="fi-in-entry-wrp">
                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                        <div class="flex items-center gap-x-3 justify-between ">
                                            <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                <span
                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                    Telepon Perusahaan :
                                                </span>
                                            </dt>
                                        </div>
                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                            <dd class="">
                                                <div class="fi-in-text w-full">
                                                    <div class="fi-in-affixes flex">
                                                        <div class="min-w-0 flex-1">
                                                            <div class="flex ">
                                                                <div class="flex max-w-max" style="">
                                                                    <div
                                                                        class="fi-in-text-item inline-flex items-center gap-1.5  ">
                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                            style="">
                                                                            {{ $product->userPeminat->userperusahaan->telepon_perusahaan }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </dd>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                                <div class="fi-in-entry-wrp">
                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                        <div class="flex items-center gap-x-3 justify-between ">
                                            <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                <span
                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                    Nama Pimpinan :
                                                </span>
                                            </dt>
                                        </div>
                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                            <dd class="">
                                                <div class="fi-in-text w-full">
                                                    <div class="fi-in-affixes flex">
                                                        <div class="min-w-0 flex-1">
                                                            <div class="flex ">
                                                                <div class="flex max-w-max" style="">
                                                                    <div
                                                                        class="fi-in-text-item inline-flex items-center gap-1.5  ">
                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                            style="">
                                                                            {{ $product->userPeminat->userperusahaan->nama_pimpinan }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </dd>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                                <div class="fi-in-entry-wrp">
                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                        <div class="flex items-center gap-x-3 justify-between ">
                                            <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                <span
                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                    Telepon Pimpinan :
                                                </span>
                                            </dt>
                                        </div>
                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                            <dd class="">
                                                <div class="fi-in-text w-full">
                                                    <div class="fi-in-affixes flex">
                                                        <div class="min-w-0 flex-1">
                                                            <div class="flex ">
                                                                <div class="flex max-w-max" style="">
                                                                    <div
                                                                        class="fi-in-text-item inline-flex items-center gap-1.5  ">
                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                            style="">
                                                                            {{ $product->userPeminat->userperusahaan->telepon_pimpinan }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </dd>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                                <div class="fi-in-entry-wrp">
                                    <div class="grid gap-y-2 sm:grid-cols-3 sm:items-start sm:gap-x-4">
                                        <div class="flex items-center gap-x-3 justify-between ">
                                            <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                                <span
                                                    class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                    Alamat Pimpinan :
                                                </span>
                                            </dt>
                                        </div>
                                        <div class="grid auto-cols-fr gap-y-2 sm:col-span-2">
                                            <dd class="">
                                                <div class="fi-in-text w-full">
                                                    <div class="fi-in-affixes flex">
                                                        <div class="min-w-0 flex-1">
                                                            <div class="flex ">
                                                                <div class="flex max-w-max" style="">
                                                                    <div
                                                                        class="fi-in-text-item inline-flex items-center gap-1.5  ">
                                                                        <div class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                            style="">
                                                                            {{ $product->userPeminat->userperusahaan->alamat_pimpinan }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </dd>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </dl>
                </div>
            </div>
        </section>

        {{-- Content --}}
    </x-filament::section>

    {{-- Discussion --}}
    <x-filament::section>
        @if ($statusMinat->status == 1)
            <section class="bg-white dark:bg-gray-900 py-3 lg:py-16 antialiased">
                <div class="max-w-2xl mx-auto px-2">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg lg:text-2xl font-bold mb-2 text-gray-900 dark:text-white">Discussion
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
    </x-filament::section>
</x-filament::page>
