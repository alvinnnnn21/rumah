<?php

namespace App\Helper;

use App\Models\Rumah;

class AHP
{           
    /// CHECK NILAI (KRITERIA DASHBOARD)

    public static function cariNilaiKriteria($nilai, $kriteria1, $kriteria2)
    {        
        foreach($nilai as $n)
        {
            if($n->kriteria_1 == $kriteria1 && $n->kriteria_2 == $kriteria2)
            {
                return $n->nilai;
            }
        }

        return null;
    }

    public static function cariNilaiRumah($nilai, $rumah1, $rumah2, $kriteria)
    {           
        foreach($nilai as $n)
        {
            if($n->rumah_1 == $rumah1 && $n->rumah_2 == $rumah2 && $n->kriteria == $kriteria)
            {                
                return $n->nilai;
            }
        }

        return null;
    }

    /// MATRIX

    public static function getPairWiseMatrixKriteria($kriteria)
    {
        $done = [];
        $perbandingan_kriteria = [];

        foreach($kriteria as $key1 => $s1)
        {   
            foreach($kriteria as $key2 => $s2)
            {   
                if($s1 !== $s2 && $key1 < $key2)
                {
                    array_push($perbandingan_kriteria, ["k1" => $s1, "k2" => $s2, "key1" => $key1, "key2" => $key2]);
                }
                // if(!in_array($s2, $done))
                // {   
                    
                // } 
            }

            array_push($done, $s1);
        }

        return $perbandingan_kriteria;
    }

    public static function getPairWiseMatrixRumah($rumah, $kriteria)
    {
        $done = [];
        $perbandingan_rumah = [];

        foreach($kriteria as $key => $k)
        {       
            $perbandingan_rumah[$key] = [];
            $perbandingan_rumah[$key]["kriteria"] = $k;
            $perbandingan_rumah[$key]["matrix"] = [];

            $done = [];

            foreach($rumah as $s1)
            {   
                foreach($rumah as $s2)
                {   
                    if(!in_array($s2->idrumah, $done))
                    {   
                        if($s1->idrumah !== $s2->idrumah)
                        {
                            array_push($perbandingan_rumah[$key]["matrix"], ["k1" => $s1->idrumah, "k2" => $s2->idrumah]);
                        }
                    } 
                }

                array_push($done, $s1->idrumah);
            }
        }

        return $perbandingan_rumah;
    }

    /// FORMAT

    public static function getKriteriaFormat($nilai)
    {   
        $kriteria_new = [];

        foreach($nilai as $key => $n)
        {   
            array_push($kriteria_new, ["k1" => $n["kriteria_1"], "k2" => $n["kriteria_2"], "nilai" => $n["nilai"]]);
        }

        return $kriteria_new;
    }

    public static function getRumahFormat($kriteria, $rumah)
    {
        $rumah_new = [];

        foreach($kriteria as $key => $k)
        {
            $rumah_new[$key]["kriteria"] = $k;
            $rumah_new[$key]["matrix"] = [];

            foreach($rumah as $key1 => $r1)
            {
                foreach($rumah as $key2 => $r2)
                {
                    $nilai = "";
 
                    if($r1->idrumah == $r2->idrumah)
                    {   
                        $nilai = 1;
                    }
                    else if($r1->idrumah != $r2->idrumah)
                    {
                        $rumah1 = Rumah::where("idrumah", $r1->idrumah)->first();
                        $rumah2 = Rumah::where("idrumah", $r2->idrumah)->first();
        
                        if($k == "Carport")
                        {   
                            $nilai1 = ($rumah1->carport != "Tidak Ada") ? 3 : 5;
                            $nilai2 = ($rumah1->carport != "Tidak Ada") ? 3 : 5;

                            $nilai = $nilai1 / $nilai2;
                        }
                        else if($k == "Kitchen Set")
                        {
                            $nilai1 = ($rumah1->kitchen_set != "Tidak Ada") ? 3 : 5;
                            $nilai2 = ($rumah1->kitchen_set != "Tidak Ada") ? 3 : 5;

                            $nilai = $nilai1 / $nilai2;
                        }
                        else if($k == "Air Bersih")
                        {   
                            $nilai1 = 0;
                            $nilai2 = 0;

                            if($rumah1->air_bersih == "PDAM") $nilai1 = 7; 
                            else if($rumah1->air_bersih == "Air Sumur") $nilai1 = 5;
                            else if($rumah1->air_bersih == "Tidak Ada Air Bersih") $nilai1 = 3;
                            
                            if($rumah2->air_bersih == "PDAM") $nilai2 = 7; 
                            else if($rumah2->air_bersih == "Air Sumur") $nilai2 = 5;
                            else if($rumah2->air_bersih == "Tidak Ada Air Bersih") $nilai2 = 3;

                            $nilai = $nilai1 / $nilai2;
                        }
                        else if($k == "Harga") $nilai = $rumah2->harga / $rumah1->harga;
                        else if($k == "Jumlah Kamar") $nilai = $rumah1->jumlah_kamar / $rumah2->jumlah_kamar;
                        else if($k == "Jumlah Kamar Mandi") $nilai = $rumah1->jumlah_kamar_mandi / $rumah2->jumlah_kamar_mandi;
                        else if($k == "Luas Tanah") $nilai = $rumah1->luas_tanah / $rumah2->luas_tanah;
                        else if($k == "Luas Bangunan") $nilai = $rumah1->luas_bangunan / $rumah2->luas_bangunan;
                        else if($k == "Daya Listrik") $nilai = $rumah1->daya_listrik / $rumah2->daya_listrik;

                    }

                    array_push($rumah_new[$key]["matrix"], ["k1" => $r1->idrumah, "k2" => $r2->idrumah, "nilai" => $nilai]);
                }
            }
        }   

        return $rumah_new;
    }


