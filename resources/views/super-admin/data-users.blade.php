@extends('layouts.super')

@section('title', 'Data Users')

@push('css')
    <link href="/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-select-bs4/css/select.bootstrap4.min.css" rel="stylesheet" />
@endpush

@section('content')
    @php
        $totalUser = App\Models\User::whereNotIn('name', ['Admin', 'Super Admin'])->count();
    @endphp

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
                    <a href="#"
                        class="ms-1 text-sm text-gray-500 md:ms-2 no-underline hover:no-underline">Data
                        Users</a>
                </div>
            </li>
        </ol>
    </nav>

    <div class="row mt-4">
        <div class="col-xl-12">
            <div class="panel panel-inverse">
                <div class="panel-heading" style="background-color: #ffffff;">
                    <img src="{{ asset('/assets/img/auth/users.png') }}" alt="users" class="h-6 mr-2" />
                    <h4 class="panel-title text-black">Data Users</h4>
                </div>

                <div class="panel-body">
                    <table id="data-table-select" class="table table-striped table-bordered table-td-valign-middle"
                        width="100%">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th class="text-nowrap">Nama</th>
                                <th class="text-nowrap">Instansi</th>
                                <th class="text-nowrap">Email</th>
                                <th class="text-nowrap">No Telp</th>
                                <th class="text-nowrap">NIK</th>
                                <th class="text-nowrap" width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach ($users as $i)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $i->name }}</td>
                                    <td>{{ $i->instansi_id === 21 ? $i->nama_instansi : $i->instansi->nama_instansi }}</td>
                                    <td>{{ $i->email }}</td>
                                    <td>{{ $i->no_telp }}</td>
                                    <td>{{ $i->nik }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('superadmin.lihat_users', $i->id) }}" type="button" class="btn btn-white"><i
                                                    class="fa fa-eye text-gray"></i></a>

                                            <a id="modal_show" href="#" type="button" data-toggle="modal"
                                                data-target="#isimodal" data-id="{{ $i->id }}" data-name="{{ $i->name }}"
                                                data-email="{{ $i->email }}" data-instansi_id="{{ $i->instansi_id }}"
                                                data-nik="{{ $i->nik }}" data-no_telp="{{ $i->no_telp }}"
                                                data-alamat_instansi="{{ $i->alamat_instansi }}"
                                                data-nama_organisasi="{{ $i->nama_organisasi }}" class="btn btn-white"><i
                                                    class="fa fa-edit text-blue"></i></a>

                                            <form action="{{ route('superadmin.hapus_users', $i->id) }}" method="POST">
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
            </div>
        </div>
    </div>

    <!-- #modal-dialog edit -->
    <div class="modal fade" id="isimodal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Data Users</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body mx-3" id="tampil_modal">
                    <form method="post" action="{{ route('superadmin.ubah_users') }}">
                        @csrf
                        <div class="form-group row m-b-15">
                            <input type="hidden" id="id" name="id">
                            <label class="col-md-4 col-form-label">Nama <sup class="text-red">*</sup></label>
                            <div class="col-md-8">
                                <input required id="name" name="name" type="text"
                                    class="form-control form-input text-small"/>
                            </div>

                            <label class="col-md-4 col-form-label mt-3">Email <sup class="text-red">*</sup></label>
                            <div class="col-md-8 mt-3">
                                <input required id="email" name="email" type="email"
                                    class="form-control form-input text-small" />
                            </div>

                            <label class="col-md-4 col-form-label mt-3">NIK <sup class="text-red">*</sup></label>
                            <div class="col-md-8 mt-3">
                                <input required id="nik" name="nik" type="text"
                                    class="form-control form-input text-small" />
                            </div>

                            <label class="col-md-4 col-form-label mt-3">No Telp <sup class="text-red">*</sup></label>
                            <div class="col-md-8 mt-3">
                                <input required id="no_telp" name="no_telp" type="text"
                                    class="form-control form-input text-small" />
                            </div>

                            <label class="col-md-4 col-form-label mt-3">New Password </label>
                            <div class="col-md-8 mt-3">
                                <input id="password" name="password" type="text"
                                    class="form-control form-input text-small" placeholder="Optional" />
                            </div>
                        </div>
                </div>
                <div class="modal-footer font-semibold text-sm">
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
            var id = $(this).data('id');
            var name = $(this).data('name');
            var email = $(this).data('email');
            var instansi_id = $(this).data('instansi_id');
            var nik = $(this).data('nik');
            var no_telp = $(this).data('no_telp');
            var alamat_instansi = $(this).data('alamat_instansi');
            var nama_organisasi = $(this).data('nama_organisasi');

            $("#tampil_modal #id").val(id);
            $("#tampil_modal #name").val(name);
            $("#tampil_modal #email").val(email);
            $("#tampil_modal #instansi_id").val(instansi_id);
            $("#tampil_modal #nik").val(nik);
            $("#tampil_modal #no_telp").val(no_telp);
            $("#tampil_modal #alamat_instansi").val(alamat_instansi);
            $("#tampil_modal #nama_organisasi").val(nama_organisasi);
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
