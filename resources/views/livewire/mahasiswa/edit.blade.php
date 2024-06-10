<div>
    <x-slot name="title">Sunting Mahasiswa</x-slot>

    <x-slot name="pagePretitle">Menyunting Data Mahasiswa</x-slot>

    <x-slot name="pageTitle">Sunting Mahasiswa</x-slot>

    <x-slot name="button">
        <x-datatable.button.back name="Kembali" :route="route('mahasiswa.index')" />
    </x-slot>

    <x-alert />

    <form class="card" wire:submit.prevent="edit" autocomplete="off">
        <div class="card-header">
            Sunting data mahasiswa
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
                        autofocus
                        required
                    />
                </div>

                <div class="col-12 col-lg-6">
                    <x-form.input
                        wire:model="nim"
                        name="nim"
                        label="NIM"
                        placeholder="masukkan nim mahasiswa"
                        type="text"
                        required
                    />
                </div>

                <div class="col-12 col-lg-6">
                    <x-form.input
                        wire:model="nomorPonsel"
                        name="nomorPonsel"
                        label="Nomor Ponsel"
                        placeholder="masukkan nomor ponsel"
                        type="number"
                        required
                    />
                </div>

                <div class="col-12 col-lg-6">
                    <x-form.input
                        wire:model="email"
                        name="email"
                        label="Email"
                        placeholder="masukkan email"
                        type="text"
                        required
                    />
                </div>

                <div class="col-12 col-lg-6">
                    <x-form.input
                        wire:model="tahunMasuk"
                        name="tahunMasuk"
                        label="Tahun Masuk"
                        placeholder="masukkan tahun masuk"
                        type="number"
                        required
                    />
                </div>

                <div class="col-12 col-lg-6">
                    <x-form.select
                        wire:model="programStudi"
                        name="programStudi"
                        label="Program Studi"
                        required
                    >
                        <option selected value=""> - Pilih Program Studi - </option>
                        @foreach (config('const.program_studi') as $key => $programStudi)
                            <option wire:key="row-{{ $programStudi }}" value="{{ $key }}">{{ ucwords($programStudi) }}
                            </option>
                        @endforeach
                    </x-form.select>
                </div>

                <div class="col-12">
                    <x-form.textarea
                        wire:model="alamat"
                        name="alamat"
                        label="Alamat"
                        rows="3"
                    />
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="btn-list justify-content-end">
                <button type="reset" class="btn">Reset</button>

                <x-datatable.button.save target="edit" />
            </div>
        </div>
    </form>
</div>
