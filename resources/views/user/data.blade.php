<table class="min-w-full divide-y divide-gray-200">
    <thead>
      <tr class="divide-x divide-gray-200">
        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Nama Pemohon</th>
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
            <td class="px-3 py-4 whitespace-nowrap text-xs text-gray-800">{{ $data->name }}</td>
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

  {!! $permohonan->render() !!}