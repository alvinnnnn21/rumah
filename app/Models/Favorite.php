<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table="favorit";
    protected $fillable = [
        "idrumah",
        "idpenyewa"
    ];
    public $timestamps = false;

    public function rumah()
    {
        return $this->belongsTo(Rumah::class, "idrumah", "idrumah");
    }
}
