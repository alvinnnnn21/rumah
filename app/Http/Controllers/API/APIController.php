<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
use App\Models\User;
use App\Models\Rumah;
use App\Models\Favorite;
use App\Models\Chat;
use App\Models\DetailChat;
use App\Models\Reminder;
use App\Models\Gambar;
use App\Models\TransaksiSewa;
use App\Models\BuktiBayar;
use App\Models\Notifikasi;

use Validator;
use Auth;
use Hash;
use Storage;
use DB;

use App\Helper\AHP;

class APIController extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            "username" => "required",
            "password" => "required"
        ];

        $messages = [
            "username.required" => "Username tidak boleh kosong",
            "password.required" => "Password tidak boleh kosong"
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails())
        {
            return response()->json(["status" => "400", "message" => "Login Gagal", "error" => $validator->messages()]);
        }

        $credentials = [
            "username" => $request->username,
            "password" => $request->password
        ];

        if(Auth::guard()->attempt($credentials))
        {
            $user = User::where("username", $request->username)->first();

            return response()->json(["status" => "200", "message" => "Login Berhasil", "data" => $user]);
        }
        else 
        {
            return response()->json(["status" => "404", "message" => "Login Gagal, Username atau Password Salah"]);
        }
    }

    public function register(Request $request)
    {
        $rules = [
            "username" => "required|max:45|unique:user",
            "password" => "required|max:45",
            "email" => "required|max:45|unique:user",
            "no_telpon" => "required|max:45|unique:user",
            "alamat" => "required|max:45",
            "nama" => "required|max:45"
        ];

        $messages = [
            "username.required" => "Username tidak boleh kosong",
            "username.max" => "Username tidak boleh lebih dari 45 karakter",
            "username.unique" => "Username sudah terdaftar",
            "password.required" => "Password tidak boleh kosong",
            "password.max" => "Password tidak boleh lebih dari 45 karakter",
            "email.required" => "Email tidak boleh kosong",
            "email.max" => "Email tidak boleh lebih dari 45 karakter",
            "email.unique" => "Email sudah terdaftar",
            "no_telpon.required" => "No Telpon tidak boleh kosong",
            "no_telpon.max" => "No Telpon tidak boleh lebih dari 45 karakter",
            "no_telpon.unique" => "No Telpon sudah terdaftar",
            "alamat.required" => "Alamat tidak boleh kosong",
            "alamat.max" => "Alamat tidak boleh lebih dari 45 karakter",
            "nama.required" => "Nama tidak boleh kosong",
            "nama.max" => "Nama tidak boleh melebihi 45 karakter"
        ];

        $validator = Validator::make($request->except(["role"]), $rules, $messages);

        if($validator->fails())
        {
            return response()->json(["status" => "400", "message" => "Register Gagal", "error" => $validator->messages()]);
        }

        $user = User::create([
            "username" => $request->username,
            "password" => Hash::make($request->password),
            "nama" => $request->nama,
            "email" => $request->email,
            "no_telpon" => $request->no_telpon,
            "roles" => $request->roles  
        ]);

        return response()->json(["status" => "200", "message" => "Register Berhasil", "data" => $user]);
    }

    public function getRumah()
    {
        $rumah = Rumah::with(["gambar", "pemilik"])->get();

        return response()->json(["status" => "200", "data" => $rumah]);
    }

    public function getDetailRumah($id)
    {       
        $id = explode("-", $id);
        $fasilitas = [];

        if(count($id) === 2)
        {
            $rumah = Rumah::with(["gambar", "favorite" => function($favorite) use($id){
                $favorite->where("idpenyewa", $id[1])->first();
            }])->where("idrumah", $id[0])->first();
    
            $chat = Chat::where("idpemilik", $rumah->id_pemilik)
                        ->where("idpenyewa", $id[1])
                        ->first();

            if($rumah->air_bersih == "Ada") array_push($fasilitas, "Air Bersih");
            if($rumah->carport == "Ada") array_push($fasilitas, "Car Port");
            if($rumah->kitchen_set == "Ada") array_push($fasilitas, "Kitchen Set");
    
            return response()->json(["status" => "200", "data" => $rumah, "chat" => $chat, "fasilitas" => $fasilitas]);
        }
        else
        {
            $rumah = Rumah::with("gambar")->where("idrumah", $id)->first();

            if($rumah->air_bersih == "Ada") array_push($fasilitas, "Air Bersih");
            if($rumah->carport == "Ada") array_push($fasilitas, "Car Port");
            if($rumah->kitchen_set == "Ada") array_push($fasilitas, "Kitchen Set");

            return response()->json(["status" => "200", "data" => $rumah, "fasilitas" => $fasilitas]);
        }
    }

    public function getFavorite($id)
    {
        $favorite = Favorite::with(["rumah" => function($rumah){
            $rumah->with("gambar")->get();
        }])->where("idpenyewa", $id)->get();

        return response()->json(["status" => "200", "data" => $favorite]);
    }

    public function createFavorite(Request $request)
    {
        Favorite::create([
            "idpenyewa" => $request->idpenyewa,
            "idrumah" => $request->idrumah
        ]);

        return response()->json(["status" => "200"]);
    }

    public function deleteFavorite($id)
    {   
        $id = explode("-", $id);

        Favorite::where("idpenyewa", $id[1])
            ->where("idrumah", $id[0])
            ->delete();

        return response()->json(["status" => "200"]);
    }

    public function getChat($id)
    {   
        $user = User::where("iduser", $id)->first("roles");

        $chat = [];

        if($user->roles === "penyewa")
        {
            $chat = Chat::with(["penyewa", "pemilik"])->where("idpenyewa", $id)->get();
        }
        else 
        {
            $chat = Chat::with(["penyewa", "pemilik"])->where("idpemilik", $id)->get();
        }

        return response()->json(["status" => "200", "data" => $chat]);
    }

    public function getDetailChat($id)
    {
        $chat = Chat::with(["detailchat", "penyewa", "pemilik"])->where("idchat", $id)->first();

        return response()->json(["status" => "200", "data" => $chat]);
    }

    public function createChat(Request $request)
    {   
        $user = User::where("iduser", $request->iduser)->first("roles");

        if($request->idchat == 0)
        {
            $chat = Chat::create([
                "idpemilik" => ($user->roles === "penyewa") ? $request->idlawan : $request->iduser,
                "idpenyewa" => ($user->roles === "penyewa") ? $request->iduser : $request->idlawan,
                "status" => "Aktif"
            ]);
        }

        DetailChat::create([
            "idpengirim" => $request->iduser,
            "pesan" => $request->pesan,
            "waktu" => date("Y-m-d h:i:s"),
            "idchat" => ($request->idchat === 0) ? $chat->id : $request->idchat
        ]);

        return response()->json(["status" => "200"]);
    }

    public function getRumahSaya($id)
    {
        $rumah = Rumah::with("gambar")->where("id_pemilik", $id)->get();

        return response()->json(["status" => "200", "data" => $rumah]);
    }

    public function createRumah(Request $request)
    {           
        $rules = [
            "judul" => "required|max:128",
            "alamat" => "required|max:45",
            "keterangan" => "required",
            "harga" => "required",
            "luas_tanah" => "required",
            "luas_bangunan" => "required",
            "jumlah_kamar" => "required",
            "jumlah_kamar_mandi" => "required",
            "daya_listrik" => "required"
        ];

        $messages = [
            "judul.required" => "Judul tidak boleh kosong",
            "judul.max" => "Judul tidak boleh lebih dari 128 karakter",
            "alamat.required" => "Alamat tidak boleh kosong",
            "alamat.max" => "Alamat tidak boleh lebih dari 45 karakter",
            "keterangan.required" => "Keterangan tidak boleh kosong",
            "harga.required" => "Harga tidak boleh kosong",
            "luas_tanah.required" => "Luas Tanah tidak boleh kosong",
            "luas_bangungan.required" => "Luas Bangunan tidak boleh kosong",
            "jumlah_kamar.required" => "Jumlah Kamar tidak boleh kosong",
            "jumlah_kamar_mandi.required" => "Jumlah Kamar Mandi tidak boleh kosong",
            "daya_listrik" => "Daya Listrik tidak boleh kosong"
        ];

        $validator = Validator::make($request->except(["role"]), $rules, $messages);

        if($validator->fails())
        {
            return response()->json(["status" => "400", "message" => "Tambah rumah gagal", "error" => $validator->messages()]);
        }

        $rumah = Rumah::create([
            "judul" => $request->judul,
            "alamat" => $request->alamat,
            "luas_bangunan" => $request->luas_bangunan,
            "luas_tanah" => $request->luas_tanah,
            "jumlah_kamar" => $request->jumlah_kamar,
            "jumlah_kamar_mandi" => $request->jumlah_kamar_mandi,
            "air_bersih" => $request->air_bersih,
            "kitchen_set" => $request->kitchen_set,
            "carport" => $request->carport,
            "harga" => $request->harga,
            "id_pemilik" => $request->pemilik,
            "keterangan" => $request->keterangan,
            "daya_listrik" => $request->daya_listrik,
        ]);

        for($i = 0; $i <= $request->count; $i++) 
        {   
            $img = "image" . $i;

            if($request->hasFile($img))
            {
                $filename = time() . "_" . rand(0, 1000) . "." . $request->file($img)->getClientOriginalName();
                $path = $request->file($img)->move(public_path("images/rumah"), $filename);

                Gambar::create([
                    "gambar" => $filename,
                    "idrumah" => $rumah->id
                ]);
            }
        }

        return response()->json(["status" => "200", "message" => "Berhasil menambah rumah baru"]);
    }

    public function getReminder($id)
    {
        $reminder = Reminder::where("iduser", $id)->get();

        return response()->json(["status" => "200", "data" => $reminder]);
    }

    public function createReminder(Request $request)
    {
        $date = explode("T", $request->date);
        $time = explode("T", $request->time);
        $time = explode(".", $time[1]);

        Reminder::create([
            "date" => $date[0],
            "time" => $time[0],
            "acara" => $request->acara,
            "iduser" => $request->iduser
        ]);

        return response()->json(["status" => "200", "message" => "Berhasil membuat reminder baru"]);
    }

    public function deleteReminder($id)
    {   
        Reminder::where("idreminder", $id)->delete();

        return response()->json(["status" => "200", "message" => "Berhasil menghapus reminder"]);
    }

    public function editReminder($id, Request $request)
    {
        Reminder::where("idreminder", $id)->update([
            "date" => $request->date,
            "time" => $request->time,
            "acara" => $request->acara
        ]);

        return response()->json(["status" => "200", "message" => "Berhasil mengubah reminder"]);
    }

    public function editUser($id, Request $request)
    {
        User::where("iduser", $id)->update([
            "nama" => $request->nama,
            "username" => $request->username,
            "email" => $request->email,
            "no_telpon" => $request->no_telpon,
            "bank" => $request->bank,
            "no_rekening" => $request->no_rekenign
        ]);

        $user = User::where("iduser", $id)->first();

        return response()->json(["status" => "200", "message" => "Berhasil mengubah data akun", "data" => $user]);
    }

    public function getSearch(Request $request)
    {
        $rumah = Rumah::with("gambar")->where('judul', 'like', '%' . $request->keyword . '%')
                                    ->orWhere('alamat', 'like', '%' . $request->keyword . '%')
                                    ->get();

        return response()->json(["status" => "200", "data" => $rumah]);
    }

    public function createSewa(Request $request)
    {
        $rumah = Rumah::where("idrumah", $request->rumah)->first();

        $transaksi = TransaksiSewa::create([
            "iduser" => $request->user,
            "idrumah" => $request->rumah,
            "lama_sewa" => $request->lama,
            "mulai_sewa" => date("Y-m-d H:i:s", strtotime($request->mulai)),
            "selesai_sewa" => date("Y-m-d H:i:s", strtotime($request->selesai)),
            "total" => $rumah->harga * $request->lama
        ]);

        return response()->json(["status" => "200", "message" => "", "data" => $transaksi]);
    }

    public function createBukti(Request $request)
    {       
        $filename = "";

        if($request->hasFile("bukti"))
        {
            $filename = time() . "_" . rand(0, 1000) . "." . $request->file("bukti")->getClientOriginalName();
            $path = $request->file("bukti")->storeAs("images/bukti", $filename);
        }

        $bukti = BuktiBayar::create([
            "idtransaksi" => $request->idtransaksi,
            "waktu_bayar" => date("Y-m-d h:i:s"),
            "bukti" => $filename
        ]);

        TransaksiSewa::where("id_transaksi_sewa", $request->transaksi)->update([
            "status" => "Proses Verifikasi Pembayaran"  
        ]);

        $bukti = BuktiBayar::where("idtransaksi", $request->idtransaksi)
                        ->where("status", "Gagal")
                        ->get();

        if(count($bukti) > 0)
        {   
            $transaksi = TransaksiSewa::where("id_transaksi_sewa", $request->idtransaksi)->first();

            $notifikasi = Notifikasi::where("idpenerima", $transaksi->iduser)->get();   

            if(count($notifikasi) > 0)
            {
                foreach($notifikasi as $n)
                {
                    $data = json_decode($n->notifikasi);

                    if($data->status === "Gagal" && $data->type === "Pembayaran")
                    {       
                        if($data->data->id_transaksi_sewa == $request->idtransaksi)
                        {   
                            Notifikasi::where("id_notifikasi", $n->id_notifikasi)->delete();
                        }
                    }
                }
            }
        }

        return response()->json(["status" => "200", "message" => "Berhasil Mengirimkan Bukti Pembayaran, Silahkan Menuggu Verifikasi Bukti Pembayaran"]);
    }

    public function editRumah($id, Request $request)
    {
        $hapus = json_decode($request->hapus);

        if(count($hapus) > 0)
        {   
            foreach($hapus as $h)
            {
                // $gambar = Gambar::where("idgambar", $h)->first();
                
                // unlink("storage/images/rumah/" . $gambar->gambar);

                Gambar::where("idgambar", $h)->delete();
            }
        }

        for($i = 0; $i <= $request->count; $i++) 
        {   
            $img = "image" . $i;

            if($request->hasFile($img))
            {
                $filename = time() . "_" . rand(0, 1000) . "." . $request->file($img)->getClientOriginalName();
                $path = $request->file($img)->move(public_path("images/rumah"), $filename);

                Gambar::create([
                    "gambar" => $filename,
                    "idrumah" => $id
                ]);
            }
        }

        Rumah::where("idrumah", $id)->update([
            "judul" => $request->judul,
            "alamat" => $request->alamat,
            "luas_bangunan" => $request->luas_bangunan,
            "luas_tanah" => $request->luas_tanah,
            "jumlah_kamar" => $request->jumlah_kamar,
            "jumlah_kamar_mandi" => $request->jumlah_kamar_mandi,
            "air_bersih" => $request->air_bersih,
            "kitchen_set" => $request->kitchen_set,
            "carport" => $request->carport,
            "harga" => $request->harga,
            "keterangan" => $request->keterangan,
            "daya_listrik" => $request->daya_listrik,
        ]);

        return response()->json(["status" => "200", "message" => "Berhasil mengedit rumah"]);
    }

    public function getUser()
    {
        $user = User::whereIn("roles", ["penyewa", "pemilik"])->get();

        return response()->json(["status" => "200", "data" => $user]);
    }

    public function getBukti()
    {   
        $bukti = BuktiBayar::with(["transaksi" => function($transaksi){
            $transaksi->with(["pembeli", "rumah" => function($rumah){
                $rumah->with("pemilik")->get();
            }])->get();
        }])->where("status", "Proses")->get();

        return response()->json(["status" => "200", "data" => $bukti]);
    }

    public function editBukti($id, Request $request)
    {
        BuktiBayar::where("id_bukti_bayar", $id)->update([
            "status" => $request->status
        ]);

        $bukti = BuktiBayar::where("id_bukti_bayar", $id)->first();

        if($request->status === "Berhasil")
        {   
            TransaksiSewa::where("id_transaksi_sewa", $bukti->idtransaksi)->update([
                "status" => "Pembayaran Berhasil"
            ]);
        }

        $transaksi = TransaksiSewa::with("rumah")->where("id_transaksi_sewa", $bukti->idtransaksi)->first();

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

        return response()->json(["status" => "200", "message" => "Berhasil verifikasi bukti pembayaran"]);
    }

    public function getTransaksi($id)
    {   
        //->orderByRaw(\DB::raw('FIELD(status, Proses Pembayaran, Proses Verifikasi Pembayaran, Pembayaran Berhasil, Selesai Sewa)'))
        
        $transaksi = TransaksiSewa::with(["bukti", "rumah" => function($rumah){
            $rumah->with("pemilik")->get();
        }])->where("iduser", $id)->get();

        return response()->json(["status" => "200", "data" => $transaksi]);
    }

    public function createPerbandingan(Request $request)
    {
        $kriteria = ["Air Bersih", "Kitchen Set", "Carport"];

        $rumah = Rumah::where("status", "Kosong");

        if(strlen($request->keyword) > 0)
        {
            $rumah = $rumah->where("judul", "LIKE %" . $request->keyword . " %")
                            ->orWhere("alamat", "LIKE %" . $request->keyword . " %");
        }

        if($request->daya_listrik_akhir > 0 || $request->daya_listrik_awal > 0)
        {   
            $rumah->whereBetween("daya_listrik", [$request->daya_listrik_awal, $request->daya_listrik_akhir]);
            array_push($kriteria, "Daya Listrik");
        }
        if($request->harga_akhir > 0 || $request->harga_awal > 0)
        {
            $rumah->whereBetween("harga", [$request->harga_awal, $request->harga_akhir]);
            array_push($kriteria, "Harga");
        }
        if($request->luas_tanah_akhir > 0 || $request->luas_tanah_awal > 0)
        {
            $rumah->whereBetween("luas_tanah", [$request->luas_tanah_awal, $request->luas_tanah_akhir]);
            array_push($kriteria, "Luas Tanah");
        }
        if($request->luas_bangunan_akhir > 0 || $request->luas_bangunan_awal > 0)
        {
            $rumah->whereBetween("luas_bangunan", [$request->luas_bangunan_awal, $request->luas_bangunan_akhir]);
            array_push($kriteria, "Luas Bangunan");
        }
        if($request->jumlah_kamar > 0)
        {
            $rumah->whereBetween("jumlah_kamar", [0, $request->jumlah_kamar]);
            array_push($kriteria, "Jumlah Kamar");
        }
        if($request->jumlah_kamar_mandi > 0)
        {
            $rumah->whereBetween("jumlah_kamar_mandi", [0, $request->jumlah_kamar_mandi]);
            array_push($kriteria, "Jumlah Kamar Mandi");
        }

        $rumah->where("air_bersih", ($request->air_bersih === true) ? "Ada" : "Tidak Ada");
        $rumah->where("kitchen_set", ($request->kitchen_set === true) ? "Ada" : "Tidak Ada");
        $rumah->where("carport", ($request->carport === true) ? "Ada" : "Tidak Ada");

        $rumah = $rumah->get();

        $perbandingan_kriteria = AHP::getPairWiseMatrixKriteria($kriteria);

        $perbandingan_rumah = AHP::getPairWiseMatrixRumah($rumah, $kriteria);

        return response()->json(["status" => "200", "data" => ["kriteria" => $perbandingan_kriteria, "rumah" => $perbandingan_rumah]]);
    }

    public function createAHP(Request $request)
    {
        /// KRITERIA

        $kriteria = $request->kriteria;

        $kriteria_list = AHP::getKriteria($kriteria);

        $matrix_kriteria = AHP::getMatrixKriteria($kriteria_list);

        $nilai_kriteria = AHP::getNilaiMatrixKriteria($matrix_kriteria, $kriteria);

        $total_kriteria = AHP::getTotalKriteria($kriteria_list, $nilai_kriteria);

        $nilai_dibagi_kriteria = AHP::getNilaiBagiKriteria($nilai_kriteria, $total_kriteria);

        $bobot_kriteria = AHP::getBobotKriteria($nilai_dibagi_kriteria, count($kriteria_list), $kriteria_list);

        /// RUMAH

        $rumah = $request->rumah;

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

        return response()->json(["status" => "200", "data" => $hasil]);
    }

    public function getNotifikasi($id)
    {
        $notifikasi = Notifikasi::where("idpenerima", $id)->get();

        $date = Date("Y-m-d");
        $time = Date("H:i:s");

        $reminder = Reminder::where("iduser", $id)
                ->whereDate("date", "<=" , now()->subDays(2)->setTime(0, 0, 0)->toDateTimeString())
                ->get();

        return response()->json(["status" => "200", "data" => ["notifikasi" => $notifikasi, "reminder" => $reminder]]);
    }
}
