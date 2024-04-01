<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CRUDController;
use App\Http\Controllers\SuperAdminDashboardController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/login');

// Protected User Routes
Route::middleware(['auth', 'role:user'])
    // ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('/', [UserDashboardController::class, 'index'])->name('index');
        Route::get('/jadwal', [UserDashboardController::class, 'lihatJadwal'])->name('jadwals');
        Route::get('/jadwal/{tanggal}', [UserDashboardController::class, 'ambilJadwal'])->name('ambilJadwal');
        Route::get('/buatPermohonan', [UserDashboardController::class, 'buatPermohonan'])->name('buatPermohonan');
        Route::get('/buatPermohonan/form', [UserDashboardController::class, 'buatPermohonanForm'])->name('buatPermohonanForm');
        Route::post('/batalPermohonan', [UserDashboardController::class, 'batalPermohonan'])->name('batalPermohonan');
        Route::get('/editPermohonan/{id_permohonan}', [UserDashboardController::class, 'editPermohonan'])->name('editPermohonan');
        Route::post('/updatePermohonan/{id_permohonan}', [UserDashboardController::class, 'updatePermohonan'])->name('updatePermohonan');
        Route::post('/simpanPermohonan', [UserDashboardController::class, 'simpanPermohonan'])->name('simpanPermohonan');
        Route::get('/historiPermohonan', [UserDashboardController::class, 'historiPermohonan'])->name('historiPermohonan');
        Route::get('/lihatPermohonan/{id_permohonan}', [UserDashboardController::class, 'lihatPermohonan'])->name('lihatPermohonan');
        Route::delete('/destroy/{id_permohonan}', [UserDashboardController::class, 'destroy'])->name('hapusPermohonan');

        Route::get('/dashboard', [UserDashboardController::class, 'test'])->name('test');
        Route::get('/cetak-permohonan/{id_permohonan}', [UserDashboardController::class, 'cetakPermohonan'])->name('cetakPermohonan');
        Route::post('ubah-users', [UserDashboardController::class, 'ubahProfileSaya'])->name('ubahProfileSaya');
        Route::post('ubah-personal-information', [UserDashboardController::class, 'ubahPersonalInformation'])->name('ubahPersonalInformation');
        Route::post('ubah-instansi', [UserDashboardController::class, 'ubahInstansi'])->name('ubahInstansi');

        Route::post('/cekJadwal', [UserDashboardController::class, 'cekJadwal'])->name('cekJadwal');

        Route::get('/cetak-permohonan/{id_permohonan}', [UserDashboardController::class, 'cetakPermohonan'])->name('cetakPermohonan');
        Route::get('/view-qr/{id_permohonan}', [UserDashboardController::class, 'qr'])->name('view-qr');

        Route::get('/downlaod-sop', [UserDashboardController::class, 'downloadSOP'])->name('downloadSOP');
    });

// Protected Admin Routes
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('index');
        Route::get('/dashboard/filter', [AdminDashboardController::class, 'filter'])->name('dashboard.filter');
        Route::get('/dataPemohon', [AdminDashboardController::class, 'dataPemohon'])->name('dataPemohon');
        Route::get('/lihatPemohon/{id_permohonan}', [AdminDashboardController::class, 'show'])->name('show');

        Route::post('/simpanPermohonan', [AdminDashboardController::class, 'simpanPermohonan'])->name('simpanPermohonan');
        // Route::get('/history', [CRUDController::class, 'history_permohonan'])->name('history_permohonan');
        Route::delete('/destroy/{id_permohonan}', [CRUDController::class, 'hapus_permohonan'])->name('hapus_permohonan');
        Route::post('/accPermohonan', [AdminDashboardController::class, 'terima_permohonan'])->name('terima_permohonan');
        Route::post('/tolakPermohonan', [AdminDashboardController::class, 'tolak_permohonan'])->name('tolak_permohonan');
    });

