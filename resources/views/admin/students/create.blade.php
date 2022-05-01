<x-app-layout>
    <x-slot name="header">
        <div class="md:flex md:justify-between items-center gap-y-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Form Mahasiswa Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-normal-form submit="{{ route('students.store') }}">
                <x-slot name="title">
                    {{ __('Mahasiswa Baru') }}
                </x-slot>
            
                <x-slot name="description">
                    {{ __('Masukkan data mengenai mahasiswa baru.') }}
                </x-slot>
            
                <x-slot name="form">
           
                    <!-- Name -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="name" value="{{ __('Nama') }}" />
                        <x-jet-input id="name" type="text" class="mt-1 block w-full" name="name" autocomplete="name" value="{{ old('name') }}" />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>
           
                    <!-- Email -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" type="text" class="mt-1 block w-full" name="email" autocomplete="email" value="{{ old('email') }}" />
                        <x-jet-input-error for="email" class="mt-2" />
                    </div>
           
                    <!-- Pass -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="password" value="{{ __('Kata sandi') }}" />
                        <x-jet-input id="password" type="password" class="mt-1 block w-full" name="password" autocomplete="password" />
                        <x-jet-input-error for="password" class="mt-2" />
                    </div>

                    <!-- Prodi -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="major" value="{{ __('Program Studi') }}" />
                        <select name="major" id="major" class="mt-1 block w-full" x-init="new TomSelect('#major')">
                            @foreach ($majors as $major)
                                <option value="{{ $major->id }}" @selected(old('major') == $major->id)>{{ $major->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="major" class="mt-2" />
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
