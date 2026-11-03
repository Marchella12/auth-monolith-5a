<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Daftar Penulis') }}</h2>
            <a href="{{ route('authors.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">+ Tambah Penulis</a>
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
                            <th class="py-3 px-6 text-left">Nama</th>
                            <th class="py-3 px-6 text-left">Email</th>
                            <th class="py-3 px-6 text-center">Jumlah Buku</th>
                            <th class="py-3 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm">
                        @forelse ($authors as $index => $author)
                            <tr class="border-b border-gray-200">
                                <td class="py-3 px-6">{{ $authors->firstItem() + $index }}</td>
                                <td class="py-3 px-6">{{ $author->name }}</td>
                                <td class="py-3 px-6">{{ $author->email }}</td>
                                <td class="py-3 px-6 text-center">{{ $author->books_count }}</td>
                                <td class="py-3 px-6 text-center">
                                    <form action="{{ route('authors.destroy', $author) }}" method="POST" onsubmit="return confirm('Hapus penulis ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-semibold">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="py-4 px-6 text-center text-gray-500">Belum ada penulis.</td></tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">{{ $authors->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
