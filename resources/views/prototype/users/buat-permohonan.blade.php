@extends('layouts.user')

@section('title', 'Buat Permohonan')

@push('css')
    <link href="/assets/plugins/smartwizard/dist/css/smart_wizard.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" />
    <link href="/assets/plugins/lightbox2/dist/css/lightbox.css" rel="stylesheet" />
@endpush

@section('content')

    @php
        $data_jam = ['8', '9', '10', '11', '12', '13', '14', '15'];

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

    <div>
        <div>
            <h1 class="text-lg font-semibold">Pilih Ruangan</h1>
        </div>

        <div class="flex items-start gap-3">
            @foreach ($fasilitas as $item)
            <div class="flex flex-col bg-white border shadow-sm rounded-xl w-[25%] mt-3">
                <img class="w-full h-auto rounded-t-xl"
                    src="https://images.unsplash.com/photo-1680868543815-b8666dba60f7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2532&q=80"
                    alt="Image Description">
                <div class="card-content">
                    <h3 class="text-lg font-bold text-gray-800">
                        {{ $item->nama_fasilitas }}
                    </h3>
                    <p class="mt-1 text-gray-500">
                        Some quick example text to build on the card title and make up the bulk of the card's content.
                    </p>
                    <button id="modal_show" type="button" data-toggle="modal" data-target="#isimodal" data-id_fasilitas="{{ $item->id_fasilitas }}" data-nama_fasilitas="{{ $item->nama_fasilitas }}" class="mt-2 py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none w-full">
                        Pilih Ruangan
                    </button>
                </div>
            </div>
            @endforeach
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
                                <label class="col-form-label">Tanggal Mulai <sup class="text-red">*</sup></label>
                                <div class="block">
                                    <input type="date" class="form-control form-input text-small" name="tgl_mulai" id="tgl_mulai" onchange="checkDate()" />
                                </div>
    
                                <label class="col-form-label mt-3">Jam Mulai <sup class="text-red">*</sup></label>
                                <div class="block">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons" id="data-jam">
                                        <p class="tgl_info">*Silahkan pilih tanggal mulai terlebih dahulu.</p>
                                    </div>
                                </div>
    
                                <label class="col-form-label mt-3">Tanggal Selesai <sup class="text-red">*</sup></label>
                                <div class="block">
                                    <input type="date" class="form-control form-input text-small" name="tgl_selesai" id="tgl_selesai" onchange="checkDateDua()" />
                                </div>
    
                                <label class="col-form-label mt-3">Jam Selesai <sup class="text-red">*</sup></label>
                                <div class="block">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons" id="data-jam-dua">
                                        <p class="tgl_info">*Silahkan pilih tanggal selesai terlebih dahulu.</p>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer font-semibold text-sm">
                        <a href="javascript:;" class="button-ghost" data-dismiss="modal">Tutup</a>
                        <button type="submit" class="button-primary">Lanjutkan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="/assets/plugins/smartwizard/dist/js/jquery.smartWizard.js"></script>
    <script src="/assets/js/demo/form-wizards.demo.js"></script>
    <script src="/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
    <script src="/assets/plugins/isotope-layout/dist/isotope.pkgd.min.js"></script>
    <script src="/assets/plugins/lightbox2/dist/js/lightbox.min.js"></script>
    <script src="/assets/js/demo/gallery.demo.js"></script>

    <script type="text/javascript">
        $(document).on("click", "#modal_show", function() {
            var id_fasilitas = $(this).data('id_fasilitas');
            var nama_fasilitas = $(this).data('nama_fasilitas');

            $("#tampil_modal #id_fasilitas").val(id_fasilitas);
            $("#tampil_modal #nama_fasilitas").val(nama_fasilitas);
        })
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
                        `<label class="btn ${isUsed ? 'bg-red-500/20 disabled cursor-not-allowed' : 'btn-white'}" id="result">
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
                    const isUsed = newArray.includes(value);

                    jam.innerHTML +=
                        `<label class="btn ${isUsed ? 'bg-red-500/20 disabled cursor-not-allowed' : 'btn-white'}" id="result">
                            <input type="radio" name="jam_selesai" value="${value}" id="${value}" />
                            ${value}:00
                        </label>`;
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
@endpush
