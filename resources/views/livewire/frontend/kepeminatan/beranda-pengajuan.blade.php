<div>
    <div
        class="relative overflow-hidden before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] before:bg-no-repeat before:bg-top before:bg-cover before:w-full before:h-full before:-z-[50] before:transform before:-translate-x-1/2 dark:before:bg-[url('https://preline.co/assets/svg/examples-dark/polygon-bg-element.svg')]">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pt-14 pb-8">
            <!-- Announcement Banner -->
            <div class="items-center p-4">
                <table class="table-auto w-full border-none">
                    <tr>
                        <!-- Kolom Logo dan Title -->
                        <td class="flex flex-col sm:flex-row justify-center items-center gap-4">
                            <!-- Logo -->
                            <img src="{{ asset('images/prov_jateng.png') }}" class="h-20 mb-4 sm:mb-0 sm:h-20"
                                alt="">
                            <!-- Title -->
                            <h1 class="font-black text-md sm:text-xl lg:text-3xl text-center sm:text-left"
                                style="font-size: 60px !important;">LETTER OF INTENT</h1>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <div class="text-center">
                                <h4 class="text-lg sm:text-xl md:text-2xl font-medium">INVESTMENT ACCOUNT PROFILE</h4>
                                <p class="text-base sm:text-lg">Profil Minat Investasi</p>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>


        <div class="max-w-[50rem] mx-auto px-4 sm:px-6 lg:px-8 lg:py-5">
            <form wire:submit="create">
                {{ $this->form }}

                <button type="submit"
                    class="w-full mt-3 py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-green-600 hover:bg-yellow-500 border-green-600 hover:border-yellow-500 text-white rounded-md">
                    Submit
                </button>
                <button onclick="window.history.back()"
                    class="w-full items-center px-6 py-3 text-sm font-medium text-center mt-2 text-white bg-gray-700 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800 transition duration-300">
                    Kembali
                </button>
            </form>
        </div>
    </div>
</div>
