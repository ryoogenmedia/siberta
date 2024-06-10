<div>
    <x-slot name="title">Mahasiswa</x-slot>

    <x-slot name="pageTitle">Mahasiswa</x-slot>

    <x-slot name="pagePretitle">Kelola data mahasiswa.</x-slot>

    <x-slot name="button">
        <x-datatable.button.add name="Tambah Mahasiswa" :route="route('mahasiswa.create')" />
    </x-slot>

    <x-alert />

    <x-modal.delete-confirmation />

    <div class="row mb-3 align-items-center justify-content-between">
        <div class="col-12 col-lg-5 d-flex">
            <div class="w-50">
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
                    @foreach (config('const.program_studi') as $programStudi)
                        <option wire:key="row-{{ $programStudi }}" value="{{ $programStudi }}">{{ ucwords($programStudi) }}
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

                        <th>
                            <x-datatable.column-sort name="Nim" wire:click="sortBy('nim')" :direction="$sorts['nim'] ?? null" />
                        </th>

                        <th>
                            <x-datatable.column-sort name="Program Studi" wire:click="sortBy('program_studi')" :direction="$sorts['program_studi'] ?? null" />
                        </th>

                        <th>
                            <x-datatable.column-sort name="Tahun Masuk" wire:click="sortBy('entry_year')" :direction="$sorts['entry_year'] ?? null" />
                        </th>

                        <th>
                            <x-datatable.column-sort name="Alamat" wire:click="sortBy('address')" :direction="$sorts['address'] ?? null" />
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
                                    <div class="ms-2">{{ $row->name }}</div>
                                    <div class="ms-2">{{ $row->email }}</div>
                                    <div class="ms-2">{{ $row->phone }}</div>
                                </div>
                            </td>

                            <td>{{ $row->nim ?? '-' }}</td>

                            <td>{{ $row->program_studi ?? '-' }}</td>

                            <td>{{ $row->entry_year ?? '-' }}</td>

                            <td>{{ $row->address ?? '-' }}</td>

                            <td>
                                <div class="d-flex">
                                    <div class="ms-auto">
                                        <a class="btn btn-sm" href="{{ route('mahasiswa.edit', $row->id) }}">
                                            Sunting
                                        </a>
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
