<div>
    <div class="bg-gray-50 dark:bg-slate-900">
        <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 py-12 mx-auto">
            <div class="max-w-2xl mx-auto text-center">
                <!-- Checkmark Icon -->
                <div class="p-4 sm:p-5 bg-white dark:bg-slate-800 rounded-full inline-flex items-center justify-center">
                    <svg class="w-10 h-10 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <h1 class="mt-5 text-3xl font-bold text-gray-800 dark:text-white sm:text-4xl">
                    Submission Received!
                </h1>
                <p class="mt-3 text-lg text-gray-600 dark:text-gray-400">
                    Terima kasih telah mengirimkan Letter of Intent Anda.
                </p>
                <p class="mt-2 text-gray-600 dark:text-gray-400">
                    A confirmation and instructions to set up your account password have been sent to your email address. Please check your inbox.
                </p>
            </div>

            {{-- --- DATA SUMMARY SECTION --- --}}
            @if (!empty($displaySections))
                <div class="mt-8 max-w-2xl mx-auto space-y-6">
                    @foreach ($displaySections as $sectionTitle => $sectionData)
                        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md p-6">
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-white text-left border-b border-gray-200 dark:border-gray-700 pb-3 mb-4">
                                {{ $sectionTitle }}
                            </h2>
                            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 text-left">
                                @foreach ($sectionData as $label => $value)
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $label }}</dt>
                                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200">{{ $value }}</dd>
                                    </div>
                                @endforeach
                            </dl>
                        </div>
                    @endforeach

                    {{-- Handle the signature separately --}}
                    @if ($signature)
                        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md p-6">
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-white text-left border-b border-gray-200 dark:border-gray-700 pb-3 mb-4">
                                Signature
                            </h2>
                            <dl class="text-left">
                                <dd class="mt-1 p-2 border border-gray-200 dark:border-gray-700 rounded-md inline-block bg-gray-50 dark:bg-slate-700">
                                    <img src="{{ $signature }}" alt="Submitted Signature" class="h-16">
                                </dd>
                            </dl>
                        </div>
                    @endif
                </div>
            @endif
            {{-- --- END OF SECTION --- --}}

            <div class="mt-8 text-center">
                <a class="inline-flex items-center justify-center gap-x-3 text-center bg-green-600 hover:bg-green-700 border border-transparent text-white text-sm font-medium rounded-md py-3 px-4" href="{{ route('beranda') }}">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                    Back to Homepage
                </a>
            </div>
        </div>
    </div>
</div>
