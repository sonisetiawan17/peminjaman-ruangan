// Logika Utama
const room = "Aula";
const selectedDate = "2024-02-03";
const currentDate = [
    ["Multimedia", "2024-02-03", "9", "12"],
    ["Aula", "2024-02-03", "14", "16"],
];

const matchingDateItems = currentDate.filter(
    (item) => item[0] === room && item[1] === selectedDate
);

const uniqueValues = new Set();

if (matchingDateItems.length > 0) {
    matchingDateItems.forEach((item) => {
        const index1 = parseInt(item[2]);
        const index2 = parseInt(item[3]);

        for (let i = index1; i <= index2; i++) {
            uniqueValues.add(i.toString().padStart(1, "0"));
        }
    });

    const newArray = Array.from(uniqueValues).sort(
        (a, b) => parseInt(a) - parseInt(b)
    );
    console.log(newArray);
} else {
    console.log("Tanggal atau ruangan tidak ditemukan dalam array.");
}

// Logika Kedua
const room = "Aula";
const selectedDate = "2024-02-05";
const currentDate = [
    ["Multimedia", "2024-02-03", "2024-02-03", "9", "12"],
    ["Aula", "2024-02-04", "2024-02-05", "14", "10"],
];

const matchingDateItems = currentDate.filter(
    (item) =>
        item[0] === room &&
        (item[1] === selectedDate || item[2] === selectedDate)
);

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
} else {
    console.log("Ruangan, tanggal, atau keduanya tidak ditemukan dalam array.");
}

// Dashboard.blade.php
function getValue() {
    const radioButton = document.getElementsByName("jam_mulai");
    const labelElement8 = document.getElementById("8-jam_mulai");
    const labelElement9 = document.getElementById("9-jam_mulai");
    const labelElement10 = document.getElementById("10-jam_mulai");
    const labelElement11 = document.getElementById("11-jam_mulai");
    const labelElement12 = document.getElementById("12-jam_mulai");
    const labelElement13 = document.getElementById("13-jam_mulai");
    const labelElement14 = document.getElementById("14-jam_mulai");
    const labelElement15 = document.getElementById("15-jam_mulai");
    const labelElement16 = document.getElementById("16-jam_mulai");

    for (let i = 0; i < radioButton.length; i++) {
        if (radioButton[i].checked) {
            const selectedValue = radioButton[i].value;

            console.log(selectedValue);

            if (
                selectedValue === "8" &&
                labelElement8.classList.contains("cursor-pointer")
            ) {
                labelElement8.style.backgroundColor = "#99f6e4";
                labelElement9.style.backgroundColor = "";
                labelElement10.style.backgroundColor = "";
                labelElement11.style.backgroundColor = "";
                labelElement12.style.backgroundColor = "";
                labelElement13.style.backgroundColor = "";
                labelElement14.style.backgroundColor = "";
                labelElement15.style.backgroundColor = "";
                labelElement16.style.backgroundColor = "";
            } else if (
                selectedValue === "9" &&
                labelElement9.classList.contains("cursor-pointer")
            ) {
                labelElement8.style.backgroundColor = "";
                labelElement9.style.backgroundColor = "#99f6e4";
                labelElement10.style.backgroundColor = "";
                labelElement11.style.backgroundColor = "";
                labelElement12.style.backgroundColor = "";
                labelElement13.style.backgroundColor = "";
                labelElement14.style.backgroundColor = "";
                labelElement15.style.backgroundColor = "";
                labelElement16.style.backgroundColor = "";
            } else if (
                selectedValue === "10" &&
                labelElement10.classList.contains("cursor-pointer")
            ) {
                labelElement8.style.backgroundColor = "";
                labelElement9.style.backgroundColor = "";
                labelElement10.style.backgroundColor = "#99f6e4";
                labelElement11.style.backgroundColor = "";
                labelElement12.style.backgroundColor = "";
                labelElement13.style.backgroundColor = "";
                labelElement14.style.backgroundColor = "";
                labelElement15.style.backgroundColor = "";
                labelElement16.style.backgroundColor = "";
            } else if (
                selectedValue === "11" &&
                labelElement11.classList.contains("cursor-pointer")
            ) {
                labelElement8.style.backgroundColor = "";
                labelElement9.style.backgroundColor = "";
                labelElement10.style.backgroundColor = "";
                labelElement11.style.backgroundColor = "#99f6e4";
                labelElement12.style.backgroundColor = "";
                labelElement13.style.backgroundColor = "";
                labelElement14.style.backgroundColor = "";
                labelElement15.style.backgroundColor = "";
                labelElement16.style.backgroundColor = "";
            } else if (
                selectedValue === "12" &&
                labelElement12.classList.contains("cursor-pointer")
            ) {
                labelElement8.style.backgroundColor = "";
                labelElement9.style.backgroundColor = "";
                labelElement10.style.backgroundColor = "";
                labelElement11.style.backgroundColor = "";
                labelElement12.style.backgroundColor = "#99f6e4";
                labelElement13.style.backgroundColor = "";
                labelElement14.style.backgroundColor = "";
                labelElement15.style.backgroundColor = "";
                labelElement16.style.backgroundColor = "";
            } else if (
                selectedValue === "13" &&
                labelElement13.classList.contains("cursor-pointer")
            ) {
                labelElement8.style.backgroundColor = "";
                labelElement9.style.backgroundColor = "";
                labelElement10.style.backgroundColor = "";
                labelElement11.style.backgroundColor = "";
                labelElement12.style.backgroundColor = "";
                labelElement13.style.backgroundColor = "#99f6e4";
                labelElement14.style.backgroundColor = "";
                labelElement15.style.backgroundColor = "";
                labelElement16.style.backgroundColor = "";
            } else if (
                selectedValue === "14" &&
                labelElement14.classList.contains("cursor-pointer")
            ) {
                labelElement8.style.backgroundColor = "";
                labelElement9.style.backgroundColor = "";
                labelElement10.style.backgroundColor = "";
                labelElement11.style.backgroundColor = "";
                labelElement12.style.backgroundColor = "";
                labelElement13.style.backgroundColor = "";
                labelElement14.style.backgroundColor = "#99f6e4";
                labelElement15.style.backgroundColor = "";
                labelElement16.style.backgroundColor = "";
            } else if (
                selectedValue === "15" &&
                labelElement15.classList.contains("cursor-pointer")
            ) {
                labelElement8.style.backgroundColor = "";
                labelElement9.style.backgroundColor = "";
                labelElement10.style.backgroundColor = "";
                labelElement11.style.backgroundColor = "";
                labelElement12.style.backgroundColor = "";
                labelElement13.style.backgroundColor = "";
                labelElement14.style.backgroundColor = "";
                labelElement15.style.backgroundColor = "#99f6e4";
                labelElement16.style.backgroundColor = "";
            } else if (
                selectedValue === "16" &&
                labelElement16.classList.contains("cursor-pointer")
            ) {
                labelElement8.style.backgroundColor = "";
                labelElement9.style.backgroundColor = "";
                labelElement10.style.backgroundColor = "";
                labelElement11.style.backgroundColor = "";
                labelElement12.style.backgroundColor = "";
                labelElement13.style.backgroundColor = "";
                labelElement14.style.backgroundColor = "";
                labelElement15.style.backgroundColor = "";
                labelElement16.style.backgroundColor = "#99f6e4";
            }
        }
    }
}


