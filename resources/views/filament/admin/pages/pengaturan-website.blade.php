{{-- Ini adalah tampilan untuk halaman setting kita --}}
<x-filament-panels::page>

    {{-- Form ini akan otomatis nampilin Tabs yang kita buat di file PHP --}}
    <form wire:submit.prevent="save">
        {{ $this->form }}

        {{-- Tombol Simpan --}}
        <div class="mt-6 space-y-2">
            <x-filament::button type="submit" form="save">
                Simpan Perubahan
            </x-filament::button>
        </div>
    </form>

</x-filament-panels::page>