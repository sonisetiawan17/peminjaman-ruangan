<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Permohonan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $current_month = Carbon::now()->format('F');
        $current_month_short  = Carbon::now()->format('M');
        $fasilitas = DB::table('fasilitas')->pluck('nama_fasilitas')->toArray();

        $data = [
            'labels' => ['January', 'February', 'March', 'April', 'May'],
            'data' => [65, 59, 80, 81, 56],
        ];

        $permohonanBulanIni = DB::table('permohonan')
                        ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                        ->selectRaw('DATE_FORMAT(permohonan.created_at, "%b") as bulan, COUNT(*) as jumlah_permohonan')
                        ->groupBy('bulan')
                        ->get();
        
        $stats = 0;
        
        if ($permohonanBulanIni) {
            foreach ($permohonanBulanIni as $data) {
                if ($data->bulan == $current_month_short) {
                    $stats = $data->jumlah_permohonan;
                } 
            }
        } else {
            $stats = 0;
        }

        $status_diterima = DB::table('permohonan')
                             ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                             ->where('status_permohonan', 'Diterima')
                             ->count();
        
        $status_menunggu = DB::table('permohonan')
                            ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                            ->where('status_permohonan', 'Menunggu')
                            ->count();
            
        $status_ditolak = DB::table('permohonan')
                            ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                            ->where('status_permohonan', 'Ditolak')
                            ->count();
                
        $permohonan = DB::table('permohonan')
                        ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                        ->join('fasilitas', 'fasilitas.id_fasilitas', '=', 'permohonan.fasilitas_id')
                        ->where('permohonan.status_permohonan', '=', 'Diterima')
                        ->get();
                            
        $statsPermohonan = $permohonan->where('status_permohonan', 'Diterima')
                                     ->groupBy('nama_fasilitas')
                                     ->map(function ($items, $key) {
                                        return [
                                            'nama_fasilitas' => $key,
                                            'jumlah_permohonan' => count($items),
                                        ];
                                     })
                                     ->values();
        
        $statsInstansi = $permohonan->where('status_permohonan', 'Diterima')
                                     ->groupBy('bidang_kegiatan')
                                     ->map(function ($items, $key) {
                                         return [
                                             'bidang_kegiatan' => $key,
                                             'jumlah_permohonan' => count($items),
                                         ];
                                     })
                                     ->sortByDesc('jumlah_permohonan')
                                     ->take(3)
                                     ->values();
                                                     
        return view('admin.dashboard', compact('data', 'status_diterima', 'status_menunggu', 'status_ditolak', 'current_month', 'fasilitas', 'statsPermohonan', 'statsInstansi', 'stats'));
    }

    public function filter(Request $request)
    {
        $current_month = Carbon::now()->format('F');
        $current_month_short  = Carbon::now()->format('M');
        $fasilitas = DB::table('fasilitas')->pluck('nama_fasilitas')->toArray();

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $permohonanBulanIni = DB::table('permohonan')
                        ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                        ->selectRaw('DATE_FORMAT(permohonan.created_at, "%b") as bulan, COUNT(*) as jumlah_permohonan')
                        ->groupBy('bulan')
                        ->get();
        
        $stats = 0;
        
        if ($permohonanBulanIni) {
            foreach ($permohonanBulanIni as $data) {
                if ($data->bulan == $current_month_short) {
                    $stats = $data->jumlah_permohonan;
                } 
            }
        } else {
            $stats = 0;
        }

        $status_diterima = DB::table('permohonan')
                             ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                             ->where('status_permohonan', 'Diterima')
                             ->whereDate('permohonan.created_at', '>=', $start_date)
                             ->whereDate('permohonan.created_at', '<=', $end_date)
                             ->count();
        
        $status_menunggu = DB::table('permohonan')
                             ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                             ->where('status_permohonan', 'Menunggu')
                             ->whereDate('permohonan.created_at', '>=', $start_date)
                             ->whereDate('permohonan.created_at', '<=', $end_date)
                             ->count();

        $status_ditolak = DB::table('permohonan')
                             ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                             ->where('status_permohonan', 'Ditolak')
                             ->whereDate('permohonan.created_at', '>=', $start_date)
                             ->whereDate('permohonan.created_at', '<=', $end_date)
                             ->count();

        $permohonan = DB::table('permohonan')
                             ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                             ->join('fasilitas', 'fasilitas.id_fasilitas', '=', 'permohonan.fasilitas_id')
                             ->join('users', 'users.id', '=', 'permohonan.user_id')
                             ->join('instansi', 'instansi.id_instansi', '=', 'users.instansi_id')
                             ->where('permohonan.status_permohonan', '=', 'Diterima')
                             ->get();
                                 
        $statsPermohonan = $permohonan->where('status_permohonan', 'Diterima')
                                          ->groupBy('nama_fasilitas')
                                          ->map(function ($items, $key) {
                                             return [
                                                 'nama_fasilitas' => $key,
                                                 'jumlah_permohonan' => count($items),
                                             ];
                                          })
                                          ->values();
             
        $statsInstansi = $permohonan->where('status_permohonan', 'Diterima')
                                             ->groupBy('bidang_kegiatan')
                                             ->map(function ($items, $key) {
                                                 return [
                                                     'bidang_kegiatan' => $key,
                                                     'jumlah_permohonan' => count($items),
                                                 ];
                                             })
                                             ->sortByDesc('jumlah_permohonan')
                                             ->take(3)
                                             ->values();

        return view('admin.dashboard', compact('status_diterima', 'status_ditolak', 'status_menunggu', 'fasilitas', 'permohonan', 'statsPermohonan', 'statsInstansi', 'stats', 'current_month'));
    }

    public function dataPemohon()
    {
         $permohonan = DB::table('permohonan')
            ->join('users', 'users.id', '=', 'permohonan.user_id')
            ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
            ->join('fasilitas', 'fasilitas.id_fasilitas', '=', 'permohonan.fasilitas_id')
            ->get();
            
        return view('admin.data-pemohon', compact('permohonan'));
    }

    public function show($id_permohonan)
    {
        $user = Permohonan::join('users','users.id','=','permohonan.user_id')
                            ->join('jadwal','jadwal.permohonan_id','permohonan.id_permohonan')
                            ->where('permohonan.id_permohonan',$id_permohonan)
                            ->select('*','permohonan.created_at as dibuat','permohonan.updated_at as diubah')
                            ->first();
                        
        
        $permohonan = Permohonan::find($id_permohonan)
                                ->join('jadwal', 'jadwal.permohonan_id', '=', 'permohonan.id_permohonan')
                                ->select('*','permohonan.created_at as dibuat','permohonan.updated_at as diubah')
                                ->first();

        return view('admin.lihat-users',compact('user', 'permohonan'));
    
    }

    public function index_instansi()
    {
        $instansi = Instansi::get();

        return view('admin.data-instansi', compact('instansi'));
    }

    public function terima_permohonan(Request $request)
    {
        $tgl = Carbon::now()->format('dmy');
        $id = Permohonan::count('kode_booking');

        if($id == 0){
            $no = 1;
        } else {
            $no = $id+1;
        }
        $kodeBooking = "SP".$no.$tgl;
        // return ($kodeBooking);
        $id_permohonan = $request->id_permohonan;
        $data = Permohonan::find($id_permohonan);
        $data->status_permohonan = $request->status_permohonan;
        $data->catatan = $request->catatan;
        $data->kode_booking = $kodeBooking;
        $simpan = $data->update();
        return redirect()
            ->back()
            ->with('sukses', 'Berhasil! Permohonan diterima');
    }

    public function tolak_permohonan(Request $request)
    {
        $id_permohonan = $request->id_permohonan;
        $data = Permohonan::find($id_permohonan);
        $data->status_permohonan = $request->status_permohonan;
        $data->catatan = $request->catatan;
        $simpan = $data->update();
        return redirect()
            ->back()
            ->with('sukses', 'Berhasil! Permohonan ditolak');
    }
}
