@extends('livewire.frontend.master-dashboard')
@section('content-pengguna')
    <div>
        {{-- Profile Information Form --}}
        <form wire:submit.prevent="updateProfileInformation">
            @if (session()->has('message'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            {{-- This renders the entire Filament form --}}
            {{ $this->form }}

            <div class="py-6 text-right">
                <button type="submit" class="py-3 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-green-600 hover:bg-yellow-500 border-green-600 hover:border-yellow-500 text-white rounded-md">
                    Simpan Perubahan
                </button>
            </div>
        </form>

        {{-- Two-Factor Authentication Section with Alpine.js --}}
        <div
            class="my-8"
            x-data="{
            showingQrCode: false,
            showingRecoveryCodes: false,
            twoFactorEnabled: {{ $this->user->two_factor_enabled ? 'true' : 'false' }}
        }"
            x-on:two-factor-enabled.window="showingQrCode = true; showingRecoveryCodes = true; twoFactorEnabled = true"
            x-on:recovery-codes-regenerated.window="showingRecoveryCodes = true"
            x-on:two-factor-disabled.window="showingQrCode = false; showingRecoveryCodes = false; twoFactorEnabled = false"
        >
            <div class="p-6 bg-white dark:bg-slate-900 shadow-md dark:shadow-gray-800 rounded-md">
                <h5 class="text-lg font-semibold mb-4">Two-Factor Authentication</h5>

                <div class="text-sm text-gray-600 dark:text-gray-400">
                    <template x-if="twoFactorEnabled">
                        <p class="font-semibold text-green-600">You have enabled two-factor authentication.</p>
                    </template>
                    <template x-if="!twoFactorEnabled">
                        <p>You have not enabled two-factor authentication.</p>
                    </template>
                    <p class="mt-2">When two-factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application.</p>
                </div>

                <div x-show="twoFactorEnabled">
                    <div x-show="showingQrCode" class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                        <p class="font-semibold">
                            Two-factor authentication is now enabled. Scan the following QR code using your phone's authenticator application.
                        </p>
                    </div>
                    <div x-show="showingQrCode" class="mt-4">
                        {{-- FIXED: Wrapped QR code generation in a try-catch to prevent crashes --}}


                    </div>

                    <div x-show="showingRecoveryCodes" class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                        <p class="font-semibold">
                            Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two-factor authentication device is lost.
                        </p>
                    </div>
                    <div x-show="showingRecoveryCodes" class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                        @if (auth()->user()->two_factor_secret)
                            @php
                                $recoveryCodes = [];
                                try {
                                    $recoveryCodes = json_decode(decrypt($this->user->two_factor_recovery_codes), true);
                                } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                                    // This will be caught if the payload is invalid, preventing a crash.
                                }
                            @endphp

                            @if (!empty($recoveryCodes))
                                @foreach ($recoveryCodes as $code)
                                    <div>{{ $code }}</div>
                                    <div> {!!  auth()->user()->twoFactorQrCodeSvg() !!}</div>
                                    <h3>Recovery codes</h3>
                                    <ul>
                                        @foreach(auth()->user()->recoveryCodes() as $code)
                                            <li>{{ $code }}</li>
                                        @endforeach
                                    </ul>
                                @endforeach
                            @else
                                <div class="text-red-500">
                                    Could not decrypt recovery codes. Please regenerate them to fix this issue.
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="mt-5">
                    <template x-if="!twoFactorEnabled">
                        <button type="button" class="py-2 px-4 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-blue-600 hover:bg-blue-700 border-blue-600 hover:border-blue-700 text-white rounded-md" wire:click="enableTwoFactorAuthentication" wire:loading.attr="disabled">
                            Enable 2FA
                        </button>
                    </template>
                    <template x-if="twoFactorEnabled">
                        <div>
                            <template x-if="showingRecoveryCodes">
                                <button type="button" class="py-2 px-4 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-gray-600 hover:bg-gray-700 border-gray-600 hover:border-gray-700 text-white rounded-md" wire:click="regenerateRecoveryCodes">
                                    Regenerate Recovery Codes
                                </button>
                            </template>
                            <template x-if="!showingRecoveryCodes">
                                <button type="button" class="py-2 px-4 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-gray-600 hover:bg-gray-700 border-gray-600 hover:border-gray-700 text-white rounded-md" @click="showingRecoveryCodes = true">
                                    Show Recovery Codes
                                </button>
                            </template>

                            <button type="button" class="ml-3 py-2 px-4 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-red-600 hover:bg-red-700 border-red-600 hover:border-red-700 text-white rounded-md" wire:click="disableTwoFactorAuthentication">
                                Disable 2FA
                            </button>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>



@endsection
