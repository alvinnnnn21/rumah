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

class MemberController extends Controller
{
    public function index(Request $request)
    {          
        $rumah = Rumah::where("status", "Kosong");

        if(!$request->query())
        {   
            $rumah = $rumah->get();

            return view("member.index")->with([
                "rumah" => $rumah
            ]);
        }
        else if($request->query())
        {                   
            $kriteria = ["Carport", "Kitchen Set", "Air Bersih"];

            $rumah = Rumah::where("status", "Kosong");
            
            if(!is_null($request->kota))
            {
                $rumah = Rumah::where("kota", $request->kota);
            }
            if(!is_null($request->provinsi))
            {   
                $provinsi = explode("-", $request->provinsi);
                
                $rumah = Rumah::where("provinsi", $provinsi[1]);
            }
            if(!is_null($request->alamat))
            {
                $rumah = $rumah->where('alamat', 'like', '%' . $request->keyword . '%');
            }
            if(!is_null($request->harga))
            {   
                $harga = str_replace(".", "", $request->harga);
                $split = explode("-", $harga);

                if($split[1] > 0)
                {
                    array_push($kriteria, "Harga");

                    $rumah = $rumah->whereBetween("harga", [$split[0], $split[1]]);
                }
            }
            if(!is_null($request->jumlah_kamar))
            {
                array_push($kriteria, "Jumlah Kamar");
                $rumah = $rumah->where("jumlah_kamar", "=", $request->jumlah_kamar);
            }
            if(!is_null($request->jumlah_kamar_mandi))
            {
                array_push($kriteria, "Jumlah Kamar Mandi");
                $rumah = $rumah->where("jumlah_kamar_mandi", "=", $request->jumlah_kamar_mandi);
            }      
            
            if(!is_null($request->luas_tanah))
            {   
                $luas = str_replace(".", "", $request->luas_tanah);
                $split = explode("-", $luas);

                if($split[1] > 0)
                {
                    array_push($kriteria, "Luas Tanah");

                    $rumah = $rumah->whereBetween("luas_tanah", [$split[0], $split[1]]);
                }
            }
            if(!is_null($request->luas_bangunan))
            {
                $luas = str_replace(".", "", $request->luas_bangunan);
                $split = explode("-", $luas);

                if($split[1] > 0)
                {
                    array_push($kriteria, "Luas Bangunan");

                    $rumah = $rumah->whereBetween("luas_bangunan", [$split[0], $split[1]]);
                }
            }
            if(!is_null($request->daya_listrik))
            {   
                array_push($kriteria, "Daya Listrik");
                $rumah = $rumah->where("daya_listrik", "=", $request->daya_listrik);
            }

            $rumah->where("air_bersih", $request->air_bersih);

            if(isset($request->carport))$rumah = $rumah->where("carport", "Ada");
            else if(!isset($request->carport)) $rumah = $rumah->where("carport", "Tidak Ada");
            if(isset($request->kitchen_set))$rumah = $rumah->where("kitchen_set", "Ada");
            else if(!isset($request->kitchen_set)) $rumah = $rumah->where("kitchen_set", "Tidak Ada");

            $rumah = $rumah->get();

            if(count($rumah) == 0)
            {
                return redirect()->back()->with(["message" => "Rumah dengan kriteria yang dicari tidak ditemukan", "status" => "info"]);
            }

            $nilai_kriteria = NilaiKriteria::whereIn("kriteria_1", $kriteria)
                                            ->whereIn("kriteria_2", $kriteria)
                                            ->get();

            $nilai = [0.11111111111111, 0.125, 0.14285714285714, 0.16666666666667, 0.2, 0.25, 0.33333333333333, 0.5];

            return view("member.perbandingan")->with([
                "rumah" => $rumah,
                "kriteria" => $kriteria,
                "nilai_kriteria" => $nilai_kriteria,
                "nilai" => $nilai
            ]);
        }
    }

    public function getChat($id, $lawan)
    {                       
        $chat = Chat::where((Auth::user()->roles == "penyewa") ? "idpenyewa" : "idpemilik", Auth::user()->iduser)->get();
        
        $data_lawan = User::where("iduser", $lawan)->first(["iduser", "nama"]);

        return view("member.chat")->with([
            "chat" => $chat,
            "id" => $id,
            "lawan" => $data_lawan
        ]);
    }

