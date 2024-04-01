<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Permohonan extends Model
{
    use HasFactory;

    protected $table = 'permohonan';

    protected $primaryKey = 'id_permohonan';

    protected $guarded = ['id_permohonan'];

    // public function bidang_kegiatan()
    // {
    //     return $this->belongsTo(BidangKegiatan::class, 'bidang_id');
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'instansi_id');
    }

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class, 'fasilitas_id');
    }

    // public function alat_pendukung()
    // {
    //     return $this->belongsTo(AlatPendukung::class, 'alat_id');
    // }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'permohonan_id');
    }

    // public function fasilitas() {
    //     return $this->belongsTo(Fasilitas::class, 'fasilitas_id');
    // }

    // public function alat_pendukung() {
    //     return $this->belongsTo(AlatPendukung::class, 'alat_pendukung_id');
    // }
}
