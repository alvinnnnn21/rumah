@extends('layouts.index')

@section('content')
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <h2 class="text-secondary">Tambah Rumah</h2>
            </div>
        </div>
        @if(isset($errors))
            @if(count($errors) > 0)
                <div class="row text-center mt-2">
                    <div class="col-md-12">
                        <ul style="list-style: none;">
                            @foreach ($errors->all() as $error)
                                <li class="mt-2">
                                    <span class="text-danger badge badge-danger text-light py-2 px-4">{{ $error }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        @endif
        <form method="post" action="{{ url("/rumah") }}" enctype="multipart/form-data">
            @csrf
            <div class="row mt-4 mb-4">
                <div class="col-md-12 mt-3 d-flex align-items-center flex-column">
                    <label>Alamat</label>
                    <input type="text" name="alamat" class="form-control w-25" required>
                </div>
                <div class="col-md-12 mt-3 d-flex align-items-center flex-column">
                    <label>Provinsi</label>
                    <select class="form-control w-25" name="provinsi">

                    </select>
                </div>
                <div class="col-md-12 mt-3 d-flex align-items-center flex-column">
                    <label>Kota</label>
                    <select class="form-control w-25" name="kota">

                    </select>
                </div>
                <div class="col-md-12 mt-3 d-flex align-items-center flex-column">
                    <label>Keterangan</label>
                    <textarea class="form-control w-25" name="keterangan" required></textarea>
                </div>
                <div class="col-md-12 mt-3 d-flex align-items-center flex-column" required>
                    <label>Harga</label>
                    <input type="number" name="harga" class="form-control w-25">
                </div>
                <div class="col-md-12 mt-3 d-flex align-items-center flex-column">
                    <label>Jumlah Kamar</label>
                    <input type="number" name="jumlah_kamar" class="form-control w-25" required>
                </div>
                <div class="col-md-12 mt-3 d-flex align-items-center flex-column">
                    <label>Jumlah Kamar Mandi</label>
                    <input type="number" name="jumlah_kamar_mandi" class="form-control w-25" required>
                </div>
                <div class="col-md-12 mt-3 d-flex align-items-center flex-column">
                    <label>Luas Bangunan m<sup>2</sup></label>
                    <input type="number" name="luas_bangunan" class="form-control w-25" required>
                </div>
                <div class="col-md-12 mt-3 d-flex align-items-center flex-column">
                    <label>Luas Tanah m<sup>2</sup></label>
                    <input type="number" name="luas_tanah" class="form-control w-25" required>
                </div>
                <div class="col-md-12 mt-3 d-flex align-items-center flex-column">
                    <label>Daya Listrik</label>
                    <select class="form-control w-25" name="daya_listrik">
                        <option value="450">450 VA</option>
                        <option value="900">900 VA</option>
                        <option value="1300">1300 VA</option>
                        <option value="2200">2200 VA</option>
                        <option value="3500">3500 VA</option>
                        <option value="4400">4400 VA</option>
                        <option value="5500">5500 VA</option>
                        <option value="6600">6600 VA</option>
                        <option value="4400">7700 VA</option>
                        <option value="10600">10600 VA</option>
                    </select>
                </div>
                <div class="col-md-12 mt-3 d-flex align-items-center flex-column">
                    <label>Air Bersih</label>
                    <select class="form-control w-25" name="air_bersih">
                        <option value="Tidak Ada Air Bersih">Tidak Ada Air Bersih</option>
                        <option value="PDAM">PDAM</option>
                        <option value="Air Sumur">Air Sumur</option>
                    </select>
                </div>
                <div class="col-md-12 mt-3 d-flex align-items-center flex-column">
                    <label>Carport</label>
                    <select class="form-control w-25" name="carport">
                        <option value="Tidak Ada">Tidak Ada</option>
                        <option value="Ada">Ada</option>
                    </select>
                </div>
                <div class="col-md-12 mt-3 d-flex align-items-center flex-column">
                    <label>Kitchen Set</label>
                    <select class="form-control w-25" name="kitchen_set">
                        <option value="Tidak Ada">Tidak Ada</option>
                        <option value="Ada">Ada</option>
                    </select>
                </div>
                <div class="col-md-12 mt-4 d-flex align-items-center flex-column">
                    <label>Gambar Rumah</label>
                    <input type="file" name="gambar[]" accept="image/*" multiple required>
                </div>
                <div class="col-md-12 mt-5 d-flex align-items-center flex-column">
                    <button type="submit" class="btn btn-secondary w-25">Simpan</button>
                </div>
            </div>
        </form>
    </div>

    @push("script-member")
        <script>
            $.ajax({
                url: "http://www.emsifa.com/api-wilayah-indonesia/api/provinces.json",
                method: "get",
                success: function(data1){

                    var html = "";

                    for(var i = 0; i < data1.length; i++)
                    {   
                        html += "<option value='" + data1[i].id + "-" + data1[i].name + "'>" + data1[i].name + "</option>";
                    }

                    $("select[name='provinsi']").html(html);

                    $.ajax({
                        url: "http://www.emsifa.com/api-wilayah-indonesia/api/regencies/" + data1[0].id + ".json",
                        method: "get",
                        success: function(data2){
                            html = "";

                            for(var i = 0; i < data2.length; i++)
                            {
                                html += "<option value='" + data2[i].name + "'>" + data2[i].name + "</option>";
                            }

                            $("select[name='kota']").html(html);
                        }
                    })
                }
            })

            $("select[name='provinsi']").on("change", function(){

                var id = $(this).val().split("-");

                console.log(id);

                $.ajax({
                        url: "http://www.emsifa.com/api-wilayah-indonesia/api/regencies/" + id[0] + ".json",
                        method: "get",
                        success: function(data2){
                            html = "";

                            for(var i = 0; i < data2.length; i++)
                            {
                                html += "<option value='" + data2[i].name + "'>" + data2[i].name + "</option>";
                            }

                            $("select[name='kota']").html(html);
                        }
                    })
            });
        </script>
    @endpush    
@endsection