    public function getChatAll()
    {
        $chat = Chat::where((Auth::user()->roles == "penyewa") ? "idpenyewa" : "idpemilik", Auth::user()->iduser)->get();

        return view("member.chat")->with([
            "chat" => $chat,
        ]);
    }

    public function storeChat(Request $request)
    {   
        if($request->id == 0)
        {       
            $chat = Chat::create([
                "idpemilik" => Auth::user()->roles == "pemilik" ? Auth::user()->iduser : $request->lawan,
                "idpenyewa" => Auth::user()->roles == "penyewa" ? Auth::user()->iduser : $request->lawan,
                "status" => "Aktif"
            ]);

            $detail = DetailChat::create([
                "idpengirim" => Auth::user()->iduser,
                "pesan" => $request->message,
                "waktu" => date("Y-m-d H:i:s"),
                "idchat" => $chat->id
            ]);

            return response()->json($detail);
        }
        else if($request->id != 0)
        {
            $detail = DetailChat::create([
                "idpengirim" => Auth::user()->iduser,
                "pesan" => $request->message,
                "waktu" => date("Y-m-d H:i:s"),
                "idchat" => $request->id
            ]);

            return response()->json($detail);
        }
    }

    public function getDetailChat($id)
    {
        $chat = Chat::with(["penyewa", "pemilik", "detailchat"])->where("idchat", $id)->first();

        return response()->json($chat);
    }

    public function getDetailRumah($id)
    {   
        $owner = false;
        $fasilitas = [];
        $chat = [];
        
        if(Auth::guard("member")->check())
        {
            $rumah = Rumah::with(["favorite" => function($favorite){
                $favorite->where("idpenyewa", Auth::guard("member")->user()->iduser)->first();
            }])->where("idrumah", $id)->first();

            $chat = Chat::where("idpemilik", $rumah->id_pemilik)
                        ->where("idpenyewa", Auth::guard("member")->user()->iduser)
                        ->first();

            $owner = ($rumah->id_pemilik == Auth::guard("member")->user()->iduser) ? true : false;
        }
        else 
        {
            $rumah = Rumah::where("idrumah", $id)->first();
        }

        if($rumah->air_bersih == "Ada") array_push($fasilitas, "Air Bersih");
        if($rumah->carport == "Ada") array_push($fasilitas, "Car Port");
        if($rumah->kitchen_set == "Ada") array_push($fasilitas, "Kitchen Set");

        return view("member.detail_rumah")->with([
            "rumah" => $rumah,
            "title" => "Detail Rumah",
            "fasilitas" => $fasilitas,
            "owner" => $owner,
            "chat" => $chat
        ]);
    }

    public function getRumahSaya()
    {   
        $rumah = Rumah::where("id_pemilik", Auth::user()->iduser)->get();
        
        return view("member.rumahsaya")->with([
            "rumah" => $rumah
        ]);
    }

    public function getAkun()
    {
        return view("member.akun")->with([
            "user" => Auth::user()
        ]);
    }

    public function getFavorit()
    {
        $rumah = Rumah::with(["favorite" => function($favorite){
            $favorite->where("idpenyewa", Auth::user()->iduser)->get();
        }])->get();

        return view("member.favorit")->with([
            "rumah" => $rumah
        ]);
    }

    public function updateAkun(Request $request)
    {   
        User::where("iduser", Auth::user()->iduser)->update([
            "nama" => $request->nama,
            "email" => $request->email,
            "username" => $request->username,
            "no_telpon" => $request->no_telpon,
            "bank" => $request->bank,
            "no_rekening" => $request->no_rekening,
        ]);

        return redirect()->back()->with(["message" => "Berhasil Mengubah Akun", "status" => "success"]);
    }

    public function createReminder()
    {   
        $reminder = Reminder::where("iduser", Auth::user()->iduser)->get();

        return view("member.create_reminder")->with([
            "reminder" => $reminder
        ]);
    }

    public function getReminder()
    {
        $reminder = Reminder::where("iduser", Auth::user()->iduser)->get();

        return view("member.reminder")->with([
            "reminder" => $reminder
        ]);
    }

    public function storeReminder(Request $request)
    {   
        $request->validate([
            'acara' => ['required', 'string', 'max:128'],
        ]);

        Reminder::create([
            "date" => $request->tanggal,
            "time" => $request->waktu,
            "acara" => $request->acara,
            "iduser" => Auth::user()->iduser
        ]);

        return redirect()->back()->with(["message" => "Berhasil Menambah Reminder", "status" => "success"]);
    }

