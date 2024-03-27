<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatPendukung extends Model
{
    use HasFactory;

    protected $table = 'alat_pendukung';

    protected $primaryKey = 'id_alat_pendukung';

    protected $fillable = [
        'nama_alat',
    ];

    public function permohonan()
    {
        return $this->hasMany(Permohonan::class, 'id_alat');
    }
}
