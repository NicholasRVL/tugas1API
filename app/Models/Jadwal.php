<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = ['kode', 'asal', 'tujuan', 'transportasi_id'];

    public function transportasi()
    {
        return $this->belongsTo(Transportasi::class, 'transportasi_id');
    }
}
