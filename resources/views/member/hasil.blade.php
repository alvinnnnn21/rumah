@extends('layouts.index')

@section('content')

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

            .card-rumah:hover{
                cursor: pointer;
            }
        </style>
    @endpush
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-12 text-center">
                <h2>HASIL PENCARIAN</h2>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12 px-5 d-flex align-items-center flex-column">
                @foreach($rumah as $r)
                    <div class="row bg-light mb-3 w-75 card-rumah" onClick="window.location.href='{{ url("/rumah") . "/" . $r->idrumah }}'" style="border-radius: 10px; height: 50vh; border: 2px solid #e2dfdf;">
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
@endsection