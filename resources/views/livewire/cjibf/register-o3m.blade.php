<div>
    @section('meta_o3m')
        <title>One-on-One Meeting Registration | Central Java Investment Platform</title>
        <link rel="canonical" href="https://cjip.jatengprov.go.id/register-o3m" />
        <meta name="robots" content="index, follow" />
        <meta name='keywords'content='One-on-One Meeting Registration' />
        <meta name="description"
            content="This activity provides an opportunity for participants to establish connections, discuss, and collaborate personally with other parties, be they investors, industry leaders, or professionals in related fields.">
        <meta property="og:locale" content="en_US">
        <meta property="og:type" content="website">
        <meta property="og:title" content="One-on-One Meeting Registration | Central Java Investment Platform">
        <meta property="og:description"
            content="This activity provides an opportunity for participants to establish connections, discuss, and collaborate personally with other parties, be they investors, industry leaders, or professionals in related fields.">
        <meta property="og:url" content="https://cjip.jatengprov.go.id/register-o3m">
        <meta property="og:site_name" content="Central Java Investment Platform">
        <meta property="og:image" content="{{ asset('images/cjibf.png') }}">
        <meta property="og:width" content="512">
        <meta property="og:height" content="512">
        <meta property="article:publisher" content="https://www.facebook.com/dpmptspjateng">
        <meta property='article:published_time' content='' />
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="One-on-One Meeting Registration | Central Java Investment Platform">
        <meta name="twitter:description"
            content="This activity provides an opportunity for participants to establish connections, discuss, and collaborate personally with other parties, be they investors, industry leaders, or professionals in related fields.">
        <meta name="twitter:image" content="{{ asset('images/cjibf.png') }}">
        <meta name="twitter:site" content="@investCJ">
    @stop

    <section class=" md:py-5 py-10 overflow-hidden mx-2 lg:mx-10"
        style="background-image: url('https://preline.co/assets/svg/examples/polygon-bg-element.svg'); background-repeat: no-repeat; background-size: cover;">
        <div>
            <h1 class="text-4xl mx-1 mt-4 font-bold text-gray-800 dark:text-white text-center">One-on-One Meeting
                Registration
            </h1>
            <p class="text-xl mx-1 mt-2 font-normal text-gray-500 dark:text-white text-center">Please fill out the
                form to register for One-on-One Meeting</p>
            <p class="text-xl mx-1 mb-5 mt-1 font-normal text-gray-500 dark:text-white text-center">More Information
                please contact: <span class="font-bold text-gray-700"> Mr. FAJAR (+62 857-2700-8400)</span></p>
        </div>
        <div class="mt-10">
            <div class="grid mx-5 md:grid-cols-12 grid-cols-1 items-center gap-[30px]">
                <div class="lg:col-span-5 md:col-span-6">
                    <div class="">
                        <div class="relative mx-5">
                            <img src="{{ asset('images/register.jpg') }}" alt="">
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7 md:col-span-6">
                    <div class="mb-16">
                        <div class="bg-white dark:bg-slate-900 rounded-md shadow dark:shadow-gray-800 p-6">
                            <form wire:submit="store">
                                {{ $this->form }}
                                <div class="py-2 grid-cols-2 grid gap-4">
                                    <button type="button" onclick="window.history.back()"
                                        class="hover:bg-slate-900 shadow-lg text-center btn-primary mb-2 mt-4 bg-slate-500 px-10 py-2 rounded-md text-white">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- </div> --}}
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div x-data="{ showModal: false }" x-show="showModal" x-cloak @o3m-registered.window="showModal = true"
        class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white rounded-lg p-6 max-w-lg w-full text-center shadow-xl">
            <h2 class="text-2xl font-semibold text-green-600">Registration Successful</h2>
            <p class="mt-4 text-gray-700 mb-3">Your data has been successfully saved.<br>Admin will contact you via
                WhatsApp.</p>
            <a href="{{ route('cjibf') }}"
                class="mt-6 px-6 py-2  bg-green-500 hover:bg-green-600 text-white rounded-md">Beranda</a>
        </div>
    </div>
</div>
