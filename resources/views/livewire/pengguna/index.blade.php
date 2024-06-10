<div>
    <x-slot name="title">Pengguna</x-slot>

    <x-slot name="pageTitle">Pengguna</x-slot>

    <x-slot name="pagePretitle">Kelola data pengguna aplikasi.</x-slot>

    <x-slot name="button">
        <x-datatable.button.add name="Tambah Pengguna" :route="route('pengguna.create')" />
    </x-slot>

    <x-alert />

    <x-modal.delete-confirmation />
</div>
