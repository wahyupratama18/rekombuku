<x-app-layout>
    <x-slot name="header">
        <div class="md:flex md:justify-between items-center gap-y-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Buku') }}
            </h2>

            <a href="{{ route('books.create') }}">
                <x-jet-button>{{ __('Tambah') }}</x-jet-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"> --}}
                <livewire:book-table />
            {{-- </div> --}}
        </div>
    </div>
</x-app-layout>
