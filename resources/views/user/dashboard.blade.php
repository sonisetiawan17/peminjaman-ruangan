@extends('layouts.landing')

@section('title', 'Beranda - Sistem Informasi Peminjaman Ruangan')

@section('content')

@php 
    $schedule = $jadwal;
@endphp

<main class="bg-[#fefefe]">
    <div class="relative h-screen md:h-[700px] lg:h-screen bg-center bg-cover w-full" style="background-image: url('{{ asset('/assets/img/auth/desktop.jpg') }}');">
        {{-- <div class="absolute top-0 bg-center bg-cover w-full h-screen z-0 md:hidden lg:block bg-gray-300/30">
        </div> --}}

        <div class="heading md:absolute z-10 md:top-1/2 md:left-1/2 md:transform md:-translate-x-1/2 md:-translate-y-1/2 md:w-[70%]">
            <div class="flex justify-center">
                <span class="py-1.5 px-3 rounded-full text-xs font-medium bg-gray-200 text-gray-800 ">Sistem Informasi Peminjaman Ruangan</span>
            </div>
            <div class="mt-5 mx-4 lg:mx-0">
                <h1 class="font-bold text-4xl lg:text-5xl xl:text-6xl text-center leading-snug lg:leading-none">Booking Room Reservations <span class="md:block md:pt-3 bg-gradient-to-r from-[#21D4FD] to-[#B721FF] text-transparent bg-clip-text h-[85px]">Easily and Efficiently</span></h1>
                <p class="hidden md:block pt-4 font-semibold text-lg text-center">SIPIRANG menawarkan berbagai manfaat, seperti menghemat waktu, <span class="block pt-2"> meningkatkan efisiensi, dan mengurangi risiko kesalahan.</span></p>
                <p class="md:hidden pt-4 font-semibold text-sm text-center">SIPIRANG menawarkan berbagai manfaat, seperti menghemat waktu, <span class="block pt-1"> meningkatkan efisiensi, dan mengurangi risiko kesalahan.</span></p>
            </div>

            <div class="mt-10 text-center space-x-3">
                <a href="{{ route('user.downloadSOP') }}">
                    <button class="bg-gradient-to-t from-primary to-blue-500 text-small rounded-lg w-[150px] text-white" style="padding: 8px 12px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">Download SOP</button>
                </a>
                <a href="{{ route('user.jadwals') }}">
                    <button class="bg-gradient-to-t from-gray-800 to-gray-500 text-small rounded-lg w-[150px] text-white" style="padding: 8px 12px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">Cek Jadwal</button>
                </a>
            </div>
        </div>

        <div class="absolute bottom-0 bg-center bg-cover w-full h-[30%] z-0 lg:block" style="background: linear-gradient(transparent 0%, #fefefe 100%);">
        </div>            
    </div>

    <div class="bg-[#fefefe] md:pt-[80px] lg:pt-0 px-[8px] md:px-[50px] lg:px-32">
        <div class="mt-5 text-center">
            <h1 class="text-base md:text-xl uppercase font-semibold tracking-widest bg-gradient-to-r from-[#21D4FD] to-[#B721FF] text-transparent bg-clip-text">Daftar Ruangan dan Area</h1>
            <h1 class="mt-4 text-2xl md:text-4xl lg:text-5xl font-bold text-neutral-600">MPP Kota Cimahi</h1>
        </div>

        <div class="mt-24 flex flex-col">
            @foreach ($fasilitas as $item)
            <div class="md:grid md:grid-cols-[45%,1fr] md:gap-5 lg:gap-10 px-[8px] md:px-0">
                <div class="rounded-2xl h-fit hidden md:block relative">
                    <img src="{{ $item->file }}" alt="ruangan" class="w-full md:h-[180px] lg:h-[350px] bg-cover bg-center rounded-2xl" />
                    {{-- <img src="/foto_fasilitas/{{ $item->file }}" alt="ruangan" class="w-full md:h-[180px] lg:h-[350px] bg-cover bg-center rounded-2xl" /> --}}

                    @if (in_array($currentDate, $item->range_tanggal) && in_array($item->id_fasilitas, $item->range_tanggal))
                    <div class="absolute top-0 left-0 w-full h-full bg-[#000814]/80 bg-blend-multiply rounded-xl flex flex-col items-center justify-center text-white px-[30px]">
                        <div class="flex items-center justify-center gap-2 text-lg pb-2 border-b-2 border-b-white w-full">
                            <i class="fa-solid fa-circle-info text-white"></i>
                            <p class="text-white">Informasi</p>
                        </div>
                        <div class="mt-3 text-center">
                            <p>Mohon maaf, ruangan ini sedang dalam proses <span class="lowercase">{{ $item->range_tanggal[1] }}</span> mulai tanggal</p>
                            <p class="mt-3"><span class="font-bold pr-1">{{ \Carbon\Carbon::parse($item->range_tanggal[2])->format('d F Y') }}</span> s/d <span class="font-bold pl-1">{{ \Carbon\Carbon::parse(end($item->range_tanggal))->format('d F Y') }}</span></p>
                        </div>
                    </div>
                    @endif
                </div>
                <div>
                    <div class="flex gap-5 md:gap-5 lg:gap-10">
                        <div class="relative">
                            <div class="{{ $item->id_fasilitas === 1 ? 'px-[16px]' : 'px-[14px]' }} py-2 rounded-full bg-primary z-10">
                                <span class="text-white font-semibold">{{ $item->id_fasilitas }}</span>
                            </div>
                            <div class="border-r-2 border-gray-300 h-full {{ $item->id_fasilitas === 7 ? 'hidden' : 'absolute top-[35px] left-1/2 z-0' }}"></div>
                        </div>
                        <div class="pb-20 md:pb-40">
                            <div class="rounded-2xl h-fit mb-[12px] md:hidden relative">
                                <img src="{{ $item->file }}" alt="ruangan" class="w-full h-[200px] bg-cover bg-center rounded-2xl" />
                                {{-- <img src="/foto_fasilitas/{{ $item->file }}" alt="ruangan" class="w-full h-[200px] bg-cover bg-center rounded-2xl" /> --}}
                                @if (in_array($currentDate, $item->range_tanggal) && in_array($item->id_fasilitas, $item->range_tanggal))
                                <div class="absolute top-0 left-0 w-full h-full bg-[#000814]/80 bg-blend-multiply rounded-xl flex flex-col items-center justify-center text-white px-[30px] md:hidden">
                                    <div class="flex items-center justify-center gap-2 text-lg pb-2 border-b-2 border-b-white w-full">
                                        <i class="fa-solid fa-circle-info text-white"></i>
                                        <p class="text-white">Informasi</p>
                                    </div>
                                    <div class="mt-3 text-center">
                                        <p>Mohon maaf, ruangan ini sedang dalam proses <span class="lowercase">{{ $item->range_tanggal[1] }}</span> mulai tanggal</p>
                                        <p class="mt-3"><span class="font-bold pr-1">{{ \Carbon\Carbon::parse($item->range_tanggal[2])->format('d F Y') }}</span> s/d <span class="font-bold pl-1">{{ \Carbon\Carbon::parse(end($item->range_tanggal))->format('d F Y') }}</span></p>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <?php
                                $str = $item->nama_fasilitas;
                                $words = explode(' ', $str); 

                                echo "<h1 class='font-bold text-black text-xl lg:text-4xl'>";
                                $gradientText = '';
                                foreach ($words as $index => $word) {
                                    if ($index == 0) {
                                        echo $word;
                                    } else {
                                        $gradientText .= "$word ";
                                    }
                                }

                                echo "<span class='bg-gradient-to-r from-[#21D4FD] to-[#B721FF] text-transparent bg-clip-text'> $gradientText</span></h1>";
                            ?>

                            <div class="mt-3 flex flex-col gap-1 text-sm lg:text-base">
                                <p><span class="font-semibold">Kapasitas Ruangan</span> : {{ $item->kapasitas }} Orang</p>
                                <p><span class="font-semibold">Lokasi Ruangan</span> : {{ $item->lokasi }} Mal Pelayanan Publik Kota Cimahi</p>
                                <p><span class="font-semibold">Fasilitas</span> : {{ $item->fasilitas }}</p>
                                <div class="flex flex-col gap-2 mt-4">
                                    <p>Waktu pemanfaatan ruangan yaitu setiap hari {{ $item->waktu_pemanfaatan }} pada pukul 08:00 - 15.30</p>
                                    <p><span class="font-semibold">Catatan</span> : Di luar waktu tersebut jam tersebut di atas,  kebersihan dan keamanan tidak menjadi tanggung jawab pengelola MPP Kota Cimahi</p>
                                </div>
                                <div class="mt-3" id="modal_show" type="button" data-toggle="modal" data-target="{{ in_array($currentDate, $item->range_tanggal) && in_array($item->id_fasilitas, $item->range_tanggal) ? ' ' : '#isimodal' }}" data-id_fasilitas="{{ $item->id_fasilitas }}" data-nama_fasilitas="{{ $item->nama_fasilitas }}" data-file="{{ $item->file }}">
                                    @if (in_array($currentDate, $item->range_tanggal) && in_array($item->id_fasilitas, $item->range_tanggal))
                                    <button class="bg-gradient-to-t  from-gray-800 to-gray-500 text-small rounded-lg text-white px-7 py-2 w-full md:w-fit font-semibold cursor-not-allowed" disabled>Pilih Ruangan</button>
                                    @else 
                                    <button class="bg-gradient-to-t from-primary to-blue-500 text-small rounded-lg text-white px-7 py-2 w-full md:w-fit font-semibold">Pilih Ruangan</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="w-full h-[2px] bg-gradient-to-r from-blue-500 via-indigo-500 to-blue-500 relative">
            <div class="absolute left-0 transform -translate-y-1/2 w-[20%] lg:w-[40%] h-[50px]" style="background: linear-gradient(270deg, transparent 0%, #fefefe 75%);"></div>
            <div class="absolute right-0 transform -translate-y-1/2 w-[20%] lg:w-[40%] h-[50px]" style="background: linear-gradient(90deg, transparent 0%, #fefefe 75%);"></div>
        </div>

        <div class="modal fade" id="isimodal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Pilih Jadwal Peminjaman</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body mx-3" id="tampil_modal">
                        <form method="get" action="{{ route('user.buatPermohonanForm') }}">
                            @csrf
                            <div class="form-group m-b-15">
                                <input type="hidden" class="form-control form-input text-small" name="id_fasilitas" id="id_fasilitas" />
                                <input type="hidden" class="form-control form-input text-small" name="nama_fasilitas" id="nama_fasilitas" />
                                <input type="hidden" class="form-control form-input text-small" name="file" id="file" />
                                <label class="col-form-label">Tanggal Mulai <sup class="text-red-500">*</sup></label>
                                <div class="block">
                                    <input type="date" class="form-control form-input text-small" name="tgl_mulai" id="tgl_mulai" onchange="checkStartDate()" required />
                                </div>
    
                                <label class="col-form-label mt-3">Jam Mulai <sup class="text-red-500">*</sup></label>
                                <div class="block">
                                    {{-- <div class="btn-group btn-group-toggle" data-toggle="buttons" id="data-jam">
                                        <p class="tgl_info">*Silahkan pilih tanggal mulai terlebih dahulu.</p>
                                    </div> --}}
                                    <div class="radio-toolbar" id="data-jam-mulai">
                                        <p class="tgl_info">*Silahkan pilih tanggal mulai terlebih dahulu.</p>
                                    </div>
                                </div>
    
                                <label class="col-form-label mt-3">Tanggal Selesai <sup class="text-red">*</sup></label>
                                <div class="block">
                                    <input type="date" class="form-control form-input text-small" name="tgl_selesai" id="tgl_selesai" onchange="checkEndDate()" required />
                                </div>
    
                                <label class="col-form-label mt-3">Jam Selesai <sup class="text-red">*</sup></label>
                                <div class="block">
                                    <div class="radio-toolbar" id="data-jam-selesai">
                                        <p class="tgl_info">*Silahkan pilih tanggal selesai terlebih dahulu.</p>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer font-semibold text-sm">
                        <a href="javascript:;" class="button-ghost" data-dismiss="modal">Tutup</a>
                        <button type="submit" id="button" class="bg-slate-900/10 py-2 px-4 text-black/50 cursor-not-allowed" disabled>Lanjutkan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="pt-24 radio-toolbar"></div>
    </div>