    public function updateReminder(Request $request, $id)
    {
        Reminder::where("idreminder", $id)->update([
            "acara" => $request->acara,
            "date" => $request->tanggal,
            "time" => $request->waktu
        ]);

        return redirect()->back()->with(["message" => "Berhasil Mengubah Reminder", "status" => "success"]);
    }

    public function destroyReminder($id)
    {
        Reminder::where("idreminder", $id)->delete();

        return redirect()->back()->with(["message" => "Berhasil Menghapus Reminder", "status" => "success"]);
    }

    public function createRumah()
    {
        return view("member.create_rumah");
    }

    public function storeRumah(Request $request)
    {   
        $request->validate([
            "alamat" => ['required', 'string', 'max:64'],
            "keterangan" => ['required', 'string'],
            "harga" =>['required', 'string', 'digits_between: 3, 11'],
            "luas_tanah" => ['required', 'string'],
            "luas_bangunan" => ['required', 'string'],
            "jumlah_kamar" => ['required', 'string', 'digits_between: 1, 11'],
            "jumlah_kamar_mandi" => ['required', 'string', 'digits_between: 1, 11'],
        ]);

        $provinsi = explode("-", $request->provinsi);

        $rumah = Rumah::create([
            "judul" => $request->judul,
            "alamat" => $request->alamat,
            "kota" => $request->kota,
            "provinsi" => $provinsi[1],
            "keterangan" => $request->keterangan,
            "harga" => $request->harga,
            "luas_tanah" => $request->luas_tanah,
            "luas_bangunan" => $request->luas_bangunan,
            "jumlah_kamar" => $request->jumlah_kamar,
            "jumlah_kamar_mandi" => $request->jumlah_kamar_mandi,
            "daya_listrik" => $request->daya_listrik,
            "air_bersih" => $request->air_bersih,
            "carport" => $request->carport,
            "kitchen_set" =>  $request->kitchen_set,
            "id_pemilik" => Auth::user()->iduser,
            "status" => "Proses"
        ]);

        for($i = 0; $i < count($request->file("gambar")); $i++)
        {
            $filename = time() . "_" . rand(0, 1000) . "." . $request->file("gambar")[$i]->getClientOriginalExtension();
            $path = $request->file("gambar")[$i]->move(public_path("images/rumah"), $filename);

            Gambar::create([
                "gambar" => $filename,
                "idrumah"  => $rumah->id
            ]);
        }

        return redirect()->back()->with(["message" => "Berhasil Menambah Rumah", "status" => "success"]);
    }

    public function updateRumah(Request $request, $id)
    {   
        Rumah::where("idrumah", $id)->update([
            // "judul" => $request->judul,
            "alamat" => $request->alamat,
            "keterangan" => $request->keterangan,
            "harga" => $request->harga,
            "luas_tanah" => $request->luas_tanah,
            "luas_bangunan" => $request->luas_bangunan,
            "jumlah_kamar" => $request->jumlah_kamar,
            "jumlah_kamar_mandi" => $request->jumlah_kamar_mandi,
            "daya_listrik" => $request->daya_listrik,
            "air_bersih" => $request->air_bersih,
            "carport" => $request->carport,
            "kitchen_set" =>  $request->kitchen_set,
        ]);

        if($request->gambar)
        {
            for($i = 0; $i < count($request->file("gambar")); $i++)
            {
                $filename = time() . "_" . rand(0, 1000) . "." . $request->file("gambar")[$i]->getClientOriginalExtension();
                $path = $request->file("gambar")[$i]->move(public_path("images/rumah"), $filename);

                Gambar::create([
                    "gambar" => $filename,
                    "idrumah"  => $id
                ]);
            }
        }

        if($request->hapus)
        {
            $id = explode(",", $request->hapus);
            $id = array_unique($id);
            $id = array_values($id);

            foreach($id as $i)
            {
                // $gambar = Gambar::where("idgambar", $i)->first();

                // unlink("storage/images/rumah/" . $gambar->gambar);

                $gambar->where("idgambar", $id)->delete();
            }
        }

        return redirect()->back()->with(["message" => "Berhasil Mengubah Detail Rumah", "status" => "success"]);
    }

    public function storeFavorite(Request $request)
    {
        $favorite = Favorite::create([
            "idpenyewa" => Auth::guard("member")->user()->iduser,
            "idrumah" => $request->rumah
        ]);

        return response()->json(["status" => ($favorite) ? "200" : "400"]);
    }

