@extends('layouts.landing')

@section('content')

@php

$schedule = $jadwal;
$dataJam = ['8', '9', '10', '11', '12', '13', '14', '15', '16'];

@endphp

<main class="bg-[#f7f7f8]">
    <div class="pt-[120px] mx-[140px]">
        <div class="bg-white border border-neutral-400">
            <div class="flex flex-row items-center justify-between gap-x-2 border-b border-neutral-200 py-4 mx-12">
                <div class="flex flex-row items-start gap-x-2">
                    <img src="{{ asset('/assets/img/auth/kalendar.png') }}" alt="kalendar" class="h-4" />
                    <h1 class="font-semibold" style="font-size: 15px">{{ $month }} {{ $currentYear }}</h1>
                </div>
                <div class="flex flex-row items-center gap-7">
                    <div class="flex flex-row items-center gap-2">
                        <div class="h-4 w-8 bg-green-200 border border-green-500"></div>
                        <p style="font-size: 11px">Tersedia</p>
                    </div>
                    <div class="flex flex-row items-center gap-2">
                        <div class="h-4 w-8 bg-red-200 border border-red-500"></div>
                        <p style="font-size: 11px">Tidak Tersedia</p>
                    </div>
                </div>
            </div> 
            <div class="py-2 border-b border-neutral-200 px-4 relative">
                {{-- <ul class="flex items-center gap-5">
                    @foreach ($day as $d)
                        <li class="cursor-pointer" id="date" data-tanggal="{{ $currentYear }}-{{ $currentMonthNum }}-{{ $d }}" onclick="checkSchedule(this)">{{ $d }}/{{ $currentMonthNum }}/{{ $currentYear }}</li>
                    @endforeach
                </ul> --}}
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach ($dayMerge as $d)
                            <div class="cursor-pointer swiper-slide" id="date" data-tanggal="{{ $d }}" onclick="checkSchedule(this)" style="font-size: 13px">{{ $d }}</div>
                            {{-- <div class="cursor-pointer swiper-slide" id="date" data-tanggal="{{ $currentYear }}-{{ $currentMonthNum }}-{{ $d }}" onclick="checkSchedule(this)" style="font-size: 13px">{{ $d }}/{{ $currentMonthNum }}/{{ $currentYear }}</div> --}}
                        @endforeach
                    </div>
                </div>
                <div class="absolute right-0 w-24 z-20 top-0 h-full" style="background: linear-gradient(90deg, transparent 0%, #ffffff 50%);"></div>
            </div>
            
            <div class="mx-12 mt-4 bg-white p-3 rounded-md" style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
                <h1 class="font-bold text-lg text-neutral-500">Ruang Multimedia</h1>
                <div class="flex items-center gap-3 mt-2">
                    <p>Jam tersedia</p>
                    <ul class="flex items-center gap-x-2" id="jam-multimedia">
                        @foreach ($dataJam as $jam)
                            @if (in_array($jam, $newArray))
                                <li><span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800">{{ $jam }}:00</span></li>
                            @else
                                <li><span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ $jam }}:00</span></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="py-4 px-12 grid grid-cols-4 gap-5" id="jadwal-multimedia">
                @foreach ($currentJadwal as $jadwal)
                @if ($jadwal->nama_fasilitas === 'Multimedia')
                <div class="flex flex-col gap-2 p-3 bg-white border-t border-t-neutral-100 border-r border-r-neutral-100 border-b border-b-neutral-100 rounded-lg w-full px-4 border-l-4 border-l-green-500" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                    <div class="flex flex-row items-center gap-x-2">
                        <img src="{{ asset('/assets/img/auth/kalendar.png') }}" class="h-3" />
                        <p class=" text-neutral-500 font-medium" style="font-size: 12px">{{ $jadwal->tgl_mulai }} - {{ $jadwal->tgl_selesai }}</p>
                    </div>
                    <p class="text-lg font-semibold">
                        {{ $jadwal->jam_mulai < 10 ? '0' . $jadwal->jam_mulai : $jadwal->jam_mulai }}:00 -
                        {{ $jadwal->jam_selesai < 10 ? '0' . $jadwal->jam_selesai : $jadwal->jam_selesai }}:00
                    </p>
                </div>
                @endif 
                @endforeach 
            </div>
            
            <div class="mx-12 bg-white p-3 rounded-md" style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
                <h1 class="font-bold text-lg text-neutral-500">Ruang Aula</h1>
                <div class="flex items-center gap-3 mt-2">
                    <p>Jam tersedia</p>
                    <ul class="flex items-center gap-x-2" id="jam-aula">
                        @foreach ($dataJam as $jam)
                            @if (in_array($jam, $newArrayAula))
                                <li><span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800">{{ $jam }}:00</span></li>
                            @else
                                <li><span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ $jam }}:00</span></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="py-4 px-12 grid grid-cols-4 gap-5" id="jadwal-aula">  
                @foreach ($currentJadwal as $jadwal)
                @if ($jadwal->nama_fasilitas === 'Aula')
                <div class="flex flex-col gap-2 p-3 bg-white border-t border-t-neutral-100 border-r border-r-neutral-100 border-b border-b-neutral-100 rounded-lg w-full px-4 border-l-4 border-l-blue-500" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                    <div class="flex flex-row items-center gap-x-2">
                        <img src="{{ asset('/assets/img/auth/kalendar.png') }}" class="h-3" />
                        <p class=" text-neutral-500 font-medium" style="font-size: 12px">{{ $jadwal->tgl_mulai }} - {{ $jadwal->tgl_selesai }}</p>
                    </div>
                    <p class="text-lg font-semibold">
                        {{ $jadwal->jam_mulai < 10 ? '0' . $jadwal->jam_mulai : $jadwal->jam_mulai }}:00 -
                        {{ $jadwal->jam_selesai < 10 ? '0' . $jadwal->jam_selesai : $jadwal->jam_selesai }}:00
                    </p>
                </div>
                @endif 
                @endforeach     
            </div>  
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 8,
      spaceBetween: 30,
      pagination: {
        clickable: true,
      },
    });
