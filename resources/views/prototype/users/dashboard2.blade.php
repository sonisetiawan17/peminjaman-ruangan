@extends('layouts.user')

@section('title', 'Dashboard V2')

@push('css')
    <link href="/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />
    <link href="/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <link href="/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
@endpush

@section('content')

    @php
        $data_jam = ['8', '9', '10', '11', '12', '13', '14', '15'];
        $jadwal = $jadwalArray;

        $curr = '2024-01-24';
        $arr = [['2024-02-01', '10', '13'], ['2024-02-02', '9', '11']];

        $filteredData = [];

        foreach ($arr as $data) {
            if ($data[0] === $curr) {
                $start = intval($data[1]);
                $end = intval($data[2]);

                $filteredData[] = array_map('strval', range($start, $end));
            }
        }

        $filteredData = array_merge(...$filteredData);
    @endphp

    <div class="panel-body panel-form">
        <div class="form-group row mb-3">
            <label class="col-lg-4 col-form-label">Mulai Tanggal</label>
            <div class="col-lg-3">
                <input type="date" class="form-control form-input text-small" name="tgl_mulai" id="tgl_mulai"
                    onchange="checkDate()" />
            </div>
        </div>
    </div>

    <div class="panel-body panel-form">
        <div class="form-group row mb-3">
            <label class="col-lg-4 col-form-label">Mulai Jam</label>
            <div class="col-lg-6">
                <div class="btn-group">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons" id="data-jam">
                        <p class="tgl_info">*Silahkan pilih tanggal mulai terlebih dahulu, untuk melihat jam yang tersedia.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-body panel-form">
        <div class="form-group row mb-3">
            <label class="col-lg-4 col-form-label">Selesai Tanggal</label>
            <div class="col-lg-3">
                <input type="date" class="form-control form-input text-small" name="tgl_selesai" id="tgl_selesai"
                    onchange="checkDateDua()" />
            </div>
        </div>
    </div>

    <div class="panel-body panel-form">
        <div class="form-group row mb-3">
            <label class="col-lg-4 col-form-label">Selesai Jam</label>
            <div class="col-lg-6">
                <div class="btn-group">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons" id="data-jam-dua">
                        <p class="tgl_info">*Silahkan pilih tanggal selesai terlebih dahulu, untuk melihat jam yang tersedia.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="panel-body panel-form">
    <div class="form-group row mb-3">
        <label class="col-lg-4 col-form-label">Selesai Tanggal</label>
        <div class="col-lg-3">
            <input type="date" class="form-control form-input text-small" name="tgl_selesai" id="tgl_selesai" onchange="checkDate()" />
        </div>
    </div>
</div>

<div class="panel-body panel-form">
    <div class="form-group row mb-3">
        <label class="col-lg-4 col-form-label">Selesai Jam</label>
        <div class="col-lg-6">
            <div class="btn-group">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-white" id="{{ $jam_selesai && in_array("8", $jam_selesai) ? "result" : "8" }}">                        
                        <input type="radio" name="jam_selesai" value="8"
                            id="8" />08:00
                    </label>
                    <label class="btn btn-white" id="{{ $jam_selesai && in_array("9", $jam_selesai) ? "result" : "9" }}">
                        <input type="radio" name="jam_selesai" value="9"
                            id="9" />09:00
                    </label>
                    <label class="btn btn-white" id="{{ $jam_selesai && in_array("10", $jam_selesai) ? "result" : "10" }}">
                        <input type="radio" name="jam_selesai" value="10"
                            id="10" />10:00
                    </label>
                    <label class="btn btn-white" id="{{ $jam_selesai && in_array("11", $jam_selesai) ? "result" : "11" }}">
                        <input type="radio" name="jam_selesai" value="11"
                            id="11" />11:00
                    </label>
                    <label class="btn btn-white" id="{{ $jam_selesai && in_array("12", $jam_selesai) ? "result" : "12" }}">
                        <input type="radio" name="jam_selesai" value="12"
                            id="12" />12:00
                    </label>
                    <label class="btn btn-white" id="{{ $jam_selesai && in_array("13", $jam_selesai) ? "result" : "13" }}">
                        <input type="radio" name="jam_selesai" value="13"
                            id="13" />13:00
                    </label>
                    <label class="btn btn-white" id="{{ $jam_selesai && in_array("14", $jam_selesai) ? "result" : "14" }}">
                        <input type="radio" name="jam_selesai" value="14"
                            id="14" />14:00
                    </label>
                    <label class="btn btn-white" id="{{ $jam_selesai && in_array("15", $jam_selesai) ? "result" : "15" }}">
                        <input type="radio" name="jam_selesai" value="15"
                            id="15" />15:00
                    </label>
                </div>
            </div>
        </div>
    </div>
</div> --}}

    {{-- <h1 id="result">False</h1> --}}

@endsection

