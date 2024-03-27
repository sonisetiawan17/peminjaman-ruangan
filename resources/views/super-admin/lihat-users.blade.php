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

    <div class="mt-4">
        <div class="mb-5 text-lg flex flex-row items-end justify-between">
            <div class="flex flex-row items-center gap-x-1">
                <i class="fa fa-user mr-2"></i>
                <h1>Detail User - {{ $user->name }}</h1>
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
                                Users</a>
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

        <div class="grid grid-cols-4 gap-x-7">
            <div class="bg-white shadow-sm px-[20px] py-[20px] rounded-sm">
                <p class="text-neutral-500">Data permohonan</p>
                <div class="flex flex-row items-end gap-x-5 pt-3">
                    <div class="px-[18px] py-[12px] rounded-full bg-violet-300">
                        <i class="fa fa-clipboard-check text-xl text-black"></i>
                    </div>
                    <div class="flex flex-col items-center">
                        <p class="font-semibold" style="font-size: 18px">{{ $jumlah_permohonan > 0 ? $jumlah_permohonan : 0 }}</p>
                        <p style="font-size: 13px">Bulan Ini</p>
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
                        <p class="font-semibold" style="font-size: 18px">{{ $status_menunggu }}</p>
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
                        <p class="font-semibold" style="font-size: 18px">{{ $status_ditolak }}</p>
                        <p style="font-size: 13px">Ditolak</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm px-[20px] py-[20px] rounded-sm">
                <p class="text-neutral-500">Data permohonan</p>
                <div class="flex flex-row items-end gap-x-5 pt-3">
                    <div class="px-[16px] py-[12px] rounded-full bg-green-300">
                        <i class="fa fa-check text-xl text-black"></i>
                    </div>
                    <div class="flex flex-col items-center">
                        <p class="font-semibold" style="font-size: 18px">{{ $status_diterima }}</p>
                        <p style="font-size: 13px">Disetujui</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-sm border p-[25px] mt-5">
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
                    <p class="pt-2 text-neutral-500">{{ $user->instansi->nama_instansi }}</p>
                </div>
                <div class="">
                    <h3 class="font-medium">Alamat Instansi</h3>
                    <p class="pt-2 text-neutral-500">{{ $user->instansi->alamat_instansi }}</p>
                </div>
                <div class="">
                    <h3 class="font-medium">Nama Organisasi</h3>
                    <p class="pt-2 text-neutral-500">{{ $user->nama_organisasi }}</p>
                </div>
            </div>
        </div>
    </div>

@endsection
