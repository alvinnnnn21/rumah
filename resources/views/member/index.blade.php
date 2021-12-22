@extends("layouts.index")

@section("content")

    @push("style-member")
        <style>
            .btn-span:hover{
                cursor: pointer;
            }
            .img-card{
                display: flex;
                justify-content: center;
                align-items: center;
                overflow: hidden
            }
            .img-card, img{
                width: 100%;
                height: 100%;
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center;
            }
            .img-active{
                border: 2px solid black !important;
                
            }
            .img-other, img:hover{
                cursor: pointer;
            }

            label{
                font-size: 20px;
            }
        </style>
    @endpush

    

    <div class="container-fluid" style="background-color: rgba(0, 0, 0, 0.06); min-height: 90vh;">
        <div class="row d-flex justify-content-center pt-3 mb-3">
            <div class="col-md-10">
                <form action="{{ url("/") }}" method="get">
                    <div class="row mt-3 mb-3 d-flex justify-content-center">
                        <input type="text" placeholder="Cari Alamat..." name="alamat" class="form-control w-75 alamat">
                    </div>
                    <div class="row mt-3 mb-3 pt-5 px-4 pb-4" style="border: 2px solid #e2dfdf; background-color: #ffffff; border-radius: 15px;">
                        <div class="col-md-3">
                            <label>Provinsi</label>
                            <select class="form-control" name="provinsi">

                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Kota</label>
                            <select class="form-control" name="kota">

                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Jumlah Kamar</label>
                            <select name="jumlah_kamar" class="form-control">
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }} Kamar</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Jumlah Kamar Mandi</label>
                            <select name="jumlah_kamar_mandi" class="form-control">
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }} Kamar Mandi</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label id="label-harga">Harga (IDR)</label>
                            <div id="harga"></div>
                            <input type="hidden" name="harga">
                        </div>
                        <div class="col-md-6 mt-4">
                            <label id="label-luas-tanah">Luas Tanah m<sup>2</sup></label>
                            <div id="luas_tanah"></div>
                            <input type="hidden" name="luas_tanah">
                        </div>
                        <div class="col-md-6 mt-4">
                            <label id="label-luas-bangunan">Luas Bangunan m<sup>2</sup></label>
                            <div id="luas_bangunan"></div>
                            <input type="hidden" name="luas_bangunan">
                        </div>
                        <div class="col-md-6 mt-4">
                            <label id="label-daya-listrik">Daya Listrik (VA)</label>
                            <select class="form-control" name="daya_listrik">
                                <option value="">-</option>
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
                        <div class="d-flex flex-row w-100 align-items-center">
                            <div class="col-md-3 mt-4">
                                <label>Air Bersih</label>
                                <select name="air_bersih" class="form-control">
                                    <option value="PDAM">PDAM</option>
                                    <option value="Air Sumur">Air Sumur</option>
                                    <option value="Tidak Ada Air Bersih">Tidak Ada Air Bersih</option>
                                </select>
                            </div>
                            <div class="col-md-3 mt-4 d-flex flex-row">
                                <input type="checkbox" name="carport" style="width: 20px; height: 20px; margin-top: 3px; margin-right: 8px;" name="car_port">
                                <label>Car Port</label>
                            </div>
                            <div class="col-md-3 mt-4 d-flex flex-row">
                                <input type="checkbox" name="kitchen_set" style="width: 20px; height: 20px; margin-top: 3px; margin-right: 8px;" name="kitchen_set">
                                <label>Kitchen Set</label>
                            </div>
                            <div class="col-md-3 mt-5">
                                <button class="btn btn-primary float-right w-75">CARI</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 px-5 d-flex align-items-center flex-column" id="hasil">
                @foreach($rumah as $r)
                    <div class="row bg-light mb-3 w-75" style="border-radius: 10px; height: 50vh; border: 2px solid #e2dfdf;">
                        <div class="col-md-4 img-card p-0">
                            <img class="img-rumah-{{ $r->idrumah }}" src="{{ asset((count($r->gambar) > 0) ? "storage/images/rumah/" . $r->gambar[0]->gambar : "storage/images/rumah/no_image.png") }}">
                        </div>
                        <div class="col-md-8 pt-3 d-flex flex-column justify-content-between pb-3">
                            <h4 class="my-0" style="font-weight: 700;">Rp {{ number_format($r->harga, 2, ',', '.') }}</h4>
                            <h6 class="text-secondary my-0">
                                <i class="fas fa-map-marker-alt mr-2 text-danger"></i>
                                {{ $r->alamat }}
                            </h6>
                            <div class="d-flex flex-row" style="font-size: 20px;">
                                <span>
                                    <i class="fas fa-bed"></i>
                                    {{ $r->jumlah_kamar }}
                                    <p class="text-secondary">Kamar</p>
                                </span>
                                <span class="ml-5">
                                    <i class="fas fa-shower"></i>
                                    {{ $r->jumlah_kamar_mandi }}
                                    <p class="text-secondary">Kamar Mandi</p>
                                </span>
                                <span class="ml-5">
                                    <i class="fas fa-expand-arrows-alt"></i>
                                    {{ $r->luas_bangunan }} m<sup>2</sup>
                                    <p class="text-secondary">Bangunan</p>
                                </span>
                            </div>
                            {{-- <p class="mt-3">{{ $r->keterangan }}</p> --}}
                            <h6>Gambar Lain</h6>
                            <div class="d-flex flex-row mb-1 img-other" style="overflow: auto;">
                                @foreach($r->gambar as $key => $g)
                                    <img data-id="{{ $r->idrumah }}" class="mr-2 {{ ($key == 0) ? "img-active" : "" }} img-carousel" style="width: 100px; height: 100px; border: 2px solid rgba(0, 0, 0, 0.2); border-radius: 10px;" src="storage/images/rumah/{{ $g->gambar }}">
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @push("script-member")
        <script>    

            var harga = document.getElementById('harga');
            var luas_tanah = document.getElementById('luas_tanah');
            var luas_bangunan = document.getElementById('luas_bangunan');
            var daya_listrik = document.getElementById('daya_listrik');

            noUiSlider.create(harga, {
                start: [0, 0],
                connect: true,
                step: 1000,
                range: {
                    'min': [0],
                    'max': [300000000]
                },
                format: wNumb({
                    thousand: ".",
                })
            });

            noUiSlider.create(luas_tanah, {
                start: [0, 0],
                step: 10,
                connect: true,
                range: {
                    'min': 0,
                    'max': 1000
                },
                format: wNumb({
                    thousand: ".",
                })
            });

            noUiSlider.create(luas_bangunan, {
                start: [0, 0],
                step: 10,
                connect: true,
                range: {
                    'min': 0,
                    'max': 1000
                },
                format: wNumb({
                    thousand: ".",
                })
            });

            harga.noUiSlider.on("update", function(values, handle){
                $("#label-harga").html("Harga " + values[0] + " (IDR) - " + values[1] + " (IDR)");
                $("input[name=harga]").val(values[0] + "-" + values[1]);
            });

            luas_tanah.noUiSlider.on("update", function(values, handle){
                $("#label-luas-tanah").html("Luas Tanah " + values[0] + "m<sup>2</sup> - " + values[1] + "m<sup>2</sup>");
                $("input[name=luas_tanah]").val(values[0] + "-" + values[1]);
            });

            luas_bangunan.noUiSlider.on("update", function(values, handle){
                $("#label-luas-bangunan").html("Luas Tanah " + values[0] + "m<sup>2</sup> - " + values[1] + "m<sup>2</sup>");
                $("input[name=luas_bangunan]").val(values[0] + "-" + values[1]);
            });

            $(".alamat").on("input", function(){    

                $.ajax({
                    url: "{{ url('/search') }}",
                    method: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "_method": "post",
                        "keyword": $(this).val()
                    },
                    success: function(data){
                        var hasil = JSON.parse(JSON.stringify(data));
                        $("#hasil").html(hasil.data.replace(/\\/g, ""));
                    }
                })
            });

            $(document).on("click", "img.img-carousel", function(){

                $(this).parent().find(".img-active").removeClass("img-active");
                $(this).addClass("img-active");

                $(".img-rumah-" + $(this).attr("data-id")).attr("src", $(this).attr("src"));
            });

            $.ajax({
                url: "http://www.emsifa.com/api-wilayah-indonesia/api/provinces.json",
                method: "get",
                success: function(data1){

                    var html = "";

                    html += "<option value=''>-</option>";

                    for(var i = 0; i < data1.length; i++)
                    {   
                        html += "<option value='" + data1[i].id + "'>" + data1[i].name + "</option>";
                    }

                    $("select[name='provinsi']").html(html);

                    $.ajax({
                        url: "http://www.emsifa.com/api-wilayah-indonesia/api/regencies/" + data1[0].id + ".json",
                        method: "get",
                        success: function(data2){
                            html = "";

                            html += "<option value=''>-</option>";

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
                $.ajax({
                        url: "http://www.emsifa.com/api-wilayah-indonesia/api/regencies/" + $(this).val() + ".json",
                        method: "get",
                        success: function(data2){
                            html = "";

                            html += "<option value=''>-</option>";

                            for(var i = 0; i < data2.length; i++)
                            {
                                html += "<option value='" + data2[i].name + "'>" + data2[i].name + "</option>";
                            }

                            $("select[name='kota']").html(html);
                        }
                    })
            });

            function formatRupiah(angka, prefix){
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split   		= number_string.split(','),
                sisa     		= split[0].length % 3,
                rupiah     		= split[0].substr(0, sisa),
                ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
    
                if(ribuan){
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
    
                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }

           
        </script>
    @endpush

@endsection