    /// KRITERIA

    public static function getKriteria($kriteria)
    {
        $kriteria_list = [];

        foreach($kriteria as $k)
        {
            array_push($kriteria_list, $k["k1"]);
            array_push($kriteria_list, $k["k2"]);
        }
        
        $kriteria_list = array_unique($kriteria_list);
        $kriteria_list = array_values($kriteria_list);

        return $kriteria_list;
    }

    public static function getMatrixKriteria($kriteria)
    {
        $matrix = [];

        foreach($kriteria as $k1)
        {
            foreach($kriteria as $k2)
            {
                array_push($matrix, ["k1" => $k1, "k2" => $k2, "nilai" => 0]);
            }
        }
        
        return $matrix;
    }

    public static function getNilaiKriteria($nilai, $k1, $k2)
    {
        foreach($nilai as $n)
        {   
            if($n["k1"] === $k1 && $n["k2"] === $k2)
            {
                return $n["nilai"];
            }
        }

        return null;
    }

    public static function getNilaiMatrixKriteria($kriteria, $nilai)
    {
        foreach($kriteria as $key => $k)
        {
            if($k["k1"] === $k["k2"])
            {
                $kriteria[$key]["nilai"] = 1;
            }
            else
            {   
                if(AHP::getNilaiKriteria($nilai, $k["k1"], $k["k2"]))
                {
                    $kriteria[$key]["nilai"] = AHP::getNilaiKriteria($nilai, $k["k1"], $k["k2"]);
                }
                else if(!AHP::getNilaiKriteria($nilai, $k["k1"], $k["k2"]))
                {   
                    $kriteria[$key]["nilai"] = 1 / AHP::getNilaiKriteria($nilai, $k["k2"], $k["k1"]);
                }
            }
        }

        return $kriteria;
    }

    public static function getTotalKriteria($kriteria, $nilai)
    {
        $total = [];

        foreach($kriteria as $key => $k)
        {   
            $temp = 0;

            foreach($nilai as $n)
            {
                if($n["k2"] === $k)
                {   
                    $temp += $n["nilai"];
                }
            }

            $total[$key] = ["kriteria" => $k, "total" => $temp];
        }

        return $total;
    }

    public static function getPembagiKriteria($total, $kriteria)
    {
        foreach($total as $t)
        {
            if($t["kriteria"] === $kriteria)
            {
                return $t["total"];
            }
        }
    }

    public static function getNilaiBagiKriteria($nilai, $total)
    {
        foreach($nilai as $key => $n)
        {
            $nilai[$key]["nilai"] = $n["nilai"] / AHP::getPembagiKriteria($total, $n["k2"]);
        }

        return $nilai;
    }

    public static function getNilaiBobotKriteria($nilai, $kriteria)
    {
        $bobot = 0;

        foreach($nilai as $n)
        {
            if($n["k1"] === $kriteria)
            {
                $bobot += $n["nilai"];
            }
        }

        return $bobot;
    }

    public static function getBobotKriteria($nilai, $count, $kriteria)
    {
        $bobot = [];
        
        foreach($kriteria as $k)
        {
            array_push($bobot, ["kriteria" => $k, "nilai" => (AHP::getNilaiBobotKriteria($nilai, $k)) / $count]);
        }

        return $bobot;
    }


    /// RUMAH

    public static function getRumah($rumah)
    {
        $rumah_list = [];

        foreach($rumah as $r)
        {
            array_push($rumah_list, $r["k1"]);
            array_push($rumah_list, $r["k2"]);
        }
        
        $rumah_list = array_unique($rumah_list);
        $rumah_list = array_values($rumah_list);

        return $rumah_list;
    }

    public static function getMatrixRumah($rumah, $kriteria)
    {
        $matrix = [];

        foreach($kriteria as $key => $k)
        {
            $matrix[$key]["kriteria"] = $k;
            $matrix[$key]["matrix"] = [];

            foreach($rumah as $r1)
            {
                foreach($rumah as $r2)
                {
                    array_push($matrix[$key]["matrix"], ["k1" => $r1, "k2" => $r2, "nilai" => 0]);
                }
            }
        }
        
        return $matrix;
    }

    public static function getNilaiRumah($nilai, $k1, $k2)
    {
        foreach($nilai as $n)
        {   
            if($n["k1"] === $k1 && $n["k2"] === $k2)
            {
                return $n["nilai"];
            }
        }

        return null;
    }

