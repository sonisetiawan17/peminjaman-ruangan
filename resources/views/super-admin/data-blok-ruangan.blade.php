@extends('layouts.super')

@section('title', 'Data Blok Ruangan')

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
                    <a href="#" class="ms-1 text-sm text-gray-500 md:ms-2 no-underline hover:no-underline">Data
                        Blok Ruangan</a>
                </div>
            </li>
        </ol>
    </nav>

    <div class="row mt-4">
        <!-- begin col-112 -->
        <div class="col-xl-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="flex flex-row items-center justify-between">
                    <div class="panel-heading" style="background-color: #ffffff;">
                        <img src="{{ asset('/assets/img/auth/block.png') }}" alt="users" class="h-6 mr-2" />
                        <h4 class="panel-title text-black">Data Blok Ruangan</h4>
                    </div>
                    <div class="panel-heading-btn">
                        <a href="#modal-dialog" class="btn btn-sm btn-primary" data-toggle="modal"><i
                                class="fa fa-plus"></i> Tambah Data</a>
                    </div>
                </div>

                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <table id="data-table-select" class="table table-striped table-bordered table-td-valign-middle"
                        width="100%">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th class="text-nowrap">Fasilitas</th>
                                <th class="text-nowrap">Tanggal Mulai</th>
                                <th class="text-nowrap">Tanggal Selesai</th>
                                <th class="text-nowrap">Keterangan</th>
                                <th class="text-nowrap" width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach ($ruangan as $i)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $i->fasilitas->nama_fasilitas }}</td>
                                    <td>{{ \Carbon\Carbon::parse($i->tgl_mulai)->format('d F Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($i->tgl_selesai)->format('d F Y') }}</td>
                                    <td>{{ $i->keterangan }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a id="modal_show" href="#" type="button" data-toggle="modal"
                                                data-target="#isimodal" data-fasilitas_id="{{ $i->fasilitas_id }}"
                                                data-tgl_mulai="{{ $i->tgl_mulai }}"
                                                data-tgl_selesai="{{ $i->tgl_selesai }}"
                                                data-keterangan="{{ $i->keterangan }}" class="btn btn-white"><i
                                                    class="fa fa-edit text-blue"></i></a>

                                            <form
                                                action="{{ route('superadmin.hapus_blok_ruangan', $i->id_blok_ruangan) }}"
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
    <!-- #modal-dialog -->
    <div class="modal fade" id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Blok Ruangan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('superadmin.simpan_blok_ruangan') }}">
                        @csrf
                        <div class="form-group row m-b-15">
                            <label class="col-md-5 col-form-label mt-3">Fasilitas</label>
                            <div class="col-md-7 mt-3">
                                <select class="form-input w-full text-small" id="fasilitas_id" name="fasilitas_id">
                                    <option value="">--- Pilih Fasilitas ---</option>
                                    @foreach ($fasilitas as $data)
                                        <option value="{{ $data->id_fasilitas }}">{{ $data->nama_fasilitas }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label class="col-md-5 col-form-label mt-3">Tanggal Mulai</label>
                            <div class="col-md-7 mt-3">
                                <input required name="tgl_mulai" type="date"
                                    class="form-control form-input text-small" />
                            </div>

                            <label class="col-md-5 col-form-label mt-3">Tanggal Selesai</label>
                            <div class="col-md-7 mt-3">
                                <input required name="tgl_selesai" type="date"
                                    class="form-control form-input text-small" />
                            </div>

                            <label class="col-md-5 col-form-label mt-3">Keterangan</label>
                            <div class="col-md-7 mt-3">
                                <input required name="keterangan" type="text"
                                    class="form-control form-input text-small" placeholder="Maintenance" />
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="button-ghost" data-dismiss="modal">Tutup</a>
                    <button type="submit" class="button-primary">Tambah</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal -->


    <!-- #modal-dialog edit -->
    <div class="modal fade" id="isimodal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Data Blok Ruangan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" id="tampil_modal">
                    <form method="post" action="{{ route('superadmin.ubah_blok_ruangan') }}">
                        @csrf
                        <div class="form-group row m-b-15">
                            <input type="hidden" id="id_blok_ruangan" name="id_blok_ruangan">
                            <label class="col-md-5 col-form-label mt-3">Fasilitas</label>
                            <div class="col-md-7 mt-3">
                                <select class="form-input w-full text-small" id="fasilitas_id" name="fasilitas_id">
                                    <option value="">--- Pilih Fasilitas ---</option>
                                    @foreach ($fasilitas as $data)
                                        <option value="{{ $data->id_fasilitas }}">{{ $data->nama_fasilitas }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label class="col-md-5 col-form-label mt-3">Tanggal Mulai</label>
                            <div class="col-md-7 mt-3">
                                <input required id="tgl_mulai" name="tgl_mulai" type="date"
                                    class="form-control form-input text-small" />
                            </div>

                            <label class="col-md-5 col-form-label mt-3">Tanggal Selesai</label>
                            <div class="col-md-7 mt-3">
                                <input required id="tgl_selesai" name="tgl_selesai" type="date"
                                    class="form-control form-input text-small" />
                            </div>

                            <label class="col-md-5 col-form-label mt-3">Keterangan</label>
                            <div class="col-md-7 mt-3">
                                <input required id="keterangan" name="keterangan" type="text"
                                    class="form-control form-input text-small" />
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="button-ghost" data-dismiss="modal">Tutup</a>
                    <button type="submit" class="button-primary">Ubah Data</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal -->

@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).on("click", "#modal_show", function() {
            var id_blok_ruangan = $(this).data('id_blok_ruangan');
            var tgl_mulai = $(this).data('tgl_mulai');
            var tgl_selesai = $(this).data('tgl_selesai');
            var fasilitas_id = $(this).data('fasilitas_id');
            var keterangan = $(this).data('keterangan');

            $("#tampil_modal #id_blok_ruangan").val(id_blok_ruangan);
            $("#tampil_modal #tgl_mulai").val(tgl_mulai);
            $("#tampil_modal #tgl_selesai").val(tgl_selesai);
            $("#tampil_modal #fasilitas_id").val(fasilitas_id);
            $("#tampil_modal #keterangan").val(keterangan);

        })
    </script>
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
