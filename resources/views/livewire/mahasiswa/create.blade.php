<div>
    <x-slot name="title">Tambah Mahasiswa</x-slot>

    <x-slot name="pagePretitle">Menambah Data Mahasiswa</x-slot>

    <x-slot name="pageTitle">Tambah Mahasiswa</x-slot>

    <x-slot name="button">
        <x-datatable.button.back name="Kembali" :route="route('mahasiswa.index')" />
    </x-slot>

    <x-alert />

    <form class="card" wire:submit.prevent="save" autocomplete="off">
        <div class="card-header">
            Tambah data mahasiswa
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <x-form.input
                        wire:model="namaMahasiswa"
                        name="namaMahasiswa"
                        label="Nama Mahasiswa"
                        placeholder="masukkan nama mahasiswa"
                        type="text"
                    />
                </div>

                <div class="col-12 col-lg-6">
                    <x-form.input wire:model="avatar" name="avatar" label="Avatar" placeholder="masukkan avatar"
                        type="file" />
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="btn-list justify-content-end">
                <button type="reset" class="btn">Reset</button>

                <x-datatable.button.save target="save" />
            </div>
        </div>
    </form>
</div>
