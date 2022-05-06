<x-app-layout>
    <x-slot name="header">
        <div class="md:flex md:justify-between items-center gap-y-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kondisi Buku') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-normal-form submit="{{ route('books.items.update', [$book, $item]) }}">
                <x-slot name="title">
                    {{ __('Edit Kondisi Buku') }}
                </x-slot>
                
                <x-slot name="description">
                    {{ __('Ubah data mengenai kondisi buku.') }}
                </x-slot>
                
                <x-slot name="form">
                    @method('PUT')
           
                    <!-- Ketersediaan -->
                    <div class="col-span-6 sm:col-span-4 flex items-center">
                        <x-jet-checkbox name="is_available" id="is_available" :checked="old('is_available', $item->is_available) == 1" />
                        <x-jet-label class="ml-2" for="is_available" value="{{ __('Tersedia?') }}" />
                        <x-jet-input-error for="is_available" class="mt-2" />
                    </div>
                    
                    <!-- Scale Rate -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="rating" value="{{ __('Kondisi (Skala 1-5)') }}" />
                        
                        <div class="flex items-center gap-x-4 mt-3" id="rating">
                            @for ($i=1; $i < 6; $i++)
                                <x-jet-input
                                    type="radio"
                                    name="scale"
                                    :id="'scale'.$i"
                                    :value="$i"
                                    class="hidden"
                                    :checked="old('scale', $item->latestCondition ? $item->latestCondition->scale : 5) === $i"
                                />
                                <x-jet-label :for="'scale'.$i" class="mdi mdi-star mdi-24px cursor-pointer" />
                            @endfor
                        </div>

                        <x-jet-input-error for="scale" class="mt-2" />
                    </div>
                </x-slot>
            
                <x-slot name="actions">
                    <x-jet-button type="submit">
                        {{ __('Simpan') }}
                    </x-jet-button>
                </x-slot>
            </x-normal-form>
            
        </div>
    </div>
</x-app-layout>