    public static function getNilaiMatrixRumah($rumah, $nilai)
    {
        foreach($rumah as $key => $rmh)
        { 
            foreach($rmh["matrix"] as $key1 => $r)
            {
                if($r["k1"] === $r["k2"])
                {
                    $rumah[$key]["matrix"][$key1]["nilai"] = 1;
                }
                else
                {
                    if(AHP::getNilaiRumah($nilai[$key]["matrix"], $r["k1"], $r["k2"]))
                    {
                        $rumah[$key]["matrix"][$key1]["nilai"] = AHP::getNilaiRumah($nilai[$key]["matrix"], $r["k1"], $r["k2"]);
                    }
                    else if(!AHP::getNilaiRumah($nilai[$key]["matrix"], $r["k1"], $r["k2"]))
                    {
                        $rumah[$key]["matrix"][$key1]["nilai"] = 1 / AHP::getNilaiRumah($nilai[$key]["matrix"], $r["k2"], $r["k1"]);
                    }
                }
            }
        }

        return $rumah;
    }

    public static function getTotalRumah($rumah, $nilai)
    {
        $total = [];

        foreach($nilai as $key => $n1)
        {   
            $total[$key]["kriteria"] = $n1["kriteria"];
            $total[$key]["nilai"] = [];

            foreach($rumah as $key1 => $r)
            {           
                $temp = 0;

                foreach($n1["matrix"] as $n2)
                {
                    if($n2["k1"] === $r)
                    {   
                        $temp += $n2["nilai"];
                    }
                    
                }

                $total[$key]["nilai"][$key1] = ["rumah" => $r, "total" => $temp];
            }

        }

        return $total;
    }

    public static function getPembagiRumah($total, $rumah, $kriteria)
    {
        foreach($total as $t1)
        {       
            if($t1["kriteria"] === $kriteria)
            {   
                foreach($t1["nilai"] as $t2)
                {
                    if($t2["rumah"] === $rumah)
                    {   
                        return $t2["total"];
                    }
                }
            }
        }
    }

    public static function getNilaiBagiRumah($nilai, $total)
    {   
        $test = "";

        foreach($nilai as $key => $n1)
        {
            foreach($n1["matrix"] as $key1 => $n2)
            {   
                $nilai[$key]["matrix"][$key1]["nilai"] = $n2["nilai"] / AHP::getPembagiRumah($total, $n2["k1"], $n1["kriteria"]);
            }
        }

        return $nilai;
    }

    public static function getNilaiBobotRumah($nilai, $rumah, $kriteria)
    {
        $bobot = 0;

        foreach($nilai as $n1)
        {
            if($n1["kriteria"] === $kriteria)
            {
                foreach($n1["matrix"] as $n2)
                {
                    if($n2["k2"] === $rumah)
                    {
                        $bobot += $n2["nilai"];
                    }
                }
            }
        }

        return $bobot;
    }

    public static function getBobotRumah($nilai, $count, $rumah, $kriteria)
    {
        foreach($kriteria as $key => $k)
        {   
            $bobot[$key]["kriteria"] = $k;
            $bobot[$key]["bobot"] = [];

            foreach($rumah as $r)
            {
                array_push($bobot[$key]["bobot"], ["rumah" => $r, "nilai" => (AHP::getNilaiBobotRumah($nilai, $r, $k)) / $count]);
            }
        }

        return $bobot;
    }


    /// FINAL

    public static function getNilaiBobotKriteriaFinal($kriteria, $nilai_kriteria)
    {
        foreach($nilai_kriteria as $k)
        {
            if($k["kriteria"] === $kriteria)
            {
                return $k["nilai"];
            }
        }
    }

    public static function getNilaiBobotRumahFinal($rumah, $kriteria, $nilai_rumah)
    {
        foreach($nilai_rumah as $n1)
        {
            if($n1["kriteria"] === $kriteria)
            {
                foreach($n1["bobot"] as $n2)
                {
                    if($n2["rumah"] === $rumah)
                    {
                        return $n2["nilai"];
                    }
                }
            }
        }
    }

    public static function getFinal($rumah, $kriteria, $nilai_rumah, $nilai_kriteria)
    {       
        $nilai = [];
        $test = "";

        foreach($rumah as $key => $r)
        {   
            $nilai[$key]["rumah"] = $r;
            $nilai[$key]["nilai"] = 0;

            foreach($kriteria as $k)
            {       
                $test .= (AHP::getNilaiBobotKriteriaFinal($k, $nilai_kriteria) . "*" . AHP::getNilaiBobotRumahFinal($r, $k, $nilai_rumah) . " = " . (AHP::getNilaiBobotKriteriaFinal($k, $nilai_kriteria) * AHP::getNilaiBobotRumahFinal($r, $k, $nilai_rumah)) . "\n");
                $nilai[$key]["nilai"] += (AHP::getNilaiBobotKriteriaFinal($k, $nilai_kriteria) * AHP::getNilaiBobotRumahFinal($r, $k, $nilai_rumah));
            }
        }

        return $nilai;
    }

    public static function ujiKonsistensi()
    {
        
    }
}