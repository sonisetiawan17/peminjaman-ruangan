@extends('layouts.landing')

@section('title', 'Buat Permohonan - Sistem Informasi Peminjaman Ruangan')

@section('content')

<main class="pt-[77px] mx-[12px] lg:mx-[140px]">
    <ul class="relative flex flex-row gap-x-2 pt-6 w-[60%] whitespace-nowrap overflow-x-auto min-w-full lg:min-w-0">
        <li class="flex items-center gap-x-2 shrink basis-0 flex-1 group">
            <div class="min-w-4 min-h-7 inline-flex justify-center items-center text-xs align-middle">
                <span class="step0 size-7 flex justify-center items-center flex-shrink-0 bg-gray-100 font-medium text-gray-800 rounded-full border-2 border-neutral-300">
                1
                </span>
                <span class="ms-2 block text-sm font-medium text-gray-500">
                Detail Permohonan
                </span>
            </div>
            <div class="divider0 w-full h-px flex-1 bg-gray-200 group-last:hidden"></div>
        </li>
    
        <li class="flex items-center gap-x-2 shrink basis-0 flex-1 group">
            <div class="min-w-4 min-h-7 inline-flex justify-center items-center text-xs align-middle">
                <span class="step1 size-7 flex justify-center items-center flex-shrink-0 bg-gray-100 font-medium text-gray-800 rounded-full border-2 border-neutral-300">
                2
                </span>
                <span class="ms-2 block text-sm font-medium text-gray-500">
                Data Instansi / Pribadi
                </span>
            </div>
            <div class="divider1 w-full h-px flex-1 bg-gray-200 group-last:hidden"></div>
        </li>
    
        <li class="flex items-center gap-x-2 shrink basis-0 flex-1 group">
            <div class="min-w-4 min-h-7 inline-flex justify-center items-center text-xs align-middle">
                <span class="step2 size-7 flex justify-center items-center flex-shrink-0 bg-gray-100 font-medium text-gray-800 rounded-full border-2 border-neutral-300">
                3
                </span>
                <span class="ms-2 block text-sm font-medium text-gray-500">
                Informasi Acara / Kegiatan
                </span>
            </div>
            <div class="divider2 w-full h-px flex-1 bg-gray-200 group-last:hidden"></div>
        </li>
    </ul>

    <div class="md:grid md:grid-cols-[65%,1fr] mt-4 mb-24">
        <form action="{{ route('user.simpanPermohonan') }}" method="POST" enctype="multipart/form-data" class="permohonan-form">
            @csrf 
            <div class="form-section">
                <h1 class="py-3 font-semibold text-xl">Detail Pemohon</h1>

                <div class="bg-white rounded-xl p-4" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                    <div class="grid grid-cols-1 gap-y-3 md:gap-y-0 md:grid-cols-2 gap-x-4">
                        <div class="w-full">
                            <label class="col-form-label font-medium">SKPD / Non SKPD <sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <select class="w-full text-xs rounded-sm border border-gray-300" id="skpd" name="skpd">
                                    <option value="" disabled selected>-- Pilih Bidang SKPD --</option>
                                    <option value="skpd">SKPD</option>
                                    <option value="non_skpd">NON SKPD</option>
                                </select>
                            </div>
                        </div>
                        <div class="w-full">
                            <label class="col-form-label font-medium">Bidang Kegiatan<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="text" class="form-control form-input text-small" name="bidang_kegiatan" id="bidang_kegiatan" />
                            </div>
                        </div>
                    </div>
                    <div class="bg-primary/20 px-7 py-2 my-2 rounded-md">
                        <small><b>Catatan :</b><br>
                            <b>SKPD</b> (acara pemerintah)<br>
                            <b>NON SKPD</b> (acara diluar pemerintah)
                        </small>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 mt-3" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                    <div class="grid grid-cols-1 gap-y-3 md:gap-y-0 md:grid-cols-2 gap-x-4">
                        <div class="w-full">
                            <label class="col-form-label font-medium">NIK <sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="text" class="form-control form-input text-small" name="nik" id="nik" value="{{ Auth::user()->nik }}" disabled />
                            </div>
                        </div>
                        <div class="w-full">
                            <label class="col-form-label font-medium">Nama Pemohon<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="hidden" class="form-control form-input text-small" value="{{ Auth::user()->id }}" name="user_id" />
                                <input type="hidden" class="form-control form-input text-small" value="" name="permohonan_id" />
                                <input type="text" class="form-control form-input text-small" name="name" id="name" value="{{ Auth::user()->name }}" disabled />
                            </div>
                        </div>
                        <div class="w-full mt-3">
                            <label class="col-form-label font-medium">No Telepon<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="text" class="form-control form-input text-small" name="no_telp" id="no_telp" value="{{ Auth::user()->no_telp }}" disabled />
                            </div>
                        </div>
                        <div class="w-full mt-3">
                            <label class="col-form-label font-medium">Email<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="text" class="form-control form-input text-small" name="email" id="email" value="{{ Auth::user()->email }}" disabled />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h1 class="py-3 font-semibold text-xl">Instansi / Pribadi</h1>

                <div class="bg-white rounded-xl p-4" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                    <div class="grid grid-cols-1 gap-y-3 md:gap-y-0 md:grid-cols-2 gap-x-4">
                        <div class="w-full">
                            <label class="col-form-label font-medium">Nama Instansi / Pribadi <sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="text" class="form-control form-input text-small" name="instansi_id" id="instansi_id" value="{{ Auth::user()->instansi_id === 21 ? Auth::user()->nama_instansi : Auth::user()->instansi->nama_instansi }}" required disabled />
                            </div>
                        </div>
                        <div class="w-full">
                            <label class="col-form-label font-medium">Alamat Instansi / Pribadi<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="text" class="form-control form-input text-small" name="alamat_instansi" id="alamat_instansi" value="{{ Auth::user()->alamat_instansi }}" required disabled />
                            </div>
                        </div>
                        <div class="w-full mt-3">
                            <label class="col-form-label font-medium">Status dalam Instansi / Pribadi<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="text" class="form-control form-input text-small" name="status_instansi" id="status_instansi" required />
                            </div>
                        </div>
                        <div class="w-full mt-3">
                            <label class="col-form-label font-medium">Bidang Instansi / Pribadi<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="text" class="form-control form-input text-small" name="bidang_instansi" id="bidang_instansi" required />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h1 class="py-3 font-semibold text-xl">Acara / Kegiatan</h1>

                <div class="bg-white rounded-xl p-4" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                    <div class="grid grid-cols-1 gap-y-3 md:gap-y-0 md:grid-cols-2 gap-x-4">
                        <div class="w-full hidden">
                            <label class="col-form-label font-medium">Tanggal Mulai<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="hidden" class="form-control form-input text-small" name="tgl_mulai" id="tgl_mulai" value="{{ $tgl_mulai }}" required />
                            </div>
                        </div>
                        <div class="w-full hidden">
                            <label class="col-form-label font-medium">Jam Mulai<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="hidden" class="form-control form-input text-small" name="jam_mulai" id="jam_mulai" value="{{ $jam_mulai }}" required />
                            </div>
                        </div>
                        <div class="w-full hidden">
                            <label class="col-form-label font-medium">Tanggal Selesai<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="hidden" class="form-control form-input text-small" name="tgl_selesai" id="tgl_selesai" value="{{ $tgl_selesai }}" required />
                            </div>
                        </div>
                        <div class="w-full hidden">
                            <label class="col-form-label font-medium">Jam Selesai<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="hidden" class="form-control form-input text-small" name="jam_selesai" id="jam_selesai" value="{{ $jam_selesai }}" required />
                            </div>
                        </div>
                        <div class="w-full">
                            <label class="col-form-label font-medium">Nama Acara / Kegiatan<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="text" class="form-control form-input text-small" name="nama_kegiatan" id="nama_kegiatan" required />
                            </div>
                        </div>
                        <div class="w-full">
                            <label class="col-form-label font-medium">Jumlah Peserta<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="text" class="form-control form-input text-small" name="jumlah_peserta" id="jumlah_peserta" required />
                            </div>
                        </div>
                        <div class="w-full mt-3">
                            <label class="col-form-label font-medium">Narasumber<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="text" class="form-control form-input text-small" name="narasumber" id="narasumber" required />
                            </div>
                        </div>
                        <div class="w-full mt-3">
                            <label class="col-form-label font-medium">Surat Permohonan<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="file" class="block w-full border border-gray-200 text-small focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none file:bg-gray-50 file:border-0 file:me-4 file:py-2 file:px-4" name="surat_permohonan" id="surat_permohonan" style="font-size: 11.5px" required />
                            </div>
                        </div>
                        <div class="w-full mt-3">
                            <label class="col-form-label font-medium">Rundown Acara<sup class="text-red-500">*</sup></label>
                            <div class="block">
                                <input type="file" class="block w-full border border-gray-200 text-small focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none file:bg-gray-50 file:border-0 file:me-4 file:py-2 file:px-4" name="rundown_acara" id="rundown_acara" style="font-size: 11.5px" required />
                            </div>
                        </div>
                        <div class="w-full mt-3">
                            <label class="col-form-label font-medium">Output</label>
                            <div class="block">
                                <input type="text" class="form-control form-input text-small" name="output" id="output" />
                            </div>
                        </div>
                        <div class="w-full mt-3">
                            <label class="col-form-label font-medium">Outcome</label>
                            <div class="block">
                                <input type="text" class="form-control form-input text-small" name="outcome" id="outcome" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 mt-3" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                    <div class="w-full">
                        <label class="col-form-label font-medium">Ringkasan Acara / Kegiatan<sup class="text-red-500">*</sup></label>
                        <div class="block">
                            <textarea class="border-gray-200 border-2 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md w-full" name="ringkasan" id="ringkasan" style="font-size: 13px" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 mt-3" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                    <div class="w-full">
                        <label class="col-form-label font-medium">Alat Pendukung</label>
                        <div class="block mt-2">
                            <div class="flex gap-x-6">
                                @foreach ($alat as $item)
                                <div class="flex">
                                  <input type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" name="id_alat[]" value="{{ $item->id_alat_pendukung }}"
                                  id="alat_pendukung">
                                  <label for="hs-checkbox-group-1" class="text-sm text-gray-500 ms-3">{{ $item->nama_alat }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="block">
                            <input type="hidden" class="form-control form-input text-small" name="id_fasilitas" id="{{ $id_fasilitas }}" value="{{ $id_fasilitas }}" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-navigation flex justify-end mt-5 gap-x-3">
                <button type="button" class="button-ghost text-small rounded-lg px-4 previous">Kembali</button>
                <button type="button" id="btn-next" class="bg-slate-900/10 text-black/50 cursor-not-allowed py-2 text-small rounded-lg px-4 next" disabled>Lanjutkan</button>
                <button type="button" id="btn-step-one" class="bg-slate-900/10 text-black/50 cursor-not-allowed py-2 text-small rounded-lg px-4 next-step" disabled>Lanjutkan</button>
                <button type="submit" id="btn-submit" class="bg-slate-900/10 text-black/50 cursor-not-allowed py-2 text-small rounded-lg px-4" disabled>Submit</button>
            </div>
        </form>
        <div class="hidden md:block bg-white rounded-xl mx-4 h-fit mt-[60px]" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
            {{-- <div class="h-44 w-full bg-cover bg-center rounded-t-xl" style="background-image: url('/foto_fasilitas/{{ $file }}');"></div> --}}
            <div class="h-44 w-full bg-cover bg-center rounded-t-xl" style="background-image: url('{{ $file }}');"></div>
            <div class="p-4">
                <h1 class="font-semibold text-lg border-b border-neutral-300 pb-4">{{ $nama_fasilitas }}</h1>
                <div class="pt-4 pb-2 text-neutral-500 font-medium">
                    <div class="flex flex-row items-center gap-x-2">
                        <img src="{{ asset('/assets/img/auth/kalendar.png') }}" class="h-4" />
                        <p>{{ $start_day }}, {{ $tgl_mulai_convert }} - {{ $end_day }}, {{ $tgl_selesai_convert }}</p>
                    </div>
                    <div class="flex flex-row items-center gap-x-2 pt-2">
                        <img src="{{ asset('/assets/img/auth/jam.png') }}" class="h-4" />
                        <p>{{ $jam_mulai }}:00 - {{ $jam_selesai }}.00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(function() {
        var $sections=$('.form-section');

        function navigateTo(index) {
            $sections.removeClass('current').eq(index).addClass('current');

            $('.form-navigation .previous').toggle(index > 0);
            var atTheEnd = index >= $sections.length - 1;
            $('.form-navigation .next').toggle(index === 0);
            $('.form-navigation .next-step').toggle(index === 1);
            $('.form-navigation [Type=submit]').toggle(atTheEnd);

            const stepOne = document.querySelector('.step0');
            const stepTwo = document.querySelector('.step1');
            const stepThree = document.querySelector('.step2');

            const dividerOne = document.querySelector('.divider0');
            const dividerTwo = document.querySelector('.divider1');
            const dividerThree = document.querySelector('.divider2');

            if (index === 0) {
                stepOne.style.backgroundColor = '#072ac8';
                stepOne.style.color = 'white';

                stepTwo.style.backgroundColor = '';
                stepTwo.style.color = '';

                stepThree.style.backgroundColor = '';
                stepThree.style.color = '';

                dividerOne.style.backgroundColor = '';
            } else if (index === 1) {
                stepOne.style.backgroundColor = '#072ac8';
                stepOne.style.color = 'white';

                stepTwo.style.backgroundColor = '#072ac8';
                stepTwo.style.color = 'white';

                stepThree.style.backgroundColor = '';
                stepThree.style.color = '';

                dividerOne.style.backgroundColor = '#072ac8';
                dividerTwo.style.backgroundColor = '';
            } else if (index === 2) {
                stepOne.style.backgroundColor = '#072ac8';
                stepOne.style.color = 'white';

                stepTwo.style.backgroundColor = '#072ac8';
                stepTwo.style.color = 'white';

                stepThree.style.backgroundColor = '#072ac8';
                stepThree.style.color = 'white';

                dividerTwo.style.backgroundColor = '#072ac8';
            }
        }
        
        function curIndex() {
            return $sections.index($sections.filter('.current'));
        }

        $('.form-navigation .previous').click(function() {
            navigateTo(curIndex() - 1);
        });

        $('.form-navigation .next').click(function() {
            $('.permohonan-form').parsley().whenValidate({
                group:'block-'+curIndex()
            }).done(function() {
                navigateTo(curIndex() + 1);
            })
        });

        $('.form-navigation .next-step').click(function() {
            $('.permohonan-form').parsley().whenValidate({
                group:'block-'+curIndex()
            }).done(function() {
                navigateTo(curIndex() + 1);
            })
        });

        $sections.each(function(index, section) {
            $(section).find(':input').attr('data-parsley-group', 'block-',+index);
        });

        navigateTo(0);
    })
</script>


<script>
    const skpd = document.getElementById("skpd");
    const bidang = document.getElementById("bidang_kegiatan");
    const button = document.getElementById("btn-next");

    function stepOneValidation(userSkpd, userBidang) {
        const isSkpdValid = userSkpd.length > 0

        const isBidangValid = userBidang.length > 0;

        if (isSkpdValid && isBidangValid) {
            button.removeAttribute("disabled");
            button.style.backgroundColor = "#072ac8";
            button.style.color = "white";
            button.style.cursor = "pointer";
            button.style.transitionDuration = "300ms";

            button.addEventListener("mouseover", function () {
            button.style.backgroundColor = "#072ac8";
            });

            button.addEventListener("mouseout", function () {
            button.style.backgroundColor = "#072ac8";
            });
        } else {
            button.style.backgroundColor = "rgba(44, 62, 80, 0.1)";
            button.style.color = "rgba(0, 0, 0, 0.5)";
            button.style.cursor = "not-allowed";

            button.addEventListener("mouseover", function () {
            button.style.backgroundColor = "rgba(44, 62, 80, 0.1)";
            });

            button.addEventListener("mouseout", function () {
            button.style.backgroundColor = "rgba(44, 62, 80, 0.1)";
            });
        }
    }

    skpd.addEventListener("input", function (event) {
        const skpdValue = skpd.value;
        stepOneValidation(skpdValue, bidang.value);
    });

    bidang.addEventListener("input", function (event) {
        const bidangValue = bidang.value;
        stepOneValidation(skpd.value, bidangValue);
    });

    // ================================================

    const instansi = document.getElementById("instansi_id");
    const statusInstansi = document.getElementById("status_instansi");
    const bidangInstansi = document.getElementById("bidang_instansi");
    const alamatInstansi = document.getElementById("alamat_instansi");
    const buttonNext = document.getElementById("btn-step-one");
    
    function stepTwoValidation(userInstansi, userStatusInstansi, userBidangInstansi, userAlamatInstansi) {
        const isInstansiValid = userInstansi.length > 0
        const isStatusValid = userStatusInstansi.length > 0;
        const isBidangValid = userBidangInstansi.length > 0;
        const isAlamatValid = userAlamatInstansi.length > 0;

        if (isInstansiValid && isStatusValid && isBidangValid && isAlamatValid) {
            buttonNext.removeAttribute("disabled");
            buttonNext.style.backgroundColor = "#072ac8";
            buttonNext.style.color = "white";
            buttonNext.style.cursor = "pointer";
            buttonNext.style.transitionDuration = "300ms";

            buttonNext.addEventListener("mouseover", function () {
            buttonNext.style.backgroundColor = "#072ac8";
            });

            buttonNext.addEventListener("mouseout", function () {
            buttonNext.style.backgroundColor = "#072ac8";
            });
        } else {
            buttonNext.style.backgroundColor = "rgba(44, 62, 80, 0.1)";
            buttonNext.style.color = "rgba(0, 0, 0, 0.5)";
            buttonNext.style.cursor = "not-allowed";

            buttonNext.addEventListener("mouseover", function () {
            buttonNext.style.backgroundColor = "rgba(44, 62, 80, 0.1)";
            });

            buttonNext.addEventListener("mouseout", function () {
            buttonNext.style.backgroundColor = "rgba(44, 62, 80, 0.1)";
            });
        }
    }

    instansi.addEventListener("input", function (event) {
        const instansiValue = instansi.value;
        stepTwoValidation(instansiValue, statusInstansi.value, bidangInstansi.value, alamatInstansi.value);
    });

    statusInstansi.addEventListener("input", function (event) {
        const statusValue = statusInstansi.value;
        stepTwoValidation(instansi.value, statusValue, bidangInstansi.value, alamatInstansi.value);
    });

    bidangInstansi.addEventListener("input", function (event) {
        const bidangValue = bidangInstansi.value;
        stepTwoValidation(instansi.value, statusInstansi.value, bidangValue, alamatInstansi.value);
    });

    alamatInstansi.addEventListener("input", function (event) {
        const alamatValue = alamatInstansi.value;
        stepTwoValidation(instansi.value, statusInstansi.value, bidangInstansi.value, alamatValue);
    });

    // ================================================

    const namaKegiatan = document.getElementById("nama_kegiatan");
    const jumlahPeserta = document.getElementById("jumlah_peserta");
    const narasumber = document.getElementById("narasumber");
    const suratPermohonan = document.getElementById("surat_permohonan");
    const rundownAcara = document.getElementById("rundown_acara");
    const ringkasan = document.getElementById("ringkasan");
    const alatPendukung = document.getElementById("alat_pendukung");
    const buttonSubmit = document.getElementById("btn-submit");
    
    function stepThreeValidation(userNamaKegiatan, userJumlahPeserta, userNarasumber, userSuratPermohonan, userRundownAcara, userRingkasan, userAlatPendukung) {
        const isKegiatanValid = userNamaKegiatan.length > 0
        const isPesertaValid = userJumlahPeserta.length > 0;
        const isNarasumberValid = userNarasumber.length > 0;
        const isSuratValid = userSuratPermohonan.length > 0;
        const isRundownValid = userRundownAcara.length > 0;
        const isRingkasanValid = userRingkasan.length > 0;
        const isAlatValid = userAlatPendukung.length > 0;

        if (isKegiatanValid && isPesertaValid && isNarasumberValid && isSuratValid && isRundownValid && isRingkasanValid && isAlatValid) {
            buttonSubmit.removeAttribute("disabled");
            buttonSubmit.style.backgroundColor = "#072ac8";
            buttonSubmit.style.color = "white";
            buttonSubmit.style.cursor = "pointer";
            buttonSubmit.style.transitionDuration = "300ms";

            buttonSubmit.addEventListener("mouseover", function () {
            buttonSubmit.style.backgroundColor = "#072ac8";
            });

            buttonSubmit.addEventListener("mouseout", function () {
            buttonSubmit.style.backgroundColor = "#072ac8";
            });
        } else {
            buttonSubmit.style.backgroundColor = "rgba(44, 62, 80, 0.1)";
            buttonSubmit.style.color = "rgba(0, 0, 0, 0.5)";
            buttonSubmit.style.cursor = "not-allowed";

            buttonSubmit.addEventListener("mouseover", function () {
            buttonSubmit.style.backgroundColor = "rgba(44, 62, 80, 0.1)";
            });

            buttonSubmit.addEventListener("mouseout", function () {
            buttonSubmit.style.backgroundColor = "rgba(44, 62, 80, 0.1)";
            });
        }
    }

    namaKegiatan.addEventListener("input", function (event) {
        const kegiatanValue = namaKegiatan.value;
        stepThreeValidation(kegiatanValue, jumlahPeserta.value, narasumber.value, suratPermohonan.value, rundownAcara.value, ringkasan.value, alatPendukung.value);
    });

    jumlahPeserta.addEventListener("input", function (event) {
        const pesertaValue = jumlahPeserta.value;
        stepThreeValidation(namaKegiatan.value, pesertaValue, narasumber.value, suratPermohonan.value, rundownAcara.value, ringkasan.value, alatPendukung.value);
    });

    narasumber.addEventListener("input", function (event) {
        const narasumberValue = narasumber.value;
        stepThreeValidation(namaKegiatan.value, jumlahPeserta.value, narasumberValue, suratPermohonan.value, rundownAcara.value, ringkasan.value, alatPendukung.value);
    });

    suratPermohonan.addEventListener("input", function (event) {
        const permohonanValue = suratPermohonan.value;
        stepThreeValidation(namaKegiatan.value, jumlahPeserta.value, narasumber.value, permohonanValue, rundownAcara.value, ringkasan.value, alatPendukung.value);
    });

    rundownAcara.addEventListener("input", function (event) {
        const rundownValue = rundownAcara.value;
        stepThreeValidation(namaKegiatan.value, jumlahPeserta.value, narasumber.value, suratPermohonan.value, rundownValue, ringkasan.value, alatPendukung.value);
    });

    ringkasan.addEventListener("input", function (event) {
        const ringkasanValue = ringkasan.value;
        stepThreeValidation(namaKegiatan.value, jumlahPeserta.value, narasumber.value, suratPermohonan.value, rundownAcara.value, ringkasanValue, alatPendukung.value);
    });

    alatPendukung.addEventListener("input", function (event) {
        const alatValue = alatPendukung.value;
        stepThreeValidation(namaKegiatan.value, jumlahPeserta.value, narasumber.value, suratPermohonan.value, rundownAcara.value, ringkasan.value, alatValue);
    });

</script>

@endsection

