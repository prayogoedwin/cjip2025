@extends('livewire.frontend.master-dashboard')
@section('content-pengguna')
    <div>
        <form wire:submit="store">
            {{ $this->form }}
            <div class="py-2 grid-cols-2 grid gap-3">
                <button type="button" onclick="window.history.back()"
                    class="hover:bg-gray-900 shadow-lg w-full text-center btn-primary mb-2 mt-4 bg-gray-500 px-10 py-3 rounded-md text-white">
                    Batal
                </button>
                <button type="submit"
                    class="hover:bg-green-800 shadow-lg w-full text-center btn-primary mb-2 mt-4 bg-green-500 px-10 py-3 rounded-md text-white">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
