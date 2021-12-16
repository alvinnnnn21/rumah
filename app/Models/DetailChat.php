<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailChat extends Model
{
    protected $table = "detail_chat";
    protected $fillable = [
        "idpengirim",
        "pesan",
        "waktu",
        "idchat"
    ];
    public $timestamps = false;

    public function chat()
    {
        return $this->belongsTo(Chat::class, "idchat", "idchat");
    }
}
