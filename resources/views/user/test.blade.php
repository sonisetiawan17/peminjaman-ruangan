@extends('layouts.landing')

@section('content')

<main class="bg-[#f7f7f8] mx-[12px] md:mx-[50px] lg:mx-[128px]">
    <div class="lg:grid lg:grid-cols-[20%,1fr] gap-5">
        <div class="pt-[100px] lg:pt-[100px]">
            <div class="bg-white p-4 rounded-xl mt-3" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                <div class="flex flex-col items-center justify-center gap-y-3">
                    <img src="{{ asset('/assets/img/auth/profile.png') }}" class="h-20" />
                    <h1 class="font-medium">{{ Auth::user()->name }}</h1>
                    <p class="text-neutral-400 text-center" style="font-size: 11px">{{ Auth::user()->instansi->nama_instansi }}</p>
                </div>
                <div class="w-full h-[1px] bg-gray-300 my-4"></div>
                <div>
                    <div class="flex flex-col gap-y-1">
                        <p class="font-semibold">NIK</p>
                        <p class="text-neutral-500">{{ Auth::user()->nik }}</p>
                    </div>

                    <div class="flex flex-col gap-y-1 mt-3">
                        <p class="font-semibold">No Telepon</p>
                        <p class="text-neutral-500">{{ Auth::user()->no_telp }}</p>
                    </div>
                </div>
                <div class="w-full h-[1px] bg-gray-300 my-4"></div>
                <div>
                    <div class="flex flex-col gap-y-1 mt-3">
                        <p class="font-semibold">Permohonan Bulan Ini</p>
                        <p class="text-neutral-500">{{ $permohonan_bulan_ini }} total permohonan</p>
                    </div>
                    <div class="flex flex-col gap-y-1 mt-3">
                        <p class="font-semibold">Semua Permohonan</p>
                        <p class="text-neutral-500">{{ $semua_permohonan }} total permohonan</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-[24px] lg:mt-[100px]">
            <div class="bg-white p-4 rounded-xl mt-3 min-w-full" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                <div>
                    <ul class="flex whitespace-nowrap overflow-x-auto lg:flex-row gap-x-14 items-center font-medium border-b border-neutral-300 pb-3 w-full" id="tabList">
                        <li class="text-center cursor-pointer" onclick="showPage('history', this)">Histori Permohonan</li>
                        <li class="text-center cursor-pointer" onclick="showPage('dashboard', this)">Statistik Permohonan</li>
                        <li class="text-center cursor-pointer" onclick="showPage('profile', this)">Profil Saya</li>
                        {{-- <li class="text-center cursor-pointer" onclick="showPage('schedule', this)">Jadwal</li> --}}
                    </ul>
    
                    {{-- <div class="w-[150px] bg-primary h-1 -mt-1 rounded-sm"></div> --}}
                </div>

                <div id="historyPage" class="hide">
                    <div class="mt-4 flex flex-row items-center justify-between">
                        <h1 class="font-medium text-lg">Histori Permohonan</h1>
                        <div class="">
                            <select class="text-xs rounded-sm border border-gray-300" name="skpd">
                                <option value="semua_waktu" selected>Semua Waktu</option>
                                <option value="tujuh_hari">7 Hari Terakhir</option>
                                <option value="sepuluh_hari">14 Hari Terakhir</option>
                                <option value="satu_bulan">1 Bulan Terakhir</option>
                                <option value="tiga_bulan">3 Bulan Terakhir</option>
                                <option value="enam_bulan">6 Bulan Terakhir</option>
                                <option value="dua_belas_bulan">12 Bulan Terakhir</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-3 border border-neutral-400">
                        <div class="bg-slate-200 border border-neutral-400 flex flex-row items-center justify-between">
                            <h1 class="font-semibold head">Permohonan</h1>
                            <input type="text" class="form-control form-input text-small w-1/2 md:w-1/4 mr-3" style="border-radius: 5px" name="search" id="search" placeholder="Cari disini..." />
                        </div>
                        <div class="bg-white">
                            <div class="flex flex-col head">
                                <div class="-m-1.5 overflow-x-auto">
                                  <div class="p-1.5 min-w-full inline-block align-middle">
                                    <div class="border overflow-hidden">
                                      <table class="min-w-full divide-y divide-gray-200">
                                        <thead>
                                          <tr class="divide-x divide-gray-200">
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Nama Kegiatan</th>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Surat Permohonan</th>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Rundown Acara</th>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Status</th>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                          </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200" id="table-body">
                                            @foreach ($permohonan as $data)
                                            <tr class="divide-x divide-gray-200">
                                                <td class="px-3 py-4 whitespace-nowrap text-xs text-gray-800">{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y') }}</td>
                                                <td class="px-3 py-4 whitespace-nowrap text-xs text-gray-800">{{ $data->nama_kegiatan }}</td>
                                                <td class="px-3 py-4 text-xs text-gray-800">
                                                    <div class="ml-2">
                                                        <a href="/file_upload/{{ $data->surat_permohonan }}">
                                                            <div class="flex flex-row items-center gap-2">
                                                                <img src="{{ asset('/assets/img/auth/google-docs.png') }}" class="w-[30px]" />
                                                                <p style="font-size: 12px" class="text-blue-500">Lihat File</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="px-3 py-4 text-xs text-gray-800">
                                                    <div class="ml-2">
                                                        <a href="/file_upload/{{ $data->rundown_acara }}">
                                                            <div class="flex flex-row items-center gap-2">
                                                                <img src="{{ asset('/assets/img/auth/google-docs.png') }}" class="w-[30px]" />
                                                                <p style="font-size: 12px" class="text-blue-500">Lihat File</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="px-3 py-4 whitespace-nowrap text-xs text-gray-800">
                                                    <div class="flex items-center gap-x-3 whitespace-nowrap">
                                                        <div class="flex w-full h-2 bg-gray-200 rounded-full overflow-hidden"
                                                            role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                                            aria-valuemax="100">
                                                            @if ($data->status_permohonan == 'Menunggu')
                                                                <div class="flex flex-col justify-center rounded-full overflow-hidden bg-yellow-500 text-xs text-white text-center whitespace-nowrap transition duration-500"
                                                                style="width: 50%"></div>
                                                            @elseif ($data->status_permohonan == 'Diterima')
                                                                <div class="flex flex-col justify-center rounded-full overflow-hidden bg-teal-500 text-xs text-white text-center whitespace-nowrap transition duration-500"
                                                                style="width: 100%"></div>
                                                            @else 
                                                                <div class="flex flex-col justify-center rounded-full overflow-hidden bg-red-500 text-xs text-white text-center whitespace-nowrap transition duration-500"
                                                                style="width: 100%"></div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="clearfix f-s-10 pt-1" style="font-size: 11px">
                                                        Status:
                                                        <b class="text-inverse" data-id="widget-elm" data-light-class="text-inverse"
                                                            data-dark-class="text-white">{{ $data->status_permohonan }}</b>
                                                    </div>
                                                </td>
                                                <td class="px-3 py-4 whitespace-nowrap text-xs text-gray-800">
                                                    <div class="flex items-center gap-2">
                                                        <a href="{{ route('user.lihatPermohonan', $data->id_permohonan) }}">
                                                            <button class="py-2 px-[10px] border border-gray-500 rounded"><i class="fa-solid fa-eye text-gray-500"></i></button>
                                                        </a>

                                                        @if ($data->status_permohonan === 'Ditolak')
                                                        <a href="{{ route('user.editPermohonan', $data->id_permohonan) }}">
                                                            <button class="py-2 px-[10px] border border-gray-500 rounded"><i class="fa-solid fa-edit text-blue-500"></i></button>
                                                        </a>
                                                        @endif 

                                                        @if ($data->status_permohonan === 'Diterima')
                                                        <a href="{{ route('user.cetakPermohonan', $data->id_permohonan) }}" target="_blank">
                                                            <button class="py-2 px-[10px] border border-gray-500 rounded bg-green-500 text-white"><i class="fa-solid fa-print text-white mr-2"></i>Cetak</button>
                                                        </a>

                                                        <!-- <a href="{{ route('user.view-qr', $data->id_permohonan) }}" target="_blank">
                                                            <button class="py-2 px-[10px] border border-gray-500 rounded bg-green-500 text-white">Liat</button>
                                                        </a> -->

                                                        @endif 

                                                        {{-- @if ($data->status_permohonan === 'Diterima')
                                                        <a href="{{ route('user.cetakPermohonan', $data->id_permohonan) }}" target="_blank">
                                                            <button class="py-2 px-[10px] border border-gray-500 rounded bg-green-500 text-white"><i class="fa-solid fa-print text-white mr-2"></i>Cetak</button>
                                                        </a>
                                                        @endif  --}}

                                                        {{-- <form action="{{ route('user.hapusPermohonan', $data->id_permohonan) }}" method="POST">
                                                            @csrf 
                                                            @method("DELETE")
                                                            <button type="submit" class="py-2 px-[10px] border border-gray-500 rounded" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><i class="fa-solid fa-trash text-red-500"></i></button>
                                                        </form> --}}

                                                    </div>
                                                </td>                           
                                            </tr>
                                            @endforeach 
                                        </tbody>
                                      </table>
                                    </div>
                                    <div>
                                        {{ $permohonan->links() }}
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>
                    <div class="mt-4">

                    </div>
                </div> 
    
                <div id="dashboardPage">
                    <div class="mt-4">
                        <h1 class="font-medium text-lg">Statisik Permohonan</h1>
                    </div>
                    <div class="flex flex-col lg:flex-none md:grid md:grid-cols-3 gap-x-7 pt-4 gap-y-3">            
                        <div class="yellow-gradient px-[20px] py-[20px] rounded-xl">
                            <p class="text-white">Data permohonan</p>
                            <div class="flex flex-row items-end gap-x-5 pt-3">
                                <div class="px-[16px] py-[12px] rounded-full bg-white">
                                    <i class="fa fa-spinner text-xl text-yellow-500"></i>
                                </div>
                                <div class="flex flex-col items-center text-white">
                                    <p class="font-semibold" style="font-size: 18px">{{ $status_menunggu }}</p>
                                    <p style="font-size: 13px">Dalam Proses</p>
                                </div>
                            </div>
                        </div>
            
                        <div class="red-gradient px-[20px] py-[20px] rounded-xl">
                            <p class="text-white">Data permohonan</p>
                            <div class="flex flex-row items-end gap-x-5 pt-3">
                                <div class="px-[16px] py-[12px] rounded-full bg-white">
                                    <i class="fa fa-ban text-xl text-red-500"></i>
                                </div>
                                <div class="flex flex-col items-center text-white">
                                    <p class="font-semibold" style="font-size: 18px">{{ $status_ditolak }}</p>
                                    <p style="font-size: 13px">Ditolak</p>
                                </div>
                            </div>
                        </div>
            
                        <div class="green-gradient px-[20px] py-[20px] rounded-xl">
                            <p class="text-white">Data permohonan</p>
                            <div class="flex flex-row items-end gap-x-5 pt-3">
                                <div class="px-[16px] py-[12px] rounded-full bg-white">
                                    <i class="fa fa-check text-xl text-green-500"></i>
                                </div>
                                <div class="flex flex-col items-center text-white">
                                    <p class="font-semibold" style="font-size: 18px">{{ $status_diterima }}</p>
                                    <p style="font-size: 13px">Disetujui</p>
                                </div>
                            </div>
                        </div>
            
                    </div>
                    <div class="mt-5">
                        <h1 class="font-medium text-lg mb-5">Chart Statistik Permohonan</h1>
                        <canvas id="barChart" height="150px"></canvas>
                    </div> 
                </div>
                
                <div id="profilePage" class="hide">
                    <div class="mt-4">
                        <h1 class="font-medium text-lg">Profil Saya</h1>
                        <div class="pt-4">
                            <div class="flex flex-row items-center gap-x-4 relative">
                                <img src="{{ asset('/assets/img/auth/profile.png') }}" class="h-20" />
                                <div class="flex flex-col items-start gap-y-1">
                                    <p class="font-medium" style="font-size: 13px">{{ Auth::user()->name }}</p>
                                    <p class="text-neutral-600">User</p>
                                    <p class="text-neutral-500">{{ Auth::user()->instansi->nama_instansi }}</p>
                                </div>
                                <div class="absolute top-1/2 right-0 transform -translate-y-1/2" id="modal_show" type="button" data-toggle="modal" data-target="#isimodalprofile" data-name="{{ Auth::user()->name }}" data-instansi_id="{{ Auth::user()->instansi_id }}">
                                    <button class="border border-gray-400 py-2 px-3 text-neutral-600 rounded-2xl flex flex-row items-center gap-x-2">
                                        Edit 
                                        <img src="{{ asset('/assets/img/auth/edit.png') }}" class="h-4" />
                                    </button>
                                </div>
                            </div>

                            {{-- Start Modal --}}

                            <div class="modal fade" id="isimodalprofile">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Profile Saya</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body mx-3" id="tampil_modal">
                                            <form method="post" action="{{ route('user.ubahProfileSaya') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="hidden" name="id" id="id" value="{{ Auth::user()->id }}" />
                                                    <label class="col-form-label font-semibold">Nama <sup class="text-red-500">*</sup></label>
                                                    <div class="block">
                                                        <input type="text" class="form-control form-input text-small" name="name" id="name" required />
                                                    </div>
                                                    
                                                    <label class="col-form-label mt-3 font-semibold">Instansi <sup class="text-red-500">*</sup></label>
                                                    <div class="block">
                                                        <select class="w-full text-xs rounded-sm border border-gray-300" id="instansi_id" name="instansi_id" required>
                                                            <option value="" disabled selected>-- Pilih Instansi --</option>
                                                            @foreach ($instansi as $i)
                                                                    <option value="{{ $i->id_instansi }}">{{ $i->nama_instansi }}
                                                                    </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer font-semibold text-sm">
                                            <a href="javascript:;" class="button-ghost" data-dismiss="modal">Tutup</a>
                                            <button type="submit" id="button" class="button-primary">Lanjutkan</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- End Modal --}}
                            
                            <div class="pt-6">
                                <div class="flex flex-row items-center justify-between">
                                    <h1 class="font-medium">Personal Information</h1>
                                    <button class="border border-gray-400 py-2 px-3 text-neutral-600 rounded-2xl flex flex-row items-center gap-x-2" id="modal_show_second" type="button" data-toggle="modal" data-target="#isimodalpersonal" data-name="{{ Auth::user()->name }}" data-email="{{ Auth::user()->email }}" data-no_telp="{{ Auth::user()->no_telp }}" data-alamat="{{ Auth::user()->alamat }}">
                                        Edit 
                                        <img src="{{ asset('/assets/img/auth/edit.png') }}" class="h-4" />
                                    </button>
                                </div>
    
                                <div class="pt-3 md:grid md:grid-cols-[40%,1fr] gap-x-3 gap-y-10">
                                    <div class="mt-[20px] lg:mt-0">
                                        <h3 class="font-medium text-neutral-500">Nama</h3>
                                        <p class="pt-2">{{ Auth::user()->name }}</p>
                                    </div>
                                    <div class="mt-[20px] lg:mt-0">
                                        <h3 class="font-medium text-neutral-500">Email</h3>
                                        <p class="pt-2">{{ Auth::user()->email }}</p>
                                    </div>
                                    <div class="mt-[20px] lg:mt-0">
                                        <h3 class="font-medium text-neutral-500">Email Verified</h3>
                                        <p class="pt-2">
                                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800">Belum Verifikasi</span>
                                        </p>
                                    </div>
                                    <div class="mt-[20px] lg:mt-0">
                                        <h3 class="font-medium text-neutral-500">No Telepon</h3>
                                        <p class="pt-2">{{ Auth::user()->no_telp }}</p>
                                    </div>
                                    <div class="mt-[20px] lg:mt-0">
                                        <h3 class="font-medium text-neutral-500">Alamat</h3>
                                        <p class="pt-2">{{ Auth::user()->alamat }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Start Modal --}}

                            <div class="modal fade" id="isimodalpersonal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Personal Information</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body mx-3" id="tampil_modal_second">
                                            <form method="post" action="{{ route('user.ubahPersonalInformation') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="hidden" name="id" id="id" value="{{ Auth::user()->id }}" />
                                                    <label class="col-form-label font-semibold">Nama <sup class="text-red-500">*</sup></label>
                                                    <div class="block">
                                                        <input type="text" class="form-control form-input text-small" name="name" id="name"  required />
                                                    </div>

                                                    <label class="col-form-label font-semibold mt-3">Email <sup class="text-red-500">*</sup></label>
                                                    <div class="block">
                                                        <input type="text" class="form-control form-input text-small" name="email" id="email"  required />
                                                    </div>
                                                    
                                                    <label class="col-form-label font-semibold mt-3">No Telepon <sup class="text-red-500">*</sup></label>
                                                    <div class="block">
                                                        <input type="text" class="form-control form-input text-small" name="no_telp" id="no_telp"  required />
                                                    </div>

                                                    <label class="col-form-label font-semibold mt-3">Alamat <sup class="text-red-500">*</sup></label>
                                                    <div class="block">
                                                        <input type="text" class="form-control form-input text-small" name="alamat" id="alamat"  required />
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer font-semibold text-sm">
                                            <a href="javascript:;" class="button-ghost" data-dismiss="modal">Tutup</a>
                                            <button type="submit" id="button" class="button-primary">Lanjutkan</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- End Modal --}}
    
                            <div class="w-full h-[1px] bg-gray-300 my-8"></div>
    
                            <div>
                                <div class="flex flex-row items-center justify-between">
                                    <h1 class="font-medium">Instansi / Organisasi</h1>
                                    <button class="border border-gray-400 py-2 px-3 text-neutral-600 rounded-2xl flex flex-row items-center gap-x-2" id="modal_show_third" type="button" data-toggle="modal" data-target="#isimodalinstansi" data-instansi_id="{{ Auth::user()->instansi_id }}" data-nama_organisasi="{{ Auth::user()->nama_organisasi }}">
                                        Edit 
                                        <img src="{{ asset('/assets/img/auth/edit.png') }}" class="h-4" />
                                    </button>
                                </div>
    
                                <div class="pt-3 md:grid md:grid-cols-[40%,1fr] gap-x-3 gap-y-10">
                                    <div class="mt-[20px] lg:mt-0">
                                        <h3 class="font-medium text-neutral-500">Instansi</h3>
                                        <p class="pt-2 pr-5">{{ Auth::user()->instansi->nama_instansi }}</p>
                                    </div>
                                    <div class="mt-[20px] lg:mt-0">
                                        <h3 class="font-medium text-neutral-500">Nama Organisasi</h3>
                                        @if (Auth::user()->nama_organisasi === null)
                                            <p class="pt-2">-</p>
                                        @else 
                                            <p class="pt-2">{{ Auth::user()->nama_organisasi }}</p>
                                        @endif 
                                    </div>
                                </div>

                                <div class="modal fade" id="isimodalinstansi">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Instansi / Organisasi</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body mx-3" id="tampil_modal_third">
                                                <form method="post" action="{{ route('user.ubahInstansi') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input type="hidden" name="id" id="id" value="{{ Auth::user()->id }}" />
                                                        <label class="col-form-label font-semibold">Instansi <sup class="text-red-500">*</sup></label>
                                                        <div class="block">
                                                            <select class="w-full text-xs rounded-sm border border-gray-300" id="instansi_id" name="instansi_id" required>
                                                                <option value="" disabled selected>-- Pilih Instansi --</option>
                                                                @foreach ($instansi as $i)
                                                                        <option value="{{ $i->id_instansi }}">{{ $i->nama_instansi }}
                                                                        </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
    
                                                        <label class="col-form-label font-semibold mt-3">Nama Organisasi <sup class="text-red-500">*</sup></label>
                                                        <div class="block">
                                                            <input type="text" class="form-control form-input text-small" name="nama_organisasi" id="nama_organisasi"  required />
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer font-semibold text-sm">
                                                <a href="javascript:;" class="button-ghost" data-dismiss="modal">Tutup</a>
                                                <button type="submit" id="button" class="button-primary">Lanjutkan</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                </div>
                </div>
                
                <div id="schedulePage" class="hide">
                    <div class="mt-4">
                        <h1 class="font-medium text-lg">Jadwal</h1>
                    </div>
                </div>        
            </div>
        </div>
    </div>

    <div class="mt-24">
    </div>
