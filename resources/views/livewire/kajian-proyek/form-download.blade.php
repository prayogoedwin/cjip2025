<div>
    <div class="py-5 lg:w-2/5 w-4/5 mx-auto mt-5">
        <h1 class="text-3xl font-bold text-center py-5">Form Unduh File Kajian Proyek</h1>
        <form wire:submit="create">
            {{ $this->form }}
            <button type="submit"
                class="w-full mt-3 py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-green-600 hover:bg-yellow-500 border-green-600 hover:border-yellow-500 text-white rounded-md">
                Submit
            </button>
        </form>
        <button onclick="window.history.back()"
            class="w-full items-center px-5 py-2 mb-2 font-semibold text-center mt-3 text-white bg-gray-700 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800 transition duration-300">
            Kembali
        </button>
    </div>
</div>
