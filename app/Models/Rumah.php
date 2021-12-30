<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Rumah extends Model
{   
    use SoftDeletes;

    protected $table = "rumah";
    public $timestamps = false;
    protected $fillable = [
        "id_pemilik",
        "alamat",
        "kota",
        "provinsi",
        "keterangan",
        "harga",
        "luas_tanah",
        "luas_bangunan",
        "jumlah_kamar",
        "jumlah_kamar_mandi",
        "daya_listrik",
        "air_bersih",
        "carport",
        "kitchen_set",
        "status",
        "alasan_tolak"
    ];

    public function favorite()
    {
        return $this->hasMany(Favorite::class, "idrumah", "idrumah");
    }

    public function gambar()
    {
        return $this->hasMany(Gambar::class, "idrumah", "idrumah");
    }

    public function pemilik()
    {
        return $this->belongsTo(User::class, "id_pemilik", "iduser");
    }
}
