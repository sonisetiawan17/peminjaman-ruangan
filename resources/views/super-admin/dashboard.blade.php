@extends('layouts.super')

@section('title', 'Dashboard')

@push('css')
    <link href="/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />
    <link href="/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <link href="/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
@endpush

@section('content')
    @php 
        $dataFasilitas = $fasilitas;
        $statistikPermohonan = $statsPermohonan;
        $statistikInstansi = $statsInstansi;
    @endphp 

    <div>
        <div class="md:flex items-end justify-between">
            <h1 class="font-semibold text-xl">Statistik Terbaru</h1>
            <div class="mt-[12px] md:mt-0">
                <a href="#modal-dialog" data-toggle="modal">
                    <button class="px-4 py-2 shadow-sm border border-neutral-400 focus:border-none">
                        <i class="fa fa-filter mr-1"></i>Filter
                    </button>
                </a>
                {{-- <select class="form-input text-sm ml-2" name="skpd">
                    <option disabled selected>Semua Waktu</option>
                    <option value="skpd">Hari Ini</option>
                    <option value="non_skpd">7 Hari Terakhir</option>
                    <option value="non_skpd">1 Bulan Terakhir</option>
                    <option value="non_skpd">3 Bulan Terakhir</option>
                    <option value="non_skpd">6 Bulan Terakhir</option>
                    <option value="non_skpd">1 Tahun Terakhir</option>
                </select> --}}
            </div>
        </div>

        <div class="modal fade" id="modal-dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Filter Berdasarkan Range Waktu</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form method="GET" action="{{ route('superadmin.dashboard.filter') }}">
                            @csrf
                            <div class="form-group row m-b-15">
                                <label class="col-md-5 col-form-label">Dari Tanggal</label>
                                <div class="col-md-7">
                                    <input required name="start_date" type="date"
                                        class="form-control form-input text-small" />
                                </div>
                                <label class="col-md-5 col-form-label mt-3">Sampai Tanggal</label>
                                <div class="col-md-7 mt-3">
                                    <input required name="end_date" type="date"
                                        class="form-control form-input text-small" />
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="button-ghost" data-dismiss="modal">Tutup</a>
                        <button type="submit" class="button-primary">Cek Data</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="flex flex-col md:flex-none gap-y-3 md:grid md:grid-cols-4 gap-x-7 mt-3">
            <div class="blue-gradient px-[20px] py-[20px] rounded-xl">
                <p class="text-white">Data permohonan bulan ini</p>
                <div class="flex flex-row items-end gap-x-5 pt-3">
                    <div class="px-[19px] py-[12px] rounded-full bg-white">
                        <i class="fa fa-clipboard-check text-xl text-blue-500"></i>
                    </div>
                    <div class="flex flex-col items-center text-white">
                        <p class="font-semibold" style="font-size: 18px">{{ $stats }}</p>
                        <p style="font-size: 13px">{{ $current_month }}</p>
                    </div>
                </div>
            </div>

            <div class="yellow-gradient px-[20px] py-[20px] rounded-xl">
                <p class="text-white">Data permohonan</p>
                <div class="flex flex-row items-end gap-x-5 pt-3">
                    <div class="px-[16px] py-[12px] rounded-full bg-white">
                        <i class="fa fa-spinner text-xl text-yellow-500"></i>
                    </div>
                    <div class="flex flex-col items-center text-white">
                        <p class="font-semibold" style="font-size: 18px">{{ $status_menunggu }}</p>
                        <p style="font-size: 13px">Dalam Proses</p>
                    </div>
                </div>
            </div>

            <div class="red-gradient px-[20px] py-[20px] rounded-xl">
                <p class="text-white">Data permohonan</p>
                <div class="flex flex-row items-end gap-x-5 pt-3">
                    <div class="px-[16px] py-[12px] rounded-full bg-white">
                        <i class="fa fa-ban text-xl text-red-500"></i>
                    </div>
                    <div class="flex flex-col items-center text-white">
                        <p class="font-semibold" style="font-size: 18px">{{ $status_ditolak }}</p>
                        <p style="font-size: 13px">Ditolak</p>
                    </div>
                </div>
            </div>

            <div class="green-gradient px-[20px] py-[20px] rounded-xl">
                <p class="text-white">Data permohonan</p>
                <div class="flex flex-row items-end gap-x-5 pt-3">
                    <div class="px-[16px] py-[12px] rounded-full bg-white">
                        <i class="fa fa-check text-xl text-green-500"></i>
                    </div>
                    <div class="flex flex-col items-center text-white">
                        <p class="font-semibold" style="font-size: 18px">{{ $status_diterima }}</p>
                        <p style="font-size: 13px">Disetujui</p>
                    </div>
                </div>
            </div>

        </div>
    </div> 

    <div class="mt-5">
        <div class="mt-3 grid grid-cols-3 gap-5">
            <div class="col-span-2 bg-white border border-neutral-500 rounded-lg p-7">
                <h1 class="font-semibold text-xl mb-5">Chart Statistik Permohonan</h1>
                <canvas id="barChart" height="150px"></canvas>
            </div>
            <div class="col-span-1 bg-white border border-neutral-500 rounded-lg p-7">
                <h1 class="font-semibold text-xl mb-5">Instansi Terbanyak</h1>
                <canvas id="dougnutChart" height="150px"></canvas>
            </div>
        </div>
    </div>

    {{-- <div class="mt-5">
        <div class="mt-3">
            <div class="bg-white border border-neutral-500 rounded-lg p-7">
                <h1 class="font-semibold text-xl mb-5">Chart Statistik Permohonan</h1>
                <canvas id="lineChart" height="100px"></canvas>
            </div>
        </div>
    </div> --}}
    </div>