    public function destroyFavorite($id)
    {
        $favorite = Favorite::where("idrumah", $id)
                ->where("idpenyewa", Auth::guard("member")->user()->iduser)
                ->delete();

        return response()->json(["status" => ($favorite) ? "200" : "400"]);
    }

    public function storeSewa(Request $request)
    {       
        $rumah = Rumah::where("idrumah", $request->rumah)->first();

        $transaksi = TransaksiSewa::create([
            "iduser" => Auth::guard("member")->user()->iduser,
            "idrumah" => $request->rumah,
            "lama_sewa" => $request->lama,
            "mulai_sewa" => date("Y-m-d H:i:s", strtotime($request->mulai)),
            "selesai_sewa" => date("Y-m-d H:i:s", strtotime($request->akhir)),
            "total" => $rumah->harga * $request->lama
        ]);

        return view("member.sukses")->with([
            "rumah" => $rumah,
            "transaksi" => $transaksi,
        ]);
    }

    public function storeBukti(Request $request)
    {               
        $previous = str_replace(url('/'), '', url()->previous());

        $filename = time() . "_" . rand(0, 1000) . "." . $request->file("bukti")->getClientOriginalExtension();
        $path = $request->file("bukti")->storeAs("images/bukti", $filename);

        $bukti = BuktiBayar::create([
            "idtransaksi" => $request->transaksi,
            "waktu_bayar" => date("Y-m-d h:i:s"),
            "bukti" => $filename
        ]);

        TransaksiSewa::where("id_transaksi_sewa", $request->transaksi)->update([
            "status" => "Proses Verifikasi Pembayaran"
        ]);

        $bukti = BuktiBayar::where("idtransaksi", $request->transaksi)
                        ->where("status", "Gagal")
                        ->get();

        if(count($bukti) > 0)
        {   
            $transaksi = TransaksiSewa::where("id_transaksi_sewa", $request->transaksi)->first();

            $notifikasi = Notifikasi::where("idpenerima", $transaksi->iduser)->get();   

            if(count($notifikasi) > 0)
            {
                foreach($notifikasi as $n)
                {
                    $data = json_decode($n->notifikasi);

                    if($data->status === "Gagal" && $data->type === "Pembayaran")
                    {       
                        if($data->data->id_transaksi_sewa == $request->transaksi)
                        {   
                            Notifikasi::where("id_notifikasi", $n->id_notifikasi)->delete();
                        }
                    }
                }
            }
        }

        if($previous === "/transaksi")
        {
            return redirect()->back()->with(["message" => "Berhasil Mengirimkan Bukti Pembayaran, Silahkan Menuggu Verifikasi Bukti Pembayaran", "status" => "success"]);
        }

        return redirect("/")->with(["message" => "Berhasil Mengirimkan Bukti Pembayaran, Silahkan Menuggu Verifikasi Bukti Pembayaran", "status" => "success"]);
    }

    public function getTransaksi()
    {
        $transaksi = TransaksiSewa::where("iduser", Auth::user()->iduser)->get();

        return view("member.transaksi")->with([
            "transaksi" => $transaksi
        ]);
    }

    public function storeAHP(Request $request)
    {           
        $rumah = json_decode($request->rumah);
        $kriteria_all = json_decode($request->kriteria);

        $nilai_kriteria_new = [];

        foreach($request->except(["kriteria", "rumah", "_token"]) as $key => $r)
        {   
            $id = explode("-", $key);

            array_push($nilai_kriteria_new, ["nilai" => $r, "kriteria_1" => $id[1], "kriteria_2" => $id[2]]);
        }

        $id = [];

        foreach($rumah as $r)
        {
            array_push($id, $r->idrumah);
        }

        $nilai_rumah = NilaiRumah::whereIn("rumah_1", $id)
                                ->whereIn("rumah_2", $id)
                                ->get();

        /// KRITERIA

        $kriteria = AHP::getKriteriaFormat($nilai_kriteria_new);

        $kriteria_list = AHP::getKriteria($kriteria);

        $matrix_kriteria = AHP::getMatrixKriteria($kriteria_list);

        $nilai_kriteria = AHP::getNilaiMatrixKriteria($matrix_kriteria, $kriteria);

        $total_kriteria = AHP::getTotalKriteria($kriteria_list, $nilai_kriteria);

        $nilai_dibagi_kriteria = AHP::getNilaiBagiKriteria($nilai_kriteria, $total_kriteria);

        $bobot_kriteria = AHP::getBobotKriteria($nilai_dibagi_kriteria, count($kriteria_list), $kriteria_list);

        /// RUMAH

        $rumah = AHP::getRumahFormat($kriteria_all, $rumah);

        $rumah_list = AHP::getRumah($rumah[0]["matrix"]);

        $matrix_rumah = AHP::getMatrixRumah($rumah_list, $kriteria_list);

        $nilai_rumah = AHP::getNilaiMatrixRumah($matrix_rumah, $rumah);

        $total_rumah = AHP::getTotalRumah($rumah_list, $nilai_rumah);

        $nilai_dibagi_rumah = AHP::getNilaiBagiRumah($nilai_rumah, $total_rumah);

        $bobot_rumah = AHP::getBobotRumah($nilai_dibagi_rumah, count($rumah_list), $rumah_list, $kriteria_list);

        /// FINAL

        $nilai_final = AHP::getFinal($rumah_list, $kriteria_list, $bobot_rumah, $bobot_kriteria);

        usort($nilai_final, function($a, $b) {
            return $b['nilai'] <=> $a['nilai'];
        });

        $hasil = [];

        foreach($nilai_final as $n)
        {
            $rumah = Rumah::with(["gambar", "pemilik"])->where("idrumah", $n["rumah"])->first();

            array_push($hasil, $rumah);
        }   

        return view("member.hasil")->with([
            "rumah" => $hasil
        ]);
    }

