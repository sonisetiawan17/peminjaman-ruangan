<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidangKegiatan extends Model
{
    use HasFactory;

    protected $table = 'bidang_kegiatan';

    protected $primaryKey = 'id_bidang_kegiatan';

    protected $fillable = ['nama_bidang'];

    public function permohonan()
    {
        return $this->hasMany(Permohonan::class, 'bidang_id');
    }
}
