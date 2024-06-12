<div>
    <x-slot name="title">Detail Mahasiswa</x-slot>

    <x-slot name="pagePretitle">Detail Data Mahasiswa</x-slot>

    <x-slot name="pageTitle">Detail Mahasiswa</x-slot>

    <x-slot name="button">
        <x-datatable.button.back name="Kembali" :route="route('mahasiswa.index')" />
    </x-slot>

    <x-alert />

    <div class="page-body">
        <div class="container-xl">
            <div class="row justify-content-center">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="divide-y">
                                <div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="text-truncate">
                                                <strong>Nama Mahasiswa</strong>
                                            </div>
                                            <div class="text-muted">{{ $mahasiswa->name }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="text-truncate">
                                                <strong>NIM</strong>
                                            </div>
                                            <div class="text-muted">{{ $mahasiswa->nim }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="text-truncate">
                                                <strong>Program Studi</strong>
                                            </div>
                                            <div class="text-muted">{{ $mahasiswa->program_studi }} | {{ config('const.program_studi.' . $mahasiswa->program_studi) }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="text-truncate">
                                                <strong>Email</strong>
                                            </div>
                                            <div class="text-muted">{{ $mahasiswa->email }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="text-truncate">
                                                <strong>Nomor Ponsel</strong>
                                            </div>
                                            <div class="text-muted">{{ $mahasiswa->phone }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="text-truncate">
                                                <strong>Tahun Ajaran / Tahun Masuk</strong>
                                            </div>
                                            <div class="text-muted">{{ $mahasiswa->entry_year }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="text-truncate">
                                                <strong>Alamat</strong>
                                            </div>
                                            <div class="text-muted">{{ $mahasiswa->address }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-end">
                            <button wire:click='downloadAllFile' class="btn btn-md btn-green">Download Semua File <i class="ms-2 las la-download font-weight-bold"></i></button>
                        </div>
                        <div class="card-body">
                            <div class="divide-y">
                                @foreach (config('const.name_file') as $berkas)
                                    <div class="d-flex justify-content-between">
                                        <div class="row">
                                            <div class="col-auto">
                                                <span class="avatar">{{ $this->checkFile($berkas)->type_document ?? ''}}</span>
                                            </div>
                                            <div class="col">
                                                <div class="text-truncate">
                                                    <strong>{{ $berkas }}</strong>
                                                </div>
                                                <div class="d-flex">
                                                    @isset($this->checkFile($berkas)->id)
                                                        <a class="btn btn-sm bg-orange-lt mt-1" href="{{ route('berkas.revision', $this->checkFile($berkas)->id) }}">Revisi Berkas</a>
                                                        <a class="btn btn-sm bg-primary-lt mt-1 ms-1" target="_blank" href="{{ asset('storage/' . $this->checkFile($berkas)->file) }}">Lihat Berkas</a>
                                                    @endisset
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            @isset($this->checkFile($berkas)->status_file)
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
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