    public function storeSearch(Request $request)
    {
        $rumah = Rumah::with("gambar")->where('alamat', 'like', '%' . $request->keyword . '%')->get();

        if($request->keyword === "")
        {
            $rumah = Rumah::all();
        }

        $html = "";

        foreach($rumah as $r)
        {
            $html .= '<div class="row bg-light mb-3" style="border-radius: 10px; height: 60vh;">';
            $html .= '<div class="col-md-4 img-card p-0">';
            $html .= '<img class="img-rumah-' . $r->idrumah . '" src="' . asset((count($r->gambar) > 0) ? "storage/images/rumah/" . $r->gambar[0]->gambar : "storage/images/rumah/no_image.png") . '">';
            $html .= '</div>';
            $html .= '<div class="col-md-8 pt-3 d-flex flex-column justify-content-between pb-3">';
            $html .= '<h4 style="font-weight: 700;">' . $r->harga . '</h4>';
            $html .= '<a href=' . url("/rumah") . '/' . $r->idrumah . '">';
            $html .= '<h5 class="mt-3">' . $r->judul . '</h5>';
            $html .= '</a>';
            $html .= '<h6 class="text-secondary">';
            $html .= '<i class="fas fa-map-marker-alt mr-2 mt-3 text-danger"></i>';
            $html .= $r->alamat;
            $html .= '</h6>';
            $html .= '<div class="mt-4 d-flex flex-row" style="font-size: 20px;">';
            $html .= '<span>';
            $html .= '<i class="fas fa-bed"></i>';
            $html .= $r->jumlah_kamar;
            $html .= '<p class="text-secondary">Kamar</p>';
            $html .= '</span>';
            $html .= '<span class="ml-5">';
            $html .= '<i class="fas fa-shower"></i>';
            $html .= $r->jumlah_kamar_mandi;
            $html .= '<p class="text-secondary">Kamar Mandi</p>';
            $html .= '</span>';
            $html .= '<span class="ml-5">';
            $html .= '<i class="fas fa-expand-arrows-alt"></i>';
            $html .= $r->luas_bangunan . 'm<sup>2</sup>';
            $html .= '<p class="text-secondary">Bangunan</p>';
            $html .= '</span>';
            $html .= '</div>';
            $html .= '<p class="mt-3">' . $r->keterangan . '</p>';
            $html .= '<h6 class="mb-3">Gambar Lain</h6>';
            $html .= '<div class="d-flex flex-row mb-1 img-other" style="overflow: auto;">';
            foreach($r->gambar as $key => $g)
            {
                $html .= '<img data-id="' . $r->idrumah . '" class="mr-2 img-carousel' . (($key == 0) ? " img-active" : "") . '" style="width: 100px; height: 100px; border: 2px solid rgba(0, 0, 0, 0.2); border-radius: 10px;" src="' . asset("storage/images/rumah/" . $g->gambar ) . '">';
            }
            $html .= '</div>';
            $html .= '</div>';  
            $html .= '</div>';
        }

        return response()->json(["status" => "200", "data" => json_encode($html)]);
    }