@push('scripts')
    <script src="/assets/plugins/d3/d3.min.js"></script>
    <script src="/assets/plugins/nvd3/build/nv.d3.js"></script>
    <script src="/assets/plugins/jvectormap-next/jquery-jvectormap.min.js"></script>
    <script src="/assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js"></script>
    <script src="/assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
    <script src="/assets/plugins/gritter/js/jquery.gritter.js"></script>
    <script src="/assets/js/demo/dashboard-v2.js"></script>

    <script>
        let tabs = document.querySelectorAll(".tab");
        let indicator = document.querySelector(".indicator");
        let panels = document.querySelectorAll(".tab-panel");

        indicator.style.width = tabs[0].getBoundingClientRect().width + "px";
        indicator.style.left =
            tabs[0].getBoundingClientRect().left -
            tabs[0].parentElement.getBoundingClientRect().left +
            "px";

        tabs.forEach((tab) => {
            tab.addEventListener("click", () => {
                let tabTarget = tab.getAttribute("aria-controls");

                indicator.style.width = tab.getBoundingClientRect().width + "px";
                indicator.style.left =
                    tab.getBoundingClientRect().left -
                    tab.parentElement.getBoundingClientRect().left +
                    "px";

                panels.forEach((panel) => {
                    let panelId = panel.getAttribute("id");
                    if (tabTarget === panelId) {
                        panel.classList.remove("invisible", "opacity-0");
                        panel.classList.add("visible", "opacity-100");
                    } else {
                        panel.classList.add("invisible", "opacity-0");
                    }
                });
            });
        });
    </script>

    <script>
        function checkDate() {
            const selectedDate = document.getElementById("tgl_mulai").value
            const currentDate = @json($arr);

            const matchingDateItem = currentDate.find(item => item[0] === selectedDate);
            const emptyArr = [];
            const newArray = [];

            if (matchingDateItem) {
                const index1 = matchingDateItem[1];
                const index2 = matchingDateItem[2];
                emptyArr.push(index1, index2)
            } else {
                console.log("Tanggal tidak ditemukan dalam array.");
            }

            for (let i = parseInt(emptyArr[0]); i <= parseInt(emptyArr[1]); i++) {
                newArray.push(i.toString().padStart(1, '0'));
            }

            console.log(newArray);

            // ===================================================================

            const jam = document.getElementById("data-jam");

            const isDateInCurrentDate = currentDate.some(item => item[0] === selectedDate);

            jam.innerHTML = '';

            if (isDateInCurrentDate) {
                for (let i = 8; i <= 15; i++) {
                    const value = i.toString();
                    const isUsed = newArray.includes(value);

                    jam.innerHTML +=
                        `<label class="btn ${isUsed ? 'bg-red-500 disabled' : 'btn-white'}" id="result">
                            <input type="radio" name="jam_mulai" value="${value}" id="${value}" />
                            ${value}:00
                        </label>`;
                }
            } else {
                for (let i = 8; i <= 15; i++) {
                    const value = i.toString();
                    jam.innerHTML +=
                        `<label class="btn btn-white" id="result"><input type="radio" name="jam_mulai" value="${value}" id="${value}" />${value}:00</label>`;
                }
            }
        }

        function checkDateDua() {
            const selectedDate = document.getElementById("tgl_selesai").value
            const currentDate = @json($arr);

            const matchingDateItem = currentDate.find(item => item[0] === selectedDate);
            const emptyArr = [];
            const newArray = [];

            if (matchingDateItem) {
                const index1 = matchingDateItem[1];
                const index2 = matchingDateItem[2];
                emptyArr.push(index1, index2)
            } else {
                console.log("Tanggal tidak ditemukan dalam array.");
            }

            for (let i = parseInt(emptyArr[0]); i <= parseInt(emptyArr[1]); i++) {
                newArray.push(i.toString().padStart(1, '0'));
            }

            console.log(newArray);

            // ===================================================================

            const jam = document.getElementById("data-jam-dua");

            const isDateInCurrentDate = currentDate.some(item => item[0] === selectedDate);

            jam.innerHTML = '';

            if (isDateInCurrentDate) {
                for (let i = 8; i <= 15; i++) {
                    const value = i.toString();

                    if (!newArray.includes(value)) {
                        jam.innerHTML +=
                            `<label class="btn btn-white" id="result"><input type="radio" name="jam_selesai" value="${value}" id="${value}" />${value}:00</label>`;
                    }
                }
            } else {
                for (let i = 8; i <= 15; i++) {
                    const value = i.toString();
                    jam.innerHTML +=
                        `<label class="btn btn-white" id="result"><input type="radio" name="jam_selesai" value="${value}" id="${value}" />${value}:00</label>`;
                }
            }
        }
    </script>

    {{-- <script>
        function checkDate() {
            const selectedDate = document.getElementById("tgl_mulai").value
            const currentDate = @json($currentDate); 

            const isDateInCurrentDate = currentDate.includes(selectedDate);

            if (isDateInCurrentDate) {
                document.getElementById("result").classList.add('hidden');
            } else {
                document.getElementById("result").classList.remove('hidden');
            }
        }
    </script> --}}
@endpush
