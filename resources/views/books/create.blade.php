<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Tambah Buku') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 text-gray-900">
                @include('partials.alerts')

                <form action="{{ route('books.store') }}" method="POST">
                    @csrf

                    @foreach ([['title', 'Judul'], ['isbn', 'ISBN'], ['published_year', 'Tahun Terbit'], ['price', 'Harga'], ['stock', 'Stok']] as [$field, $label])
                        <div class="mb-4">
                            <label for="{{ $field }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
                            <input type="text" name="{{ $field }}" id="{{ $field }}" value="{{ old($field) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error($field)
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach

                    <div class="mb-4">
                        <label for="author_id" class="block text-sm font-medium text-gray-700">Penulis</label>
                        <select name="author_id" id="author_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">-- Pilih Penulis --</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}" @selected(old('author_id') == $author->id)>{{ $author->name }}</option>
                            @endforeach
                        </select>
                        @error('author_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
