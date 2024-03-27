@extends('layouts.landing')

@section('content')

@php

$schedule = $jadwal;
$namaFasilitas = $fasilitas;
$dataJam = ['8', '9', '10', '11', '12', '13', '14', '15', '16'];
$fasilitasArray = $fasilitasWithAlias

@endphp

<main class="bg-[#f7f7f8]">
    <div class="py-[120px] mx-[8px] md:mx-[50px] lg:mx-[140px]">
        <div class="bg-white border border-neutral-400 rounded-xl" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">
            <div class="border-b border-neutral-200 mx-[2px] md:mx-[48px]">
                <div class="flex flex-col md:flex-row items-center justify-between gap-x-2 py-4 gap-y-5 lg:gap-y-0">
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
                <div class="mb-3 flex items-end justify-center md:justify-end">
                    <img src="{{ asset('/assets/img/auth/swipe.png') }}" alt="logo" class="h-5 mr-2" />
                    <p class="text-xs text-gray-600">Swipe untuk melihat jadwal lainnya</p>
                </div>
            </div>
            <div class="py-2 border-b border-neutral-200 md:px-[30px] relative">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach ($dayMerge as $d)
                        @php
                            $formattedDate = date('d M Y', strtotime($d));
                        @endphp
                        <div class="cursor-pointer swiper-slide date {{ $d === $currentDate ? ' active' : '' }}" id="date" data-tanggal="{{ $d }}" onclick="checkSchedule(this)" style="font-size: 13px">{{ $formattedDate }}</div>
                            {{-- <div class="cursor-pointer swiper-slide" id="date" data-tanggal="{{ $currentYear }}-{{ $currentMonthNum }}-{{ $d }}" onclick="checkSchedule(this)" style="font-size: 13px">{{ $d }}/{{ $currentMonthNum }}/{{ $currentYear }}</div> --}}
                        @endforeach
                    </div>
                </div>
                <div class="absolute right-0 w-24 z-20 top-0 h-full" style="background: linear-gradient(90deg, transparent 0%, #ffffff 50%);"></div>
            </div>
            
            <div class="flex flex-col gap-3 my-4">
                @foreach ($fasilitasArray as $fasilitas)
                    <div class="mx-[8px] lg:mx-12 bg-white p-3 rounded-md" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                        <h1 class="font-bold text-lg text-neutral-500">{{ $fasilitas[0] }}</h1>
                        <div class="lg:flex lg:items-center gap-3 mt-2">
                            <p>Jam tersedia</p>
                            <ul class="mt-[8px] lg:mt-0 flex flex-wrap lg:items-center gap-y-3 lg:gap-y-0 gap-x-2" id="jam-{{ $fasilitas[1] }}">
                                @foreach ($dataJam as $jam)
                                    @if (in_array($jam, $newArray[$fasilitas[0]]))
                                        <li><span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800">{{ $jam }}:00</span></li>
                                    @else
                                        <li><span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ $jam }}:00</span></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="py-4 px-12 grid grid-cols-4 gap-5" id="jadwal-multimedia">
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
                </div> --}}
                
                {{-- <div class="mx-12 bg-white p-3 rounded-md" style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
                    <h1 class="font-bold text-lg text-neutral-500">Ruang Aula</h1>
                    <div class="flex items-center gap-3 mt-2">
                        <p>Jam tersedia</p>
                        <ul class="flex items-center gap-x-2" id="jam-aula">
                            @foreach ($dataJam as $jam)
                                @if (in_array($jam, $newArray['Ruang Multimedia']))
                                    <li><span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800">{{ $jam }}:00</span></li>
                                @else
                                    <li><span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ $jam }}:00</span></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div> --}}
    
                {{-- <div class="py-4 px-12 grid grid-cols-4 gap-5" id="jadwal-aula">  
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
                </div>   --}}
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 2.5,
      spaceBetween: 10,
      pagination: {
        clickable: true,
      },
      breakpoints: {
        640: {
          slidesPerView: 2.5,
          spaceBetween: 10,
        },
        768: {
          slidesPerView: 6,
          spaceBetween: 30,
        },
        1024: {
          slidesPerView: 8,
          spaceBetween: 30,
        },
      },
    });
</script>

<script>
    const dateElements = document.querySelectorAll('.date');

    dateElements.forEach(function (element) {
        element.addEventListener('click', function () {
            dateElements.forEach(function (el) {
                el.classList.remove('active');
            });

            element.classList.add('active');
        });
    });

    const dataJadwal = @json($schedule);
    const fasilitas = @json($namaFasilitas);
    const fasilitasWithAlias = @json($fasilitasArray);

    function checkSchedule(date) {
        const dates = date.dataset.tanggal;
        const dateValue = dates;
        
        function processRoomSchedule(room, dateValue, abbreviation) {
            const jadwal = ['8', '9', '10', '11', '12', '13', '14', '15', '16'];

            const jamTersedia = document.getElementById(`jam-${abbreviation}`);
            jamTersedia.innerHTML = '';

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
                item => item[0] === room && (item[1] === dateValue || item[2] === dateValue) && (item[5] === 'Diterima' || item[5] === 'Menunggu')
            );

            console.log(matchingDateItems);

            const uniqueValues = new Set();

            if (matchingDateItems.length > 0) {
                matchingDateItems.forEach(item => {
                    const index1 = parseInt(item[3]);
                    const index2 = parseInt(item[4]);
                    const startDate = (item[1] === dateValue) ? index1 : 8;
                    const endDate = (item[2] === dateValue) ? index2 : 17;

                    for (let i = startDate; i <= endDate; i++) {
                        uniqueValues.add(i.toString().padStart(1, "0"));
                    }
                });

                const newArray = Array.from(uniqueValues).sort((a, b) => parseInt(a) - parseInt(b));

                jadwal.forEach(jam => {
                    const found = newArray.includes(jam);
                    const style = found ? 'bg-red-100' : 'bg-green-100';
                    const displayJam = `<span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium ${style} text-${found ? 'red' : 'green'}-800">${jam}:00</span>`;

                    jamTersedia.innerHTML += `<li>${displayJam}</li>`;
                });
            } else {
                jadwal.forEach(jam => {
                    jamTersedia.innerHTML += `<span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-${room === 'Aula' ? 'green' : 'blue'}-800">${jam}:00</span>`;
                });
            }
        }

        fasilitasWithAlias.forEach(room => {
            const roomName = room[0];
            const roomAlias = room[1];
            
            processRoomSchedule(roomName, dateValue, roomAlias);
        });

        // processRoomSchedule('Area Selasar', dateValue, 'selasar');
        // processRoomSchedule('Ruang Rapat DPMPTSP', dateValue, 'dpmptsp');
        // processRoomSchedule('Ruang Rapat Umum', dateValue, 'umum');
        // processRoomSchedule('Ruang Rapat Terbatas', dateValue, 'terbatas');
        // processRoomSchedule('Ruang Ballroom', dateValue, 'ballroom');
        // processRoomSchedule('Ruang Multimedia', dateValue, 'multimedia');
        // processRoomSchedule('Ruang Podcast', dateValue, 'podcast');
    }
</script>


@endsection

