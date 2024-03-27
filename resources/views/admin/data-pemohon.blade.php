@extends('layouts.default')

@section('title', 'Data Permohonan')

@push('css')
    <link href="/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-select-bs4/css/select.bootstrap4.min.css" rel="stylesheet" />
@endpush

@section('content')
    <nav class="flex ml-2" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.index') }}"
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
                        Permohonan</a>
                </div>
            </li>
        </ol>
    </nav>
    <!-- end page-header -->
    <!-- begin row -->
    <div class="row mt-4">
        <!-- begin col-112 -->
        <div class="col-xl-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading" style="background-color: #ffffff;">
                    <img src="{{ asset('/assets/img/auth/history.png') }}" alt="users" class="h-6 mr-2" />
                    <h4 class="panel-title text-black">Data Permohonan</h4>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    @if (session('sukses'))
                        <div class="alert alert-success fade show">
                            <span class="close" data-dismiss="alert">×</span>

                            {{ session('sukses') }}
                        </div>
                    @endif
                    <table id="data-table-select" class="table table-striped table-bordered table-td-valign-middle"
                        width="100%">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th class="text-nowrap">Nama Pemohon</th>
                                <th class="text-nowrap">Kegiatan</th>
                                <th class="text-nowrap">Surat Permohonan</th>
                                <th class="text-nowrap">Rundown Acara</th>
                                <th class="text-nowrap">Status</th>
                                <th class="text-nowrap">ACC</th>
                                <th class="text-nowrap">Aksi</th>
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
                                            <a href="/file_upload/{{ $p->surat_permohonan }}"
                                                data-lightbox="gallery-group-1">
                                                <div class="flex flex-row items-center gap-2">
                                                    <img src="{{ asset('/assets/img/auth/google-docs.png') }}"
                                                        class="w-[30px]" />
                                                    <p style="font-size: 12px" class="text-blue-500">Lihat File</p>
                                                </div>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="gallery ml-2">
                                            <a href="/file_upload/{{ $p->rundown_acara }}" data-lightbox="gallery-group-1">
                                                <div class="flex flex-row items-center gap-2">
                                                    <img src="{{ asset('/assets/img/auth/google-docs.png') }}"
                                                        class="w-[30px]" />
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
                                                    <div class="flex flex-col justify-center rounded-full overflow-hidden bg-green-500 text-xs text-white text-center whitespace-nowrap transition duration-500"
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
                                        <div class="flex flex-row items-center gap-1">
                                            @if ($p->status_permohonan == 'Menunggu')
                                                <a id="modal_show" href="#" data-toggle="modal"
                                                    data-target="#modal-acc" data-id_permohonan="{{ $p->id_permohonan }}"
                                                    type="button"
                                                    class="bg-green-500 hover:bg-green-500/70 transition px-[10px] py-[3px] rounded-sm"
                                                    placholder="Terima Permohonan"><i style="font-size:75%"
                                                        class="fa fa-check text-white"></i></a>
                                                <a id="modal_show" href="#" data-toggle="modal"
                                                    data-target="#modal-tolak"
                                                    data-id_permohonan="{{ $p->id_permohonan }}" type="button"
                                                    class="bg-red-500 hover:bg-red-500/70 transition px-[11px] py-[3px] rounded-sm"
                                                    placholder="Tolak Permohonan"><i style="font-size:75%"
                                                        class="fa fa-times text-white"></i></a>
                                            @else
                                                <span>-</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group">

                                            <!-- <a id="modal_show" href="#" type="button" data-toggle="modal" data-target="#isimodal"
                                                    data-id_permohonan="{{ $p->id_permohonan }}"
                                                    data-nik="{{ $p->nik }}"
                                                    data-no_telp="{{ $p->no_telp }}"
                                                    data-bidang_instansi="{{ $p->bidang_instansi }}"
                                                    data-alamat="{{ $p->alamat }}"
                                                    data-name="{{ $p->name }}"
                                                    data-email="{{ $p->email }}"
                                                    data-nama_instansi="{{ $p->nama_instansi }}"
                                                    data-nama_kegiatan="{{ $p->nama_kegiatan }}"
                                                    data-jumlah_peserta="{{ $p->jumlah_peserta }}"
                                                    data-narasumber="{{ $p->narasumber }}"
                                                    data-ringkasan="{{ $p->ringkasan }}"
                                                    data-surat_permohonan="{{ $p->surat_permohonan }}"
                                                    data-rundown_acara="{{ $p->rundown_acara }}"
                                                    data-output="{{ $p->output }}"
                                                    data-outcome="{{ $p->outcome }}"
                                                    data-outcome="{{ $p->outcome }}"
                                                    data-created_at="{{ $p->created_at }}"
                                                    data-status_permohonan="{{ $p->status_permohonan }}"
                                                    data-catatan="{{ $p->catatan }}"
                                                    data-tgl_mulai="{{ $p->tgl_mulai }}"
                                                    data-jam_mulai="{{ $p->jam_mulai }}"
                                                    data-tgl_selesai="{{ $p->tgl_selesai }}"
                                                    data-jam_selesai="{{ $p->jam_selesai }}"
                                                    data-nama_fasilitas="{{ $p->nama_fasilitas }}"
                                                    class="btn btn-white btn-outline">
                                                    <i class="fa fa-search-plus text-black"></i></a> -->
                                            <a href="{{ route('admin.show', $p->id_permohonan) }}" type="button"
                                                class="btn btn-white"><i class="fa fa-eye text-gray"></i></a>

                                            <form action="{{ route('admin.hapus_permohonan', $p->id_permohonan) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-white btn-outline title="Hapus Data"
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

    </div>
    </div>
    <!-- end row -->

    <!-- #modal-dialog acc -->
    <div class="modal fade" id="modal-acc">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg p-3 mb-5 bg-white rounded">
                <div class="modal-header">
                    <h4 class="modal-title">Catatan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                            class="fa fa-times"></i></button>
                </div>
                <form method="post" action="{{ route('admin.terima_permohonan') }}">
                    @csrf
                    <div class="modal-body" id="tampilAcc">
                        <input type="hidden" id="id_permohonan" name="id_permohonan">
                        <input type="hidden" name="status_permohonan" value="diterima">
                        <textarea
                            class="border-gray-200 border-2 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md w-full"
                            name="catatan" placeholder="Tuliskan keterangan" autofocus style="font-size: 13px"></textarea>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="button-ghost" data-dismiss="modal">Batal</a>
                        <button type="submit" class="button-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal  -->

    <!-- #modal-dialog tolak -->
    <div class="modal fade" id="modal-tolak">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg p-3 mb-5 bg-white rounded">
                <div class="modal-header">
                    <h4 class="modal-title">Catatan Tolak</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                            class="fa fa-times"></i></button>
                </div>
                <form method="post" action="{{ route('admin.tolak_permohonan') }}">
                    @csrf
                    <div class="modal-body" id="tampilAcc">
                        <input type="hidden" id="id_permohonan" name="id_permohonan">
                        <input type="hidden" name="status_permohonan" value="ditolak">
                        <textarea
                            class="border-gray-200 border-2 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md w-full"
                            name="catatan" placeholder="Tuliskan Keterangan" autofocus style="font-size: 13px"></textarea>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="button-ghost" data-dismiss="modal">Batal</a>
                        <button type="submit" class="button-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- end modal  -->


    <!-- modal lihat pemohon -->
    <div class="modal fade" id="isimodal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Data Pemohon</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body bg-light" id="tampil_modal">
                    <!-- begin panel-body -->
                    <div class="panel-body">

                        <!-- begin nav-tabs -->
                        <div class="tab-overflow overflow-right">
                            <ul class="nav nav-tabs nav-tabs-inverse bg-light">
                                <li class="nav-item">
                                    <a href="#default-tab-1" data-toggle="tab" class="nav-link active">
                                        <span class="d-sm-none">Identitas</span>
                                        <span class="d-sm-block d-none">Identitas Pemohon</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#default-tab-2" data-toggle="tab" class="nav-link">
                                        <span class="d-sm-none">Kegiatan</span>
                                        <span class="d-sm-block d-none">Kegiatan</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#default-tab-3" data-toggle="tab" class="nav-link">
                                        <span class="d-sm-none">Peminjaman</span>
                                        <span class="d-sm-block d-none">Peminjaman</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#default-tab-4" data-toggle="tab" class="nav-link">
                                        <span class="d-sm-none">Status</span>
                                        <span class="d-sm-block d-none">Status</span>
                                    </a>
                                </li>
                            </ul>
                            <!-- end nav-tabs -->

                            <!-- begin tab-content -->
                            <div class="tab-content pb-1">

                                <!-- begin tab-pane -->
                                <div class="tab-pane fade active show" id="default-tab-1">
                                    <!-- <h3 class="m-t-10"><i class="fa fa-cog"></i> Lorem ipsum dolor sit amet</h3> -->

                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="grid grid-cols-4 gap-x-7 mt-3">

                                                <div class="blue-gradient px-[20px] py-[20px] rounded-xl">
                                                    <div class="flex flex-row items-end gap-x-5 pt-1">
                                                        <div class="px-[19px] py-[12px] rounded-full bg-white">
                                                            <i class="fa fa-clipboard-check text-xl text-blue-500"></i>
                                                        </div>
                                                        <div class="flex flex-col items-center text-white">
                                                            <p class="font-semibold" style="font-size: 18px">0</p>
                                                            <p style="font-size: 13px">Menunggu</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="yellow-gradient px-[20px] py-[20px] rounded-xl">
                                                    <div class="flex flex-row items-end gap-x-5 pt-1">
                                                        <div class="px-[16px] py-[12px] rounded-full bg-white">
                                                            <i class="fa fa-spinner text-xl text-yellow-500"></i>
                                                        </div>
                                                        <div class="flex flex-col items-center text-white">
                                                            <p class="font-semibold" style="font-size: 18px">0</p>
                                                            <p style="font-size: 13px">Dalam Proses</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="red-gradient px-[20px] py-[20px] rounded-xl">
                                                    <div class="flex flex-row items-end gap-x-5 pt-1">
                                                        <div class="px-[16px] py-[12px] rounded-full bg-white">
                                                            <i class="fa fa-ban text-xl text-red-500"></i>
                                                        </div>
                                                        <div class="flex flex-col items-center text-white">
                                                            <p class="font-semibold" style="font-size: 18px">0</p>
                                                            <p style="font-size: 13px">Ditolak</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="green-gradient px-[20px] py-[20px] rounded-xl">
                                                    <div class="flex flex-row items-end gap-x-5 pt-1">
                                                        <div class="px-[16px] py-[12px] rounded-full bg-white">
                                                            <i class="fa fa-check text-xl text-green-500"></i>
                                                        </div>
                                                        <div class="flex flex-col items-center text-white">
                                                            <p class="font-semibold" style="font-size: 18px">0</p>
                                                            <p style="font-size: 13px">Disetujui</p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <table class="table">
                                        <tr>
                                            <td class="bg-light">KTP</td>
                                            <td width="1px">:</td>
                                            <td><input type="text" id="nik" class="bg-white"
                                                    style="border:none; width:100%" disabled></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light">Nama Pemohon</td>
                                            <td width="1px">:</td>
                                            <td><input type="text" id="name" class="bg-white"
                                                    style="border:none; width:100%" disabled></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light">No Telp</td>
                                            <td width="1px">:</td>
                                            <td><input type="text" id="no_telp" class="bg-white"
                                                    style="border:none; width:100%" disabled></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light">Instansi</td>
                                            <td width="1px">:</td>
                                            <td><input type="text" id="nama_instansi" class="bg-white"
                                                    style="border:none; width:100%" disabled></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light">Nama Organisasi/Pribadi</td>
                                            <td width="1px">:</td>
                                            <td><input type="text" id="bidang_instansi" class="bg-white"
                                                    style="border:none; width:100%" disabled></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light">Email</td>
                                            <td width="1px">:</td>
                                            <td><input type="text" id="email" class="bg-white"
                                                    style="border:none; width:100%" disabled></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light">Alamat</td>
                                            <td width="1px">:</td>
                                            <td><input type="text" id="alamat" class="bg-white"
                                                    style="border:none; width:100%" disabled></td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- end tab-pane -->
                                <!-- begin tab-pane -->
                                <div class="tab-pane fade" id="default-tab-2">
                                    <table class="table">
                                        <tr>
                                            <td class="bg-light">Nama Kegiatan</td>
                                            <td width="1px">:</td>
                                            <td><input type="text" id="nama_kegiatan" class="bg-white"
                                                    style="border:none; width:100%" disabled></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light">Jumlah Peserta</td>
                                            <td width="1px">:</td>
                                            <td><input type="text" id="jumlah_peserta" class="bg-white"
                                                    style="border:none; width:100%" disabled></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light">Narasumber</td>
                                            <td width="1px">:</td>
                                            <td><input type="text" id="narasumber" class="bg-white"
                                                    style="border:none; width:100%" disabled></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light">Ringkasan</td>
                                            <td width="1px">:</td>
                                            <td><input type="text" id="ringkasan" class="bg-white"
                                                    style="border:none; width:100%" disabled></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light">Surat Permohonan</td>
                                            <td width="1px">:</td>
                                            <td><a href=""></a><input type="text" id="surat_permohonan"
                                                    class="bg-white" style="border:none; width:100%" disabled></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light">Rundown Acara</td>
                                            <td width="1px">:</td>
                                            <td><input type="text" id="rundown_acara" class="bg-white"
                                                    style="border:none; width:100%" disabled></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light">Output (optional)</td>
                                            <td width="1px">:</td>
                                            <td><input type="text" id="output" class="bg-white"
                                                    style="border:none; width:100%" disabled></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light">Outcome (optional)</td>
                                            <td width="1px">:</td>
                                            <td><input type="text" id="outcome" class="bg-white"
                                                    style="border:none; width:100%" disabled></td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- end tab-pane -->

                                <!-- begin tab-pane -->
                                <div class="tab-pane fade" id="default-tab-3">
                                    <table class="table">
                                        <tr>
                                            <td class="bg-light">Tanggal Mulai</td>
                                            <td width="1px">:</td>
                                            <td><input type="text" id="tgl_mulai" class="bg-white"
                                                    style="border:none; width:100%" disabled></td>
                                            <td class="bg-light">Jam Mulai</td>
                                            <td width="1px">:</td>
                                            <td><input type="text" id="jam_mulai" class="bg-white"
                                                    style="border:none; width:100%" disabled></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light">Tanggal Selesai</td>
                                            <td width="1px">:</td>
                                            <td><input type="text" id="tgl_selesai" class="bg-white"
                                                    style="border:none; width:100%" disabled></td>
                                            <td class="bg-light">Jam Selesai</td>
                                            <td width="1px">:</td>
                                            <td><input type="text" id="jam_selesai" class="bg-white"
                                                    style="border:none; width:100%" disabled></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light">Fasilitas di Pinjam</td>
                                            <td width="1px">:</td>
                                            <td><input type="text" id="nama_fasilitas" class="bg-white"
                                                    style="border:none; width:100%" disabled></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light">Alat Pendukung Tambahan</td>
                                            <td width="1px">:</td>
                                            <td><input type="text" id="nama_alat" class="bg-white"
                                                    style="border:none; width:100%" disabled></td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- end tab-pane -->

                                <!-- begin tab-pane -->
                                <div class="tab-pane fade" id="default-tab-4">
                                    <table class="table">
                                        <tr>
                                            <td class="bg-light">Tanggal Pengajuan Permohonan</td>
                                            <td width="1px">:</td>
                                            <td><input type="text" id="created_at" class="bg-white"
                                                    style="border:none; width:100%" disabled></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light">Status Permohonan</td>
                                            <td width="1px">:</td>
                                            <td><input type="text" id="status_permohonan" class="bg-white"
                                                    style="border:none; width:100%" disabled></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light">Catatan Admin :</td>
                                            <td width="1px">:</td>
                                            <td>
                                                <textarea id="catatan" class="bg-white" style="border:none; width:100%" disabled></textarea>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- end tab-pane -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).on("click", "#modal_show", function() {
            var nik = $(this).data('nik');
            var no_telp = $(this).data('no_telp');
            var bidang_instansi = $(this).data('bidang_instansi');
            var alamat = $(this).data('alamat');
            var id_permohonan = $(this).data('id_permohonan');
            var name = $(this).data('name');
            var nama_instansi = $(this).data('nama_instansi');
            var email = $(this).data('email');
            var nama_kegiatan = $(this).data('nama_kegiatan');
            var jumlah_peserta = $(this).data('jumlah_peserta');
            var ringkasan = $(this).data('ringkasan');
            var narasumber = $(this).data('narasumber');
            var surat_permohonan = $(this).data('surat_permohonan');
            var rundown_acara = $(this).data('rundown_acara');
            var output = $(this).data('output');
            var outcome = $(this).data('outcome');
            var created_at = $(this).data('created_at');
            var status_permohonan = $(this).data('status_permohonan');
            var catatan = $(this).data('catatan');
            var tgl_mulai = $(this).data('tgl_mulai');
            var jam_mulai = $(this).data('jam_mulai');
            var tgl_selesai = $(this).data('tgl_selesai');
            var jam_selesai = $(this).data('jam_selesai');
            var nama_fasilitas = $(this).data('nama_fasilitas');
            var nama_alat = $(this).data('nama_alat');

            $("#tampilAcc #id_permohonan").val(id_permohonan);
            $("#tampil_modal #nik").val(nik);
            $("#tampil_modal #no_telp").val(no_telp);
            $("#tampil_modal #bidang_instansi").val(bidang_instansi);
            $("#tampil_modal #alamat").val(alamat);
            $("#tampil_modal #created_at").val(created_at);
            $("#tampil_modal #status_permohonan").val(status_permohonan);
            $("#tampil_modal #name").val(name);
            $("#tampil_modal #nama_instansi").val(nama_instansi);
            $("#tampil_modal #email").val(email);
            $("#tampil_modal #nama_kegiatan").val(nama_kegiatan);
            $("#tampil_modal #jumlah_peserta").val(jumlah_peserta);
            $("#tampil_modal #ringkasan").val(ringkasan);
            $("#tampil_modal #narasumber").val(narasumber);
            $("#tampil_modal #surat_permohonan").val(surat_permohonan);
            $("#tampil_modal #rundown_acara").val(rundown_acara);
            $("#tampil_modal #output").val(output);
            $("#tampil_modal #outcome").val(outcome);
            $("#tampil_modal #catatan").val(catatan);
            $("#tampil_modal #tgl_mulai").val(tgl_mulai);
            $("#tampil_modal #jam_mulai").val(jam_mulai);
            $("#tampil_modal #tgl_selesai").val(tgl_selesai);
            $("#tampil_modal #jam_selesai").val(jam_selesai);
            $("#tampil_modal #nama_fasilitas").val(nama_fasilitas);
            $("#tampil_modal #nama_alat").val(nama_alat + ",");

        })
    </script>
    <script type="text/javascript">
        $(document).on("click", "#modal_show", function() {
            var id_permohonan = $(this).data('id_permohonan');

            $("#tampilAcc #id_permohonan").val(id_permohonan);

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
