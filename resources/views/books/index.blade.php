<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Daftar Buku') }}</h2>
            <a href="{{ route('books.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">+ Tambah Buku</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('partials.alerts')

            <div class="bg-white shadow-sm sm:rounded-lg p-6 text-gray-900 overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 uppercase text-sm">
                            <th class="py-3 px-6 text-left">No</th>
                            <th class="py-3 px-6 text-left">Judul</th>
                            <th class="py-3 px-6 text-left">ISBN</th>
                            <th class="py-3 px-6 text-left">Penulis</th>
                            <th class="py-3 px-6 text-center">Tahun</th>
                            <th class="py-3 px-6 text-center">Stok</th>
                            <th class="py-3 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm">
                        @forelse ($books as $index => $book)
                            <tr class="border-b border-gray-200">
                                <td class="py-3 px-6">{{ $books->firstItem() + $index }}</td>
                                <td class="py-3 px-6">{{ $book->title }}</td>
                                <td class="py-3 px-6">{{ $book->isbn }}</td>
                                <td class="py-3 px-6">{{ $book->author->name }}</td>
                                <td class="py-3 px-6 text-center">{{ $book->published_year }}</td>
                                <td class="py-3 px-6 text-center">{{ $book->stock }}</td>
                                <td class="py-3 px-6 text-center">
                                    <form action="{{ route('books.borrow', $book) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-blue-500 hover:text-blue-700 font-semibold">Pinjam</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="py-4 px-6 text-center text-gray-500">Belum ada buku.</td></tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">{{ $books->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
