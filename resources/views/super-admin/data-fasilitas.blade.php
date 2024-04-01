@extends('layouts.super')

@section('title', 'Data Fasilitas')

@push('css')
    <link href="/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-select-bs4/css/select.bootstrap4.min.css" rel="stylesheet" />

    <link href="/assets/plugins/blueimp-gallery/css/blueimp-gallery.min.css" rel="stylesheet" />
    <link href="/assets/plugins/blueimp-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
    <link href="/assets/plugins/blueimp-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />

    <link href="/assets/plugins/lightbox2/dist/css/lightbox.css" rel="stylesheet" />
@endpush

@section('content')
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
                    <a href="#" class="ms-1 text-sm text-gray-500 md:ms-2 no-underline hover:no-underline">Data
                        Fasilitas</a>
                </div>
            </li>
        </ol>
    </nav>

    <div class="row mt-4">
        <div class="col-xl-12">
            <div class="panel panel-inverse">
                <div class="flex flex-row items-center justify-between">
                    <div class="panel-heading" style="background-color: #ffffff;">
                        <img src="{{ asset('/assets/img/auth/fasilitas.png') }}" alt="users" class="h-6 mr-2" />
                        <h4 class="panel-title text-black">
                            Data Fasilitas
                        </h4>
                    </div>
                    <div class="panel-heading-btn">
                        <a href="#modal-dialog" class="btn btn-sm btn-primary" data-toggle="modal">
                            <i class="fa fa-plus"></i> Tambah Data
                        </a>
                    </div>
                </div>

                <div class="panel-body">
                    <table id="data-table-select" class="table table-striped table-bordered table-td-valign-middle"
                        width="100%">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th class="text-nowrap">Nama Fasilitas</th>
                                <th class="text-nowrap">Foto</th>
                                <th class="text-nowrap">Kapasitas</th>
                                <th class="text-nowrap">Keterangan</th>
                                <th class="text-nowrap" width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach ($fasilitas as $f)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $f->nama_fasilitas }}</td>
                                    <td>
                                        <div class="gallery ml-2">
                                            <a href="/foto_fasilitas/{{ $f->file }}" data-lightbox="gallery-group-1">
                                                <div class="flex flex-row items-center gap-2">
                                                    <img src="{{ asset('/assets/img/auth/image.png') }}" class="w-[30px]" />
                                                    <p style="font-size: 12px">Lihat Gambar</p>
                                                </div>
                                            </a>
                                        </div>
                                    </td>
                                    <td>{{ $f->kapasitas }} orang</td>
                                    <td style="font-size: 12px" class="space-y-1">
                                        <p class="font-semibold text-neutral-500">Nama :
                                            <span class="font-normal">{{ $f->nama }}</span>
                                        </p>
                                        <p class="font-semibold text-neutral-500">Format :
                                            <span class="font-normal uppercase">{{ $f->extension }}</span>
                                        </p>
                                        <p class="font-semibold text-neutral-500">Size :
                                            <span class="font-normal">{{ formatSizeUnits($f->size) }}</span>
                                        </p>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a id="modal_show" href="#" type="button" 
                                                data-toggle="modal"
                                                data-target="#isimodal" 
                                                data-id_fasilitas="{{ $f->id_fasilitas }}"
                                                data-nama_fasilitas="{{ $f->nama_fasilitas }}"
                                                data-kapasitas="{{ $f->kapasitas }}"
                                                data-file="{{ $f->file }}" class="btn btn-white">
                                                <i class="fa fa-edit text-blue"></i>
                                            </a>

                                            <form action="{{ route('superadmin.hapus_fasilitas', $f->id_fasilitas) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-white title="Hapus Data" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fa fa-trash text-red"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Fasilitas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body mx-3">
                    <form action="{{ route('superadmin.simpan_fasilitas') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row m-b-15">
                            <label class="col-md-5 col-form-label">Nama Fasilitas/Ruangan <sup class="text-red">*</sup></label>
                            <div class="col-md-7">
                                <input type="text" name="nama_fasilitas" class="form-control form-input text-small" required />
                            </div>
                            <label class="col-md-5 col-form-label mt-3">Foto <sup class="text-red">*</sup></label>
                            <div class="col-md-7 mt-3">
                                <input type="file" class="block w-full border border-gray-200 text-small focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none file:bg-gray-50 file:border-0 file:me-4 file:py-2 file:px-4" name="file" id="file" style="font-size: 11.5px" required />
                            </div>
                            <label class="col-md-5 col-form-label mt-3">Kapasitas Ruangan <sup class="text-red">*</sup></label>
                            <div class="col-md-7 mt-3">
                                <input type="text" name="kapasitas" class="form-control form-input text-small" required />
                            </div>
                            <label class="col-md-5 col-form-label mt-3">Lokasi <sup class="text-red">*</sup></label>
                            <div class="col-md-7 mt-3">
                                <input type="text" name="lokasi" class="form-control form-input text-small" placeholder="Contoh: Lantai 2" required />
                            </div>
                            <label class="col-md-5 col-form-label mt-3">Fasilitas <sup class="text-red">*</sup></label>
                            <div class="col-md-7 mt-3">
                                <input type="text" name="fasilitas" class="form-control form-input text-small" required />
                            </div>
                            <label class="col-md-5 col-form-label mt-3">Waktu Pemanfaatan <sup class="text-red">*</sup></label>
                            <div class="col-md-7 mt-3">
                                <input type="text" name="waktu_pemanfaatan" class="form-control form-input text-small" placeholder="Senin - Jum'at" required />
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="button-ghost" data-dismiss="modal">Batal</a>
                    <button type="submit" class="button-primary">Tambah</button>
                </div>
            </div>
        </div>
    </div>
    </form>

    <div class="modal fade" id="isimodal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Data Users</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body mx-3" id="tampil_modal">
                    <form method="post" action="{{ route('superadmin.ubah_fasilitas') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row m-b-15">
                            <label class="col-md-4 col-form-label">Nama <sup class="text-red">*</sup></label>
                            <input type="hidden" id="id_fasilitas" name="id_fasilitas">
                            <div class="col-md-8">
                                <input required id="nama_fasilitas" name="nama_fasilitas" type="text"
                                    class="form-control form-input text-small" />
                            </div>
                            <label class="col-md-4 col-form-label mt-3">Foto <sup class="text-red">*</sup></label>
                            <div class="col-md-8 mt-3">
                                <input type="file" class="block w-full border border-gray-200 text-small focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none file:bg-gray-50 file:border-0 file:me-4 file:py-2 file:px-4" name="file" id="file" style="font-size: 11.5px" required />
                            </div>
                            <label class="col-md-4 col-form-label mt-3">Kapasitas <sup class="text-red">*</sup></label>
                            <div class="col-md-8 mt-3">
                                <input type="number" id="kapasitas" name="kapasitas" class="form-control form-input text-small" required />
                            </div>
                            <label class="col-md-4 col-form-label mt-3">Lokasi <sup class="text-red">*</sup></label>
                            <div class="col-md-8 mt-3">
                                <input type="text" id="lokasi" name="lokasi" class="form-control form-input text-small" required placeholder="Contoh: Lt.4" />
                            </div>
                        </div>
                </div>
                <div class="modal-footer font-semibold text-sm">
                    <a href="javascript:;" class="button-ghost" data-dismiss="modal">Tutup</a>
                    <button type="submit" class="button-primary">Ubah Data</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal -->
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).on("click", "#modal_show", function() {
            var id_fasilitas = $(this).data('id_fasilitas');
            var nama_fasilitas = $(this).data('nama_fasilitas');
            var kapasitas = $(this).data('kapasitas');

            $("#tampil_modal #id_fasilitas").val(id_fasilitas);
            $("#tampil_modal #nama_fasilitas").val(nama_fasilitas);
            $("#tampil_modal #kapasitas").val(kapasitas);
        })
    </script>

    <script src="/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="/assets/plugins/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
    <script src="/assets/js/demo/table-manage-select.demo.js"></script>
    <script src="/assets/js/demo/ui-modal-notification.demo.js"></script>

    <!-- The template to display files available for upload -->
    <script id="template-upload" type="text/x-tmpl">
		{% for (var i=0, file; file=o.files[i]; i++) { %}
		<tr class="template-upload fade show">
			<td>
				<span class="preview"></span>
			</td>
			<td>
				<div class="bg-light rounded p-10 mb-2">
					<dl class="m-b-0">
						<dt class="text-inverse">File Name:</dt>
						<dd class="name">{%=file.name%}</dd>
						<dt class="text-inverse m-t-10">File Size:</dt>
						<dd class="size">Processing...</dd>
					</dl>
				</div>
				<strong class="error text-danger h-auto d-block text-left"></strong>
			</td>
			<td nowrap>
				{% if (!i) { %}
					<button class="btn btn-default cancel width-100 p-r-20">
						<i class="fa fa-trash fa-fw text-muted"></i>
						<span>Hapus</span>
					</button>
				{% } %}
			</td>
		</tr>
		{% } %}
	</script>

    <!-- The template to display files available for download -->
    <script id="template-download" type="text/x-tmpl">
		{% for (var i=0, file; file=o.files[i]; i++) { %}
			<tr class="template-download fade show">
				<td width="1%">
					<span class="preview">
						{% if (file.thumbnailUrl) { %}
							<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}" class="rounded"></a>
						{% } else { %}
							<div class="bg-light text-center f-s-20" style="width: 80px; height: 80px; line-height: 80px; border-radius: 6px;">
								<i class="fa fa-file-image fa-lg text-muted"></i>
							</div>
						{% } %}
					</span>
				</td>
				<td>
					<div class="bg-light p-10 mb-2">
						<dl class="m-b-0">
							<dt class="text-inverse">File Name:</dt>
							<dd class="name">
								{% if (file.url) { %}
									<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
								{% } else { %}
									<span>{%=file.name%}</span>
								{% } %}
							</dd>
							<dt class="text-inverse m-t-10">File Size:</dt>
							<dd class="size">{%=o.formatFileSize(file.size)%}</dd>
						</dl>
						{% if (file.error) { %}
							<div><span class="label label-danger">ERROR</span> {%=file.error%}</div>
						{% } %}
					</div>
				</td>
				<td></td>
				<td>
					{% if (file.deleteUrl) { %}
						<button class="btn btn-danger delete width-100 m-r-3 p-r-20" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
							<i class="fa fa-trash pull-left fa-fw text-inverse m-t-2"></i>
							<span>Delete</span>
						</button>
						<input type="checkbox" name="delete" value="1" class="toggle">
					{% } else { %}
						<button class="btn btn-default cancel width-100 m-r-3 p-r-20">
							<i class="fa fa-trash pull-left fa-fw text-muted m-t-2"></i>
							<span>Cancel</span>
						</button>
					{% } %}
				</td>
			</tr>
		{% } %}
	</script>

    <script src="/assets/plugins/blueimp-file-upload/js/vendor/jquery.ui.widget.js"></script>
    <script src="/assets/plugins/blueimp-tmpl/js/tmpl.js"></script>
    <script src="/assets/plugins/blueimp-load-image/js/load-image.all.min.js"></script>
    <script src="/assets/plugins/blueimp-canvas-to-blob/js/canvas-to-blob.js"></script>
    <script src="/assets/plugins/blueimp-gallery/js/jquery.blueimp-gallery.min.js"></script>
    <script src="/assets/plugins/blueimp-file-upload/js/jquery.iframe-transport.js"></script>
    <script src="/assets/plugins/blueimp-file-upload/js/jquery.fileupload.js"></script>
    <script src="/assets/plugins/blueimp-file-upload/js/jquery.fileupload-process.js"></script>
    <script src="/assets/plugins/blueimp-file-upload/js/jquery.fileupload-image.js"></script>
    <script src="/assets/plugins/blueimp-file-upload/js/jquery.fileupload-audio.js"></script>
    <script src="/assets/plugins/blueimp-file-upload/js/jquery.fileupload-video.js"></script>
    <script src="/assets/plugins/blueimp-file-upload/js/jquery.fileupload-validate.js"></script>
    <script src="/assets/plugins/blueimp-file-upload/js/jquery.fileupload-ui.js"></script>
    <script src="/assets/js/demo/form-multiple-upload.demo.js"></script>

    <script src="/assets/plugins/lightbox2/dist/js/lightbox.min.js"></script>
    <script src="/assets/js/demo/gallery.demo.js"></script>
@endpush