// Jadwal.bladed.php

const jadwal = ['8', '9', '10', '11', '12', '13', '14', '15', '16'];

const jamTersediaAula = document.getElementById('jam-aula')
const jamTersediaMultimedia = document.getElementById('jam-multimedia')

jamTersediaAula.innerHTML = '';
jamTersediaMultimedia.innerHTML = '';

        // ===================================================== AULA =====================================================
        const ruangMultimedia = 'Ruang Multimedia';
        const ruangAula = 'Ruang Aula';

        const transformedData = dataJadwal.map(item => [
            item.nama_fasilitas,
            item.tgl_mulai,
            item.tgl_selesai,
            item.jam_mulai,
            item.jam_selesai
        ]);

        console.log(transformedData);
        console.log(dateValue);

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

        console.log(ruangMultimedia);
        console.log(matchingDateItemsSecondary);

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


// Jadwal blade secondary

    const dataJadwal = @json($schedule);
    const fasilitas = @json($namaFasilitas);

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

        // const jamTersediaAula = document.getElementById('jam-aula')
        // const jamTersediaMultimedia = document.getElementById('jam-multimedia')

        // jamTersediaAula.innerHTML = '';
        // jamTersediaMultimedia.innerHTML = '';
        console.log(dataJadwal);


        function processRoomSchedule(room, dateValue, abbreviation) {
            const jadwal = ['8', '9', '10', '11', '12', '13', '14', '15', '16'];

            const jamTersedia = document.getElementById(`jam-${abbreviation}`);
            jamTersedia.innerHTML = '';

            const transformedData = dataJadwal.map(item => [
                item.nama_fasilitas,
                item.tgl_mulai,
                item.tgl_selesai,
                item.jam_mulai,
                item.jam_selesai
            ]);

            console.log(transformedData);

            const matchingDateItems = transformedData.filter(
                item => item[0] === room && (item[1] === dateValue || item[2] === dateValue)
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

        processRoomSchedule('Ruang Aula', dateValue, 'aula');
        processRoomSchedule('Ruang Multimedia', dateValue, 'multimedia');
    }
