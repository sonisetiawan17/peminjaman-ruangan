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
                <h1>Detail Permohonan - {{ $user->name }}</h1>
            </div>

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
					<!-- begin timeline-time -->
					<div class="timeline-time">
						<span class="date">Di Ajukan</span>
						<span class="time">{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}</span>
					</div>
					<!-- end timeline-time -->
					<!-- begin timeline-icon -->
					<div class="timeline-icon">
						<a href="javascript:;">&nbsp;</a>
					</div>
					<!-- end timeline-icon -->
					<!-- begin timeline-body -->
					<div class="timeline-body">
						<div class="timeline-header">
							<span class="username" style="text-transform:uppercase;"># {{$user->nama_kegiatan}}</span>
							<span class="views" style="text-transform:capitalize;">{{$user->name}}</span>
						</div>
						<div class="timeline-content" style="text-transform:capitalize;">
							<p>
								{{$user->ringkasan}}
							</p>
						</div>
						<div class="timeline-likes">
							<div class="stats-right">
								<span class="stats-text">
                                    <i class="fa fa-calendar"></i>
                                    {{ \Carbon\Carbon::parse($user->tgl_mulai)->format('d') }} s/d
                                    {{ \Carbon\Carbon::parse($user->tgl_selesai)->format('d M Y') }}
                                </span>
								<span class="stats-text"><i class="fa fa-clock"></i> {{ sprintf("%02d", $user->jam_mulai) }}:00 - {{ sprintf("%02d", $user->jam_selesai) }}:00</span>
							</div>
						</div>
					</div>
					<!-- end timeline-body -->
				</li>
                @if($user->status_permohonan === "Menunggu")
                <li>
					<!-- begin timeline-time -->
					<div class="timeline-time">
						<span class="date">Menunggu</span>
						<span class="time">{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}</span>
					</div>
					<!-- end timeline-time -->
					<!-- begin timeline-icon -->
					<div class="timeline-icon">
						<a href="javascript:;">&nbsp;</a>
					</div>
					<!-- end timeline-icon -->
					<!-- begin timeline-body -->
					<div class="timeline-body">
						<div class="timeline-content" style="text-transform:capitalize;">
							<p>
								Data permohonan sedang ditinjau
							</p>
						</div>
					</div>
					<!-- end timeline-body -->
				</li>
                @elseif($user->status_permohonan == "Diterima")
                <li>
					<!-- begin timeline-time -->
					<div class="timeline-time">
						<span class="date">Selesai</span>
						<span class="time">{{ \Carbon\Carbon::parse($user->diubah)->format('d M Y') }}</span>
					</div>
					<!-- end timeline-time -->
					<!-- begin timeline-icon -->
					<div class="timeline-icon">
						<a href="javascript:;">&nbsp;</a>
					</div>
					<!-- end timeline-icon -->
					<!-- begin timeline-body -->
					<div class="timeline-body">
						<div class="timeline-header">  
                            <span class="username" style="text-transform:uppercase;">KODE BOOKING : {{$user->kode_booking}}</span>                        
                            <span class="views inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800">Pengajuan Anda {{ $user->status_permohonan }} <i class="fa fa-check-circle text-green"></i></span>
							
						</div>
						<div class="timeline-content" style="text-transform:capitalize;">
							<p>
                                Catatan : {{$user->catatan}}
							</p>
						</div>
					</div>
					<!-- end timeline-body -->
				</li>
                @else
                <li>
					<!-- begin timeline-time -->
					<div class="timeline-time">
						<span class="date">Selesai</span>
						<span class="time">{{ \Carbon\Carbon::parse($user->diubah)->format('d M Y') }}</span>
					</div>
					<!-- end timeline-time -->
					<!-- begin timeline-icon -->
					<div class="timeline-icon">
						<a href="javascript:;">&nbsp;</a>
					</div>
					<!-- end timeline-icon -->
					<!-- begin timeline-body -->
					<div class="timeline-body">
						<div class="timeline-header">                            
                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800">Pengajuan Anda {{ $user->status_permohonan }}</span>
							<span class="views" style="text-transform:capitalize;"><i class="fa fa-times text-red"></i></span>
						</div>
						<div class="timeline-content" style="text-transform:capitalize;">
							<p>
                                Catatan : {{$user->catatan}}
							</p>
						</div>
					</div>
					<!-- end timeline-body -->
				</li>
                @endif
			</ul>
        <div class="bg-white shadow-sm border p-[25px] mt-3">
            <div class="border-b border-neutral-200 pb-3 font-medium" style="font-size: 14px">
                <h1>Data User - {{ $user->name }}</h1>
            </div>
            <div class="grid grid-cols-4 gap-x-3 gap-y-10 mt-4">
                <div class="">
                    <h3 class="font-medium">Nama</h3>
                    <p class="pt-2 text-neutral-500">{{ $user->name }}</p>
                </div>
                <div class="">
                    <h3 class="font-medium">Email</h3>
                    <p class="pt-2 text-neutral-500">{{ $user->email }}</p>
                </div>
                <div class="">
                    <h3 class="font-medium">NIK</h3>
                    <p class="pt-2 text-neutral-500">{{ $user->nik }}</p>
                </div>
                <div class="">
                    <h3 class="font-medium">Alamat</h3>
                    <p class="pt-2 text-neutral-500">{{ $user->alamat }}</p>
                </div>
                <div class="">
                    <h3 class="font-medium">No Telepon</h3>
                    <p class="pt-2 text-neutral-500">{{ $user->no_telp }}</p>
                </div>
                <div class="">
                    <h3 class="font-medium">Instansi</h3>
                    <p class="pt-2 text-neutral-500">{{ $user->nama_instansi }}</p>
                </div>
                <div class="">
                    <h3 class="font-medium">Alamat Instansi</h3>
                    <p class="pt-2 text-neutral-500">{{ $user->alamat_instansi }}</p>
                </div>
                <div class="">
                    <h3 class="font-medium">Nama Organisasi</h3>
                    <p class="pt-2 text-neutral-500">{{ $user->nama_organisasi }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-sm border p-[25px] mt-5">
                    <div class="border-b border-neutral-200 pb-3 font-medium" style="font-size: 14px">
                        <h1>Identitas Permohonan - {{ $user->name }}</h1>
                    </div>
                    <div class="grid grid-cols-4 gap-x-3 gap-y-10 mt-4">
                        <div class="">
                            <h3 class="font-medium">SKPD/Non SKPD</h3>
                            <p class="pt-2 text-neutral-500">{{ $user->skpd }}</p>
                        </div>
                        <div class="">
                            <h3 class="font-medium">Bidang Kegiatan</h3>
                            <p class="pt-2 text-neutral-500">{{ $user->nama_bidang }}</p>
                        </div>
                        <div class="">
                            <h3 class="font-medium">No KTP</h3>
                            <p class="pt-2 text-neutral-500">{{ $user->nik }}</p>
                        </div>
                        <div class="">
                            <h3 class="font-medium">Nama Pemohon</h3>
                            <p class="pt-2 text-neutral-500">{{ $user->name }}</p>
                        </div>
                        <div class="">
                            <h3 class="font-medium">No Telepon</h3>
                            <p class="pt-2 text-neutral-500">{{ $user->no_telp }}</p>
                        </div>
                        <div class="">
                            <h3 class="font-medium">Alamat Lengkap</h3>
                            <p class="pt-2 text-neutral-500">{{ $user->alamat }}</p>
                        </div>
                        <div class="">
                            <h3 class="font-medium">Nama Instansi/Pribadi</h3>
                            <p class="pt-2 text-neutral-500"></p>
                        </div>
                        <div class="">
                            <h3 class="font-medium">Status dalam Instansi/Pribadi</h3>
                            <p class="pt-2 text-neutral-500">{{ $user->status_instansi }}</p>
                        </div>
                        <div class="">
                            <h3 class="font-medium">Bidang Instansi/Pribadi</h3>
                            <p class="pt-2 text-neutral-500">{{ $user->bidang_instansi }}</p>
                        </div>
                        <div class="">
                            <h3 class="font-medium">Alamat Instansi/Pribadi</h3>
                            <p class="pt-2 text-neutral-500">{{ $user->alamat_instansi }}</p>
                        </div>
                    </div>
                </div>
        </div>

        <div class="bg-white shadow-sm border p-[25px] mt-5">
                    <div class="border-b border-neutral-200 pb-3 font-medium" style="font-size: 14px">
                        <h1>Kegiatan - {{ $user->name }}</h1>
                    </div>
                    <div class="grid grid-cols-4 gap-x-3 gap-y-10 mt-4">
                        <div class="">
                            <h3 class="font-medium">Nama Kegiatan</h3>
                            <p class="pt-2 text-neutral-500">{{ $user->nama_kegiatan }}</p>
                        </div>
                        <div class="">
                            <h3 class="font-medium">Jumlah Peserta</h3>
                            <p class="pt-2 text-neutral-500">{{ $user->jumlah_peserta }}</p>
                        </div>
                        <div class="">
                            <h3 class="font-medium">Narasumber</h3>
                            <p class="pt-2 text-neutral-500">{{ $user->narasumber }}</p>
                        </div>
                        <div class="">
                            <h3 class="font-medium">Ringkasan</h3>
                            <p class="pt-2 text-neutral-500">{{ $user->ringkasan }}</p>
                        </div>
                        <div class="">
                            <h3 class="font-medium">Surat Permohonan</h3>
                            <div class="gallery ml-2 mt-2">
                                <a href="/file_upload/{{ $user->surat_permohonan }}" data-lightbox="gallery-group-1">
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
                                <a href="/file_upload/{{ $user->rundown_acara }}" data-lightbox="gallery-group-1">
                                    <div class="flex flex-row items-center gap-2">
                                        <img src="{{ asset('/assets/img/auth/google-docs.png') }}" class="w-[30px]" />
                                        <p style="font-size: 12px" class="text-blue-500">Lihat File</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="">
                            <h3 class="font-medium">Output</h3>
                            <p class="pt-2 text-neutral-500">{{ $user->output }}</p>
                        </div>
                        <div class="">
                            <h3 class="font-medium">Outcome</h3>
                            <p class="pt-2 text-neutral-500">{{ $user->outcome }}</p>
                        </div>
                    </div>
                </div>

               
        </div>

        <div class="bg-white shadow-sm border p-[25px] mt-5">
                    <div class="border-b border-neutral-200 pb-3 font-medium" style="font-size: 14px">
                        <h1>Peminjaman - {{ $user->name }}</h1>
                    </div>
                    <div class="grid grid-cols-4 gap-x-3 gap-y-10 mt-4">
                        <div class="">
                            <h3 class="font-medium">Tanggal Mulai</h3>
                            <p class="pt-2 text-neutral-500">{{ \Carbon\Carbon::parse($user
                                ->tgl_mulai)->format('d M Y') }}</p>
                        </div>
                        <div class="">
                            <h3 class="font-medium">Jam Mulai</h3>
                            <p class="pt-2 text-neutral-500">{{ sprintf("%02d", $user->jam_mulai) }}:00</p>
                        </div>
                        <div class="">
                            <h3 class="font-medium">Tanggal Selesai</h3>
                            <p class="pt-2 text-neutral-500">{{ \Carbon\Carbon::parse($user
                                ->tgl_selesai)->format('d M Y') }}</p>
                        </div>
                        <div class="">
                            <h3 class="font-medium">Jam Selesai</h3>
                            <p class="pt-2 text-neutral-500">{{ sprintf("%02d", $user->jam_selesai) }}:00</p>
                        </div>
                        <div class="">
                            <h3 class="font-medium">Fasilitas</h3>
                            <p class="pt-2 text-neutral-500">
                                @php
                                    $inputUser = $user->id_fasilitas;
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
                            <p class="pt-2 text-neutral-500">
                                @php
                                    $inputUser = $user->id_alat;
                                    $arrayFasilitas = explode(",", $inputUser);
                                    $fasilitas = \App\Models\AlatPendukung::whereIn('id_alat_pendukung', $arrayFasilitas)->pluck('nama_alat');
                                    $arrayNamaFasilitas = $fasilitas->toArray();
                                    $stringNamaFasilitas = implode(", ", $arrayNamaFasilitas);
                                    echo $stringNamaFasilitas;
                                @endphp
                            </p>
                        </div>
                    </div>
                </div>

            <div class="bg-white shadow-sm border p-[25px] mt-5">
                    <div class="border-b border-neutral-200 pb-3 font-medium" style="font-size: 14px">
                        <h1>Status Permohonan - {{ $user->name }}</h1>
                    </div>
                    <div class="grid grid-cols-4 gap-x-3 gap-y-10 mt-4">
                        <div class="">
                            <h3 class="font-medium">Tanggal Pengajuan</h3>
                            <p class="pt-2 text-neutral-500">{{ \Carbon\Carbon::parse($user
                                ->created_at)->format('d M Y - H:i') }}</p>
                        </div>
                        <div class="">
                            <h3 class="font-medium mb-2">Status Permohonan</h3>
                            @if ($user->status_permohonan === 'Diterima')
                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ $user->status_permohonan }}</span>
                            @elseif ($user->status_permohonan === 'Ditolak')
                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800">{{ $user->status_permohonan }}</span>
                            @else 
                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-yellow-200 text-yellow-800">{{ $user->status_permohonan }}</span>
                            @endif
                        </div>
                        <div class="">
                            <h3 class="font-medium">Catatan Admin</h3>
                            <p class="pt-2 text-neutral-500">{{ $user->catatan }}</p>
                        </div>
                    </div>
                </div>

        </div>
        
@endsection
