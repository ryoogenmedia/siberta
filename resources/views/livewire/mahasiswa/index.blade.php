<div>
    <x-slot name="title">Mahasiswa</x-slot>

    <x-slot name="pageTitle">Mahasiswa</x-slot>

    <x-slot name="pagePretitle">Kelola data mahasiswa.</x-slot>

    <x-slot name="button">
        <x-datatable.button.add name="Tambah Mahasiswa" :route="route('mahasiswa.create')" />
    </x-slot>

    <x-alert />

    <x-modal.delete-confirmation />
</div>
