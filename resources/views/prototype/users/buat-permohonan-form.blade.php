@extends('layouts.user')

@section('title', 'Buat Permohonan')

@push('css')
    <link href="/assets/plugins/smartwizard/dist/css/smart_wizard.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" />
    <link href="/assets/plugins/lightbox2/dist/css/lightbox.css" rel="stylesheet" />
@endpush

@section('content')

    @php
        $data_jam = ['8', '9', '10', '11', '12', '13', '14', '15'];
        // $jadwal = $jadwalArray;

        $curr = '2024-01-24';
        $arr = [['2024-02-02', '10', '13'], ['2024-02-02', '9', '11']];

        $filteredData = [];

        foreach ($arr as $data) {
            if ($data[0] === $curr) {
                $start = intval($data[1]);
                $end = intval($data[2]);

                $filteredData[] = array_map('strval', range($start, $end));
            }
        }

        $filteredData = array_merge(...$filteredData);
    @endphp
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
                    <!-- begin fieldset -->
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
                                                <select class="form-input w-full text-small" name="skpd">
                                                    <option disabled selected>-- Pilih Bidang SKPD --</option>
                                                    <option value="skpd">SKPD</option>
                                                    <option value="non_skpd">NON SKPD</option>
                                                </select>
                                                <div class="bg-primary/20 px-7 py-2 my-2 rounded-md">
                                                    <small><b>Catatan :</b><br>
                                                        <b>SKPD</b> (acara pemerintah)<br>
                                                        <b>NON SKPD</b> (acara diluar pemerintah)</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-lg-4 col-form-label">Bidang Kegiatan <sup
                                                    class="text-red">*</sup></label>
                                            <div class="col-lg-8">
                                                <select class="form-input w-full text-small" name="bidang_id">
                                                    <option disabled selected>-- Pilih Bidang Kegiatan --</option>
                                                    @foreach ($bidang as $b)
                                                        <option value="{{ $b->id_bidang_kegiatan }}">{{ $b->nama_bidang }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-lg-4 col-form-label">No KTP <sup
                                                    class="text-red">*</sup></label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control form-input text-small"
                                                    name="nik" value="{{ Auth::user()->nik }}" disabled />
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-lg-4 col-form-label">Nama Pemohon <sup
                                                    class="text-red">*</sup></label>
                                            <div class="col-lg-8">
                                                <input type="hidden" class="form-control form-input text-small"
                                                    value="{{ Auth::user()->id }}" name="user_id" />
                                                <input type="hidden" class="form-control form-input text-small"
                                                    value="" name="permohonan_id" />
                                                <input type="text" class="form-control form-input text-small"
                                                    value="{{ Auth::user()->name }}" name="name" disabled />
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-lg-4 col-form-label">No Telepon <sup
                                                    class="text-red">*</sup></label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control form-input text-small"
                                                    name="no_telp" value="{{ Auth::user()->no_telp }}" disabled />
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-lg-4 col-form-label">Alamat Lengkap <sup
                                                    class="text-red">*</sup></label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control form-input text-small"
                                                    name="alamat" value="{{ Auth::user()->alamat }}" disabled />
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <!-- end col-8 -->
                        </div>
                        <!-- end row -->
                    </fieldset>

                    <!-- end fieldset -->
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
                                        <label class="col-lg-4 col-form-label">Nama Instansi / Pribadi</label>
                                        <div class="col-lg-8">
                                            <select class="form-input w-full text-small" name="instansi_id"
                                                id="instansiSelect">
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
                                            <input type="text" class="form-control form-input text-small"
                                                name="status_instansi" />
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-lg-4 col-form-label">Bidang Instansi / Pribadi</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control form-input text-small"
                                                name="bidang_instansi" />
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-lg-4 col-form-label">Alamat Instansi / Pribadi</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control form-input text-small"
                                                name="alamat_instansi" id="valAlamat" />
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
                                            <input type="text" class="form-control form-input text-small"
                                                name="tgl_mulai" id="tgl_mulai" value="{{ $tgl_mulai }}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-body panel-form">
                                    <div class="form-group row mb-3">
                                        <label class="col-lg-4 col-form-label">Jam Mulai</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control form-input text-small"
                                                name="jam_mulai" id="jam_mulai" value="{{ $jam_mulai }}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-body panel-form">
                                    <div class="form-group row mb-3">
                                        <label class="col-lg-4 col-form-label">Selesai Tanggal</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control form-input text-small"
                                                name="tgl_selesai" id="tgl_selesai" value="{{ $tgl_selesai }}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-body panel-form">
                                    <div class="form-group row mb-3">
                                        <label class="col-lg-4 col-form-label">Jam Selesai</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control form-input text-small"
                                                name="jam_selesai" id="jam_selesai" value="{{ $jam_selesai }}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label">Nama Acara / Kegiatan</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control form-input text-small"
                                            name="nama_kegiatan" />
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label">Jumlah Peserta</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control form-input text-small"
                                            name="jumlah_peserta" />
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label">Narasumber</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control form-input text-small"
                                            name="narasumber" />
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label">Ringkasan</label>
                                    <div class="col-lg-8">
                                        <textarea
                                            class="border-gray-200 border-2 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md w-full"
                                            name="ringkasan" style="font-size: 13px" /></textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label mt-3">Surat Permohonan <sup
                                            class="text-red">*</sup></label>
                                    <div class="col-lg-8 mt-3">
                                        <input type="file" name="surat_permohonan" id="surat_permohonan"
                                            class="block w-full border border-gray-200 text-small focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none file:bg-gray-50 file:border-0 file:me-4 file:py-2 file:px-4">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">

                                    <label class="col-lg-4 col-form-label mt-3">Surat Permohonan <sup
                                            class="text-red">*</sup></label>
                                    <div class="col-lg-8 mt-3">
                                        <input type="file" name="rundown_acara" id="rundown_acara"
                                            class="block w-full border border-gray-200 text-small focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none file:bg-gray-50 file:border-0 file:me-4 file:py-2 file:px-4">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label">Output</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control form-input text-small"
                                            name="output" />
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label">Outcome</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control form-input text-small"
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
                                            style="background-color: rgba(84, 101, 255, 0.8); border-radius: 0 0 8px 0;">
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
