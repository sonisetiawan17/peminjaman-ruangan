<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $table = 'fasilitas';

    protected $primaryKey = 'id_fasilitas';

    protected $guarded = ['id'];

    public function blok_ruangan()
    {
        return $this->hasMany(BlokRuangan::class, 'fasilitas_id');
    }

    public function permohonan()
    {
        return $this->hasMany(Permohonan::class, 'fasilitas_id');
    }
}
