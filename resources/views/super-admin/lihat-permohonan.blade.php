@extends('layouts.super')

@section('title', 'Dashboard V2')

@section('content')

    <main class="bg-[#f7f7f8]">
        <div class="mt-[20px]">
            <div class="bg-white p-4 rounded-xl mt-3" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                <div class="border-b border-neutral-300 py-3 mx-[20px]">
                    <a href="{{ route('superadmin.history_permohonan') }}">
                        <button class="button-ghost rounded-md"><i class="fa fa-arrow-left mr-1"></i> Kembali</button>
                    </a>
                </div>

                <div class="mt-3 p-[20px]">
                    <div class="bg-white shadow-sm border p-[25px]">
                        <div class="border-b border-neutral-200 pb-3 font-medium" style="font-size: 14px">
                            <h1>Identitas Permohonan - {{ $data->name }}</h1>
                        </div>
                        <div class="grid grid-cols-4 gap-x-3 gap-y-10 mt-4">
                            <div class="">
                                <h3 class="font-medium">SKPD/Non SKPD</h3>
                                <p class="pt-2 text-neutral-500">{{ $data->skpd }}</p>
                            </div>
                            <div class="">
                                <h3 class="font-medium">Bidang Kegiatan</h3>
                                <p class="pt-2 text-neutral-500">{{ $data->nama_bidang }}</p>
                            </div>
                            <div class="">
                                <h3 class="font-medium">No KTP</h3>
                                <p class="pt-2 text-neutral-500">{{ $data->nik }}</p>
                            </div>
                            <div class="">
                                <h3 class="font-medium">Nama Pemohon</h3>
                                <p class="pt-2 text-neutral-500">{{ $data->name }}</p>
                            </div>
                            <div class="">
                                <h3 class="font-medium">No Telepon</h3>
                                <p class="pt-2 text-neutral-500">{{ $data->no_telp }}</p>
                            </div>
                            <div class="">
                                <h3 class="font-medium">Alamat Lengkap</h3>
                                <p class="pt-2 text-neutral-500">{{ $data->alamat }}</p>
                            </div>
                            <div class="">
                                <h3 class="font-medium">Nama Instansi/Pribadi</h3>
                                <p class="pt-2 text-neutral-500">{{ $data->nama_instansi }}</p>
                            </div>
                            <div class="">
                                <h3 class="font-medium">Status dalam Instansi/Pribadi</h3>
                                <p class="pt-2 text-neutral-500">{{ $data->status_instansi }}</p>
                            </div>
                            <div class="">
                                <h3 class="font-medium">Bidang Instansi/Pribadi</h3>
                                <p class="pt-2 text-neutral-500">{{ $data->bidang_instansi }}</p>
                            </div>
                            <div class="">
                                <h3 class="font-medium">Alamat Instansi/Pribadi</h3>
                                <p class="pt-2 text-neutral-500">{{ $data->alamat_instansi }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow-sm border p-[25px] mt-5">
                        <div class="border-b border-neutral-200 pb-3 font-medium" style="font-size: 14px">
                            <h1>Kegiatan - {{ $data->name }}</h1>
                        </div>
                        <div class="grid grid-cols-4 gap-x-3 gap-y-10 mt-4">
                            <div class="">
                                <h3 class="font-medium">Nama Kegiatan</h3>
                                <p class="pt-2 text-neutral-500">{{ $data->nama_kegiatan }}</p>
                            </div>
                            <div class="">
                                <h3 class="font-medium">Jumlah Peserta</h3>
                                <p class="pt-2 text-neutral-500">{{ $data->jumlah_peserta }} peserta</p>
                            </div>
                            <div class="">
                                <h3 class="font-medium">Narasumber</h3>
                                <p class="pt-2 text-neutral-500">{{ $data->narasumber }}</p>
                            </div>
                            <div class="">
                                <h3 class="font-medium">Ringkasan</h3>
                                <p class="pt-2 text-neutral-500">{{ $data->ringkasan }}</p>
                            </div>
                            <div class="">
                                <h3 class="font-medium">Surat Permohonan</h3>
                                <div class="gallery ml-2 mt-2">
                                    <a href="/file_upload/{{ $data->surat_permohonan }}"
                                        data-lightbox="gallery-group-1">
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
                                    <a href="/file_upload/{{ $data->rundown_acara }}"
                                        data-lightbox="gallery-group-1">
                                        <div class="flex flex-row items-center gap-2">
                                            <img src="{{ asset('/assets/img/auth/google-docs.png') }}" class="w-[30px]" />
                                            <p style="font-size: 12px" class="text-blue-500">Lihat File</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="">
                                <h3 class="font-medium">Output</h3>
                                <p class="pt-2 text-neutral-500">{{ $data->output }}</p>
                            </div>
                            <div class="">
                                <h3 class="font-medium">Outcome</h3>
                                <p class="pt-2 text-neutral-500">{{ $data->outcome }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow-sm border p-[25px] mt-5">
                        <div class="border-b border-neutral-200 pb-3 font-medium" style="font-size: 14px">
                            <h1>Peminjaman - {{ $data->name }}</h1>
                        </div>
                        <div class="grid grid-cols-4 gap-x-3 gap-y-10 mt-4">
                            <div class="">
                                <h3 class="font-medium">Tanggal Mulai</h3>
                                <p class="pt-2 text-neutral-500">
                                    {{ \Carbon\Carbon::parse($data->tgl_mulai)->format('d M Y') }}
                                </p>
                            </div>
                            <div class="">
                                <h3 class="font-medium">Jam Mulai</h3>
                                <p class="pt-2 text-neutral-500">{{ sprintf('%02d', $data->jam_mulai) }}:00</p>
                            </div>
                            <div class="">
                                <h3 class="font-medium">Tanggal Selesai</h3>
                                <p class="pt-2 text-neutral-500">
                                    {{ \Carbon\Carbon::parse($data->tgl_selesai)->format('d M Y') }}
                                </p>
                            </div>
                            <div class="">
                                <h3 class="font-medium">Jam Selesai</h3>
                                <p class="pt-2 text-neutral-500">{{ sprintf('%02d', $data->jam_selesai) }}:00</p>
                            </div>
                            <div class="">
                                <h3 class="font-medium">Fasilitas</h3>
                                <p class="pt-2 text-neutral-500">
                                    @php
                                        $inputUser = $data->id_fasilitas;
                                        $arrayFasilitas = explode(',', $inputUser);
                                        $fasilitas = \App\Models\Fasilitas::whereIn(
                                            'id_fasilitas',
                                            $arrayFasilitas,
                                        )->pluck('nama_fasilitas');
                                        $arrayNamaFasilitas = $fasilitas->toArray();
                                        $stringNamaFasilitas = implode(', ', $arrayNamaFasilitas);
                                        echo $stringNamaFasilitas;
                                    @endphp
                                </p>

                            </div>
                            <div class="">
                                <h3 class="font-medium">Alat Pendukung</h3>
                                <p class="pt-2 text-neutral-500">
                                    @php
                                        $inputUser = $data->id_alat;
                                        $arrayFasilitas = explode(',', $inputUser);
                                        $fasilitas = \App\Models\AlatPendukung::whereIn(
                                            'id_alat_pendukung',
                                            $arrayFasilitas,
                                        )->pluck('nama_alat');
                                        $arrayNamaFasilitas = $fasilitas->toArray();
                                        $stringNamaAlat = implode(', ', $arrayNamaFasilitas);
                                        echo $stringNamaAlat;
                                    @endphp
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow-sm border p-[25px] mt-5">
                        <div class="border-b border-neutral-200 pb-3 font-medium" style="font-size: 14px">
                            <h1>Status - {{ $data->name }}</h1>
                        </div>
                        <div class="grid grid-cols-4 gap-x-3 gap-y-10 mt-4">
                            <div class="">
                                <h3 class="font-medium">Tanggal Pengajuan Permohonan</h3>
                                <p class="pt-2 text-neutral-500">
                                    {{ \Carbon\Carbon::parse($data->created_at)->format('d M Y - H:i') }}
                                </p>
                            </div>
                            <div class="">
                                <h3 class="font-medium">Status Permohonan</h3>
                                @if ($data->status_permohonan === 'Diterima')
                                    <span
                                        class="mt-3 inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ $permohonan->status_permohonan }}</span>
                                @elseif ($data->status_permohonan === 'Ditolak')
                                    <span
                                        class="mt-3 inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800">{{ $data->status_permohonan }}</span>
                                @else
                                    <span
                                        class="mt-3 inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-yellow-200 text-yellow-800">{{ $data->status_permohonan }}</span>
                                @endif
                            </div>
                            <div class="">
                                <h3 class="font-medium">Catatan Admin</h3>
                                <p class="pt-2 text-neutral-500">{{ $data->catatan }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-24">
        </div>
    </main>

@endsection