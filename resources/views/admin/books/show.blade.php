<x-app-layout>
    <x-slot name="header">
        <div class="md:flex md:justify-between items-center gap-y-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex gap-x-3">
                {{ __('Detail Buku') }}
                <x-action :route="(object) [
                    'edit' => route('books.edit', $book),
                    'destroy' => route('books.destroy', $book)
                ]" />
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 gap-4 grid grid-cols-1 md:grid-cols-4">
            {{-- Images --}}
            <div></div>

            {{-- Content --}}
            <div class="md:col-span-3">
                <div class="grid grid-cols-3">
                    <div class="mb-3">
                        <h2 class="font-bold text-sm">Nama</h2>
                        <p>{{ $book->name }}</p>
                    </div>
    
                    <div class="mb-3">
                        <h2 class="font-bold text-sm">ISBN</h2>
                        <p>{{ $book->isbn }}</p>
                    </div>
    
                    <div class="mb-3">
                        <h2 class="font-bold text-sm">Tahun</h2>
                        <p>{{ $book->year }}</p>
                    </div>
    
                    <div class="mb-3">
                        <h2 class="font-bold text-sm">Penerbit</h2>
                        <p>{{ $book->penerbit }}</p>
                    </div>
    
                    <div class="mb-3">
                        <h2 class="font-bold text-sm">Edisi</h2>
                        <p>{{ $book->edition }}</p>
                    </div>
    
                    <div class="mb-3">
                        <h2 class="font-bold text-sm">Harga</h2>
                        <p>{{ $book->price }}</p>
                    </div>
    
                    {{-- <div class="mb-3">
                        <h2 class="font-bold text-sm">Kuantitas</h2>
                        <p>{{ $book->qty }}</p>
                    </div> --}}
    
                    <div class="mb-3">
                        <h2 class="font-bold text-sm">Genre</h2>
                        <p>{{ $book->implodeGenres() }}</p>
                    </div>
    
                    <div class="mb-3">
                        <h2 class="font-bold text-sm">Penulis</h2>
                        <p>{{ $book->implodeWriters() }}</p>
                    </div>
                </div>
                
                <div>
                    <h2 class="font-bold text-sm">Ketersediaan</h2>
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ketersediaan</th>
                                <th>Kondisi Terakhir</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($book->items as $item)
                                <tr>
                                    <td>{{ $book->id.'.'.$item->id }}</td>
                                    <td>{{ $item->is_available ? 'Ya' : 'Tidak' }}</td>
                                    <td>{!! $item->latestCondition?->stars !!}</td>
                                    <td>
                                        <x-action :route="(object) [
                                            'edit' => route('books.items.edit', [$book, $item]),
                                            'destroy' => route('books.items.destroy', [$book, $item])
                                        ]" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Tidak ada data tersedia</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
