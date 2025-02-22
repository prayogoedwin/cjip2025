@extends('livewire.frontend.master-dashboard')
@section('content-pengguna')
    <div>
        <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 gap-4">
            @foreach ($peminatMasuk as $item)
                <div class="blog relative rounded-md shadow-sm dark:shadow-gray-700 overflow-hidden">
                    <img src="{{ $item->product->gambar }}" alt="" class="object-cover"
                        style="height: 230px; width: 100%;">

                    <div class="content p-3">
                        <a href="{{ route('detail.minat-masuk', $item->id) }}"
                            class="title h5 text-xl font-semibold hover:text-green-900 text-green-700 transition duration-500 text-justify">
                            {{ $item->product->name }}</a>
                        <p class="desc text-gray-500">
                            {!! Str::limit(str($item->product->description)->markdown()->sanitizeHtml(), 100) !!}
                        </p>
                        <br>
                        <span class="text-primary-600">
                            Peminat : {{ $item->userPeminat->name }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