</script>

<script>
    const dataJadwal = @json($schedule);

    function checkSchedule(date) {
        const dates = date.dataset.tanggal;
        console.log(dates);

        const jadwalMultimedia = document.getElementById("jadwal-multimedia");
        const jadwalAula = document.getElementById("jadwal-aula");

        const dateValue = dates;
        const check = dataJadwal.filter(item => item.tgl_mulai === dateValue)

        jadwalMultimedia.innerHTML = '';
        jadwalAula.innerHTML = '';

        check.map(item => {
            if (item.nama_fasilitas === 'Multimedia') {
                jadwalMultimedia.innerHTML += 
                `<div class="flex flex-col gap-2 p-3 bg-white border-t border-t-neutral-100 border-r border-r-neutral-100 border-b border-b-neutral-100 rounded-lg w-full px-4 border-l-4 border-l-green-500" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                    <div class="flex flex-row items-center gap-x-2">
                        <img src="{{ asset('/assets/img/auth/kalendar.png') }}" class="h-3" />
                        <p class=" text-neutral-500 font-medium" style="font-size: 12px">${item.tgl_mulai} - ${item.tgl_selesai}</p>
                    </div>
                    <p class="text-lg font-semibold">${item.jam_mulai.length === 1 ? '0' + item.jam_mulai : item.jam_mulai}:00 - ${item.jam_selesai.length === 1 ? '0' + item.jam_selesai : item.jam_selesai}:00</p>
                </div>`
            } else {
                jadwalAula.innerHTML += 
                `<div class="flex flex-col gap-2 p-3 bg-white border-t border-t-neutral-100 border-r border-r-neutral-100 border-b border-b-neutral-100 rounded-lg w-full px-4 border-l-4 border-l-blue-500" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                    <div class="flex flex-row items-center gap-x-2">
                        <img src="{{ asset('/assets/img/auth/kalendar.png') }}" class="h-3" />
                        <p class=" text-neutral-500 font-medium" style="font-size: 12px">${item.tgl_mulai} - ${item.tgl_selesai}</p>
                    </div>
                    <p class="text-lg font-semibold">${item.jam_mulai.length === 1 ? '0' + item.jam_mulai : item.jam_mulai}:00 - ${item.jam_selesai.length === 1 ? '0' + item.jam_selesai : item.jam_selesai}:00</p>
                </div>`
            }
        })

        const jadwal = ['8', '9', '10', '11', '12', '13', '14', '15', '16'];

        const jamTersediaAula = document.getElementById('jam-aula')
        const jamTersediaMultimedia = document.getElementById('jam-multimedia')

        jamTersediaAula.innerHTML = '';
        jamTersediaMultimedia.innerHTML = '';

        // ===================================================== AULA =====================================================
        const ruangMultimedia = 'Multimedia';
        const ruangAula = 'Aula';

        const transformedData = dataJadwal.map(item => [
            item.nama_fasilitas,
            item.tgl_mulai,
            item.tgl_selesai,
            item.jam_mulai,
            item.jam_selesai
        ]);

        const matchingDateItems = transformedData.filter(
            (item) =>
                item[0] === ruangAula &&
                (item[1] === dateValue || item[2] === dateValue)
        );

        const uniqueValues = new Set();

        if (matchingDateItems.length > 0) {
            matchingDateItems.forEach((item) => {
                const index1 = parseInt(item[3]);
                const index2 = parseInt(item[4]);

                if (item[1] === dateValue && item[2] === dateValue) {
                    for (let i = index1; i <= index2; i++) {
                        uniqueValues.add(i.toString().padStart(1, "0"));
                    }
                } else if (item[1] === dateValue) {
                    for (let i = index1; i <= 17; i++) {
                        uniqueValues.add(i.toString().padStart(1, "0"));
                    }
                } else if (item[2] === dateValue) {
                    for (let i = 8; i <= index2; i++) {
                        uniqueValues.add(i.toString().padStart(1, "0"));
                    }
                }
            });

            const newArray = Array.from(uniqueValues).sort(
                (a, b) => parseInt(a) - parseInt(b)
            );

            const result = jadwal.filter(jam => !newArray.includes(jam))

            jadwal.map(jam => {
                const found = newArray.includes(jam)
                const style = found ? 'bg-red-100' : 'bg-green-100'
                const displayJam = found ? `<span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium ${style} text-red-800"> ${jam}:00 </span>` : `<span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium ${style} text-green-800"> ${jam}:00 </span>`

                jamTersediaAula.innerHTML += `<li>${displayJam}</li>`
            })
        } else {
            jadwal.map(jam => {
                jamTersediaAula.innerHTML += `<span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800"> ${jam}:00 </span>`
            })
        }


        // ===================================================== MULTIMEDIA =====================================================
        const matchingDateItemsSecondary = transformedData.filter(
            (item) =>
                item[0] === ruangMultimedia &&
                (item[1] === dateValue || item[2] === dateValue)
        );

        const uniqueValuesSecondary = new Set();

        if (matchingDateItemsSecondary.length > 0) {
            matchingDateItemsSecondary.forEach((item) => {
                const index1 = parseInt(item[3]);
                const index2 = parseInt(item[4]);

                if (item[1] === dateValue && item[2] === dateValue) {
                    for (let i = index1; i <= index2; i++) {
                        uniqueValuesSecondary.add(i.toString().padStart(1, "0"));
                    }
                } else if (item[1] === dateValue) {
                    for (let i = index1; i <= 17; i++) {
                        uniqueValuesSecondary.add(i.toString().padStart(1, "0"));
                    }
                } else if (item[2] === dateValue) {
                    for (let i = 8; i <= index2; i++) {
                        uniqueValuesSecondary.add(i.toString().padStart(1, "0"));
                    }
                }
            });

            const newArray = Array.from(uniqueValuesSecondary).sort(
                (a, b) => parseInt(a) - parseInt(b)
            );

            const jamTersediaMultimedia = document.getElementById('jam-multimedia')

            const result = jadwal.filter(jam => !newArray.includes(jam))

            jadwal.map(jam => {
                const found = newArray.includes(jam)
                const style = found ? 'bg-red-100' : 'bg-green-100'
                const displayJam = found ? `<span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium ${style} text-red-800"> ${jam}:00 </span>` : `<span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium ${style} text-green-800"> ${jam}:00 </span>`

                jamTersediaMultimedia.innerHTML += `<li>${displayJam}</li>`
            })
        } else {
            jadwal.map(jam => {
                jamTersediaMultimedia.innerHTML += `<span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-blue-800"> ${jam}:00 </span>`
            })
        }
    }
</script>


@endsection

