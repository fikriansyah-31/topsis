<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPm extends Model
{
    use HasFactory;

    protected $table = 'hasil_pm';
    protected $fillable = ['alternatif_id', 'nilai'];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class);
    }
}
