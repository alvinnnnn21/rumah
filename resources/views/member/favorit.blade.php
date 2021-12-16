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
        </style>
    @endpush

    <div class="container-fluid" style="background-color: rgba(0, 0, 0, 0.06); min-height: 90vh;">
        <div class="row d-flex justify-content-center pt-3">
            <div class="col-md-6">
                <form action="{{ url("/login") }}" method="post">
                    <div class="input-group mb-2 mr-sm-2">
                        <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <a type="submit" role="button">
                                    <i class="fas fa-search"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12 px-5">
                @foreach($rumah as $r)
                    <div class="row bg-light mb-3" style="border-radius: 10px; height: 60vh;">
                        <div class="col-md-4 img-card p-0">
                            <img class="img-rumah-{{ $r->idrumah }}" src="{{ asset((count($r->gambar) > 0) ? "storage/images/rumah/" . $r->gambar[0]->gambar : "storage/images/rumah/no_image.png") }}">
                        </div>
                        <div class="col-md-8 pt-3 d-flex flex-column justify-content-between pb-3">
                            <h4 style="font-weight: 700;">Rp {{ number_format($r->harga, 2, ',', '.') }}</h4>
                            <a href="{{ url("/rumah") . "/" . $r->idrumah }}">
                                <h5 class="mt-3">{{ $r->judul }}</h5>
                            </a>
                            <h6 class="text-secondary">
                                <i class="fas fa-map-marker-alt mr-2 mt-3 text-danger"></i>
                                {{ $r->alamat }}
                            </h6>
                            <div class="mt-4 d-flex flex-row" style="font-size: 20px;">
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
                            <p class="mt-3">{{ $r->keterangan }}</p>
                            <h6 class="mb-3">Gambar Lain</h6>
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
            $(".img-carousel").click(function(){
                $(this).parent().find(".img-active").removeClass("img-active");
                $(this).addClass("img-active");

                $(".img-rumah-" + $(this).attr("data-id")).attr("src", $(this).attr("src"));
            });
        </script>
    @endpush

@endsection