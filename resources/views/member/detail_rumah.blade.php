@extends('layouts.index')

@section('content')

    @push("style-member")   
        <style>
            img{
                width: 100%;
                height: 100%;
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center;
            }
            #main {
                margin: 50px 0;
            }

            #main #detail .card {
                margin-bottom: 30px;
                border: 0;
            }

            #main #detail .card .card-header {
                border: 0;
                -webkit-box-shadow: 0 0 20px 0 rgba(213, 213, 213, 0.5);
                box-shadow: 0 0 20px 0 rgba(213, 213, 213, 0.5);
                border-radius: 2px;
                padding: 0;
            }

            #main #detail .card .card-header .btn-header-link {
                color: #fff;
                display: block;
                text-align: left;
                background: #AFAFAF;
                color: #222;
                padding: 20px;
            }

            #main #detail .card .card-header .btn-header-link:after {
                content: "\f107";
                font-family: 'Font Awesome 5 Free';
                font-weight: 900;
                float: right;
            }

            #main #detail .card .card-header .btn-header-link.collapsed {
                background: #AFAFAF;
                color: #fff;
            }

            #main #detail .card .card-header .btn-header-link.collapsed:after {
                content: "\f106";
            }

            #main #detail .card .collapsing {
                background: #FFFFFF;
                line-height: 30px;
            }

            #main #detail .card .collapse {
                border: 0;
            }

            #main #detail .card .collapse.show {
                background: #FFFFFF;
                line-height: 30px;
                color: #222;
            }

            .label{
                font-size: 20px;
            }
        </style>
    @endpush

    <div class="container-fluid" style="background-color: rgba(0, 0, 0, 0.06); min-height: 90vh;">
        @if(Auth::guard("member")->check())
            @if($owner)
                <form method="post" id="form-edit" action="{{ url('/rumah') . "/" . $rumah->idrumah }}" enctype="multipart/form-data">
                @csrf
                @method("put")
                <input type="hidden" name="hapus" id="hapus-gambar">
            @endif  
        @endif
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="owl-carousel owl-theme d-flex flex-column align-items-center">
                    @foreach($rumah->gambar as $key => $g)
                        <div class="item text-center">
                            <img style="border: 2px solid rgb(199, 196, 196); width: 30vw; height: 50vh;"  class="img-fluid" src="{{ asset("images/rumah/" . $g->gambar) }}">
                            @if(Auth::guard("member")->check())
                                @if($owner)
                                    <button type="button" class="btn btn-danger mt-2 btn-hapus" data-index={{$key}} data-id={{$g->idgambar}}>Hapus</i>
                                @endif  
                            @endif
                        </div>
                    @endforeach
                    <div class="owl-dots">
                    </div>
                </div>  
                @if(Auth::guard("member")->check())
                    @if(Auth::guard("member")->user()->roles === "penyewa")
                        <div class="d-flex justify-content-end">
                            <div class="btn-group">
                                <a href="{{ ($chat) ? url('/chat') . "/" . $chat->idchat . "/" . $chat->idpemilik : url('/chat/0') . "/" . $rumah->id_pemilik }}" class="btn px-3">
                                    <i class="fas fa-comment-alt"></i>
                                </a>
                                <a href="javascript:void(0)" class="btn px-3" id="favorite">
                                    <i class="fas fa-heart {{ (count($rumah->favorite) > 0) ? "text-danger" : "" }}"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                @endif
                <hr>
                <div class="d-flex justify-content-center">
                    <div class="d-flex justify-content-around pt-2 w-75">
                        @if($owner)
                            <span>
                                <i class="fas fa-bed"></i>
                                <input type="number" name="jumlah_kamar" class="form-contorl w-50"  value="{{ $rumah->jumlah_kamar }}" required>
                                <p class="text-secondary">Kamar</p>
                            </span>
                            <span class="ml-5">
                                <i class="fas fa-shower"></i>
                                <input type="number" name="jumlah_kamar_mandi" class="form-contorl w-50"  value="{{ $rumah->jumlah_kamar_mandi }}" required>
                                <p class="text-secondary">Kamar Mandi</p>
                            </span>
                            <span class="ml-5">
                                <i class="fas fa-home"></i>
                                <input type="number" name="luas_bangunan" class="form-contorl w-50"  value="{{ $rumah->luas_bangunan }}" required>
                                <p class="text-secondary">Bangunan</p>
                            </span>
                            <span class="ml-5">
                                <i class="fas fa-expand-arrows-alt"></i>
                                <input type="number" name="luas_tanah" class="form-contorl w-50"  value="{{ $rumah->luas_tanah }}" required>
                                <p class="text-secondary">Tanah</p>
                            </span>
                        @else
                            <span>
                                <i class="fas fa-bed"></i>
                                {{ $rumah->jumlah_kamar }}
                                <p class="text-secondary">Kamar</p>
                            </span>
                            <span class="ml-5">
                                <i class="fas fa-shower"></i>
                                {{ $rumah->jumlah_kamar_mandi }}
                                <p class="text-secondary">Kamar Mandi</p>
                            </span>
                            <span class="ml-5">
                                <i class="fas fa-home"></i>
                                {{ $rumah->luas_bangunan }} m<sup>2</sup>
                                <p class="text-secondary">Bangunan</p>
                            </span>
                            <span class="ml-5">
                                <i class="fas fa-expand-arrows-alt"></i>
                                {{ $rumah->luas_tanah }} m<sup>2</sup>
                                <p class="text-secondary">Tanah</p>
                            </span>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-center">
                    <div class="w-50">
                        <h4 class="mb-5 mt-2">Informasi Detail Rumah</h4>
                        @if($owner)
                            <label>Status</label>
                            <input type="text" name="alamat" class="form-control" value="{{ $rumah->alamat }}" required> 
                            <hr>
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="{{ $rumah->alamat }}" required> 
                            <hr>
                            <label>Harga</label>
                            <input type="number" name="harga" class="form-control" value="{{ $rumah->harga }}" required> 
                            <hr>
                            <label>Keterangan</label>
                            <textarea name="keterangan" class="form-control" required>{{ $rumah->keterangan }}</textarea>
                            <hr>
                            <label>Air Bersih</label>
                            <select class="form-control w-25" name="air_bersih">
                                <option {{($rumah->air_bersih == "Tidak Ada") ? "selected" : ""}} value="Tidak Ada">Tidak Ada</option>
                                <option {{($rumah->air_bersih == "Ada") ? "selected" : ""}} value="Ada">Ada</option>
                            </select>
                            <hr>
                            <label>Carport</label>
                            <select class="form-control w-25" name="car_port">
                                <option {{($rumah->carport == "Tidak Ada") ? "selected" : ""}} value="Tidak Ada">Tidak Ada</option>
                                <option {{($rumah->carport == "Ada") ? "selected" : ""}} value="Ada">Ada</option>
                            </select>
                            <hr>
                            <label>Kitchen Set</label>
                            <select class="form-control w-25" name="kitchen_set">
                                <option {{($rumah->kitchen_set == "Tidak Ada") ? "selected" : ""}} value="Tidak Ada">Tidak Ada</option>
                                <option {{($rumah->kitchen_set == "Ada") ? "selected" : ""}} value="Ada">Ada</option>
                            </select>
                            <hr>
                            <label>Daya Listrik</label>
                            <input type="number" name="daya_listrik" class="form-control" value="{{ $rumah->daya_listrik }}" required> 
                            <hr>
                            <label>Gambar</label>
                            <br>
                            <input type="file" name="gambar[]" accept="image/*" multiple>
                            <hr>
                        @else
                            <label class="text-secondary label">Alamat</label>
                            <p class="h6">
                                {{ $rumah->alamat }}
                            </p>
                            <hr>
                            <label class="text-secondary label">Harga</label>
                            <p class="h6">
                                Rp {{ number_format($rumah->harga, 2, ',', '.') }} / tahun
                            </p>
                            <hr>
                            <label class="text-secondary label">Keterangan</label>
                            <p class="h6">
                                {{ $rumah->keterangan }}
                            </p>
                            <hr>
                            <label class="text-secondary label">Fasilitas</label>
                            <p class="h6">
                                {{ implode(" | ", $fasilitas) }}
                            </p>
                            <hr>
                            <label class="text-secondary label">Daya Listrik</label>
                            <p class="h6">
                                {{ $rumah->daya_listrik }}
                            </p>
                            <hr>
                        @endif  
                    </div>
                </div>
            </div>
           
        </div>
        @if(Auth::guard("member")->check())
            <div class="row">
                <div class="col-md-12 text-center mb-3">
                    @if($owner)
                        <button type="button" class="btn btn-secondary btn-edit w-25">Edit</button>
                    @elseif(Auth::guard("member")->user()->roles == "penyewa")
                        <button type="button" data-toggle="modal" data-target="#modal-sewa" class="btn btn-secondary w-25">Sewa Rumah</button>
                    @endif
                </div>
            </div>
        @endif
        @if(Auth::guard("member")->check())
            @if($owner)
                </form>
            @endif
        @endif
    </div>

    <div class="modal fade" id="modal-sewa" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="post" action="{{ url("/sewa") }}" id="form-sewa">
                @csrf
                <input type="hidden" value="{{ $rumah->idrumah }}" name="rumah">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h4>FORM SEWA RUMAH</h4>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <label>Lama Sewa (Tahun)</label>
                                    <input type="number" min="1" id="rent-duration" name="lama" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Harga Sewa</label>
                                    <input type="text" value="Rp {{ number_format($rumah->harga, 2, ',', '.') }} / tahun" class="form-control" readyonly disabled>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label>Mulai Sewa (Tahun)</label>
                                    <input type="date" id="rent-start" name="mulai" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Akhir Sewa (Tahun)</label>
                                    <input type="date" id="rent-end" name="akhir" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="row mt-3 d-none detail">
                                <div class="col-md-6">
                                    <label>DP (Rupiah)</label>
                                    <input type="number" id="dp" name="dp" class="form-control">
                                </div>
                            </div>
                            <div class="row mt-5 d-none detail">
                                <div class="col-md-12">
                                    <h6>DETAIL SEWA</h6>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th>No Rekening</th>
                                                <th>:</th>
                                                <th id="no-rekening">{{ $rumah->pemilik->no_rekening ? $rumah->pemilik->no_rekening : "-" }}</th>
                                            </tr>
                                            <tr>
                                                <th>Lama Sewa</th>
                                                <th>:</th>
                                                <th id="lama-sewa"></th>
                                            </tr>
                                            <tr>
                                                <th>Waktu Sewa</th>
                                                <th>:</th>
                                                <th id="waktu-sewa"></th>
                                            </tr>
                                            <tr>
                                                <th>Harga Total</th>
                                                <th>:</th>
                                                <th id="total-harga"></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="button" id="btn-sewa" class="btn btn-primary">Kirim</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push("script-member")

        <script>    

            var favorite = {!! json_encode(count($rumah->favorite)) !!}
            var rumah = {!! json_encode($rumah) !!}
            var hapus = [];
            var gambar = JSON.parse(JSON.stringify({!! json_encode($rumah->gambar) !!}));
            var total = 0;

            var items = gambar.length;
            var loop = false;

            if(gambar.length >= 3)
            {
                items = 3;
                loop = true;
            }
            
            $(".owl-carousel").owlCarousel({    
                items: items,
                dots: true,
                loop: loop,
                autoWidth: true,
                margin: 5
            });

            $(".btn-edit").click(function(){
                $("#hapus-gambar").val(hapus);

                $("#form-edit").submit();
            });

            $("#favorite").click(function(){

                var link = (favorite === 0) ? ("") : ("/" + rumah.idrumah);

                $.ajax({
                    url: ("{{ url('/favorite') }}" + link),
                    method: (favorite == 0) ? "post" : "delete",
                    data:{
                        rumah: rumah.idrumah,
                        _token: "{{csrf_token()}}",
                        _method: (favorite == 0) ? "post" : "delete"
                    },
                    success: function(data){        
                        
                        if(data.status == "200")
                        {           
                            if(favorite === 0)
                            {       
                                $(".fa-heart").addClass("text-danger");
                            }
                            else if(favorite === 1)
                            {
                                $(".fa-heart").removeClass("text-danger");
                            }

                            favorite = (favorite == 0) ? 1 : 0;
                        }
                    } 
                })
            });

            $(document).on("click", "button.btn", function(){
                $(".owl-carousel").trigger("remove.owl.carousel", [$(this).attr("data-index")]).trigger("refresh.owl.carousel");

                hapus.push($(this).attr("data-id"));
            });

            $("#rent-start").change(function(event){
                var date = event.target.valueAsDate;
                date.setFullYear(parseInt(date.getFullYear()) + parseInt($("#rent-duration").val()));
                
                $("#rent-end").val(date.toISOString().split("T")[0]);

                if($("#rent-duration").val().length != 0)
                {
                    $("#waktu-sewa").html(event.target.value + " - " + date.toISOString().split("T")[0]);
                }

                if($("#rent-start").val().length != 0 && $("#rent-duration").val().length != 0)
                {
                    $(".detail").removeClass("d-none");
                }
            });

            $("#rent-duration").change(function(event){

                if(event.target.value <= 0)
                {
                    $(this).val(1);
                }

                var date = new Date($("#rent-start").val());
                date.setFullYear(parseInt(date.getFullYear()) + parseInt(event.target.value));

                total = parseInt({!! json_encode($rumah->harga) !!} * event.target.value);
                $("#total-harga").html(formatRupiah(total));
                $("#lama-sewa").html(event.target.value + " Tahun");
                

                if($("#rent-start").val().length != 0)
                {
                    $("#rent-end").val(date.toISOString().split("T")[0]);
                    $("#waktu-sewa").html($("#rent-start").val() + " - " + date.toISOString().split("T")[0]);
                }

                if($("#rent-start").val().length != 0 && $("#rent-duration").val().length != 0)
                {
                    $(".detail").removeClass("d-none");
                }
            });

            $("#btn-sewa").click(function(){
                if($("#rent-start").val().length != 0 && $("#rent-duration").val().length != 0)
                {
                    $("#form-sewa").submit();
                }
            });

            $("#dp").keyup(function(){
                if($(this).val() > total)
                {
                    alert("DP tidak boleh melebihi total bayar");
                    $(this).val(0);
                }
            });

            function formatRupiah(bilangan){
                var	number_string = bilangan.toString(),
                sisa 	= number_string.length % 3,
                rupiah 	= number_string.substr(0, sisa),
                ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
                    
                if (ribuan) 
                {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                return "Rp. " + rupiah;
            }
            
        </script>

    @endpush
    
@endsection