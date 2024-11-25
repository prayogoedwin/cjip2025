@extends('livewire.frontend.master-dashboard')
@section('content-pengguna')
    <div>
        <form wire:submit="create">
            {{ $this->form }}

            <button type="submit"
                class="w-full mt-3 py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-green-600 hover:bg-yellow-500 border-green-600 hover:border-yellow-500 text-white rounded-md">
                Submit
            </button>
        </form>
    </div>
@endsection
