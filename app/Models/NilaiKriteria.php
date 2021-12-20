<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiKriteria extends Model
{
    protected $table = "nilai_kriteria";
    protected $fillable = [
        "kriteria_1",
        "kriteria_2",
        "nilai"
    ];
    public $timestamps = false;
}
