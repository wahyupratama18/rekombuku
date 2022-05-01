<x-app-layout>
    <x-slot name="header">
        <div class="md:flex md:justify-between items-center gap-y-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Form Program Studi') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-normal-form submit="{{ route('books.update', $book) }}">
                <x-slot name="title">
                    {{ __('Edit Byjy') }}
                </x-slot>
                
                <x-slot name="description">
                    {{ __('Ubah data mengenai buku.') }}
                </x-slot>
                
                <x-slot name="form">
                    @method('PUT')
           
                    <!-- Name -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="name" value="{{ __('Nama') }}" />
                        <x-jet-input id="name" type="text" class="mt-1 block w-full" name="name" autocomplete="name" value="{{ old('name', $major->name) }}" />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                </x-slot>
            
                <x-slot name="actions">
                    <x-jet-button type="submit">
                        {{ __('Simpan') }}
                    </x-jet-button>
                    {{-- <x-jet-action-message class="mr-3" on="saved">
                        {{ __('Saved.') }}
                    </x-jet-action-message>
            
                    <x-jet-button wire:loading.attr="disabled" wire:target="photo">
                        {{ __('Save') }}
                    </x-jet-button> --}}
                </x-slot>
            </x-normal-form>
            
        </div>
    </div>
</x-app-layout>
