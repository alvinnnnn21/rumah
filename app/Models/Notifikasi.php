<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = "notifikasi";
    protected $fillable = [
        "notifikasi",
        "idpenerima",
        "created_at"
    ];
    public $timestamps = false;

    public function user()
    {
        return $this->belonsTo(User::class, "iduser", "idpenerima");
    }
}
