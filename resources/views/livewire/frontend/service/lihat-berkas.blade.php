@section('pretitle', 'Lihat Berkas Mahasiswa')
@section('title', 'Berkas Mahasiswa')


<div>
    <div class="mb-2">
        <x-datatable.button.back name="Kembali Ke Halaman Utama" :route="route('frontend.home')" />
    </div>

    @if ($berkas->status_file == 'approve')
        <div class="row">
            <div class="col">
                <div class="card p-5 my-4 border border-1 border-success">
                    <h1 class="text-center">BERKAS DI SETUJUI</h1>
                    <div class="d-flex justify-content-center">
                        <button wire:click='downloadSurat' class="btn btn-success me-2" style="width: 200px;">Download Surat Ujian</button>
                        <a href="{{ asset('storage/' . $berkas->exam_letter) }}" target="_blank" class="btn" style="width: 200px;">Lihat Surat Ujian</a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($berkas->status_file == 'revision')
        <div class="row">
            <div class="col">
                <div class="card p-5 my-4 border border-1 border-danger bg-pink-lt">
                    <h1 class="text-center my-0 py-0 text-danger">BERKAS DI TOLAK</h1>
                </div>
            </div>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-4 col-12 mb-3">
            <div class="card">

                @if ($berkas->file)
                    <div class="card-header d-flex">
                        <button wire:click='downloadFile' class="btn btn-md btn-green w-100">Download Berkas</button>
                    </div>
                @endif

                <div class="card-body">
                    <div>
                        <div class="row">
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>Status Berkas</strong>
                                </div>
                                <div class="text-muted mt-2">
                                    @switch($berkas->status_file)
                                        @case('approve')
                                            <span class="badge bg-green text-white">Ok <i class="las la-check"></i></span>
                                            @break
                                        @case('pending')
                                            <span class="badge bg-orange text-white">Sendang Proses</span>
                                            @break
                                        @case('revision')
                                            <span class="badge bg-danger text-white">Revisi</span>
                                            @break
                                        @case('revised')
                                            <span class="badge bg-primary text-white">Menunggu Konfirmasi</span>
                                            @break
                                        @default
                                            <span class="badge bg-danger text-white">Belum ada</span>
                                    @endswitch
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="row">
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>Catatan</strong>
                                </div>
                                @if ($berkas->status_file == 'revision' && $berkas->revision)
                                    <div class="text-muted mt-2 p-4 border border-1 border-orange rounded">
                                        {{ $berkas->revision->note_revision }}
                                    </div>
                                @else
                                    <div class="text-center mt-2 border border-1 border-orange rounded">
                                        <h3 class="my-3 p-4">Tidak Ada Catatan</h3>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="divide-y">
                        <div>
                            <div class="row">
                                <div class="col">
                                    <div class="text-truncate mb-3">
                                        <strong>Kategori & Nama Berkas</strong>
                                    </div>
                                    <div class="d-inline"><strong>LEMBAR {{ strtoupper($berkas->category) }}</strong></div>
                                    <div class="text-muted">{{ ucwords($berkas->name_file) }}</div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="row">
                                <div class="col">
                                    <div class="text-truncate">
                                        <strong>Kode Berkas</strong>
                                    </div>
                                    <div class="text-muted">{{ $berkas->code_document }}</div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="row">
                                <div class="col">
                                    <div class="text-truncate">
                                        <strong>Prodi</strong>
                                    </div>
                                    <div class="text-muted">{{ $berkas->mahasiswa->program_studi }} | {{ config('const.program_studi.' . $berkas->mahasiswa->program_studi) }}</div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="row">
                                <div class="col">
                                    <div class="text-truncate">
                                        <strong>Mahasiswa</strong>
                                    </div>
                                    <div class="text-muted">{{ $berkas->mahasiswa->name }}</div>
                                    <div class="text-muted">{{ $berkas->mahasiswa->email }}</div>
                                    <div class="text-muted">{{ $berkas->mahasiswa->phone }}</div>
                                    <div class="text-muted">{{ $berkas->mahasiswa->alamat }}</div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="row">
                                <div class="col">
                                    <div class="text-truncate">
                                        <strong>Tanggal / Waktu Upload</strong>
                                    </div>
                                    <div class="text-muted">{{ $berkas->date_upload->format('d-m-Y') }}</div>
                                    <div class="text-muted">{{ $berkas->time_upload->format('H:i:s') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
