@section('pretitle', 'Upload Berkas Mahasiswa')
@section('title', 'Upload Berkas')

<div>
    <x-alert/>

    <div class="row">
        @isset ($this->revision)
            <div class="col-lg-4 col-12 mb-3">
                <div class="card">
                    <div class="card-header d-flex">
                        <button wire:click="resetInfoRevision" class="btn btn-md btn-danger w-100">Tutup Informasi</button>
                    </div>
                    <div class="card-body">
                        <div class="mt-3">
                            <div class="row">
                                <div class="col">
                                    <div class="text-truncate">
                                        <strong>Catatan</strong>
                                    </div>
                                    @if ($this->revision)
                                        <div class="text-muted mt-2 p-4 border border-1 border-danger rounded">
                                            {{ $this->revision->note_revision }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset

        <div class="col-lg-8 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="divide-y">
                        <div>
                            <div class="row">
                                <div class="col">
                                    <div class="text-truncate mb-3">
                                        <strong>Pilih Kategori Berkas</strong>
                                    </div>
                                    <div>
                                        <x-form.select
                                            wire:model.lazy='kategoriBerkas'
                                            name='kategoriBerkas'
                                            placeholder='Kategori Berkas'
                                        >
                                            <option value="">- Pilih Kategori Berkas -</option>

                                            @foreach (config('const.category_document') as $kategori)
                                                <option wire:key='row-{{ $kategori }}' value="{{ $kategori }}">{{ strtoupper($kategori) }}</option>
                                            @endforeach
                                        </x-form.select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($this->kategoriBerkas)
                            @foreach (config('const.name_file.' . $this->kategoriBerkas) as $berkas)
                                <div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="text-truncate">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <strong>{{ $berkas }}</strong>
                                                    </div>

                                                    <div>
                                                        @isset ($this->checkFile($berkas)->status_file)
                                                            @switch($this->checkFile($berkas)->status_file)
                                                                @case('approve')
                                                                    <span class="badge bg-green text-white">Ok <i class="las la-check"></i></span>
                                                                    @break
                                                                @case('pending')
                                                                    <span class="badge bg-orange text-white">Menunggu</span>
                                                                    @break
                                                                @case('revision')
                                                                    <span class="badge bg-danger text-white">Revisi</span>
                                                                    @break
                                                                @case('revised')
                                                                    <span class="badge bg-primary text-white">Konfirmasi perbaikan</span>
                                                                    @break
                                                                @default
                                                                    <span class="badge bg-danger text-white">Belum ada</span>
                                                            @endswitch
                                                        @endisset

                                                        @if (!isset($this->checkFile($berkas)->status_file))
                                                            <span class="badge bg-white text-black border-black">Belum ada</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                @isset($this->checkFile($berkas)->status_file)
                                                    @if($this->checkFile($berkas)->status_file == 'revision')
                                                        <button wire:click='showRevision({{ $this->checkFile($berkas)->id }})' class="btn btn-sm bg-danger-lt">Lihat Revisi</button>
                                                    @endif
                                                    <a target='_blank' href="{{ asset('storage/' . $this->checkFile($berkas)->file) }}" class="btn btn-sm bg-orange-lt">Lihat File</a>
                                                @endisset
                                            </div>
                                            <div class="mt-3">
                                                <button class="btn btn-primary">Upload File</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>