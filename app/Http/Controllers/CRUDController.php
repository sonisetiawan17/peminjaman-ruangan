<?php

namespace App\Http\Controllers;

use App\Models\AlatPendukung;
use App\Models\BidangKegiatan;
use App\Models\BlokRuangan;
use App\Models\Fasilitas;
use App\Models\Instansi;
use App\Models\Permohonan;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class CRUDController extends Controller
{
    public function index_jadwal()
    {
        $fasilitas = DB::table('fasilitas')->select('nama_fasilitas')->get();
        $fasilitasArray = DB::table('fasilitas')->pluck('nama_fasilitas')->toArray();

        $currentDate = Carbon::now()->format('Y-m-d');
        $currentMonth = Carbon::now()->format('M');
        $currentMonthFullName = Carbon::now()->format('F');
        $currentMonthNum = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');

        if ($currentMonthFullName === 'January') {
            $month = 'Januari';
        } elseif ($currentMonthFullName === 'February') {
            $month = 'Februari';
        } elseif ($currentMonthFullName === 'March') {
            $month = 'Maret';
        } elseif ($currentMonthFullName === 'April') {
            $month = 'April';
        } elseif ($currentMonthFullName === 'May') {
            $month = 'Mei';
        } elseif ($currentMonthFullName === 'June') {
            $month = 'Juni';
        } elseif ($currentMonthFullName === 'July') {
            $month = 'Juli';
        } elseif ($currentMonthFullName === 'August') {
            $month = 'Agustus';
        } elseif ($currentMonthFullName === 'September') {
            $month = 'September';
        } elseif ($currentMonthFullName === 'October') {
            $month = 'Oktober';
        } elseif ($currentMonthFullName === 'November') {
            $month = 'November';
        } elseif ($currentMonthFullName === 'December') {
            $month = 'Desember';
        }

        $jadwal = DB::table('permohonan')
                    ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                    ->join('users', 'users.id', '=', 'permohonan.user_id')
                    ->join('fasilitas', 'fasilitas.id_fasilitas', '=', 'permohonan.fasilitas_id')
                    ->whereDate('tgl_mulai', '>=', $currentDate)
                    ->get();

        $startDate = Carbon::now()->format('d');
        $endDate = Carbon::now()->endOfMonth()->format('d');        
        $day = [];

        for ($i = intval($startDate); $i <= intval($endDate); $i++) {
            $day[] = str_pad($i, 2, '0', STR_PAD_LEFT);
        }

        $currentDay = array_map(function ($item) use ($currentYear, $currentMonthNum) {
            return $currentYear . '-' . $currentMonthNum . '-' . $item;
        }, $day); 

        $startDateNextMonth = Carbon::now()->addMonths(1)->startOfMonth()->format('d');
        $endDateNextMonth = Carbon::now()->addMonths(1)->endOfMonth()->format('d');
        $nextMonth = Carbon::now()->addMonths(1)->format('m');
        $dayNextMonth = [];

        for ($i = intval($startDateNextMonth); $i <= intval($endDateNextMonth); $i++) {
            $dayNextMonth[] = str_pad($i, 2, '0', STR_PAD_LEFT);
        }

        $daysForNextMonth = array_map(function ($item) use ($currentYear, $nextMonth) {
            return $currentYear . '-' . $nextMonth . '-' . $item;
        }, $dayNextMonth);

        $dayMerge = array_merge($currentDay, $daysForNextMonth);

        $currentJadwal = DB::table('permohonan')
                            ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                            ->join('users', 'users.id', '=', 'permohonan.user_id')
                            ->join('fasilitas', 'fasilitas.id_fasilitas', '=', 'permohonan.fasilitas_id')
                            ->where('tgl_mulai', '=', $currentDate)
                            ->get();

        function processRoomSchedule($currentJadwal, $room, $currentDate)
        {
            $resultArray = collect($currentJadwal)->map(function ($jadwal) {
                return [
                    $jadwal->nama_fasilitas,
                    $jadwal->tgl_mulai,
                    $jadwal->tgl_selesai,
                    $jadwal->jam_mulai,
                    $jadwal->jam_selesai,
                ];
            })->toArray();

            $matchingDateItems = collect($resultArray)->filter(function ($item) use ($room, $currentDate) {
                return $item[0] === $room && ($item[1] === $currentDate || $item[2] === $currentDate);
            });

            $uniqueValues = collect();

            if ($matchingDateItems->count() > 0) {
                $matchingDateItems->each(function ($item) use ($currentDate, &$uniqueValues) {
                    $index1 = (int)$item[3];
                    $index2 = (int)$item[4];

                    if ($item[1] === $currentDate && $item[2] === $currentDate) {
                        for ($i = $index1; $i <= $index2; $i++) {
                            $uniqueValues->add(str_pad($i, 2, "0", STR_PAD_LEFT));
                        }
                    } elseif ($item[1] === $currentDate) {
                        for ($i = $index1; $i <= 17; $i++) {
                            $uniqueValues->add(str_pad($i, 2, "0", STR_PAD_LEFT));
                        }
                    } elseif ($item[2] === $currentDate) {
                        for ($i = 8; $i <= $index2; $i++) {
                            $uniqueValues->add(str_pad($i, 2, "0", STR_PAD_LEFT));
                        }
                    }
                });

                return $uniqueValues->sort()->values()->toArray();
            } else {
                return [];
            }
        }

        $fasilitasWithAlias = array_map(function ($item) {
            $words = explode(' ', $item);
            $lastWord = strtolower(end($words));
            return [$item, $lastWord];
        }, $fasilitasArray);

        $newArray = [];

        foreach ($fasilitasArray as $roomName) {
            $newArray[$roomName] = processRoomSchedule($currentJadwal, $roomName, $currentDate);
        }
        
        return view('super-admin.data-jadwal', compact('fasilitas', 'jadwal', 'day', 'dayMerge', 'month', 'currentDate', 'currentMonth', 'currentMonthNum', 'currentYear', 'currentJadwal', 'newArray', 'fasilitasWithAlias'));
    }

    public function filter(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $students = Student::whereDate('created_at', '>=', $start_date)
                            ->whereDate('created_at', '<=', $end_date)
                            ->get();
        
        return view('super-admin.data-jadwal', compact('students'));
    }

    // ============= FASILITAS =============

    public function index_fasilitas()
    {
        $fasilitas = Fasilitas::get();
        $user = auth::user()->name;

        if ($user == 'Admin') {
            return view('admin.data-fasilitas', compact('fasilitas'));
        } elseif ($user == 'Super Admin') {
            return view('super-admin.data-fasilitas', compact('fasilitas'));
        }
    }

    public function simpan_fasilitas(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:doc,docx,xls,xlsx,pdf,jpg,jpeg,png,bmp',
        ]);

        if ($request->hasFile('file')) {
            $uploadPath = public_path('foto_fasilitas');

            if (!File::isDirectory($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true, true);
            }

            $file = $request->file('file');
            $explode = explode('.', $file->getClientOriginalName());
            $originalName = $explode[0];
            $extension = $file->getClientOriginalExtension();
            $rename = 'file_' . date('YmdHis') . '.' . $extension;
            $mime = $file->getClientMimeType();
            $filesize = $file->getSize();
            $nama_fasilitas = $request->nama_fasilitas;
            $kapasitas = $request->kapasitas;
            $lokasi = $request->lokasi;
            $fasilitas = $request->fasilitas;
            $waktu_pemanfaatan = $request->waktu_pemanfaatan;

            if ($file->move($uploadPath, $rename)) {
                $media = new Fasilitas();
                $media->nama_fasilitas = $nama_fasilitas;
                $media->kapasitas = $kapasitas;
                $media->lokasi = $lokasi;
                $media->fasilitas = $fasilitas;
                $media->waktu_pemanfaatan = $waktu_pemanfaatan;
                $media->nama = $originalName;
                $media->file = $rename;
                $media->extension = $extension;
                $media->size = $filesize;
                $media->mime = $mime;
                $media->save();

                return redirect()
                    ->back()
                    ->with('sukses', 'Berhasil, file telah di upload');
            }

            return redirect()
                ->back()
                ->with('error', 'Error, file tidak dapat di upload');
        }

        return redirect()
            ->back()
            ->with('error', 'Error, tidak ada file ditemukan');
    }

    public function ubah_fasilitas(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:doc,docx,xls,xlsx,pdf,jpg,jpeg,png,bmp',
        ]);

        if ($request->hasFile('file')) {
            $uploadPath = public_path('foto_fasilitas');

            if (!File::isDirectory($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true, true);
            }

            $file = $request->file('file');
            $explode = explode('.', $file->getClientOriginalName());
            $originalName = $explode[0];
            $extension = $file->getClientOriginalExtension();
            $rename = 'file_' . date('YmdHis') . '.' . $extension;
            $mime = $file->getClientMimeType();
            $filesize = $file->getSize();
            $nama_fasilitas = $request->nama_fasilitas;
            $kapasitas = $request->kapasitas;
            $lokasi = $request->lokasi;
            $fasilitas = $request->fasilitas;
            $waktu_pemanfaatan = $request->waktu_pemanfaatan;

            if ($file->move($uploadPath, $rename)) {
                $id_fasilitas = $request->id_fasilitas;
                $fasilitas = Fasilitas::find($id_fasilitas);
                $fasilitas->nama_fasilitas = $nama_fasilitas;
                $fasilitas->kapasitas = $kapasitas;
                $fasilitas->lokasi = $lokasi;
                $fasilitas->fasilitas = $fasilitas;
                $fasilitas->waktu_pemanfaatan = $waktu_pemanfaatan;
                $fasilitas->nama = $originalName;
                $fasilitas->file = $rename;
                $fasilitas->extension = $extension;
                $fasilitas->size = $filesize;
                $fasilitas->mime = $mime;
                $fasilitas->update();

                return redirect()
                    ->back()
                    ->with('sukses', 'Data berhasil diubah');
            }
            
            return redirect()
                ->back()
                ->with('sukses', 'Error, file tidak dapat di upload');
        }

        return redirect()
            ->back()
            ->with('sukses', 'Error, tidak ada file ditemukan');
    }

    public function hapus_fasilitas($id_fasilitas)
    {
        $data = Fasilitas::find($id_fasilitas);
        $data->delete();
        return redirect()
            ->back()
            ->with('sukses', 'Data Berhasil dihapus!');
    }

    // ============= ADMIN =============
    public function index_admin()
    {
        // $users = User::where('name', 'LIKE', 'Admin%')->get();
        $users = DB::table('users')->where('tipe', 'admin')->get();

        $user = auth::user()->name;

        if ($user == 'Admin') {
            return view('admin.data-admin', compact('users'));
        } elseif ($user == 'Super Admin') {
            return view('super-admin.data-admin', compact('users'));
        }
    }

    public function simpan_admin(Request $request)
    {
        $data = new User();
        $user = auth::user()->name;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->tipe = $request->tipe;
        $data->password = bcrypt($request->password);
        $data->save();

        $data->assignRole('admin');

        if ($user == 'Admin') {
            return redirect('admin/admin')->with('sukses', 'Data Berhasil ditambahkan!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/admin')->with('sukses', 'Data Berhasil ditambahkan!');
        }
    }

    public function lihat_admin($id)
    {
        $user = User::find($id);

        $role = auth::user()->name;

        if ($role == 'Admin') {
            return view('admin.lihat-users', compact('user'));
        } elseif ($role == 'Super Admin') {
            return view('super-admin.lihat-users', compact('user'));
        }
    }

    public function hapus_admin($id)
    {
        $data = User::find($id);
        $user = auth::user()->name;
        $data->delete();

        if ($user == 'Admin') {
            return redirect('admin/admin')->with('sukses', 'Data Berhasil dihapus!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/admin')->with('sukses', 'Data Berhasil dihapus!');
        }
    }

    public function ubah_admin(Request $request)
    {
        $id = $request->id;
        $data = User::find($id);
        $user = auth::user()->name;

        $data->name = $request->name;
        $data->email = $request->email;
        
        if ($request->password !== null) {
            $data->password = Hash::make($request->password);
        }

        $data->update();

        $data->assignRole('admin');

        if ($user == 'Admin') {
            return redirect('admin/admin')->with('sukses', 'Data Berhasil diubah!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/admin')->with('sukses', 'Data Berhasil diubah!');
        }
    }

    // ============= USERS =============
    public function index_users()
    {
        $instansi = Instansi::get();
        $users = User::whereNotIn('name', ['Admin', 'Super Admin'])
                     ->where('tipe', null)
                     ->orderBy('created_at', 'desc')
                     ->get();

        $user = auth::user()->name;

        if ($user == 'Admin') {
            return view('admin.data-users', compact('users', 'instansi'));
        } elseif ($user == 'Super Admin') {
            return view('super-admin.data-users', compact('users', 'instansi'));
        }
    }

    public function lihat_users($id)
    {
        
        $user = User::find($id);
        $user_id = $user->id;

        $role = auth::user()->name;

        $status_diterima = DB::table('permohonan')
                             ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                             ->where('status_permohonan', 'Diterima')
                             ->where('permohonan.user_id', $user_id)
                             ->count();
        
        $status_menunggu = DB::table('permohonan')
                            ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                            ->where('status_permohonan', 'Menunggu')
                            ->where('permohonan.user_id', $user_id)
                            ->count();
            
        $status_ditolak = DB::table('permohonan')
                            ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                            ->where('status_permohonan', 'Ditolak')
                            ->where('permohonan.user_id', $user_id)
                            ->count();
        
        $permohonan = DB::table('permohonan')
                            ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                            ->where('jadwal.user_id', $user_id)
                            ->selectRaw('DATE_FORMAT(permohonan.created_at, "%b") as bulan, COUNT(*) as jumlah_permohonan')
                            ->groupBy('bulan')
                            ->get();
        
        $jumlah_permohonan = '';

        if ($permohonan) {
            foreach ($permohonan as $data) {
                $jumlah_permohonan = $data->jumlah_permohonan;
            }
        } else {
            $jumlah_permohonan = 0;
        }

        if ($role == 'Admin') {
            return view('admin.lihat-users', compact('user', 'status_diterima', 'status_menunggu', 'status_ditolak', 'jumlah_permohonan'));
        } elseif ($role == 'Super Admin') {
            return view('super-admin.lihat-users', compact('user', 'status_diterima', 'status_menunggu', 'status_ditolak', 'jumlah_permohonan'));
        }
    }

    public function hapus_users($id)
    {
        $data = User::find($id);
        $user = auth::user()->name;
        $data->delete();

        if ($user == 'Admin') {
            return redirect('admin/users')->with('sukses', 'Data Berhasil dihapus!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/users')->with('sukses', 'Data Berhasil dihapus!');
        }
    }

    public function ubah_users(Request $request)
    {
        $user_id = $request->id;
        $data = User::find($user_id);
        $user = Auth::user()->name;

        $data->id = $user_id;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->nik = $request->nik;
        $data->no_telp = $request->no_telp;
        
        if ($request->password !== null) {
            $data->password = Hash::make($request->password);
        }

        $data->update();

        if ($user == 'Admin') {
            return redirect('admin/users')->with('sukses', 'Data Berhasil diubah!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/users')->with('sukses', 'Data Berhasil diubah!');
        }
    }

    // ============= INSTANSI =============

    public function index_instansi()
    {
        $instansi = Instansi::get();
        $user = auth::user()->name;

        if ($user == 'Admin') {
            return view('admin.data-instansi', compact('instansi'));
        } elseif ($user == 'Super Admin') {
            return view('super-admin.data-instansi', compact('instansi'));
        }
    }

    public function simpan_instansi(Request $request)
    {
        $data = new Instansi();
        $user = auth::user()->name;
        $data->nama_instansi = $request->nama_instansi;
        $data->save();

        if ($user == 'Admin') {
            return redirect('admin/instansi')->with('sukses', 'Data Berhasil ditambahkan!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/instansi')->with('sukses', 'Data Berhasil ditambahkan!');
        }
    }

    public function hapus_instansi($id_instansi)
    {
        $data = Instansi::find($id_instansi);
        $user = auth::user()->name;
        $data->delete();

        if ($user == 'Admin') {
            return redirect('admin/instansi')->with('sukses', 'Data Berhasil dihapus!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/instansi')->with('sukses', 'Data Berhasil dihapus!');
        }
    }

    public function ubah_instansi(Request $request)
    {
        $id_instansi = $request->id_instansi;
        $user = auth::user()->name;
        $data = Instansi::find($id_instansi);
        $data->nama_instansi = $request->nama_instansi;
        $data->update();

        if ($user == 'Admin') {
            return redirect('admin/instansi')->with('sukses', 'Data Berhasil diubah!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/instansi')->with('sukses', 'Data Berhasil diubah!');
        }
    }

    // ============= ALAT PENDUKUNG =============
    public function index_alat()
    {
        $alat = AlatPendukung::get();
        $user = auth::user()->name;

        if ($user == 'Admin') {
            return view('admin.data-alat-pendukung', compact('alat'));
        } elseif ($user == 'Super Admin') {
            return view('super-admin.data-alat-pendukung', compact('alat'));
        }
    }

    public function simpan_alat(Request $request)
    {
        $data = new AlatPendukung();
        $user = auth::user()->name;
        $data->nama_alat = $request->nama_alat;
        $data->save();

        if ($user == 'Admin') {
            return redirect('admin/alat-pendukung')->with('sukses', 'Data Berhasil ditambahkan!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/alat-pendukung')->with('sukses', 'Data Berhasil ditambahkan!');
        }
    }

    public function hapus_alat($id_alat_pendukung)
    {
        $data = AlatPendukung::find($id_alat_pendukung);
        $user = auth::user()->name;
        $data->delete();

        if ($user == 'Admin') {
            return redirect('admin/alat-pendukung')->with('sukses', 'Data Berhasil dihapus!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/alat-pendukung')->with('sukses', 'Data Berhasil dihapus!');
        }
    }

    public function ubah_alat(Request $request)
    {
        $id_alat_pendukung = $request->id_alat_pendukung;
        $user = auth::user()->name;
        $data = AlatPendukung::find($id_alat_pendukung);
        $data->nama_alat = $request->nama_alat;
        $data->update();

        if ($user == 'Admin') {
            return redirect('admin/alat-pendukung')->with('sukses', 'Data Berhasil diubah!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/alat-pendukung')->with('sukses', 'Data Berhasil diubah!');
        }
    }

    // ============= BLOK RUANGAN =============
    public function index_blok_ruangan()
    {
        $ruangan = BlokRuangan::get();
        $fasilitas = DB::table('fasilitas')->get();
        $user = auth::user()->name;

        if ($user == 'Admin') {
            return view('admin.data-blok-ruangan', compact('ruangan', 'fasilitas'));
        } elseif ($user == 'Super Admin') {
            return view('super-admin.data-blok-ruangan', compact('ruangan', 'fasilitas'));
        }
    }

    public function simpan_blok_ruangan(Request $request)
    {
        $fasilitas = $request->fasilitas_id;
        $tgl_mulai = $request->tgl_mulai;
        $tgl_selesai = $request->tgl_selesai;

        $jadwal = DB::table('permohonan')
                    ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                    ->join('fasilitas', 'fasilitas.id_fasilitas', '=', 'permohonan.fasilitas_id')
                    ->select('fasilitas.id_fasilitas', 'nama_fasilitas', 'tgl_mulai', 'tgl_selesai')
                    ->get();
            
        $jadwalArray = collect($jadwal)->map(function ($jadwal) {
            return [
                $jadwal->id_fasilitas,
                $jadwal->nama_fasilitas,
                $jadwal->tgl_mulai,
                $jadwal->tgl_selesai
            ];
        })->toArray();

        $matchingDateItems = array_filter($jadwalArray, function ($data) use ($fasilitas, $tgl_mulai, $tgl_selesai) {
            return $data[0] == (int) $fasilitas && ($data[2] == $tgl_mulai || $data[3] == $tgl_selesai);
        });

        if (!empty($matchingDateItems)) {
            return back()->with('error', 'Terdapat reservasi ruangan pada tanggal tersebut, silahkan pilih tanggal lain!');
        } else {
            $data = new BlokRuangan();
            $user = auth::user()->name;
            $data->tgl_mulai = $request->tgl_mulai;
            $data->tgl_selesai = $request->tgl_selesai;
            $data->keterangan = $request->keterangan;
            $data->fasilitas_id = $request->fasilitas_id;
            $data->save();

            if ($user == 'Admin') {
                return redirect('admin/blok-ruangan')->with('sukses', 'Data Berhasil ditambahkan!');
            } elseif ($user == 'Super Admin') {
                return redirect('superadmin/blok-ruangan')->with('sukses', 'Data Berhasil ditambahkan!');
            }
        }
    }

    public function hapus_blok_ruangan($id_blok_ruangan)
    {
        $data = BlokRuangan::find($id_blok_ruangan);
        $user = auth::user()->name;
        $data->delete();

        if ($user == 'Admin') {
            return redirect('admin/blok-ruangan')->with('sukses', 'Data Berhasil dihapus!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/blok-ruangan')->with('sukses', 'Data Berhasil dihapus!');
        }
    }

    public function ubah_blok_ruangan(Request $request)
    {
        $id_blok_ruangan = $request->id_blok_ruangan;
        $user = auth::user()->name;
        $data = BlokRuangan::find($id_blok_ruangan);

        $data->tgl_mulai = $request->tgl_mulai;
        $data->tgl_selesai = $request->tgl_selesai;
        $data->keterangan = $request->keterangan;
        $data->fasilitas_id = $request->fasilitas_id;
        $data->update();

        if ($user == 'Admin') {
            return redirect('admin/blok-ruangan')->with('sukses', 'Data Berhasil diubah!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/blok-ruangan')->with('sukses', 'Data Berhasil diubah!');
        }
    }

    // ============= BIDANG KEGIATAN =============
    public function index_bidang_kegiatan()
    {
        $bidang = BidangKegiatan::get();
        $user = auth::user()->name;

        if ($user == 'Admin') {
            return view('admin.data-bidang-kegiatan', compact('bidang'));
        } elseif ($user == 'Super Admin') {
            return view('super-admin.data-bidang-kegiatan', compact('bidang'));
        }
    }

    public function simpan_bidang_kegiatan(Request $request)
    {
        $data = new BidangKegiatan();
        $user = auth::user()->name;
        $data->nama_bidang = $request->nama_bidang;
        $data->save();

        if ($user == 'Admin') {
            return redirect('admin/bidang-kegiatan')->with('sukses', 'Data Berhasil ditambahkan!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/bidang-kegiatan')->with('sukses', 'Data Berhasil ditambahkan!');
        }
    }

    public function hapus_bidang_kegiatan($id_bidang_kegiatan)
    {
        $data = BidangKegiatan::find($id_bidang_kegiatan);
        $user = auth::user()->name;
        $data->delete();

        if ($user == 'Admin') {
            return redirect('admin/bidang-kegiatan')->with('sukses', 'Data Berhasil dihapus!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/bidang-kegiatan')->with('sukses', 'Data Berhasil dihapus!');
        }
    }

    public function ubah_bidang_kegiatan(Request $request)
    {
        $id_bidang_kegiatan = $request->id_bidang_kegiatan;
        $user = auth::user()->name;
        $data = BidangKegiatan::find($id_bidang_kegiatan);
        $data->nama_bidang = $request->nama_bidang;
        $simpan = $data->update();

        if ($user == 'Admin') {
            return redirect('admin/bidang-kegiatan')->with('sukses', 'Data Berhasil diubah!');
        } elseif ($user == 'Super Admin') {
            return redirect('superadmin/bidang-kegiatan')->with('sukses', 'Data Berhasil diubah!');
        }
    }

    public function history_permohonan()
    {
        $date = Carbon::now()->format('Y-m-d');
        $permohonan_date = DB::table('permohonan')
            ->select('created_at')
            ->get();
        

        $permohonan = DB::table('permohonan')
            ->join('users', 'users.id', '=', 'permohonan.user_id')
            ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
            ->join('fasilitas', 'fasilitas.id_fasilitas', '=', 'permohonan.fasilitas_id')
            ->get();

        return view('super-admin.histori-permohonan', compact('permohonan'));
    }

    public function lihat_permohonan($id_permohonan)
    {
        $permohonan = Permohonan::find($id_permohonan);

        $user = Permohonan::join('users','users.id','=','permohonan.user_id')
                            ->join('jadwal','jadwal.permohonan_id','permohonan.id_permohonan')
                            ->where('permohonan.id_permohonan',$id_permohonan)
                            ->select('*','permohonan.created_at as dibuat','permohonan.updated_at as diubah')
                            ->first();

        $data = Permohonan::find($id_permohonan)
                                ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                                ->select('*','permohonan.created_at as dibuat','permohonan.updated_at as diubah')
                                ->first();
                    
        return view('super-admin.lihat-permohonan', compact('permohonan', 'data', 'user'));
    }

    public function hapus_permohonan($id_permohonan)
    {
        $data = Permohonan::find($id_permohonan);
        $data->delete();
        return redirect()
            ->back()
            ->with('sukses', 'Data Berhasil dihapus!');
    }
}
