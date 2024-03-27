@extends('layouts.user')

@section('title', 'Buat Permohonan')

@push('css')
    <link href="/assets/plugins/smartwizard/dist/css/smart_wizard.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" />
    <link href="/assets/plugins/lightbox2/dist/css/lightbox.css" rel="stylesheet" />
@endpush

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Beranda</a></li>
        <li class="breadcrumb-item active">Data Permohonan</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Buat Data Permohonan</h1>
    <!-- end page-header -->
    <!-- begin wizard-form -->

    @if (session('sukses'))
        <div class="alert alert-success fade show">
            <span class="close" data-dismiss="alert">×</span>

            {{ session('sukses') }}
        </div>
    @endif
    <form action="{{ route('user.simpanPermohonan') }}" method="POST" enctype="multipart/form-data"
        class="form-control-with-bg">
        @csrf
        <!-- begin wizard -->
        <div id="wizard">
            <!-- begin wizard-step -->
            <ul>
                <li>
                    <a href="#step-1">
                        <span class="number">1</span>
                        <span class="info">
                            Data Pemohon
                            <!-- <small>Name, Address, IC No and DOB</small> -->
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#step-2">
                        <span class="number">2</span>
                        <span class="info">
                            Data Instansi / Pribadi
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#step-3">
                        <span class="number">3</span>
                        <span class="info">
                            Informasi Acara / Kegiatan
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#step-4">
                        <span class="number">4</span>
                        <span class="info">
                            Ruang dan Alat
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#step-5">
                        <span class="number">5</span>
                        <span class="info">
                            Selesai
                        </span>
                    </a>
                </li>
            </ul>
            <!-- end wizard-step -->
            <!-- begin wizard-content -->
            <div>
                <!-- begin step-1 -->
                <div id="step-1">
                    <fieldset>
                        <!-- begin row -->
                        <div class="row">
                            <!-- begin col-12 -->
                            <div class="col-xl-12">
                                <div class="panel-body panel-form">
                                    <form class="form-horizontal form-bordered">
                                        <div class="form-group row mb-0">
                                            <label class="col-lg-4 col-form-label">SKPD/Non SKPD <sup
                                                    class="text-red">*</sup></label>
                                            <div class="col-lg-8">
                                                <select
                                                    class="border-gray-200 border-2 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md w-full"
                                                    name="skpd">
                                                    <option disabled selected>-- Pilih Bidang SKPD --</option>
                                                    <option value="skpd">SKPD</option>
                                                    <option value="non_skpd">NON SKPD</option>
                                                </select>
                                                <div class="alert alert-muted px-8 py-2 mt-1">
                                                    <small><b>Catatan :</b><br>
                                                        <b>SKPD</b> (acara pemerintah)<br>
                                                        <b>NON SKPD</b> (acara diluar pemerintah)
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-lg-4 col-form-label">Bidang Kegiatan</label>
                                            <div class="col-lg-8">
                                                <select
                                                    class="border-gray-200 border-2 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md w-full"
                                                    name="bidang_id">
                                                    <option disabled selected>-- Pilih Bidang Kegiatan --</option>
                                                    @foreach ($bidang as $b)
                                                        <option value="{{ $b->id_bidang_kegiatan }}">{{ $b->nama_bidang }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-lg-4 col-form-label">No KTP</label>
                                            <div class="col-lg-8">
                                                <input type="text"
                                                    class="form-control border-gray-200 border-2 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md"
                                                    name="nik" value="{{ Auth::user()->nik }}" disabled />
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-lg-4 col-form-label">Nama Pemohon</label>
                                            <div class="col-lg-8">
                                                <input type="hidden"
                                                    class="form-control border-gray-200 border-2 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md"
                                                    value="{{ Auth::user()->id }}" name="user_id" disabled />
                                                <input type="text"
                                                    class="form-control border-gray-200 border-2 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md"
                                                    value="{{ Auth::user()->name }}" name="name" disabled />
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-lg-4 col-form-label">No Telepon</label>
                                            <div class="col-lg-8">
                                                <input type="text"
                                                    class="form-control border-gray-200 border-2 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md"
                                                    name="no_telp" value="{{ Auth::user()->no_telp }}" disabled />
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-lg-4 col-form-label">Alamat Lengkap</label>
                                            <div class="col-lg-8">
                                                <input type="text"
                                                    class="form-control border-gray-200 border-2 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md"
                                                    name="alamat" value="{{ Auth::user()->alamat }}" disabled />
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <!-- end col-8 -->
                        </div>
                        <!-- end row -->
                    </fieldset>
                </div>

                <div id="step-2">
                    <!-- begin fieldset -->
                    <fieldset>
                        <!-- begin row -->
                        <div class="row">
                            <!-- begin col-12 -->
                            <div class="col-xl-12">
                                <div class="panel-body panel-form">
                                    <div class="form-group row mb-3">
                                        <label class="col-lg-4 col-form-label">Bidang Kegiatan</label>
                                        <div class="col-lg-8">
                                            <select
                                                class="border-gray-200 border-2 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md w-full"
                                                name="instansi_id" id="instansiSelect">
                                                <option disabled selected>-- Pilih Instansi --</option>
                                                @foreach ($instansi as $i)
                                                    <option value="{{ $i->id_instansi }}">{{ $i->nama_instansi }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-lg-4 col-form-label">Status dalam instansi / Pribadi</label>
                                        <div class="col-lg-8">
                                            <input type="text"
                                                class="form-control border-gray-200 border-2 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md"
                                                name="status_instansi" />
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-lg-4 col-form-label">Bidang Instansi / Pribadi</label>
                                        <div class="col-lg-8">
                                            <input type="text"
                                                class="form-control border-gray-200 border-2 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md"
                                                name="bidang_instansi" />
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-lg-4 col-form-label">Alamat Instansi / Pribadi</label>
                                        <div class="col-lg-8">
                                            <input type="text"
                                                class="form-control border-gray-200 border-2 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md"
                                                name="alamat_instansi" id="valAlamat" disabled />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col-12 -->
                        </div>
                        <!-- end row -->
                    </fieldset>
                    <!-- end fieldset -->
                </div>

                <div id="step-3">
                    <fieldset>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="panel-body panel-form">
                                    <div class="form-group row mb-3">
                                        <label class="col-lg-4 col-form-label">Mulai Tanggal</label>
                                        <div class="col-lg-3">
                                            <input type="date"
                                                class="form-control border-gray-200 border-2 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md"
                                                name="tgl_mulai" />
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body panel-form">
                                    <div class="form-group row mb-3">
                                        <label class="col-lg-4 col-form-label">Mulai Jam</label>
                                        <div class="col-lg-6">
                                            <div class="btn-group">
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-white">
                                                        <input type="radio" name="jam_mulai" value="8"
                                                            id="8" />08:00
                                                    </label>
                                                    <label class="btn btn-white">
                                                        <input type="radio" name="jam_mulai" value="9"
                                                            id="9" />09:00
                                                    </label>
                                                    <label class="btn btn-white">
                                                        <input type="radio" name="jam_mulai" value="10"
                                                            id="10" />10:00
                                                    </label>
                                                    <label class="btn btn-white">
                                                        <input type="radio" name="jam_mulai" value="11"
                                                            id="11" />11:00
                                                    </label>
                                                    <label class="btn btn-white">
                                                        <input type="radio" name="jam_mulai" value="12"
                                                            id="12" />12:00
                                                    </label>
                                                    <label class="btn btn-white">
                                                        <input type="radio" name="jam_mulai" value="13"
                                                            id="13" />13:00
                                                    </label>
                                                    <label class="btn btn-white">
                                                        <input type="radio" name="jam_mulai" value="14"
                                                            id="14" />14:00
                                                    </label>
                                                    <label class="btn btn-white">
                                                        <input type="radio" name="jam_mulai" value="15"
                                                            id="15" />15:00
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-body panel-form">
                                    <div class="form-group row mb-3">
                                        <label class="col-lg-4 col-form-label">Selesai Tanggal</label>
                                        <div class="col-lg-3">
                                            <input type="date"
                                                class="form-control border-gray-200 border-2 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md"
                                                name="tgl_selesai" />
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body panel-form">
                                    <div class="form-group row mb-3">
                                        <label class="col-lg-4 col-form-label">Selesai Jam</label>
                                        <div class="col-lg-6">
                                            <div class="btn-group">
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-white">
                                                        <input type="radio" name="jam_selesai" value="8"
                                                            id="8" />08:00
                                                    </label>
                                                    <label class="btn btn-white">
                                                        <input type="radio" name="jam_selesai" value="9"
                                                            id="9" />09:00
                                                    </label>
                                                    <label class="btn btn-white">
                                                        <input type="radio" name="jam_selesai" value="10"
                                                            id="10" />10:00
                                                    </label>
                                                    <label class="btn btn-white">
                                                        <input type="radio" name="jam_selesai" value="11"
                                                            id="11" />11:00
                                                    </label>
                                                    <label class="btn btn-white">
                                                        <input type="radio" name="jam_selesai" value="12"
                                                            id="12" />12:00
                                                    </label>
                                                    <label class="btn btn-white">
                                                        <input type="radio" name="jam_selesai" value="13"
                                                            id="13" />13:00
                                                    </label>
                                                    <label class="btn btn-white">
                                                        <input type="radio" name="jam_selesai" value="14"
                                                            id="14" />14:00
                                                    </label>
                                                    <label class="btn btn-white">
                                                        <input type="radio" name="jam_selesai" value="15"
                                                            id="15" />15:00
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label">Nama Acara / Kegiatan</label>
                                    <div class="col-lg-8">
                                        <input type="text"
                                            class="form-control border-gray-200 border-2 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md"
                                            name="nama_kegiatan" />
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label">Jumlah Peserta</label>
                                    <div class="col-lg-8">
                                        <input type="text"
                                            class="form-control border-gray-200 border-2 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md"
                                            name="jumlah_peserta" />
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label">Narasumber</label>
                                    <div class="col-lg-8">
                                        <input type="text"
                                            class="form-control border-gray-200 border-2 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md"
                                            name="narasumber" />
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label">Ringkasan</label>
                                    <div class="col-lg-8">
                                        <textarea
                                            class="border-gray-200 border-2 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md w-full"
                                            name="ringkasan" /></textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label">Surat Permohonan</label>
                                    <div class="col-lg-8">
                                        <input type="file" id="surat_permohonan" class="form-control pl-0 pt-0"
                                            name="surat_permohonan" />
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label">Rundown Acara</label>
                                    <div class="col-lg-8">
                                        <input type="file" id="rundown_acara" class="form-control pl-0 pt-0"
                                            name="rundown_acara" />
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label">Output</label>
                                    <div class="col-lg-8">
                                        <input type="text"
                                            class="form-control border-gray-200 border-2 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md"
                                            name="output" />
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label">Outcome</label>
                                    <div class="col-lg-8">
                                        <input type="text"
                                            class="form-control border-gray-200 border-2 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md"
                                            name="outcome" />
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- end row -->
                    </fieldset>
                    <!-- end fieldset -->
                </div>

                <div id="step-4">
                    <h5 class="mb-3">Fasilitas Tersedia </h5>
                    <div class="gallery">
                        <div class="row">
                            @foreach ($fasilitas as $f)
                                <div class="image gallery-group-1 relative" style="float:left">
                                    <div class="image-inner">
                                        <a href="/foto_fasilitas/{{ $f->file }}" data-lightbox="gallery-group-1">
                                            <div class="img"
                                                style="background-image: url(/foto_fasilitas/{{ $f->file }})"></div>
                                        </a>
                                        <p class="absolute top-0 lef-0 px-4 py-1 text-white"
                                            style="background-color: rgba(0, 170, 91, 0.5); border-radius: 0 0 8px 0;">
                                            {{ $f->nama_fasilitas }}
                                        </p>
                                    </div>
                                    <div class="image-info  bg-light">
                                        <h5 class="title">{{ $f->nama_fasilitas }}</h5>
                                        <div class="checkbox checkbox-css">
                                            <input type="checkbox" name="id_fasilitas[]" value="{{ $f->id_fasilitas }}"
                                                id="{{ $f->id_fasilitas }}">
                                            <label for="{{ $f->id_fasilitas }}">Pilih Fasilitas</label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- end image -->
                        <hr>
                        <h5 class="mt-5">Alat Pendukung Kegiatan </h5>
                        <div class="alert alert-light">
                            <div class="row">
                                @foreach ($alat as $a)
                                    <div class="btn-group mr-3">
                                        <div class="checkbox">
                                            <input name="id_alat[]" type="checkbox" value="{{ $a->id_alat_pendukung }}"
                                                id="{{ $a->id_alat }}">
                                            <label class="text-dark">{{ $a->nama_alat }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

                <div id="step-5">

                    <div class="jumbotron m-b-0 text-center">
                        <h5 class="display-4">Form Permohonan telah diisi!</h5>
                        <p class="lead mb-4">
                            Klik tombol kirim permohonan apabila Kamu sudah yakin.<br>
                            Pemohonan akan diproses selama 1x24 jam.
                        </p>
                        <p><button type="submit" class="btn btn-primary btn-lg">Kirim Permohonan</button></p>
                    </div>
                </div>
            </div>
            <!-- end wizard-content -->
        </div>
        <!-- end wizard -->
    </form>
    <!-- end wizard-form -->
@endsection

@push('scripts')
    <script src="/assets/plugins/smartwizard/dist/js/jquery.smartWizard.js"></script>
    <script src="/assets/js/demo/form-wizards.demo.js"></script>
    <script src="/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
    <script src="/assets/plugins/isotope-layout/dist/isotope.pkgd.min.js"></script>
    <script src="/assets/plugins/lightbox2/dist/js/lightbox.min.js"></script>
    <script src="/assets/js/demo/gallery.demo.js"></script>

    <script>
        document.getElementById('instansiSelect').addEventListener('change', function() {
            var selectedValue = this.value;

            var inputValue = '';

            switch (selectedValue) {
                case '1':
                    inputValue = 'Cimahi Utara';
                    break;
                case '2':
                    inputValue = 'Cimahi Tengah';
                    break;
                case '3':
                    inputValue = 'Cimahi Selatan';
                    break;
                default:
                    inputValue = '';
            }

            document.getElementById('valAlamat').value = inputValue;
        });
    </script>
@endpush
