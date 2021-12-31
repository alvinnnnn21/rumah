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
use App\Models\NilaiRumah;
use App\Models\NilaiKriteria;

use Auth;

use App\Helper\AHP;

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
        $rumah = Rumah::all();

        $kriteria = ["Carport", "Kitchen Set", "Air Bersih", "Harga", "Jumlah Kamar", "Jumlah Kamar Mandi", "Luas Tanah", "Luas Bangunan", "Daya Listrik"];
        $nilai = [0.11111111111111, 0.125, 0.14285714285714, 0.16666666666667, 0.2, 0.25, 0.33333333333333, 0.5];

        $nilai_rumah = NilaiRumah::all();
        $nilai_kriteria = NilaiKriteria::all();
 
        return view("admin.kriteria")->with([
            "nilai_rumah" => $nilai_rumah,
            "nilai_kriteria" => $nilai_kriteria,
            "rumah" => $rumah,
            "kriteria" => $kriteria,
            "nilai" => $nilai
        ]);
    }

    public function storeKriteria(Request $request)
    {   
        $kriteria = ["Carport", "Kitchen Set", "Air Bersih", "Harga", "Jumlah Kamar", "Jumlah Kamar Mandi", "Luas Tanah", "Luas Bangunan", "Daya Listrik"];
        $rumah = Rumah::all();  

        NilaiKriteria::where("id_nilai_kriteria", ">", 0)->delete();
        NilaiRumah::where("id_nilai_rumah_kriteria", ">", 0)->delete();

        foreach($kriteria as $key1 => $k1)
        {
            foreach($kriteria as $key2 => $k2)
            {       
                NilaiKriteria::create([
                    "kriteria_1" => $k1,
                    "kriteria_2" => $k2,
                    "nilai" => ($key1 == $key2) ? 1 : $request->input("kriteria-" . $key1 . "-" . $key2) 
                ]);
            }
        }
    
        return redirect()->back()->with(["message" => "Berhasil Menyimpan Nilai Perbandingan", "status" => "success"]); 
    }

    public function updateKonfirmasi(Request $request, $id)
    {   
        $rumah = Rumah::where("idrumah", $id)->first();

        if($request->status == "Setuju")
        {
            Rumah::where("idrumah", $id)->update([
                "status" => "Kosong",
            ]);
        }
        else
        {
            Rumah::where("idrumah", $id)->update([
                "status" => "Ditolak",
                "alasan_tolak" => $request->alasan
            ]);
        }

        $notifikasi = [
            "type" => "Konfirmasi Rumah", 
            "status" => $request->status, 
            "message" => ($request->status === "Setuju") ? "Proses penambahan rumah disetujui" : "Proses penambahan rumah ditolak, karena " . $request->alasan,
        ];

        Notifikasi::create([
            "idpenerima" => $rumah->id_pemilik,
            "notifikasi" => json_encode($notifikasi),
        ]);
        
        return response()->json(["message" => "Berhasil konfirmasi rumah", "status" => "success"]);
    }
}
