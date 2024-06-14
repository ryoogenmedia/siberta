<div>
    <x-slot name="title">Revisi Berkas</x-slot>

    <x-slot name="pagePretitle">Revisi Data Berkas Mahasiswa</x-slot>

    <x-slot name="pageTitle">Revisi Berkas</x-slot>

    <x-slot name="button">
        <x-datatable.button.back name="Kembali" :route="route('berkas.hasil.index')" />
    </x-slot>

    <x-alert />

    <form class="card" wire:submit.prevent="save" autocomplete="off">
        <div class="card-header">
            Revisi data berkas mahasiswa
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <x-form.input
                        wire:model="namaPengirim"
                        name="namaPengirim"
                        label="Nama Pengirim Revisi"
                        type="text"
                        autofocus
                        required
                    />
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <x-form.input
                        wire:model="tanggalRevisi"
                        name="tanggalRevisi"
                        label="Tanggal Revisi"
                        type="datetime-local"
                        disabled
                        required
                    />
                </div>

                <div class="col-12 col-lg-6">
                    <x-form.input
                        wire:model="batasTanggalRevisi"
                        name="batasTanggalRevisi"
                        label="Batas Tanggal Revisi (Optional)"
                        type="datetime-local"
                    />
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <x-form.textarea
                        wire:model="catatanRevisi"
                        name="catatanRevisi"
                        label="Catatan Revisi"
                        rows="6"
                        required
                    />
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="btn-list justify-content-end">
                <button type="reset" class="btn">Reset</button>

                <x-datatable.button.save target="save" name="Revisi Berkas" />
            </div>
        </div>
    </form>
</div>