</main>

<script type="text/javascript">
    $(document).on("click", "#modal_show", function() {
        var id_fasilitas = $(this).data('id_fasilitas');
        var nama_fasilitas = $(this).data('nama_fasilitas');
        var file = $(this).data('file');

        $("#tampil_modal #id_fasilitas").val(id_fasilitas);
        $("#tampil_modal #nama_fasilitas").val(nama_fasilitas);
        $("#tampil_modal #file").val(file);
    })
</script>

<script>
    function checkStartDate() {
        const selectedDate = document.getElementById("tgl_mulai").value
        const room = document.getElementById('nama_fasilitas').value
        const dataJadwal = @json($schedule);

        const transformedData = dataJadwal.map(item => [
            item.nama_fasilitas,
            item.tgl_mulai,
            item.tgl_selesai,
            item.jam_mulai,
            item.jam_selesai,
            item.status_permohonan
        ]);

        console.log(transformedData);

        const matchingDateItems = transformedData.filter(
            (item) =>
                item[0] === room &&
                (item[1] === selectedDate || item[2] === selectedDate) && 
                 (item[5] === 'Diterima' || item[5] === 'Menunggu')
        );

        console.log(matchingDateItems);

        const uniqueValues = new Set();

        if (matchingDateItems.length > 0) {
            matchingDateItems.forEach((item) => {
                const index1 = parseInt(item[3]);
                const index2 = parseInt(item[4]);

                if (item[1] === selectedDate && item[2] === selectedDate) {
                    for (let i = index1; i <= index2; i++) {
                        uniqueValues.add(i.toString().padStart(1, "0"));
                    }
                } else if (item[1] === selectedDate) {
                    for (let i = index1; i <= 17; i++) {
                        uniqueValues.add(i.toString().padStart(1, "0"));
                    }
                } else if (item[2] === selectedDate) {
                    for (let i = 8; i <= index2; i++) {
                        uniqueValues.add(i.toString().padStart(1, "0"));
                    }
                }
            });

            const newArray = Array.from(uniqueValues).sort(
                (a, b) => parseInt(a) - parseInt(b)
            );
            console.log(newArray);

            const jam = document.getElementById("data-jam-mulai");

            const isDateInCurrentDate = transformedData.some(item => item[1] === selectedDate || item[2] === selectedDate);
            console.log(isDateInCurrentDate)

            jam.innerHTML = '';

            if (isDateInCurrentDate) {
                for (let i = 8; i <= 15; i++) {
                    const value = i.toString();
                    const isUsed = newArray.includes(value);
                    const labelClass = isUsed
                        ? 'inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-500/20 disabled cursor-not-allowed text-red-800'
                        : 'inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800 cursor-pointer';

                    jam.innerHTML +=
                        `<label class="${labelClass} mr-1" id="${value}-jam_mulai">
                            <input type="radio" name="jam_mulai" value="${value}" id="${value}" onclick="getValue()" ${isUsed ? 'disabled' : ''} required />
                            ${value}:${value == 15 ? '30' : '00'}
                        </label>`;
                }
            } 
        } else {
            const jam = document.getElementById("data-jam-mulai");

            const isDateInCurrentDate = transformedData.some(item => item[1] === selectedDate || item[2] === selectedDate);
            console.log(isDateInCurrentDate)

            jam.innerHTML = '';

            for (let i = 8; i <= 15; i++) {
                const value = i.toString();
                jam.innerHTML +=
                    `<label class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800 cursor-pointer mr-1" id="${value}-jam_mulai">
                        <input type="radio" name="jam_mulai" value="${value}" id="${value}" onclick="getValue()" required />
                        ${value}:${value == 15 ? '30' : '00'}
                    </label>`;
            }
        }

        // ===================================================================
    }

    function getValue() {
        const radioButton = document.getElementsByName("jam_mulai");

        for (let i = 8; i <= 15; i++) {
            const value = i.toString();
            const labelElement = document.getElementById(`${value}-jam_mulai`);

            if (radioButton[i - 8].checked && labelElement.classList.contains('cursor-pointer')) {
                for (let j = 8; j <= 15; j++) {
                    const currentLabel = document.getElementById(`${j}-jam_mulai`);
                    currentLabel.style.backgroundColor = (i === j) ? 'yellow' : '';
                }
            }
        }
    }

    // ===============================================================================

    function checkEndDate() {
        const selectedDate = document.getElementById("tgl_selesai").value
        const room = document.getElementById('nama_fasilitas').value
        const dataJadwal = @json($schedule);

        const transformedData = dataJadwal.map(item => [
            item.nama_fasilitas,
            item.tgl_mulai,
            item.tgl_selesai,
            item.jam_mulai,
            item.jam_selesai,
            item.status_permohonan
        ]);

        console.log(transformedData);

        const matchingDateItems = transformedData.filter(
            (item) =>
                item[0] === room &&
                (item[1] === selectedDate || item[2] === selectedDate) && 
                 (item[5] === 'Diterima' || item[5] === 'Menunggu')
        );

        console.log(matchingDateItems);

        const uniqueValues = new Set();

        if (matchingDateItems.length > 0) {
            matchingDateItems.forEach((item) => {
                const index1 = parseInt(item[3]);
                const index2 = parseInt(item[4]);

                if (item[1] === selectedDate && item[2] === selectedDate) {
                    for (let i = index1; i <= index2; i++) {
                        uniqueValues.add(i.toString().padStart(1, "0"));
                    }
                } else if (item[1] === selectedDate) {
                    for (let i = index1; i <= 17; i++) {
                        uniqueValues.add(i.toString().padStart(1, "0"));
                    }
                } else if (item[2] === selectedDate) {
                    for (let i = 8; i <= index2; i++) {
                        uniqueValues.add(i.toString().padStart(1, "0"));
                    }
                }
            });

            const newArray = Array.from(uniqueValues).sort(
                (a, b) => parseInt(a) - parseInt(b)
            );
            console.log(newArray);

            const jam = document.getElementById("data-jam-selesai");

            const isDateInCurrentDate = transformedData.some(item => item[1] === selectedDate || item[2] === selectedDate);
            console.log(isDateInCurrentDate)

            jam.innerHTML = '';

            if (isDateInCurrentDate) {
                for (let i = 8; i <= 15; i++) {
                    const value = i.toString();
                    const isUsed = newArray.includes(value);
                    const labelClass = isUsed
                        ? 'inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-500/20 disabled cursor-not-allowed text-red-800'
                        : 'inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800 cursor-pointer';

                    jam.innerHTML +=
                        `<label class="${labelClass} mr-1" id="${value}-jam_selesai">
                            <input type="radio" name="jam_selesai" value="${value}" id="${value}" onclick="getValueSelesai()" ${isUsed ? 'disabled' : ''} required />
                            ${value}:${value == 15 ? '30' : '00'}
                        </label>`;
                }
            } 
        } else {
            const jam = document.getElementById("data-jam-selesai");

            const isDateInCurrentDate = transformedData.some(item => item[1] === selectedDate || item[2] === selectedDate);
            console.log(isDateInCurrentDate)

            jam.innerHTML = '';

            for (let i = 8; i <= 15; i++) {
                const value = i.toString();
                jam.innerHTML +=
                    `<label class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800 cursor-pointer mr-1" id="${value}-jam_selesai">
                        <input type="radio" name="jam_selesai" value="${value}" id="${value}" onclick="getValueSelesai()" required />
                        ${value}:${value == 15 ? '30' : '00'}
                    </label>`;
            }
        }

        // ===================================================================
    }

    function getValueSelesai() {
        const radioButton = document.getElementsByName("jam_selesai");

        for (let i = 8; i <= 15; i++) {
            const value = i.toString();
            const labelElement = document.getElementById(`${value}-jam_selesai`);

            if (radioButton[i - 8].checked && labelElement.classList.contains('cursor-pointer')) {
                for (let j = 8; j <= 16; j++) {
                    const currentLabel = document.getElementById(`${j}-jam_selesai`);
                    currentLabel.style.backgroundColor = (i === j) ? 'yellow' : '';
                }
            }
        }
    }
    

    const tgl_mulai = document.getElementById('tgl_mulai');
    const tgl_selesai = document.getElementById('tgl_selesai');
    const jam_mulai = document.getElementsByName('jam_mulai');
    const jam_selesai = document.getElementsByName('jam_selesai');
    const button = document.getElementById('button');

    function checkAndChangeButtonColor(tglMulai, tglSelesai) {
        const isTglMulaiValid = tglMulai.length > 0
        const isTglSelesaiValid = tglSelesai.length > 0;

        if (isTglMulaiValid && isTglSelesaiValid) {
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

    tgl_mulai.addEventListener("input", function (event) {
        const tglMulaiValue = event.target.value;
        checkAndChangeButtonColor(tglMulaiValue, tgl_selesai.value);
    });

    tgl_selesai.addEventListener("input", function (event) {
        const tglSelesaiValue = event.target.value;
        checkAndChangeButtonColor(tgl_mulai.value, tglSelesaiValue);
    });

</script>

@endsection

