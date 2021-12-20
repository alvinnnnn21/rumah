<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiRumah extends Model
{
    protected $table = "nilai_rumah_kriteria";
    protected $fillable = [
        "rumah_1",
        "rumah_2",
        "kriteria",
        "nilai"
    ];
    public $timestamps = false;
}
