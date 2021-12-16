<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = "kriteria";
    public $timestamps = false;
    protected $fillable = [
        "nama_kriteria",
        "bobot"
    ];
}