// Protected SuperAdmin Routes
Route::middleware(['auth', 'role:super-admin'])
    ->prefix('superadmin')
    ->name('superadmin.')
    ->group(function () {
        Route::get('/dashboard', [SuperAdminDashboardController::class, 'index'])->name('index');
        Route::get('/dashboard/filter', [SuperAdminDashboardController::class, 'filter'])->name('dashboard.filter');
        Route::get('/jadwal', [CRUDController::class, 'index_jadwal'])->name('index_jadwal');
        Route::get('/filter', [CRUDController::class, 'filter'])->name('filter');

        Route::get('/fasilitas', [CRUDController::class, 'index_fasilitas'])->name('index_fasilitas');
        Route::post('/ubahFasilitas', [CRUDController::class, 'ubah_fasilitas'])->name('ubah_fasilitas');
        Route::post('/simpanFasilitas', [CRUDController::class, 'simpan_fasilitas'])->name('simpan_fasilitas');
        Route::delete('/hapusFasilitas/{id_fasilitas}', [CRUDController::class, 'hapus_fasilitas'])->name('hapus_fasilitas');

        Route::get('/users', [CRUDController::class, 'index_users'])->name('index_users');
        Route::post('/simpanUsers', [CRUDController::class, 'simpan_users'])->name('simpan_users');
        Route::get('/users/{id}', [CRUDController::class, 'lihat_users'])->name('lihat_users');
        Route::delete('/hapusUsers/{id}', [CRUDController::class, 'hapus_users'])->name('hapus_users');
        Route::post('/ubahUsers', [CRUDController::class, 'ubah_users'])->name('ubah_users');

        Route::get('/admin', [CRUDController::class, 'index_admin'])->name('index_admin');
        Route::post('/simpanAdmin', [CRUDController::class, 'simpan_admin'])->name('simpan_admin');
        Route::get('/admin/{id}', [CRUDController::class, 'lihat_admin'])->name('lihat_admin');
        Route::delete('/hapusAdmin/{id}', [CRUDController::class, 'hapus_admin'])->name('hapus_admin');
        Route::post('/ubahAdmin', [CRUDController::class, 'ubah_admin'])->name('ubah_admin');

        Route::get('/instansi', [CRUDController::class, 'index_instansi'])->name('index_instansi');
        Route::post('/simpanInstansi', [CRUDController::class, 'simpan_instansi'])->name('simpan_instansi');
        Route::delete('/hapusInstansi/{id_instansi}', [CRUDController::class, 'hapus_instansi'])->name('hapus_instansi');
        Route::post('/ubahInstansi', [CRUDController::class, 'ubah_instansi'])->name('ubah_instansi');

        Route::get('/alat-pendukung', [CRUDController::class, 'index_alat'])->name('index_alat');
        Route::post('/simpanAlatPendukung', [CRUDController::class, 'simpan_alat'])->name('simpan_alat');
        Route::delete('/hapusAlatPendkukung/{id_alat_pendukung}', [CRUDController::class, 'hapus_alat'])->name('hapus_alat');
        Route::post('/ubahAlatPendukung', [CRUDController::class, 'ubah_alat'])->name('ubah_alat');

        Route::get('/blok-ruangan', [CRUDController::class, 'index_blok_ruangan'])->name('blok_ruangan');
        Route::post('/simpanBlokRuangan', [CRUDController::class, 'simpan_blok_ruangan'])->name('simpan_blok_ruangan');
        Route::delete('/hapusBlokRuangan/{id_blok_ruangan}', [CRUDController::class, 'hapus_blok_ruangan'])->name('hapus_blok_ruangan');
        Route::post('/ubahBlokRuangan', [CRUDController::class, 'ubah_blok_ruangan'])->name('ubah_blok_ruangan');

        Route::get('/bidang-kegiatan', [CRUDController::class, 'index_bidang_kegiatan'])->name('bidang_kegiatan');
        Route::post('/simpanBidangKegiatan', [CRUDController::class, 'simpan_bidang_kegiatan'])->name('simpan_bidang');
        Route::delete('/hapusBidangKegiatan/{id_bidang_kegiatan}', [CRUDController::class, 'hapus_bidang_kegiatan'])->name('hapus_bidang');
        Route::post('/ubahBidangKegiatan', [CRUDController::class, 'ubah_bidang_kegiatan'])->name('ubah_bidang');

        Route::get('/buat-permohonan', [SuperAdminDashboardController::class, 'buatPermohonan'])->name('buatPermohonan');
        Route::post('/simpanPermohonan', [SuperAdminDashboardController::class, 'simpanPermohonan'])->name('simpanPermohonan');
        Route::get('/history', [CRUDController::class, 'history_permohonan'])->name('history_permohonan');
        Route::get('/history/filter', [SuperAdminDashboardController::class, 'filter_history'])->name('history.filter');
        Route::get('/lihat-permohonan/{id_permohonan}', [CRUDController::class, 'lihat_permohonan'])->name('lihat_permohonan');
        Route::delete('/destroy/{id_permohonan}', [CRUDController::class, 'hapus_permohonan'])->name('hapus_permohonan');
        Route::post('/accPermohonan', [SuperAdminDashboardController::class, 'terima_permohonan'])->name('terima_permohonan');
        Route::post('/tolakPermohonan', [SuperAdminDashboardController::class, 'tolak_permohonan'])->name('tolak_permohonan');
    });

require __DIR__ . '/auth.php';
