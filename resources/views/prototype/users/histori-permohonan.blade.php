@extends('layouts.user')

@section('title', 'Histori Permohonan')

@push('css')
    <link href="/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-select-bs4/css/select.bootstrap4.min.css" rel="stylesheet" />
@endpush

@section('content')
    <nav class="flex ml-2" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('superadmin.index') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary no-underline hover:no-underline">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Beranda
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="#" class="ms-1 text-sm text-gray-500 md:ms-2 no-underline hover:no-underline">History
                        Permohonan</a>
                </div>
            </li>
        </ol>
    </nav>

    <div class="row mt-4">
        <div class="col-xl-12">
            <div class="panel panel-inverse">
                <div class="panel-heading" style="background-color: #ffffff;">
                    <h4 class="panel-title text-black"><i class="fa fa-user mr-2"></i>History Permohonan</h4>
                </div>
               
                <div class="panel-body">
                    <table id="data-table-select" class="table table-striped table-bordered table-td-valign-middle"
                        width="100%">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th class="text-nowrap" width='15%'>Nama Pemohon</th>
                                <th class="text-nowrap">Nama Kegiatan</th>
                                <th class="text-nowrap" width='15%'>Surat Permohonan</th>
                                <th class="text-nowrap" width='15%'>Rundown Acara</th>
                                <th class="text-nowrap">Status</th>
                                <th class="text-nowrap" width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach ($permohonan as $p)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->nama_kegiatan }}</td>
                                    <td>
                                        <div class="gallery ml-2">
                                            <a href="/file_upload/{{ $p->surat_permohonan }}" data-lightbox="gallery-group-1">
                                                <div class="flex flex-row items-center gap-2">
                                                    <img src="{{ asset('/assets/img/auth/google-docs.png') }}" class="w-[30px]" />
                                                    <p style="font-size: 12px" class="text-blue-500">Lihat File</p>
                                                </div>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="gallery ml-2">
                                            <a href="/file_upload/{{ $p->rundown_acara }}" data-lightbox="gallery-group-1">
                                                <div class="flex flex-row items-center gap-2">
                                                    <img src="{{ asset('/assets/img/auth/google-docs.png') }}" class="w-[30px]" />
                                                    <p style="font-size: 12px" class="text-blue-500">Lihat File</p>
                                                </div>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-x-3 whitespace-nowrap">
                                            <div class="flex w-full h-2 bg-gray-200 rounded-full overflow-hidden"
                                                role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                                aria-valuemax="100">
                                                @if ($p->status_permohonan == 'Menunggu')
                                                <div class="flex flex-col justify-center rounded-full overflow-hidden bg-yellow-500 text-xs text-white text-center whitespace-nowrap transition duration-500"
                                                    style="width: 50%"></div>
                                                @elseif ($p->status_permohonan == 'Diterima')
                                                <div class="flex flex-col justify-center rounded-full overflow-hidden bg-teal-500 text-xs text-white text-center whitespace-nowrap transition duration-500"
                                                    style="width: 100%"></div>
                                                @else 
                                                <div class="flex flex-col justify-center rounded-full overflow-hidden bg-red-500 text-xs text-white text-center whitespace-nowrap transition duration-500"
                                                    style="width: 100%"></div>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="clearfix f-s-10 pt-1">
                                            Status:
                                            <b class="text-inverse" data-id="widget-elm" data-light-class="text-inverse"
                                                data-dark-class="text-white">{{ $p->status_permohonan }}</b>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('user.lihatPermohonan', $p->id_permohonan) }}" class="btn btn-white"><i class="fa fa-eye text-gray"></i></a>
                                            @if ($p->status_permohonan == 'Ditolak')
                                                <a href="{{ route('user.editPermohonan', $p->id_permohonan) }}"
                                                    class="btn btn-white"><i class="fa fa-edit text-blue"></i></a>
                                            @endif

                                            <form action="{{ route('user.hapusPermohonan', $p->id_permohonan) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-white title="Hapus Data"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                                        class="fa fa-trash text-red"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- end panel-body -->
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-10 -->
    </div>
    <!-- end row -->
@endsection

@push('scripts')
    <script src="/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="/assets/plugins/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
    <script src="/assets/js/demo/table-manage-select.demo.js"></script>
    <script src="/assets/js/demo/ui-modal-notification.demo.js"></script>
    <script src="/assets/plugins/sweetalert/dist/sweetalert.min.js"></script>
@endpush
