<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = "alternatif";
    protected $primaryKey = "id";
    public $incrementing = "true";
    // protected $keyType = "string";
    public $timestamps = "true";
    protected $fillable = [
        "objek_id",
    ];

    public function objek()
    {
        return $this->belongsTo(Objek::class);
    }

    public function pmKriteria()
    {
        return $this->belongsToMany(Kriteria::class, 'pm_penilaian')
            ->orderby('alternatif_id')
            ->orderBy('kriteria_id')
            ->withPivot('nilai')->withTimestamps();
    }

    public function hasilTopsis()
    {
        return $this->hasOne(HasilSolusiTopsis::class);
    }

    public function hasilPm()
    {
        return $this->hasOne(HasilPm::class);
    }
}
