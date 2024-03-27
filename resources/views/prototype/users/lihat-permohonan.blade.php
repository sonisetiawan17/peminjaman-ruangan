@extends('layouts.user')

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

    <div class="mt-4">
        <div class="mb-5 text-lg flex flex-row items-end justify-between">
            <div class="flex flex-row items-center gap-x-1">
                <i class="fa fa-user mr-2"></i>
                <h1>Detail Permohonan - {{ $permohonan->user->name }}</h1>
            </div>

            <nav class="flex ml-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="{{ route('user.index') }}"
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
                            <a href="{{ route('user.historiPermohonan') }}"
                                class="ms-1 text-sm text-gray-500 md:ms-2 no-underline hover:no-underline hover:text-primary">History
                                Permohonan</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="#"
                                class="ms-1 text-sm text-gray-500 md:ms-2 no-underline hover:no-underline">{{ $permohonan->user->name }}</a>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="grid grid-cols-4 gap-x-7">
            <div class="bg-white shadow-sm px-[20px] py-[20px] rounded-sm">
                <p class="text-neutral-500">Data permohonan</p>
                <div class="flex flex-row items-end gap-x-5 pt-3">
                    <div class="px-[16px] py-[12px] rounded-full bg-green-300">
                        <i class="fa fa-check text-xl text-black"></i>
                    </div>
                    <div class="flex flex-col items-center">
                        <p class="font-semibold" style="font-size: 18px">1</p>
                        <p style="font-size: 13px">Disetujui</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm px-[20px] py-[20px] rounded-sm">
                <p class="text-neutral-500">Data permohonan</p>
                <div class="flex flex-row items-end gap-x-5 pt-3">
                    <div class="px-[16px] py-[12px] rounded-full bg-yellow-300">
                        <i class="fa fa-spinner text-xl text-black"></i>
                    </div>
                    <div class="flex flex-col items-center">
                        <p class="font-semibold" style="font-size: 18px">1</p>
                        <p style="font-size: 13px">Dalam Proses</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm px-[20px] py-[20px] rounded-sm">
                <p class="text-neutral-500">Data permohonan</p>
                <div class="flex flex-row items-end gap-x-5 pt-3">
                    <div class="px-[16px] py-[12px] rounded-full bg-red-300">
                        <i class="fa fa-ban text-xl text-black"></i>
                    </div>
                    <div class="flex flex-col items-center">
                        <p class="font-semibold" style="font-size: 18px">1</p>
                        <p style="font-size: 13px">Ditolak</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm px-[20px] py-[20px] rounded-sm">
                <p class="text-neutral-500">Data permohonan</p>
                <div class="flex flex-row items-end gap-x-5 pt-3">
                    <div class="px-[18px] py-[12px] rounded-full bg-violet-300">
                        <i class="fa fa-clipboard-check text-xl text-black"></i>
                    </div>
                    <div class="flex flex-col items-center">
                        <p class="font-semibold" style="font-size: 18px">1</p>
                        <p style="font-size: 13px">Selesai</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-sm border p-[25px] mt-5">
            <div class="border-b border-neutral-200 pb-3 font-medium" style="font-size: 14px">
                <h1>Identitas Permohonan - {{ $permohonan->user->name }}</h1>
            </div>
            <div class="grid grid-cols-4 gap-x-3 gap-y-10 mt-4">
                <div class="">
                    <h3 class="font-medium">SKPD/Non SKPD</h3>
                    <p class="pt-2 text-neutral-500">{{ $permohonan->skpd }}</p>
                </div>
                <div class="">
                    <h3 class="font-medium">Bidang Kegiatan</h3>
                    <p class="pt-2 text-neutral-500">{{ $permohonan->bidang_kegiatan->nama_bidang }}</p>
                </div>
                <div class="">
                    <h3 class="font-medium">No KTP</h3>
                    <p class="pt-2 text-neutral-500">{{ $permohonan->user->nik }}</p>
                </div>
                <div class="">
                    <h3 class="font-medium">Nama Pemohon</h3>
                    <p class="pt-2 text-neutral-500">{{ $permohonan->user->name }}</p>
                </div>
                <div class="">
                    <h3 class="font-medium">No Telepon</h3>
                    <p class="pt-2 text-neutral-500">{{ $permohonan->user->no_telp }}</p>
                </div>
                <div class="">
                    <h3 class="font-medium">Alamat Lengkap</h3>
                    <p class="pt-2 text-neutral-500">{{ $permohonan->user->alamat }}</p>
                </div>
                <div class="">
                    <h3 class="font-medium">Nama Instansi/Pribadi</h3>
                    <p class="pt-2 text-neutral-500">{{ $permohonan->instansi->nama_instansi }}</p>
                </div>
                <div class="">
                    <h3 class="font-medium">Status dalam Instansi/Pribadi</h3>
                    <p class="pt-2 text-neutral-500">{{ $permohonan->status_instansi }}</p>
                </div>
                <div class="">
                    <h3 class="font-medium">Bidang Instansi/Pribadi</h3>
                    <p class="pt-2 text-neutral-500">{{ $permohonan->bidang_instansi }}</p>
                </div>
                <div class="">
                    <h3 class="font-medium">Alamat Instansi/Pribadi</h3>
                    <p class="pt-2 text-neutral-500">{{ $permohonan->instansi->alamat_instansi }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-sm border p-[25px] mt-5">
            <div class="border-b border-neutral-200 pb-3 font-medium" style="font-size: 14px">
                <h1>Kegiatan - {{ $permohonan->user->name }}</h1>
            </div>
            <div class="grid grid-cols-4 gap-x-3 gap-y-10 mt-4">
                <div class="">
                    <h3 class="font-medium">Nama Kegiatan</h3>
                    <p class="pt-2 text-neutral-500">{{ $permohonan->nama_kegiatan }}</p>
                </div>
                <div class="">
                    <h3 class="font-medium">Jumlah Peserta</h3>
                    <p class="pt-2 text-neutral-500">{{ $permohonan->jumlah_peserta }}</p>
                </div>
                <div class="">
                    <h3 class="font-medium">Narasumber</h3>
                    <p class="pt-2 text-neutral-500">{{ $permohonan->narasumber }}</p>
                </div>
                <div class="">
                    <h3 class="font-medium">Ringkasan</h3>
                    <p class="pt-2 text-neutral-500">{{ $permohonan->ringkasan }}</p>
                </div>
                <div class="">
                    <h3 class="font-medium">Surat Permohonan</h3>
                    <div class="gallery ml-2 mt-2">
                        <a href="/file_upload/{{ $permohonan->surat_permohonan }}" data-lightbox="gallery-group-1">
                            <div class="flex flex-row items-center gap-2">
                                <img src="{{ asset('/assets/img/auth/google-docs.png') }}" class="w-[30px]" />
                                <p style="font-size: 12px" class="text-blue-500">Lihat File</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="">
                    <h3 class="font-medium">Rundown Acara</h3>
                    <div class="gallery ml-2 mt-2">
                        <a href="/file_upload/{{ $permohonan->rundown_acara }}" data-lightbox="gallery-group-1">
                            <div class="flex flex-row items-center gap-2">
                                <img src="{{ asset('/assets/img/auth/google-docs.png') }}" class="w-[30px]" />
                                <p style="font-size: 12px" class="text-blue-500">Lihat File</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="">
                    <h3 class="font-medium">Output</h3>
                    <p class="pt-2 text-neutral-500">{{ $permohonan->output }}</p>
                </div>
                <div class="">
                    <h3 class="font-medium">Outcome</h3>
                    <p class="pt-2 text-neutral-500">{{ $permohonan->outcome }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-sm border p-[25px] mt-5">
            <div class="border-b border-neutral-200 pb-3 font-medium" style="font-size: 14px">
                <h1>Peminjaman - {{ $permohonan->user->name }}</h1>
            </div>
            <div class="grid grid-cols-4 gap-x-3 gap-y-10 mt-4">
                <div class="">
                    <h3 class="font-medium">Tanggal Mulai</h3>
                    <p class="pt-2 text-neutral-500">{{ \Carbon\Carbon::parse($data
                        ->tgl_mulai)->format('d M Y') }}</p>
                </div>
                <div class="">
                    <h3 class="font-medium">Jam Mulai</h3>
                    <p class="pt-2 text-neutral-500">{{ sprintf("%02d", $data->jam_mulai) }}:00</p>
                </div>
                <div class="">
                    <h3 class="font-medium">Tanggal Selesai</h3>
                    <p class="pt-2 text-neutral-500">{{ \Carbon\Carbon::parse($data
                        ->tgl_selesai)->format('d M Y') }}</p>
                </div>
                <div class="">
                    <h3 class="font-medium">Jam Selesai</h3>
                    <p class="pt-2 text-neutral-500">{{ sprintf("%02d", $data->jam_selesai) }}:00</p>
                </div>
                <div class="">
                    <h3 class="font-medium">Fasilitas</h3>
                    <p class="pt-2 text-neutral-500">
                        @php
                            $inputUser = $permohonan->id_fasilitas;
                            $arrayFasilitas = explode(",", $inputUser);
                            $fasilitas = \App\Models\Fasilitas::whereIn('id_fasilitas', $arrayFasilitas)->pluck('nama_fasilitas');
                            $arrayNamaFasilitas = $fasilitas->toArray();
                            $stringNamaFasilitas = implode(", ", $arrayNamaFasilitas);
                            echo $stringNamaFasilitas;
                        @endphp
                    </p>
                    
                </div>
                <div class="">
                    <h3 class="font-medium">Alat Pendukung</h3>
                    <p class="pt-2 text-neutral-500">{{ $data->nama_alat }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-sm border p-[25px] mt-5">
            <div class="border-b border-neutral-200 pb-3 font-medium" style="font-size: 14px">
                <h1>Status - {{ $permohonan->user->name }}</h1>
            </div>
            <div class="grid grid-cols-4 gap-x-3 gap-y-10 mt-4">
                <div class="">
                    <h3 class="font-medium">Tanggal Pengajuan Permohonan</h3>
                    <p class="pt-2 text-neutral-500">{{ \Carbon\Carbon::parse($permohonan
                        ->created_at)->format('d M Y - H:i') }}</p>
                </div>
                <div class="">
                    <h3 class="font-medium">Status Permohonan</h3>
                    @if ($permohonan->status_permohonan === 'Diterima')
                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ $permohonan->status_permohonan }}</span>
                    @elseif ($permohonan->status_permohonan === 'Ditolak')
                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800">{{ $permohonan->status_permohonan }}</span>
                    @else 
                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-yellow-200 text-yellow-800">{{ $permohonan->status_permohonan }}</span>
                    @endif
                </div>
                <div class="">
                    <h3 class="font-medium">Catatan Admin</h3>
                    <p class="pt-2 text-neutral-500">{{ $permohonan->catatan }}</p>
                </div>
            </div>
        </div>
    </div>

@endsection