@endsection



@push('scripts')
    <script src="/assets/plugins/d3/d3.min.js"></script>
    <script src="/assets/plugins/nvd3/build/nv.d3.js"></script>
    <script src="/assets/plugins/jvectormap-next/jquery-jvectormap.min.js"></script>
    <script src="/assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js"></script>
    <script src="/assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
    <script src="/assets/plugins/gritter/js/jquery.gritter.js"></script>
    <script src="/assets/js/demo/dashboard-v2.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const fasilitas = @json($dataFasilitas);
        const statistikPermohonan = @json($statistikPermohonan);
        const statistikInstansi = @json($statistikInstansi);
        const barctx = document.getElementById('barChart');

        const jumlahPermohonan = Array(fasilitas.length).fill(0);

        statistikPermohonan.forEach(item => {
            const index = fasilitas.indexOf(item.nama_fasilitas);
            if (index !== -1) {
                jumlahPermohonan[index] = item.jumlah_permohonan;
            }
        });

        new Chart(barctx, {
            type: 'bar',
            data: {
                labels: fasilitas,
                datasets: [{
                    label: 'Permohonan',
                    data: jumlahPermohonan,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 1,
                    borderRadius: 5,
                }],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        });

        const dougnutctx = document.getElementById('dougnutChart');
        const labelInstansi = statistikInstansi.map(item => item.bidang_kegiatan);
        const jumlahPermohonanInstansi = statistikInstansi.map(item => item.jumlah_permohonan);

        new Chart(dougnutctx, {
            type: 'doughnut',
            data: {
                labels: labelInstansi,
                datasets: [{
                    label: 'Jumlah Permohonan',
                    data: jumlahPermohonanInstansi,
                    backgroundColor: [
                    'rgb(0, 168, 232)',
                    'rgb(239, 35, 60)',
                    'rgb(128, 237, 153)'
                    ],
                    hoverOffset: 4,
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                        }
                    }
                }
            },
        });

        // const linectx = document.getElementById('lineChart');

        // new Chart(linectx, {
        //     type: 'line',
        //     data: {
        //         labels: [
        //             'Jan',
        //             'Feb',
        //             'Mar',
        //             'Apr',
        //             'Mei',
        //             'Jun',
        //             'Jul',
        //             'Agu',
        //             'Sep',
        //             'Okt',
        //             'Nov',
        //             'Des',
        //         ],
        //         datasets: [{
        //             label: 'Statistik Permohonan 1 Tahun',
        //             data: [65, 59, 80, 81, 56, 55, 40, 30, 90, 75, 60, 85],
        //             fill: false,
        //             borderColor: 'rgba(238, 96, 85, 1)',
        //             tension: 0.1
        //         }]
        //     },
        // });
    </script>
@endpush
