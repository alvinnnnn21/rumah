<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = "chat";
    protected $fillable = [
        "idpemilik",
        "idpenyewa",
        "status"
    ];
    public $timestamps = false;

    public function penyewa()
    {
        return $this->belongsTo(User::class, "idpenyewa", "iduser");
    }

    public function pemilik()
    {
        return $this->belongsTo(User::class, "idpemilik", "iduser");
    }

    public function detailchat()
    {
        return $this->hasMany(DetailChat::class, "idchat", "idchat");
    }
}
