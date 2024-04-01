@extends('layouts.default')

@section('title', 'Data Permohonan')

@push('css')
    <link href="/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-select-bs4/css/select.bootstrap4.min.css" rel="stylesheet" />
@endpush

@section('content')

    <div class="mt-4">
        <div class="mb-5 text-lg flex flex-row items-end justify-between">
            <div class="flex flex-row items-center gap-x-1">
                <i class="fa fa-user mr-2"></i>
                <h1>Detail Permohonan</h1>
            </div>

            <nav class="lg:flex ml-2 hidden" aria-label="Breadcrumb">
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
                            <a href="{{ route('superadmin.index_users') }}"
                                class="ms-1 text-sm text-gray-500 md:ms-2 no-underline hover:no-underline hover:text-primary">Data
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
                                class="ms-1 text-sm text-gray-500 md:ms-2 no-underline hover:no-underline">User - {{ $user->name }}</a>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="mt-[50px]">
            <div class="border-b border-neutral-300 pb-3 w-full mt-3">
                        <a href="{{ route('admin.dataPemohon') }}">
                            <button class="button-ghost rounded-md">< Kembali</button>
                        </a> 
            </div>
            <ul class="timeline">
                <li>
                    <div class="timeline-time">
                        <span class="date">Di Ajukan</span>
                        <span class="time">{{ \Carbon\Carbon::parse($permohonan->created_at)->format('d M Y') }}</span>
                    </div>

                    <div class="timeline-icon">
                        <a href="javascript:;">&nbsp;</a>
                    </div>

                    <div class="timeline-body">
                        <div class="timeline-header">
                            <span class="username" style="text-transform:uppercase;"># {{$permohonan->nama_kegiatan}}</span>
                            <span class="views" style="text-transform:capitalize;">{{$permohonan->user->name}}</span>
                        </div>
                        <div class="timeline-content" style="text-transform:capitalize;">
                            <p>
                                {{$permohonan->ringkasan}}
                            </p>
                        </div>
                        <div class="timeline-likes">
                            <div class="stats-right">
                                <span class="stats-text">
                                    <i class="fa fa-calendar"></i>
                                    {{ \Carbon\Carbon::parse($permohonan->tgl_mulai)->format('d') }} s/d
                                    {{ \Carbon\Carbon::parse($permohonan->tgl_selesai)->format('d M Y') }}
                                </span>
                                <span class="stats-text"><i class="fa fa-clock"></i> {{ sprintf("%02d", $permohonan->jam_mulai) }}:00 - {{ sprintf("%02d", $permohonan->jam_selesai) }}:00</span>
                            </div>
                        </div>
                    </div>
                </li>
                @if($permohonan->status_permohonan === "Menunggu")
                <li>
                    <div class="timeline-time">
                        <span class="date">Menunggu</span>
                        <span class="time">{{ \Carbon\Carbon::parse($permohonan->created_at)->format('d M Y') }}</span>
                    </div>

                    <div class="timeline-icon">
                        <a href="javascript:;">&nbsp;</a>
                    </div>

                    <div class="timeline-body">
                        <div class="timeline-content" style="text-transform:capitalize;">
                            <p>
                                Data permohonan sedang ditinjau
                            </p>
                        </div>
                    </div>
                </li>
                @elseif($permohonan->status_permohonan == "Diterima")
                <li>
                    <div class="timeline-time">
                        <span class="date">Selesai</span>
                        <span class="time">{{ \Carbon\Carbon::parse($permohonan->diubah)->format('d M Y') }}</span>
                    </div>

                    <div class="timeline-icon">
                        <a href="javascript:;">&nbsp;</a>
                    </div>

                    <div class="timeline-body">
                        <div class="timeline-header">  
                            <span class="username" style="text-transform:uppercase;">KODE BOOKING : {{$permohonan->kode_booking}}</span>                        
                            <span class="views inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800">Pengajuan {{ $permohonan->status_permohonan }} <i class="fa fa-check-circle text-green"></i></span>
                            
                        </div>
                        <div class="timeline-content" style="text-transform:capitalize;">
                            <p>
                                Catatan : {{$permohonan->catatan}}
                            </p>
                        </div>
                    </div>
                </li>
                @else
                <li>
                    <div class="timeline-time">
                        <span class="date">Selesai</span>
                        <span class="time">{{ \Carbon\Carbon::parse($permohonan->diubah)->format('d M Y') }}</span>
                    </div>

                    <div class="timeline-icon">
                        <a href="javascript:;">&nbsp;</a>
                    </div>

                    <div class="timeline-body">
                        <div class="timeline-header">                            
                            @if ($data->status_permohonan === 'Batal')
                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-500 text-white">Pengajuan {{ $data->status_permohonan }}</span>
                            @else
                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800">Pengajuan {{ $data->status_permohonan }}</span>
                            @endif
                            <span class="views" style="text-transform:capitalize;"><i class="fa fa-times text-red"></i></span>
                        </div>
                        <div class="timeline-content" style="text-transform:capitalize;">
                            <p>
                                Catatan : {{$permohonan->catatan}}
                            </p>
                        </div>
                    </div>
                </li>
                @endif
            </ul>

            <div class="pt-[30px] lg:pt-0 lg:mt-[50px]">
                <div class="bg-white p-[10px] md:p-[16px] rounded-xl mt-3" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
        
                <div class="mt-3">
                    <div class="bg-white shadow-sm border p-[15px] md:p-[25px]">
                        <div class="border-b border-neutral-200 pb-3 font-medium" style="font-size: 14px">
                            <h1>Identitas Permohonan</h1>
                        </div>
                        <div class="md:grid md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-x-3 gap-y-10 mt-4">
                            <div class="">
                                <h3 class="font-medium">SKPD/Non SKPD</h3>
                                <p class="pt-2 text-neutral-500">{{ $permohonan->skpd === 'skpd' ? 'Skpd' : 'Non Skpd' }}</p>
                            </div>
                            <div class="mt-[20px] md:mt-0">
                                <h3 class="font-medium">Bidang Kegiatan</h3>
                                <p class="pt-2 text-neutral-500">{{ $permohonan->bidang_kegiatan }}</p>
                            </div>
                            <div class="mt-[20px] md:mt-0">
                                <h3 class="font-medium">No KTP</h3>
                                <p class="pt-2 text-neutral-500">{{ $permohonan->user->nik }}</p>
                            </div>
                            <div class="mt-[20px] md:mt-0">
                                <h3 class="font-medium">Nama Pemohon</h3>
                                <p class="pt-2 text-neutral-500">{{ $permohonan->user->name }}</p>
                            </div>
                            <div class="mt-[20px] md:mt-0">
                                <h3 class="font-medium">No Telepon</h3>
                                <p class="pt-2 text-neutral-500">{{ $permohonan->user->no_telp }}</p>
                            </div>
                            <div class="mt-[20px] md:mt-0">
                                <h3 class="font-medium">Email</h3>
                                <p class="pt-2 text-neutral-500">{{ $permohonan->user->email }}</p>
                            </div>
                            <div class="mt-[20px] md:mt-0">
                                <h3 class="font-medium">Nama Instansi/Pribadi</h3>
                                <p class="pt-2 text-neutral-500">{{ $permohonan->user->instansi->nama_instansi }}</p>
                            </div>
                            <div class="mt-[20px] md:mt-0">
                                <h3 class="font-medium">Status dalam Instansi/Pribadi</h3>
                                <p class="pt-2 text-neutral-500">{{ $permohonan->status_instansi }}</p>
                            </div>
                            <div class="mt-[20px] md:mt-0">
                                <h3 class="font-medium">Bidang Instansi/Pribadi</h3>
                                <p class="pt-2 text-neutral-500">{{ $permohonan->bidang_instansi }}</p>
                            </div>
                            <div class="mt-[20px] md:mt-0">
                                <h3 class="font-medium">Alamat Instansi/Pribadi</h3>
                                <p class="pt-2 text-neutral-500">{{ $permohonan->user->alamat_instansi }}</p>
                            </div>
                        </div>
                    </div>
    
                    <div class="bg-white shadow-sm border p-[15px] md:p-[25px] mt-5">
                        <div class="border-b border-neutral-200 pb-3 font-medium" style="font-size: 14px">
                            <h1>Kegiatan</h1>
                        </div>
                        <div class="md:grid md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-x-3 gap-y-10 mt-4">
                            <div class="mt-[20px] md:mt-0">
                                <h3 class="font-medium">Nama Kegiatan</h3>
                                <p class="pt-2 text-neutral-500">{{ $permohonan->nama_kegiatan }}</p>
                            </div>
                            <div class="mt-[20px] md:mt-0">
                                <h3 class="font-medium">Jumlah Peserta</h3>
                                <p class="pt-2 text-neutral-500">{{ $permohonan->jumlah_peserta }}</p>
                            </div>
                            <div class="mt-[20px] md:mt-0">
                                <h3 class="font-medium">Narasumber</h3>
                                <p class="pt-2 text-neutral-500">{{ $permohonan->narasumber }}</p>
                            </div>
                            <div class="mt-[20px] md:mt-0">
                                <h3 class="font-medium">Ringkasan</h3>
                                <p class="pt-2 text-neutral-500">{{ $permohonan->ringkasan }}</p>
                            </div>
                            <div class="mt-[20px] md:mt-0">
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
                            <div class="mt-[20px] md:mt-0">
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
                            <div class="mt-[20px] md:mt-0">
                                <h3 class="font-medium">Output</h3>
                                <p class="pt-2 text-neutral-500">{{ $permohonan->output === null ? '-' : $permohonan->output }}</p>
                            </div>
                            <div class="mt-[20px] md:mt-0">
                                <h3 class="font-medium">Outcome</h3>
                                <p class="pt-2 text-neutral-500">{{ $permohonan->outcome === null ? '-' : $permohonan->outcome }}</p>
                            </div>
                        </div>
                    </div>
    
                    <div class="bg-white shadow-sm border p-[15px] md:p-[25px] mt-5">
                        <div class="border-b border-neutral-200 pb-3 font-medium" style="font-size: 14px">
                            <h1>Peminjaman</h1>
                        </div>
                        <div class="md:grid md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-x-3 gap-y-10 mt-4">
                            <div class="mt-[20px] md:mt-0mt-[20px] md:mt-0">
                                <h3 class="font-medium">Tanggal Mulai</h3>
                                <p class="pt-2 text-neutral-500">{{ \Carbon\Carbon::parse($permohonan
                                    ->tgl_mulai)->format('d M Y') }}</p>
                            </div>
                            <div class="mt-[20px] md:mt-0mt-[20px] md:mt-0">
                                <h3 class="font-medium">Jam Mulai</h3>
                                <p class="pt-2 text-neutral-500">{{ sprintf("%02d", $permohonan->jam_mulai) }}:00</p>
                            </div>
                            <div class="mt-[20px] md:mt-0mt-[20px] md:mt-0">
                                <h3 class="font-medium">Tanggal Selesai</h3>
                                <p class="pt-2 text-neutral-500">{{ \Carbon\Carbon::parse($permohonan
                                    ->tgl_selesai)->format('d M Y') }}</p>
                            </div>
                            <div class="mt-[20px] md:mt-0mt-[20px] md:mt-0">
                                <h3 class="font-medium">Jam Selesai</h3>
                                <p class="pt-2 text-neutral-500">{{ sprintf("%02d", $permohonan->jam_selesai) }}:{{ $permohonan->jam_selesai == 15 ? '30' : '00' }}</p>
                            </div>
                            <div class="mt-[20px] md:mt-0mt-[20px] md:mt-0">
                                <h3 class="font-medium">Fasilitas</h3>
                                <p class="pt-2 text-neutral-500">{{ $permohonan->fasilitas->nama_fasilitas }}</p>
                            </div>
                            <div class="mt-[20px] md:mt-0mt-[20px] md:mt-0">
                                <h3 class="font-medium">Alat Pendukung</h3>
                                <p class="pt-2 text-neutral-500">
                                    @php
                                        $inputUser = $permohonan->alat_id;
                                        $arrayFasilitas = explode(",", $inputUser);
                                        $fasilitas = \App\Models\AlatPendukung::whereIn('id_alat_pendukung', $arrayFasilitas)->pluck('nama_alat');
                                        $arrayNamaFasilitas = $fasilitas->toArray();
                                        $stringNamaAlat = implode(", ", $arrayNamaFasilitas);
                                        echo $stringNamaAlat ? $stringNamaAlat : '-';
                                    @endphp
                                </p>
                            </div>
                        </div>
                    </div>
    
                    <div class="bg-white shadow-sm border p-[15px] md:p-[25px] mt-5">
                        <div class="border-b border-neutral-200 pb-3 font-medium" style="font-size: 14px">
                            <h1>Status</h1>
                        </div>
                        <div class="md:grid md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-x-3 gap-y-10 mt-4">
                            <div class="mt-[20px] md:mt-0">
                                <h3 class="font-medium">Tanggal Pengajuan Permohonan</h3>
                                <p class="pt-2 text-neutral-500">{{ \Carbon\Carbon::parse($permohonan
                                    ->created_at)->format('d M Y') }}</p>
                            </div>
                            <div class="mt-[20px] md:mt-0">
                                <h3 class="font-medium">Status Permohonan</h3>
                                @if ($permohonan->status_permohonan === 'Diterima')
                                <span class="mt-3 inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ $permohonan->status_permohonan }}</span>
                                @elseif ($permohonan->status_permohonan === 'Ditolak')
                                <span class="mt-3 inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800">{{ $permohonan->status_permohonan }}</span>
                                @elseif ($permohonan->status_permohonan === 'Batal')
                                <span class="mt-3 inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-500 text-white">{{ $permohonan->status_permohonan }}</span>
                                @else 
                                <span class="mt-3 inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-yellow-200 text-yellow-800">{{ $permohonan->status_permohonan }}</span>
                                @endif
                            </div>
                            <div class="mt-[20px] md:mt-0">
                                <h3 class="font-medium">Catatan Admin</h3>
                                <p class="pt-2 text-neutral-500">{{ $permohonan->catatan === null ? '-' : $permohonan->catatan }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
        
@endsection
