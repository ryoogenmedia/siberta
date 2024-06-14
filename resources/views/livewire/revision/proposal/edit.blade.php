<div>
    <x-slot name="title">Revisi Berkas Proposal</x-slot>

    <x-slot name="pagePretitle">Revisi Data Berkas Proposal Mahasiswa</x-slot>

    <x-slot name="pageTitle">Revisi Berkas Proposal</x-slot>

    <x-slot name="button">
        <x-datatable.button.back name="Kembali" :route="route('revision.proposal.index')" />
    </x-slot>

    <x-alert />

    <form class="card" wire:submit.prevent="edit" autocomplete="off">
        <div class="card-header">
            Revisi data berkas proposal mahasiswa
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

                <x-datatable.button.save target="edit" name="Sunting Revisi Berkas" />
            </div>
        </div>
    </form>
</div>
