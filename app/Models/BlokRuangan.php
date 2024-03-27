<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlokRuangan extends Model
{
    use HasFactory;

    protected $table = 'blok_ruangan';

    protected $primaryKey = 'id_blok_ruangan';

    protected $fillable = ['fasilitas_id', 'tgl_mulai', 'tgl_selesai', 'keterangan'];

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class, 'fasilitas_id');
    }
}
