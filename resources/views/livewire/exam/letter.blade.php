<div>
    <x-slot name="title">Upload Surat Ujian</x-slot>

    <x-slot name="pageTitle">Upload Surat Ujian</x-slot>

    <x-slot name="pagePretitle">Upload Surat Ujian.</x-slot>

    <x-alert />

    <x-modal.delete-confirmation />

    <x-modal size="md" :show="$show">
        <form wire:submit='save'>
            <div class="modal-header">
                <h5 class="modal-title">Upload Surat Ujian</h5>
                <button wire:click='closeModal' type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <x-form.select
                    wire:model='kategoriBerkas'
                    name="kategoriBerkas"
                    label="Kategori File"
                >
                    <option value="">- Pilih Kategori Berkas -</option>
                    @foreach (config('const.category_document') as $category)
                        <option wire:key='row-{{ $category }}' value="{{ $category }}">{{ ucwords($category) }}</option>
                    @endforeach
                </x-form.select>

                <x-form.input
                    wire:model='suratUjian'
                    type='file'
                    name="suratUjian"
                    label="Surat Ujian"
                />
            </div>
            <div class="modal-footer">
                <div class="btn-list justify-content-end">
                    <button type="reset" class="btn">Reset</button>

                    <x-datatable.button.save
                        color="success"
                        name="Setujui Berkas"
                        target="save"
                    />
                </div>
            </div>
        </form>
    </x-modal>

    <div class="row mb-3 align-items-center justify-content-between">
        <div class="col-12 col-lg-5 d-flex">
            <div class="w-100">
                <x-datatable.search placeholder="Cari nama mahasiswa..." />
            </div>
            <div class="w-50 ms-2">
                <x-datatable.filter.button target="mahasiswa" />
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

    <x-datatable.filter.card id="mahasiswa">
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
                <x-form.input
                    wire:model.live="filters.nomor_ponsel"
                    name="filters.nomor_ponsel"
                    label="Nomor Ponsel"
                    placeholder="masukkan nomor ponsel mahasiswa"
                    type="number"
                />
            </div>

            <div class="col-lg-6 col-12">
                <x-form.select
                    wire:model.lazy="filters.program_studi"
                    name="filters.program_studi"
                    label="Program Studi"
                >

                    <option selected value=""> - Pilih - </option>
                    @foreach (config('const.program_studi') as $key => $programStudi)
                        <option wire:key="row-{{ $programStudi }}" value="{{ $key }}">{{ ucwords($programStudi) }}
                        </option>
                    @endforeach

                </x-form.select>
            </div>

            <div class="col-lg-6 col-12">
                <x-form.select
                    wire:model.lazy="filters.tahun_masuk"
                    name="filters.tahun_masuk"
                    label="Tahun Masuk"
                >

                    <option selected value=""> - Pilih - </option>
                    @foreach ($this->tahunMasuk as $tahunMasuk)
                        <option wire:key="row-{{ $tahunMasuk->entry_year }}" value="{{ $tahunMasuk->entry_year }}">{{ ucwords($tahunMasuk->entry_year) }}
                        </option>
                    @endforeach

                </x-form.select>
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
                            <x-datatable.column-sort name="Mahasiswa" wire:click="sortBy('name')" :direction="$sorts['name'] ?? null" />
                        </th>

                        <th>Status Proposal</th>

                        <th>Status Hasil</th>

                        <th>Status Tutup</th>

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
                                    <div class="ms-2"><b>{{ $row->name }}</b></div>
                                    <div class="ms-2 pt-2">{{ $row->email }}</div>
                                    <div class="ms-2 pt-2">{{ $row->phone }}</div>
                                </div>
                            </td>

                            <td>
                                <p>
                                    <span class="badge bg-{{ $this->checkExamLetter($row->id, 'proposal') ? 'success' : 'danger' }}-lt">
                                        {{ $this->checkExamLetter($row->id, 'proposal') ? 'telah di berikan' : 'berlum di berikan' }}
                                    </span>
                                </p>

                                @if ($this->checkExamLetter($row->id, 'proposal'))
                                    <a target="_blank" href="{{ asset('storage/' . $this->checkExamLetter($row->id,'proposal')) }}"><small>Lihat File</small> <i class="fas fa-eye"></i></a>
                                @endif
                            </td>

                            <td>
                                <p>
                                    <span class="badge bg-{{ $this->checkExamLetter($row->id, 'hasil') ? 'success' : 'danger' }}-lt">
                                        {{ $this->checkExamLetter($row->id, 'hasil') ? 'telah di berikan' : 'berlum di berikan' }}
                                    </span>
                                </p>

                                @if ($this->checkExamLetter($row->id, 'hasil'))
                                    <a target="_blank" href="{{ asset('storage/' . $this->checkExamLetter($row->id,'hasil')) }}"><small>Lihat File</small> <i class="fas fa-eye"></i></a>
                                @endif
                            </td>

                            <td>
                                <p>
                                    <span class="badge bg-{{ $this->checkExamLetter($row->id, 'tutup') ? 'success' : 'danger' }}-lt">
                                        {{ $this->checkExamLetter($row->id, 'tutup') ? 'telah di berikan' : 'belum di berikan' }}
                                    </span>
                                </p>

                                @if ($this->checkExamLetter($row->id, 'hasil'))
                                    <a target="_blank" href="{{ asset('storage/' . $this->checkExamLetter($row->id,'tutup')) }}"><small>Lihat File</small> <i class="fas fa-eye"></i></a>
                                @endif
                            </td>

                            <td>
                                <div class="d-flex w-100">
                                    <div class="ms-auto">
                                        <button wire:click='openModal({{ $row->id }})' class="btn btn-success">Upload Surat Ujian</button>
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
