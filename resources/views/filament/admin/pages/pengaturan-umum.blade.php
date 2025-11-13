<x-filament-panels::page>
    <form wire:submit.prevent="save">
        {{-- Ini akan otomatis menampilkan form yang kita definisikan di Page --}}
        {{ $this->form }}

        <div class="mt-6">
            <x-filament::button type="submit">
                Simpan Pengaturan
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>