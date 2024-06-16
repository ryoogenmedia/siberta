<div>
    <x-slot name="title">Berkas Hasil Mahasiswa</x-slot>

    <x-slot name="pageTitle">Berkas Hasil Mahasiswa</x-slot>

    <x-slot name="pagePretitle">Kelola data berkas hasil mahasiswa.</x-slot>

    <x-alert />

    <x-modal.delete-confirmation />

    <div class="row mb-3 align-items-center justify-content-between">
        <div class="col-12 col-lg-7 d-flex flex-md-nowrap flex-wrap">
            <div class="w-100 d-flex mt-3">
                <div style="width: 450px">
                    <x-datatable.search placeholder="Cari nama berkas mahasiswa..." />
                </div>

                <div class="ms-2">
                    <x-form.select
                        wire:model.lazy='filters.nama_file'
                        name="filters.name_file"
                    >
                        <option selected value="">- Pilih Berkas -</option>

                        @foreach (config('const.name_file.hasil') as $berkas)
                            <option wire:key='row-{{ $berkas }}' value="{{ $berkas }}">{{ ucwords($berkas) }}</option>
                        @endforeach
                    </x-form.select>
                </div>
            </div>

            <div class="w-50 ms-md-2 ms-0 mb-lg-0 mb-3 align-self-center">
                <x-datatable.filter.button target="berkas-mahasiswa" />
            </div>
        </div>

        <div class="col-auto ms-auto d-flex">
            <x-datatable.items-per-page />

            <x-datatable.bulk.dropdown>
                <div class="dropdown-menu dropdown-menu-end">
                    <button data-bs-toggle="modal" data-bs-target="#delete-confirmation" class="dropdown-item"
                        type="button">
                        <i class="las la-trash me-3"></i>

                        <span>Hapus</span>
                    </button>
                </div>
            </x-datatable.bulk.dropdown>
        </div>
    </div>

    <x-datatable.filter.card id="berkas-mahasiswa">
        <div class="row">
            <div class="col-lg-6 col-12">
                <x-form.input
                    wire:model.live="filters.nim"
                    name="filters.nim"
                    label="NIM"
                    placeholder="masukkan nim mahasiswa"
                    type="text"
                />
            </div>

            <div class="col-lg-6 col-12">
                <x-form.select
                    wire:model.lazy="filters.program_studi"
                    name="filters.program_studi"
                    label="Program Studi Mahasiswa"
                >

                    <option selected value=""> - Pilih Program Studi - </option>
                    @foreach (config('const.program_studi') as $key => $programStudi)
                        <option wire:key="row-{{ $programStudi }}" value="{{ $key }}">{{ ucwords($programStudi) }}
                        </option>
                    @endforeach

                </x-form.select>
            </div>

            <div class="col-lg-6 col-12">
                <x-form.select
                    wire:model.lazy="filters.tipe_dokumen"
                    name="filters.tipe_dokumen"
                    label="Tipe Dokumen"
                >

                    <option selected value=""> - Pilih Tipe Dokumen - </option>
                    @foreach ($this->typeDocument as $type)
                        <option wire:key="row-{{ $type->type_document }}" value="{{ $type->type_document }}">{{ strtoupper($type->type_document) }}
                        </option>
                    @endforeach

                </x-form.select>
            </div>

            <div class="col-lg-6 col-12">
                <x-form.select
                    wire:model.lazy="filters.status_file"
                    name="filters.status_file"
                    label="Status Konfirmasi"
                >

                    <option selected value=""> - Pilih Status Konfirmasi - </option>
                    @foreach (config('const.status_file') as $status)
                        <option wire:key="row-{{ $status }}" value="{{ $status }}">{{ ucwords($status) }}
                        </option>
                    @endforeach

                </x-form.select>
            </div>

            <div class="col-lg-6 col-12">
                <x-form.input
                    wire:model.live="filters.tanggal_awal"
                    name="filters.tanggal_awal"
                    label="Tanggal Awal"
                    type="date"
                />
            </div>

            <div class="col-lg-6 col-12">
                <x-form.input
                    wire:model.live="filters.tanggal_akhir"
                    name="filters.tanggal_akhir"
                    label="Tanggal Akhir"
                    type="date"
                />
            </div>
        </div>
    </x-datatable.filter.card>

    <div class="card" wire:loading.class.delay="card-loading" wire:offline.class="card-loading">
        <div class="table-responsive mb-0">
            <table class="table card-table table-bordered datatable">
                <thead>
                    <tr>
                        <th class="w-1">
                            <x-datatable.bulk.check wire:model.lazy="selectPage" />
                        </th>

                        <th>
                            <x-datatable.column-sort name="Mahasiswa" wire:click="sortBy('name_file')" :direction="$sorts['name_file'] ?? null" />
                        </th>

                        <th>
                            <x-datatable.column-sort name="Berkas" wire:click="sortBy('name_file')" :direction="$sorts['name_file'] ?? null" />
                        </th>

                        <th>
                            <x-datatable.column-sort name="Status" wire:click="sortBy('status_file')" :direction="$sorts['status_file'] ?? null" />
                        </th>

                        <th>
                            <x-datatable.column-sort name="Tanggal / Waktu" wire:click="sortBy('date_upload')" :direction="$sorts['date_upload'] ?? null" />
                        </th>

                        <th>
                            <x-datatable.column-sort name="Catatan Mahasiswa" wire:click="sortBy('entry_year')" :direction="$sorts['entry_year'] ?? null" />
                        </th>

                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @if ($selectPage)
                        <tr>
                            <td colspan="10" class="bg-red-lt">
                                @if (!$selectAll)
                                    <div class="text-red">
                                        <span>Anda telah memilih <strong>{{ $this->rows->total() }}</strong> mahasiswa,
                                            apakah
                                            Anda mau memilih semua <strong>{{ $this->rows->total() }}</strong>
                                            mahasiswa?</span>

                                        <button wire:click="selectedAll" class="btn ms-2">Pilih Semua</button>
                                    </div>
                                @else
                                    <span class="text-pink">Anda sekarang memilih semua
                                        <strong>{{ count($this->selected) }}</strong> mahasiswa.
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endif

                    @forelse ($this->rows as $row)
                        <tr wire:key="row-{{ $row->id }}">
                            <td>
                                <x-datatable.bulk.check wire:model.lazy="selected" value="{{ $row->id }}" />
                            </td>

                            <td>
                                <div class="d-flex flex-column">
                                    <div class="ms-2"><b>{{ $row->mahasiswa->name }}</b></div>
                                    <div class="ms-2 pt-2">{{ $row->mahasiswa->nim }}</div>
                                    <div class="ms-2 pt-2">{{ $row->mahasiswa->program_studi }}</div>
                                </div>
                            </td>

                            <td>
                                <div class="d-flex flex-column">
                                    <div class="ms-2"><b>{{ $row->name_file }}</b></div>
                                    <div class="ms-2 pt-2">
                                        <span @class(['badge', 'bg-danger-lt' => $row->type_document == 'PDF', 'bg-primary-lt' => $row->type_document == 'WORD', 'bg-green-lt' => $row->type_document == 'XLSX'])>{{ $row->type_document }}</span>

                                        <span>
                                            @if ($row->type_document == 'PDF')
                                                <a target="_blank" title="{{ ucwords($row->name_file) . ' - ' . ucwords($row->mahasiswa->name) }}" class="ms-2 small" href="{{ asset('storage/' . $row->file) }}">Lihat File <i class="las la-file"></i></a>
                                            @endif
                                        </span>

                                        <p class="pb-0 mb-0 mt-3">
                                            <b>{{ $row->code_document }}</b>
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td><span @class(['badge','bg-green-lt' => $row->status_file == 'approve', 'bg-danger-lt' => $row->status_file == 'revision', 'bg-orange-lt' => $row->status_file == 'pending'])>{{ $row->status_file }}</span></td>

                            <td>
                                <div class="d-flex flex-column">
                                    <div class="ms-2"><b>{{ $row->date_upload->format('d-m-Y') }}</b></div>
                                    <div class="ms-2 pt-2">{{ $row->time_upload->format('H:i:s') }}</div>
                                </div>
                            </td>

                            <td style="width: 250px">{{ $row->note_mahasiswa ?? '-' }}</td>

                            <td style="width: 40px">
                                <div class="d-flex w-100">
                                    <div class="d-flex flex-column">
                                        @unless ($row->status_file == 'approve')
                                            <button style="width: 120px" class="btn bg-success-lt btn-sm mb-2" wire:click="approve({{ $row->id }})" wire:confirm='Apakah anda yakin ingin menyetujui berkas ini?'>
                                                Approve Berkas
                                            </button>
                                        @endunless

                                        @if ($row->status_file == 'approve')
                                            <button style="width: 120px" class="btn bg-primary-lt btn-sm mb-2" wire:click="unApprove({{ $row->id }})" wire:confirm='Apakah anda yakin ingin membatalkan?'>
                                                Batalkan Approve
                                            </button>
                                        @endif

                                        <button style="width: 120px" class="btn bg-orange-lt btn-sm mb-2" wire:click="downloadFile({{ $row->id }})" target="_blank">
                                            Download
                                        </button>

                                        @unless ($row->status_file == 'revision')
                                            <a style="width: 120px" class="btn bg-danger-lt btn-sm" href="{{ route('berkas.proposal.revision', $row->id) }}">Revisi Berkas</a>
                                        @endunless

                                        @if ($row->status_file == 'revision')
                                            <button style="width: 120px" wire:click='unRevision({{ $row->id }})' class="btn bg-primary-lt btn-sm" wire:confirm='Apakah anda yakin ingin membatalkan revisi berkas?'>Batalkan Revisi</button>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <x-datatable.empty colspan="10" />
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $this->rows->links() }}
    </div>
</div>
