<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Rumah;
use App\Models\Chat;
use App\Models\User;
use App\Models\DetailChat;
use App\Models\Reminder;
use App\Models\Favorite;
use App\Models\Gambar;
use App\Models\TransaksiSewa;
use App\Models\BuktiBayar;
use App\Models\Notifikasi;

use Auth;

class AdminController extends Controller
{
    public function index()
    {   
        $user = User::where("roles", "!=", "admin")->get();

        return view("admin.index")->with([
            "user" => $user
        ]);
    }

    public function destroyUser($id)
    {
        User::where("iduser", $id)->delete();
        Rumah::where("iduser", $id)->delete();
        Reminder::where("iduser", $id)->delete();

        return redirect()->back()->with(["message" =>"Berhasil Menghapus User", "status" => "success"]);
    }

    public function getBukti() 
    {
        $bukti = BuktiBayar::where("status", "Proses")->get();

        return view("admin.bukti")->with([
            "bukti" => $bukti
        ]);
    }

    public function updateBukti(Request $request, $id)
    {
        BuktiBayar::where("id_bukti_bayar", $id)->update([
            "status" => $request->status
        ]); 

        TransaksiSewa::where("id_transaksi_sewa", $request->transaksi)->update([
            "status" => ($request->status === "Berhasil") ? "Pembayaran Berhasil" : "Proses Pembayaran"
        ]);

        $transaksi = TransaksiSewa::with("rumah")->where("id_transaksi_sewa", $request->transaksi)->first();

        $notifikasi = [
            "type" => "Pembayaran", 
            "status" => $request->status, 
            "message" => ($request->status === "Berhasil") ? "Pembayaran Berhasil Di Verifikasi" : "Pembayaran Gagal Di Verifikasi Silahkan Upload Ulang Bukti Pembayaran",
            "data" => $transaksi
        ];

        Notifikasi::create([
            "idpenerima" => $transaksi->iduser,
            "notifikasi" => json_encode($notifikasi),
        ]);

        if($request->status == "Berhasil")
        {
            $notifikasi = [
                "type" => "Pembayaran", 
                "status" => $request->status, 
                "message" => "Pembayaran Berhasil Di Verifikasi",
                "data" => $transaksi
            ];      

            Notifikasi::create([
                "idpenerima" => $transaksi->rumah->id_pemilik,
                "notifikasi" => json_encode($notifikasi),
            ]);
        }

        return response()->json(["message" => "Berhasil Verfikasi Bukti Pembayaran", "status" => "success"]);
    }

    public function getRumah()
    {
        $rumah = Rumah::all();

        return view("admin.rumah")->with([
            "rumah" => $rumah
        ]);
    }

    public function destroyRumah($id)
    {
        Rumah::where("idrumah", $id)->delete();
        
        return redirect()->back()->with(["message" => "Berhasil Menghapus Data Rumah", "status" => "success"]);
    }

    public function getKriteria()
    {   
        return view("admin.kriteria");
    }
}
