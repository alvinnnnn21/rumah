<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $table = "reminder";
    public $timestamps = false;
    protected $fillable = [
        "iduser",
        "date",
        "time",
        "acara"
    ];
}
