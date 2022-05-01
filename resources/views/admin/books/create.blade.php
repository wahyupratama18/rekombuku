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
            <x-normal-form submit="{{ route('books.store') }}">
                <x-slot name="title">
                    {{ __('Buku Baru') }}
                </x-slot>
            
                <x-slot name="description">
                    {{ __('Masukkan data mengenai buku baru.') }}
                </x-slot>
            
                <x-slot name="form">
           
                    <!-- Name -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="name" value="{{ __('Nama') }}" />
                        <x-jet-input id="name" type="text" class="mt-1 block w-full" name="name" autocomplete="name" value="{{ old('name') }}" />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>
           
                    <!-- ISBN -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="isbn" value="{{ __('ISBN') }}" />
                        <x-jet-input id="isbn" type="text" class="mt-1 block w-full" name="isbn" autocomplete="isbn" value="{{ old('isbn') }}" />
                        <x-jet-input-error for="isbn" class="mt-2" />
                    </div>
           
                    <!-- Tahun -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="year" value="{{ __('Tahun') }}" />
                        <x-jet-input id="year" type="number" class="mt-1 block w-full" name="year" autocomplete="year" value="{{ old('year') }}" />
                        <x-jet-input-error for="year" class="mt-2" />
                    </div>
           
                    <!-- Penerbit -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="penerbit" value="{{ __('Penerbit') }}" />
                        <x-jet-input id="penerbit" type="text" class="mt-1 block w-full" name="penerbit" autocomplete="penerbit" value="{{ old('penerbit') }}" />
                        <x-jet-input-error for="penerbit" class="mt-2" />
                    </div>
           
                    <!-- Edisi -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="edition" value="{{ __('Edisi') }}" />
                        <x-jet-input id="edition" type="text" class="mt-1 block w-full" name="edition" autocomplete="edition" value="{{ old('edition') }}" />
                        <x-jet-input-error for="edition" class="mt-2" />
                    </div>
           
                    <!-- Harga -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="price" value="{{ __('Harga') }}" />
                        <x-jet-input id="price" type="number" class="mt-1 block w-full" name="price" autocomplete="price" value="{{ old('price') }}" />
                        <x-jet-input-error for="price" class="mt-2" />
                    </div>
           
                    <!-- Buku Baru -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="qty" value="{{ __('Kuantitas') }}" />
                        <x-jet-input id="qty" type="number" class="mt-1 block w-full" name="qty" autocomplete="qty" value="{{ old('qty') }}" />
                        <x-jet-input-error for="qty" class="mt-2" />
                    </div>

                    <!-- Genre -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="genres" value="{{ __('Genre') }}" />
                        <select name="genres[]" id="genres" class="mt-1 block w-full" x-init="new TomSelect('#genres', {create: true})" multiple>
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="genres" class="mt-2" />
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
