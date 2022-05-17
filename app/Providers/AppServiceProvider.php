<?php

namespace App\Providers;

use App\Models\Notifikasi;
use Illuminate\Support\ServiceProvider;
use App\Models\Rumah;
use App\Models\TransaksiSewa;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
        $transaksi = TransaksiSewa::where("batas_waktu_transaksi", "<=", date("Y-m-d H:i:s", time()))
            ->where("status", "Proses Pembayaran")
            ->get();   

        foreach($transaksi as $t)
        {       
            TransaksiSewa::where("id_transaksi_sewa", $t->id_transaksi_sewa)->update([
                "status" => "Pembayaran Gagal"
            ]); 

            Rumah::where("idrumah", $t->rumah->idrumah)->update([
                "status" => "Kosong"
            ]);

            $notifikasi = [
                "type" => "Pembayaran", 
                "status" => "Gagal", 
                "message" => "Pemabayaran Rumah Melebihi Batas Waktu Transaksi, Transaksi Telah Dibatalkan Otomatis Oleh Sistem",
            ];
    
            Notifikasi::create([
                "idpenerima" => $t->iduser,
                "notifikasi" => json_encode($notifikasi),
            ]);
        }
    }
}