</main>

<script type="text/javascript">
    $(document).on("click", "#modal_show", function() {
        var name = $(this).data('name');
        var instansi_id = $(this).data('instansi_id');

        $("#tampil_modal #name").val(name);
        $("#tampil_modal #instansi_id").val(instansi_id);
    })

    $(document).on("click", "#modal_show_second", function() {
        var name = $(this).data('name');
        var email = $(this).data('email');
        var no_telp = $(this).data('no_telp');
        var alamat = $(this).data('alamat');

        $("#tampil_modal_second #name").val(name);
        $("#tampil_modal_second #email").val(email);
        $("#tampil_modal_second #no_telp").val(no_telp);
        $("#tampil_modal_second #alamat").val(alamat);
    })

    $(document).on("click", "#modal_show_third", function() {
        var instansi_id = $(this).data('instansi_id');
        var nama_organisasi = $(this).data('nama_organisasi');

        $("#tampil_modal_third #instansi_id").val(instansi_id);
        $("#tampil_modal_third #nama_organisasi").val(nama_organisasi);
    })


    $(document).ready(function () {
        $('#search').on('input', function () {
            var searchText = $(this).val().toLowerCase();
            
            $('#table-body tr').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
            });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    function showPage(pageName, tab) {
        document.getElementById('dashboardPage').classList.add('hide');
        document.getElementById('profilePage').classList.add('hide');
        document.getElementById('schedulePage').classList.add('hide');
        document.getElementById('historyPage').classList.add('hide');

        Array.from(document.getElementById('tabList').getElementsByTagName('li')).forEach(item => {
            item.classList.remove('active');
        });

        document.getElementById(pageName + 'Page').classList.remove('hide');

        tab.classList.add('active');
    }

    showPage('history', document.getElementById('tabList').querySelector('li'));

    const barctx = document.getElementById('barChart');

    new Chart(barctx, {
        type: 'bar',
        data: {
            labels: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'Mei',
                'Jun',
                'Jul',
                'Agu',
                'Sep',
                'Okt',
                'Nov',
                'Des',
            ],
            datasets: [{
                label: 'Aula',
                data: [65, 59, 80, 81, 56, 55, 40, 30, 90, 75, 60, 85],
                borderWidth: 1,
                borderRadius: 5, 
            },
            {
                label: 'Multimedia',
                data: [65, 59, 80, 81, 56, 55, 40, 30, 90, 75, 60, 85],
                borderWidth: 1,
                borderRadius: 5,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    });
</script>

@endsection
