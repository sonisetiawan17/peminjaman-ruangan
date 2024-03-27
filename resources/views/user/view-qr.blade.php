<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Mulish:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<link href="/assets/css/default/app.min.css" rel="stylesheet" />
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
    body{
    font-family: "Poppins", sans-serif;
    }
        hr {
          display: block;
          height: 2px;
          background: transparent;
          width: 100%;
          border: none;
          border-top: solid 1px #aaa;
          margin-top:5px;
      }
</style>
</head>
<body class="bg-light">
<div class="row">
    <div class="col-12">
        <br><br>
        <table align="center">
        <tr>
            <td style="text-align: left">
                <img src="/assets/img/auth/logo-cimahi.svg" alt="logo" width="50" height="50">
            </td>
            <td style="text-align: left">
            <center>
              <font size="4" style="text-align: left">
                PEMERINTAH KOTA CIMAHI
              </font><br />
              <font size="5">
                <b>Mal Pelayanan Publik Kota Cimahi</b>
              </font> <br />
              <font size="2">
                <i>Jl. Raden Demang Hardjakusumah No.1, Cibabat, Kec. Cimahi Utara, Kota Cimahi</i>
              </font> <br />
            </center>
          </td>
        </tr>
        <tr>
          <td colspan="3">
            <hr>
          </td>
        </tr>
      </table>
    </div>
    <div class="col-12">
        <center>
            <h1 style="font-size:20px; margin-top:25px">Tracking Booking Pemohon <b>#{{ $user->kode_booking }}</b></h1>
        </center>
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
                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800">Pengajuan Anda {{ $user->status_permohonan }}</span>
							<span class="views" style="text-transform:capitalize;"><i class="fa fa-check-circle text-green"></i></span>
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
</div>
<div class="col-1"></div>
<div class="col-10">
    
<center>
    <h1 style="font-size:20px; margin-top:25px">Detail Booking Pemohon</h1>
</center>
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

        <div class="bg-white shadow-sm border p-[25px] mt-2">
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

        <div class="bg-white shadow-sm border p-[25px] mt-2">
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

        <div class="bg-white shadow-sm border p-[25px] mt-2">
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

            <div class="bg-white shadow-sm border p-[25px] mt-2">
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
<div class="1"></div>

    </div>
</div>  
    <br><br><br><br>  
    <div class="col-12">
    <center>
        <p>copyright by :</p>
        <br>
        <div class="col-3" style="float:left; color:lightgray;">-</div>
        <div class="col-3" style="float:left;">
        <img src="/assets/img/auth/logo.png" alt="logo" width="200" height="71" style>
        </div>
        <div class="col-3" style="float:right; color:lightgray;">-</div>
        <div class="col-3" style="float:right;">
        <img src="/assets/img/auth/logo-dpmptsp.png" alt="logo" width="200" height="75">
        </div>
    </center>
    </div>
</body>
</html>