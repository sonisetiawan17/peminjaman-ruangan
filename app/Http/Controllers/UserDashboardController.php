<?php

namespace App\Http\Controllers;

use App\Models\AlatPendukung;
use App\Models\BidangKegiatan;
use App\Models\BlokRuangan;
use App\Models\Fasilitas;
use App\Models\Instansi;
use App\Models\Jadwal;
use App\Models\Jam;
use App\Models\Permohonan;
use App\Models\User;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class UserDashboardController extends Controller
{
    public function index()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $fasilitas = DB::table('fasilitas')->get();
        $fasilitasCount = DB::table('fasilitas')->count();
        $lastFasilitasId = DB::table('fasilitas')
                            ->orderBy('id_fasilitas', 'desc')
                            ->pluck('id_fasilitas')
                            ->first();

        $blokRuangan = DB::table('blok_ruangan')
                          ->whereDate('created_at', '>=', 'tgl_selesai')
                          ->get();

        foreach ($blokRuangan as $key => $value) {
            $tglMulai = new DateTime($value->tgl_mulai);
            $tglSelesai = new DateTime($value->tgl_selesai);
            $interval = DateInterval::createFromDateString('1 day');
            $range_tanggal = [];

            $period = new DatePeriod($tglMulai, $interval, $tglSelesai->modify('+1 day'));

            foreach ($period as $date) {
            $range_tanggal[] = $date->format('Y-m-d');
            }

            $blokRuangan[$key]->range_tanggal = $range_tanggal;
        }

        foreach ($fasilitas as $fasilitasKey => $fasilitasValue) {
            $fasilitas[$fasilitasKey]->range_tanggal = [];
        
            foreach ($blokRuangan as $blokRuanganValue) {
                if ($fasilitasValue->id_fasilitas == $blokRuanganValue->fasilitas_id) {
                    $range_tanggal = $blokRuanganValue->range_tanggal;
                    array_unshift($range_tanggal, $blokRuanganValue->fasilitas_id);

                    $keterangan = $blokRuanganValue->keterangan;
                    array_splice($range_tanggal, 1, 0, $keterangan);

                    $fasilitas[$fasilitasKey]->range_tanggal = $range_tanggal;
                    break;
                }
            }
        }
        
        // $blokRuanganArray = collect($blokRuangan)->map(function ($ruangan) {
        //     return [
        //         $ruangan->fasilitas_id,
        //         $ruangan->tgl_mulai,
        //         $ruangan->tgl_selesai,
        //         $ruangan->keterangan
        //     ];
        // })->toArray();
        
        // $dateRange = [];        
        
        // foreach ($blokRuanganArray as $item) {
        //     if ($currentDate >= $item[1] && $currentDate <= $item[2]) {
        //         $startDate = new Carbon($item[1]);
        //         $endDate = new Carbon($item[2]);
        
        //         $dateRange = [];
        //         while ($startDate <= $endDate) {
        //             $dateRange[] = $startDate->format('Y-m-d');
        //             $startDate->addDay();
        //         }

        //         array_unshift($dateRange, $item[0]);
        //         array_splice($dateRange, 1, 0, $item[3]);
        //         break; 
        //     }
        // }

        $date = Carbon::now()->format('Y-m-d');

        $jam_mulai = DB::table('jadwal')->get();
        $jadwalArray = [];

        if ($jam_mulai->count() > 0) {
            foreach ($jam_mulai as $jam) {
                $currJam[] = $jam->jam_mulai;
            }
            foreach ($jam_mulai as $jadwal) {
                $jadwalArray[] = [$jadwal->tgl_mulai, $jadwal->jam_mulai, $jadwal->jam_selesai];
            }
        } else {
            $jadwalArray = [];
        }

        $jadwal = DB::table('permohonan')
                    ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                    ->join('users', 'users.id', '=', 'permohonan.user_id')
                    ->join('fasilitas', 'fasilitas.id_fasilitas', '=', 'permohonan.fasilitas_id')
                    ->get();

        $jam_selesai = DB::table('jadwal')->select('jam_selesai')->get();
        $jam_selesai_arr = [];

        foreach ($jam_selesai as $jam) {
            $currJamSelesai[] = $jam->jam_selesai;
        }

        $tanggal_selesai = DB::table('jadwal')->select('tgl_selesai')->get();
        $tanggal_selesai_arr = [];

        foreach ($tanggal_selesai as $tanggal) {
            $currDateSelesai[] = $tanggal->tgl_selesai;
        }

        return view('user.dashboard', compact('date', 'jadwalArray', 'fasilitas', 'jadwal', 'blokRuangan', 'currentDate', 'fasilitasCount', 'lastFasilitasId'));
    }

    public function downloadSOP()
    {
        $file_path = public_path('pdf/peminjaman-ruangan-sop.pdf');

        if (file_exists($file_path)) {
            return response()->download($file_path);
        } else {
            return redirect()->back()->with('error', 'File PDF tidak ditemukan');
        }
    }

    public function buatPermohonan()
    {
        $bidang = BidangKegiatan::get();
        $instansi = Instansi::get();
        $fasilitas = DB::table('fasilitas')->get();
        $alat = AlatPendukung::get();
        $blok = BlokRuangan::get();

        $date = Carbon::now()->format('m/d/Y');

        $jadwal = DB::table('jadwal')->join('permohonan', 'permohonan.id_permohonan', '=', 'jadwal.permohonan_id')->select('tgl_mulai', 'tgl_selesai', 'jam_mulai', 'jam_selesai', 'id_fasilitas', 'id_alat')->get();

        return view('user.buat-permohonan', compact('bidang', 'instansi', 'fasilitas', 'alat', 'jadwal', 'blok'));
    }

    public function buatPermohonanForm(Request $request)
    {
        $id_fasilitas = $request->id_fasilitas;
        $nama_fasilitas = $request->nama_fasilitas;
        $file = $request->file;
        $tgl_mulai = $request->tgl_mulai;
        $tgl_selesai = $request->tgl_selesai;
        $jam_mulai = $request->jam_mulai;
        $jam_selesai = $request->jam_selesai;

        $tgl_mulai_convert = Carbon::createFromFormat('Y-m-d', $tgl_mulai)->format('d M Y');
        $tgl_mulai_date_format = Carbon::createFromFormat('Y-m-d', $tgl_mulai);
        $tgl_mulai_day = $tgl_mulai_date_format->format('D');
        
        $tgl_selesai_convert = Carbon::createFromFormat('Y-m-d', $tgl_selesai)->format('d M Y');
        $tgl_selesai_date_format = Carbon::createFromFormat('Y-m-d', $tgl_selesai);
        $tgl_selesai_day = $tgl_selesai_date_format->format('D');

        if ($tgl_mulai_day === 'Mon') {
            $start_day = 'Sen';
        } elseif ($tgl_mulai_day === 'Tue') {
            $start_day = 'Sel';
        } elseif ($tgl_mulai_day === 'Wed') {
            $start_day = 'Rab';
        } elseif ($tgl_mulai_day === 'Thu') {
            $start_day = 'Kam';
        } elseif ($tgl_mulai_day === 'Fri') {
            $start_day = 'Jum';
        } elseif ($tgl_mulai_day === 'Sat') {
            $start_day = 'Sab';
        } elseif ($tgl_mulai_day === 'Sun') {
            $start_day = 'Ming';
        }

        if ($tgl_selesai_day === 'Mon') {
            $end_day = 'Sen';
        } elseif ($tgl_selesai_day === 'Tue') {
            $end_day = 'Sel';
        } elseif ($tgl_selesai_day === 'Wed') {
            $end_day = 'Rab';
        } elseif ($tgl_selesai_day === 'Thu') {
            $end_day = 'Kam';
        } elseif ($tgl_selesai_day === 'Fri') {
            $end_day = 'Jum';
        } elseif ($tgl_selesai_day === 'Sat') {
            $end_day = 'Sab';
        } elseif ($tgl_selesai_day === 'Sun') {
            $end_day = 'Ming';
        }

        $bidang = BidangKegiatan::get();
        $instansi = Instansi::get();
        $fasilitas = Fasilitas::get();
        $alat = AlatPendukung::get();
        $blok = BlokRuangan::get();

        $date = Carbon::now()->format('m/d/Y');

        $jadwal = DB::table('jadwal')
                    ->join('permohonan', 'permohonan.id_permohonan', '=', 'jadwal.permohonan_id')
                    ->select('tgl_mulai', 'tgl_selesai', 'jam_mulai', 'jam_selesai', 'fasilitas_id', 'alat_id')
                    ->get();

        return view('user.buat-permohonan-form', compact('bidang', 'instansi', 'fasilitas', 'alat', 'jadwal', 'blok', 'id_fasilitas', 'nama_fasilitas', 'tgl_mulai', 'tgl_selesai', 'tgl_mulai_day', 'tgl_mulai_convert', 'tgl_selesai_day', 'tgl_selesai_convert', 'jam_mulai', 'jam_selesai', 'start_day', 'end_day', 'file'));
    }

    public function editPermohonan($id_permohonan)
    {
        $fasilitas = DB::table('fasilitas')->get();
        $alat = DB::table('alat_pendukung')->get();
        $bidang = DB::table('bidang_kegiatan')->get();
        $instansi = DB::table('instansi')->get();
        $jadwal = DB::table('jadwal')->where('permohonan_id', $id_permohonan)->get();
        $dataJadwal = DB::table('permohonan')
                    ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                    ->join('users', 'users.id', '=', 'permohonan.user_id')
                    ->join('fasilitas', 'fasilitas.id_fasilitas', '=', 'permohonan.fasilitas_id')
                    ->get();

        $user_id = Auth::user()->id;

        $data = Permohonan::find($id_permohonan);

        $permohonan = DB::table('permohonan')
                        ->join('users', 'users.id', '=', 'permohonan.user_id')
                        ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                        ->join('fasilitas', 'fasilitas.id_fasilitas', '=', 'permohonan.fasilitas_id')
                        ->where('users.id', '=', $user_id)
                        ->where('permohonan.id_permohonan', '=', $id_permohonan)
                        ->first();

        return view('user.edit-permohonan', compact('permohonan', 'fasilitas', 'alat', 'data', 'bidang', 'instansi', 'dataJadwal'));
    }

    public function updatePermohonan(Request $request, $id_permohonan)
    {
        $user_id = Auth::user()->id;

        $request->validate([
            'surat_permohonan' => 'required|mimes:doc,docx,xls,xlsx,pdf,jpg,jpeg,png,bmp',
            'rundown_acara' => 'required|mimes:doc,docx,xls,xlsx,pdf,jpg,jpeg,png,bmp',
        ]);

        if ($request->hasFile('surat_permohonan') && $request->hasFile('rundown_acara')) {
            $uploadPath = public_path('file_upload');

            if (!File::isDirectory($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true, true);
            }

            $file_surat = $request->file('surat_permohonan');
            $file_acara = $request->file('rundown_acara');

            $extension_surat = $file_surat->getClientOriginalExtension();
            $extension_acara = $file_acara->getClientOriginalExtension();

            $rename_surat = 'surat_' . date('YmdHis') . '.' . $extension_surat;
            $rename_acara = 'acara_' . date('YmdHis') . '.' . $extension_acara;

            $id_fasilitas = implode(',', (array) $request->input('id_fasilitas', []));

            if ($request->id_alat > 0) {
                $id_alat = implode(',', (array) $request->input('id_alat', []));
            } else {
                $id_alat = null;
            }

            if ($file_surat->move($uploadPath, $rename_surat) && $file_acara->move($uploadPath, $rename_acara)) {
                $permohonan = Permohonan::find($id_permohonan);
                $permohonan->skpd = $request->skpd;
                $permohonan->bidang_kegiatan = $request->bidang_kegiatan;
                $permohonan->user_id = $user_id;
                $permohonan->status_instansi = $request->status_instansi;
                $permohonan->bidang_instansi = $request->bidang_instansi;
                $permohonan->nama_kegiatan = $request->nama_kegiatan;
                $permohonan->jumlah_peserta = $request->jumlah_peserta;
                $permohonan->narasumber = $request->narasumber;
                $permohonan->output = $request->output;
                $permohonan->outcome = $request->outcome;
                $permohonan->ringkasan = $request->ringkasan;
                $permohonan->status_permohonan = 'Menunggu';

                $permohonan->surat_permohonan = $rename_surat;
                $permohonan->rundown_acara = $rename_acara;

                $permohonan->fasilitas_id = $id_fasilitas;
                $permohonan->alat_id = $id_alat;
                $permohonan->update();

                if (isset($permohonan['id_permohonan'])) {
                    $cekData = [
                        'permohonan_id' => $permohonan['id_permohonan'],
                    ];
                }

                $jadwal = Jadwal::find($request->id_jadwal);
                $jadwal->user_id = $user_id;
                $jadwal->permohonan_id = $cekData['permohonan_id'];
                $jadwal->tgl_mulai = $request->tgl_mulai;
                $jadwal->jam_mulai = $request->jam_mulai;
                $jadwal->tgl_selesai = $request->tgl_selesai;
                $jadwal->jam_selesai = $request->jam_selesai;
                $jadwal->update();

                //  return $data;
                return redirect()->to('/dashboard')->with('sukses', 'Berhasil, file telah di upload');
            }
            //  return $data;
            return redirect()->to('/dashboard')->with('error', 'Error, file tidak dapat di upload');
        }
        //  return "Gagal";
        return redirect()->to('/dashboard')->with('error', 'Error, tidak ada file ditemukan');
    }

    public function batalPermohonan(Request $request)
    {
        $permohonan_id = $request->id_permohonan;
        $permohonan = Permohonan::find($permohonan_id);
        $permohonan->status_permohonan = $request->status_permohonan;

        $permohonan->update();

        return back()->with('sukses', 'Berhasil, file telah di upload');
    }

    public function simpanPermohonan(Request $request)
    {
        $request->validate([
            'surat_permohonan' => 'required|mimes:doc,docx,xls,xlsx,pdf,jpg,jpeg,png,bmp',
            'rundown_acara' => 'required|mimes:doc,docx,xls,xlsx,pdf,jpg,jpeg,png,bmp',
        ]);

        if ($request->hasFile('surat_permohonan') && $request->hasFile('rundown_acara')) {
            $uploadPath = public_path('file_upload');

            if (!File::isDirectory($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true, true);
            }

            $file_surat = $request->file('surat_permohonan');
            $file_acara = $request->file('rundown_acara');

            $extension_surat = $file_surat->getClientOriginalExtension();
            $extension_acara = $file_acara->getClientOriginalExtension();

            $rename_surat = 'surat_' . date('YmdHis') . '.' . $extension_surat;
            $rename_acara = 'acara_' . date('YmdHis') . '.' . $extension_acara;

            $id_fasilitas = implode(',', (array) $request->input('id_fasilitas', []));
            // $id_alat = implode(',', (array) $request->input('id_alat', []));

            if ($request->id_alat > 0) {
                $id_alat = implode(',', (array) $request->input('id_alat', []));
            } else {
                $id_alat = null;
            }

            if ($file_surat->move($uploadPath, $rename_surat) && $file_acara->move($uploadPath, $rename_acara)) {
                $data = new Permohonan();
                $data->skpd = $request->skpd;
                $data->bidang_kegiatan = $request->bidang_kegiatan;
                $data->user_id = $request->user_id;
                // $data->instansi_id = $request->instansi_id;
                $data->status_instansi = $request->status_instansi;
                $data->bidang_instansi = $request->bidang_instansi;
                $data->nama_kegiatan = $request->nama_kegiatan;
                $data->jumlah_peserta = $request->jumlah_peserta;
                $data->narasumber = $request->narasumber;
                $data->output = $request->output;
                $data->outcome = $request->outcome;
                $data->ringkasan = $request->ringkasan;

                $data->surat_permohonan = $rename_surat;
                $data->rundown_acara = $rename_acara;

                $data->fasilitas_id = $id_fasilitas;
                $data->alat_id = $id_alat;
                $data->save();

                if (isset($data['id_permohonan'])) {
                    $cekData = [
                        'permohonan_id' => $data['id_permohonan'],
                    ];
                }

                $jadwal = new Jadwal();
                $jadwal->user_id = $request->user_id;
                $jadwal->permohonan_id = $cekData['permohonan_id'];
                $jadwal->tgl_mulai = $request->tgl_mulai;
                $jadwal->jam_mulai = $request->jam_mulai;
                $jadwal->tgl_selesai = $request->tgl_selesai;
                $jadwal->jam_selesai = $request->jam_selesai;
                $jadwal->save();

                //  return $data;
                return redirect()->to('/dashboard')->with('sukses', 'Berhasil, file telah di upload');
            }
            //  return $data;
            return redirect()->to('/dashboard')->with('error', 'Error, file tidak dapat di upload');
        }
        //  return "Gagal";
        return redirect()->back()->with('error', 'Error, tidak ada file ditemukan');
    }

    public function lihatPermohonan($id_permohonan)
    {
        $currentMonth = Carbon::now()->format('m');
        $user_id = Auth::user()->id;

        $permohonan_bulan_ini = DB::table('permohonan')
                                    ->join('users', 'users.id', '=', 'permohonan.user_id')
                                    ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                                    ->join('fasilitas', 'fasilitas.id_fasilitas', '=', 'permohonan.fasilitas_id')
                                    ->join('alat_pendukung', 'alat_pendukung.id_alat_pendukung', '=', 'permohonan.alat_id')
                                    ->whereMonth('permohonan.created_at', '=', $currentMonth)
                                    ->count();
        
        $semua_permohonan = DB::table('permohonan')
                                    ->join('users', 'users.id', '=', 'permohonan.user_id')
                                    ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                                    ->join('fasilitas', 'fasilitas.id_fasilitas', '=', 'permohonan.fasilitas_id')
                                    ->join('alat_pendukung', 'alat_pendukung.id_alat_pendukung', '=', 'permohonan.alat_id')
                                    ->where('users.id', '=', $user_id)
                                    ->count();

        $permohonan = Permohonan::find($id_permohonan);

        $data = DB::table('permohonan')
                    ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                    ->where('permohonan.id_permohonan', '=', $id_permohonan)->first();

        return view('user.lihat-permohonan', compact('permohonan', 'data', 'permohonan_bulan_ini', 'semua_permohonan'));
    }

    public function historiPermohonan()
    {
        $user_id = Auth::user()->id;

        $permohonan = DB::table('permohonan')->join('users', 'users.id', '=', 'permohonan.user_id')->join('bidang_kegiatan', 'bidang_kegiatan.id_bidang_kegiatan', '=', 'permohonan.bidang_id')->join('instansi', 'instansi.id_instansi', '=', 'permohonan.instansi_id')->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')->join('fasilitas', 'fasilitas.id_fasilitas', '=', 'permohonan.id_fasilitas')->join('alat_pendukung', 'alat_pendukung.id_alat_pendukung', '=', 'permohonan.id_alat')->where('users.id', '=', $user_id)->get();

        $user = Auth::user()->name;

        return view('user.histori-permohonan', compact('permohonan'));
    }

    // public function lihatJadwal()
    // {
    //     $firstDate = '1';
    //     $endDate = '29';

    //     $daysArray = [
    //         'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'
    //     ];

    //     $datesArray = range((int)$firstDate, (int)$endDate);

    //     $dates = [];
    //     foreach ($datesArray as $day) {
    //         $dayOfWeek = $daysArray[$day % 7];
    //         $dates[] = [
    //             'hari' => $dayOfWeek,
    //             'tanggal' => str_pad($day, 2, '0', STR_PAD_LEFT)
    //         ];
    //     }

    //     return view('user.lihat-jadwal', compact('dates'));
    // }

    public function ambilJadwal($tanggal)
    {
        $data = DB::table('jadwal')->whereDay('tgl_mulai', $tanggal)->whereMonth('tgl_mulai', '02')->get();

        return view('user.lihat-jadwal', ['data' => $data]);
    }

    public function cekJadwal(Request $request)
    {
        $tgl_mulai = $request->tgl_mulai;
        $jam_mulai = $request->jam_mulai;
        $tgl_selesai = $request->tgl_selesai;
        $jam_selesai = $request->jam_selesai;

        dd($tgl_mulai, $jam_mulai, $tgl_selesai, $jam_selesai);
    }

    public function test() 
    {
        $currentMonth = Carbon::now()->format('m');
        $user_id = Auth::user()->id;
        $instansi = Instansi::get();

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
                          ->join('users', 'users.id', '=', 'permohonan.user_id')
                          ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                          ->join('fasilitas', 'fasilitas.id_fasilitas', '=', 'permohonan.fasilitas_id')
                          ->where('users.id', '=', $user_id)
                          ->paginate(10);
        
        $semua_permohonan = DB::table('permohonan')
                                ->join('users', 'users.id', '=', 'permohonan.user_id')
                                ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                                ->join('fasilitas', 'fasilitas.id_fasilitas', '=', 'permohonan.fasilitas_id')
                                ->join('alat_pendukung', 'alat_pendukung.id_alat_pendukung', '=', 'permohonan.alat_id')
                                ->where('users.id', '=', $user_id)
                                ->count();
        
        $permohonan_bulan_ini = DB::table('permohonan')
                                    ->join('users', 'users.id', '=', 'permohonan.user_id')
                                    ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                                    ->join('fasilitas', 'fasilitas.id_fasilitas', '=', 'permohonan.fasilitas_id')
                                    ->join('alat_pendukung', 'alat_pendukung.id_alat_pendukung', '=', 'permohonan.alat_id')
                                    ->whereMonth('permohonan.created_at', '=', $currentMonth)
                                    ->count();  
        
        return view('user.test', compact('permohonan', 'permohonan_bulan_ini', 'semua_permohonan', 'status_diterima', 'status_menunggu', 'status_ditolak', 'instansi'));
    }

    public function ubahProfileSaya(Request $request)
    {
        $id = $request->id;
        $data = User::find($id);
                
        if ($request->instansi_id != 21) {
            $data->name = $request->name;
            $data->instansi_id = $request->instansi_id;
            $data->nama_instansi = null;
        } else {
            $data->name = $request->name;
            $data->instansi_id = $request->instansi_id;
            $data->nama_instansi = $request->nama_instansi;
        }
        $data->update();

        return back()->with('sukses', 'Data Berhasil diubah!');
    }

    public function ubahPersonalInformation(Request $request)
    {
        $id = $request->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->no_telp = $request->no_telp;
        $data->nik = $request->nik;
        $data->update();

        return back()->with('sukses', 'Data Berhasil diubah!');
    }

    public function ubahInstansi(Request $request)
    {
        $id = $request->id;
        $data = User::find($id);

        $data->instansi_id = $request->instansi_id;
        $data->nama_organisasi = $request->nama_organisasi;
        $data->update();

        return back()->with('sukses', 'Data berhasil diubah!');
    }

    public function lihatJadwal()
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
                    $jadwal->status_permohonan
                ];
            })->toArray();

            $matchingDateItems = collect($resultArray)->filter(function ($item) use ($room, $currentDate) {
                return $item[0] === $room && ($item[1] === $currentDate || $item[2] === $currentDate) && ($item[5] === 'Diterima' || $item[5] === 'Menunggu');
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

        return view('user.jadwals', compact('fasilitas', 'jadwal', 'day', 'dayMerge', 'month', 'currentDate', 'currentMonth', 'currentMonthNum', 'currentYear', 'currentJadwal', 'newArray', 'fasilitasWithAlias'));
    }

    public function cetakPermohonan($id_permohonan){
        
        $id_permohonan = $id_permohonan;
        // $data = DB::table('permohonan')
        //                   ->join('users', 'users.id', '=', 'permohonan.user_id')
        //                   ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
        //                   ->join('fasilitas', 'fasilitas.id_fasilitas', '=', 'permohonan.fasilitas_id')
        //                   ->join('alat_pendukung', 'alat_pendukung.id_alat_pendukung', '=', 'permohonan.alat_id')
        //                   ->where('permohonan.id_permohonan', '=', $id_permohonan)
        //                   ->first();
        $data = Permohonan::find($id_permohonan);
        $nama = Auth::user()->name;
        // $tgl = Carbon::now()->format('dmy');
        // $id = Permohonan::count('id_permohonan');
        // if($id == 0){
        //     $no = 1;
        // } else {
        //     $no = $id;
        // }
        // $kodeBooking = "SP".$no.$tgl;
        
        // dd($kodeBooking);
        
        // $pdf = PDF::loadview('user.cetak-bukti',['data' => $data,'kodeBooking' => $kodeBooking]);
        // return $pdf->download('Bukti Permohonan - '.$nama.'.pdf');

        return view('user.cetak-bukti', compact('data'));

    }

    public function qr($id_permohonan)
    {
        $user = Permohonan::
        join('users','users.id','=','permohonan.user_id')
        ->join('jadwal','jadwal.permohonan_id','permohonan.id_permohonan')
        ->where('permohonan.id_permohonan',$id_permohonan)
        ->select('*','permohonan.created_at as dibuat','permohonan.updated_at as diubah')
        ->first();
        
        $tgl = Carbon::now()->format('dmy');
        $id = Permohonan::count('id_permohonan');
        if($id == 0){
            $no = 1;
        } else {
            $no = $id;
        }
        $kodeBooking = "SP".$no.$tgl;
        
        return view('user.view-qr',compact('user','kodeBooking'));
    }
}
