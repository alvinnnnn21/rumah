<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiBayar extends Model
{
    protected $table = "bukti_bayar";
    protected $fillable = [
        "iduser",
        "idtransaksi",
        "waktu_bayar",
        "bukti",
        "status"
    ];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, "iduser", "iduser");
    }

    public function transaksi()
    {
        return $this->belongsTo(TransaksiSewa::class, "idtransaksi", "id_transaksi_sewa");
    }

}