    public function getNotifikasi($id)
    {
        $notifikasi = Notifikasi::where("idpenerima", $id)->get();

        $date = Date("Y-m-d");
        $time = Date("H:i:s");

        $reminder = Reminder::where("iduser", $id)
                ->whereDate("date", "<=" , now()->toDateString())
                ->whereTime("time", "<=", now()->toTimeString())
                ->get();

        $html = "";
        $modal = "";

        foreach($notifikasi as $n)
        {
            $data = json_decode($n->notifikasi);

            $html .= '<div class="notification-card">';
            $html .= '<div class="row">';
            $html .= '<div class="col-md-12">';
            $html .= '<h5>' . $data->type . '</h5>';
            $html .= '<p style="font-size: 12px;">';
            $html .= $data->message;
            $html .= '</p>';
            if($data->status === "Gagal")
            {
                $html .= '<button class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-upload-' . $data->data->id_transaksi_sewa . '">Upload Ulang</button>';
                
                $modal .= '<div class="modal fade" id="modal-upload-' . $data->data->id_transaksi_sewa . '" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">';
                $modal .= '<div class="modal-dialog modal-lg" role="document">';
                $modal .= '<form method="post" action="' .  url("/bukti") . '" enctype="multipart/form-data">';
                $modal .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                $modal .= '<input type="hidden" name="transaksi" value="' . $data->data->id_transaksi_sewa . '">';
                $modal .= '<div class="modal-content">';
                $modal .= '<div class="modal-body">';
                $modal .= '<div class="container-fluid">';
                $modal .= '<div class="row">';
                $modal .= '<div class="col-md-12">';
                $modal .= '<h6>DETAIL SEWA</h6>';
                $modal .= '<hr>';
                $modal .= '</div>';
                $modal .= '<div class="col-md-12">';
                $modal .= '<table class="table table-borderless">';
                $modal .= '<thead>';
                $modal .= '<tr>';
                $modal .= '<th>Lama Sewa</th>';
                $modal .= '<th>:</th>';
                $modal .= '<th>';
                $modal .= $data->data->lama_sewa;
                $modal .= '</th>';
                $modal .= '</tr>';
                $modal .= '<tr>';
                $modal .= '<th>Waktu Sewa</th>';
                $modal .= '<th>:</th>';
                $modal .= '<th id="waktu-sewa">';
                $modal .= date("Y-m-d", strtotime($data->data->mulai_sewa)) . " - " . date("Y-m-d", strtotime($data->data->selesai_sewa));
                $modal .= '</th>';
                $modal .= '</tr>';
                $modal .= '<tr>';
                $modal .= '<th>Harga Total</th>';
                $modal .= '<th>:</th>';
                $modal .= '<th>';
                $modal .= 'Rp ' . number_format($data->data->total, 2, ",", ".");
                $modal .= '</th>';
                $modal .= '</tr>';
                $modal .= '<tr>';
                $modal .= '<th colspan="2">Upload Bukti</th>';
                $modal .= '<th>';
                $modal .= '<input type="file" name="bukti" accept="image/*" required>';
                $modal .= '</th>';
                $modal .= '</tr>';
                $modal .= '</thead>';
                $modal .= '</table>';
                $modal .= '</div>';
                $modal .= '</div>';      
                $modal .= '</div>';
                $modal .= '</div>';
                $modal .= '<div class="modal-footer">';
                $modal .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>';
                $modal .= '<button type="submit" class="btn btn-primary">Kirim</button>';
                $modal .= '</div>';
                $modal .= '</div>';      
                $modal .= '</form>';
                $modal .= '</div>';
                $modal .= '</div>';
            }

            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        }

        foreach($reminder as $r)
        {
            $html .= '<div class="notification-card">';
            $html .= '<div class="row">';
            $html .= '<div class="col-md-12">';
            $html .= '<h5>Reminder</h5>';
            $html .= '<p>';
            $html .= $r->acara;
            $html .= '</p>';
            $html .= '<p>';
            $html .= $r->date . " " . $r->time;
            $html .= '</p>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        }

        if(count($notifikasi) == 0)
        {   
            $html .= "<div class='d-flex justify-content-center align-items-center' style='height: 100%;'>";
            $html .= "<h4>Tidak Ada Notifikasi</h4>";
            $html .= "</div>";
        }

        return response()->json(["status" => "200", "html" => $html, "modal" => $modal]);
    }

    public function getTutorial()       
    {   
        return view("member.tutorial");
    }
}
