<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiSewa extends Model
{
    protected $table = "transaksi_sewa";
    protected $fillable = [
        "iduser",
        "idrumah",
        "lama_sewa",
        "mulai_sewa",
        "selesai_sewa",
        "total",
        "status",
        "dp"
    ];
    public $timestamps = false;

    public function pembeli() 
    {
        return $this->belongsTo(User::class, "iduser", "iduser");
    }

    public function bukti() 
    {
        return $this->hasMany(BuktiBayar::class, "idtransaksi", "id_transaksi_sewa", );
    }

    public function rumah() 
    {
        return $this->belongsTo(Rumah::class, "idrumah", "idrumah");
    }
}
