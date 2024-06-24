<div>
    <x-slot name="title">Beranda</x-slot>

    <x-slot name="pagePretitle">Ringkasan aplikasi anda berada disini.</x-slot>

    <x-slot name="pageTitle">Beranda</x-slot>

    <div class="row">
        <div class="col-12 col-md-4 col-lg-3">
            <div class="card mt-2 flex">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>Menunggu</div>

                        <div class="ms-auto lh-1">
                            <span class="badge bg-blue-lt">Total</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-baseline mt-3">
                        <div class="h1 mb-0 me-2" style="font-size: 30px;">{{ $this->jmlMenunggu }}</div>
                    </div>
                </div>
            </div>

            <div class="card mt-2 flex">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>Revisi</div>

                        <div class="ms-auto lh-1">
                            <span class="badge bg-blue-lt">Total</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-baseline mt-3">
                        <div class="h1 mb-0 me-2" style="font-size: 30px;">{{ $this->jmlRevisi }}</div>
                    </div>
                </div>
            </div>

            <div class="card mt-2 flex">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>Disetujui</div>

                        <div class="ms-auto lh-1">
                            <span class="badge bg-blue-lt">Total</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-baseline mt-3">
                        <div class="h1 mb-0 me-2" style="font-size: 30px;">{{ $this->jmlDisetujui }}</div>
                    </div>
                </div>
            </div>

            <div class="card mt-2 flex">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>Perbaikan</div>

                        <div class="ms-auto lh-1">
                            <span class="badge bg-blue-lt">Total</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-baseline mt-3">
                        <div class="h1 mb-0 me-2" style="font-size: 30px;">{{ $this->jmlPerbaikan }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- @dd($this->menunggu) --}}

        <div class="col-12 col-md-8 col-lg-9 d-flex">
            <div class="card h-100 mt-2 w-100" wire:ignore>
                <div class="card-body">
                    <h3 class="card-title">Data Berkas 10 Hari Terakhir</h3>

                    <div data-revisi="{{ json_encode($this->revisi['data']) }}"
                        data-disetujui="{{ json_encode($this->disetujui['data']) }}"
                        data-menunggu="{{ json_encode($this->menunggu['data']) }}"
                        data-perbaikan="{{ json_encode($this->perbaikan['data']) }}"
                        date="{{ json_encode($this->menunggu['date']) }}"
                        id="chart-mentions"
                        class="chart-lg">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        const item = document.getElementById('chart-mentions');
        console.log(item.getAttribute('data-menunggu'));
        window.ApexCharts && (new ApexCharts(item, {
            chart: {
                type: "bar",
                fontFamily: 'inherit',
                height: 340,
                parentHeightOffset: 0,
                toolbar: {
                    show: false,
                },
                animations: {
                    enabled: true
                },
                stacked: true,
            },
            plotOptions: {
                bar: {
                    columnWidth: '50%',
                }
            },
            dataLabels: {
                enabled: false,
            },
            fill: {
                opacity: 1,
            },
            series: [
                {
                    name: "Menunggu",
                    data: JSON.parse(item.getAttribute('data-menunggu'))
                },
                {
                    name: "Revisi",
                    data: JSON.parse(item.getAttribute('data-revisi'))
                },
                {
                    name: "Disetujui",
                    data: JSON.parse(item.getAttribute('data-disetujui'))
                },
                {
                    name: "Perbaikan",
                    data: JSON.parse(item.getAttribute('data-perbaikan'))
                }
            ],
            grid: {
                padding: {
                    top: -20,
                    right: 0,
                    left: -4,
                    bottom: -4
                },
                strokeDashArray: 4,
                xaxis: {
                    lines: {
                        show: true
                    }
                },
            },
            xaxis: {
                labels: {
                    padding: 0,
                },
                tooltip: {
                    enabled: false
                },
                axisBorder: {
                    show: false,
                },
                type: 'datetime',
            },
            yaxis: {
                labels: {
                    padding: 4
                },
            },
            labels: JSON.parse(item.getAttribute('date')),
            colors: ["#E87619","#FF2D0B","#4ade80","#4D89D0", ],
            legend: {
                show: false,
            },
        })).render();
    </script>
@endpush
