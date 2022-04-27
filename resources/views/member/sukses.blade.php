@extends('layouts.index')

@section('content')

    @push("style-member")
        <link rel="stylesheet" href="{{ asset('css/tick.css') }}"/>
    @endpush

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex;">
                    <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                    <span class="swal2-success-line-tip"></span>
                    <span class="swal2-success-line-long"></span>
                    <div class="swal2-success-ring"></div> 
                    <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                    <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12 text-center">
                <h3 class="text-secondary">FORMULIR SEWA RUMAH BERHASIL DIKIRIM</h3>
                <h5 class="text-secondary">SILAHKAN TRANSFER DALAM WAKTU 24 JAM</h5>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12 text-center">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-verifikasi">VERIFIKASI PEMBAYARAN</button>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12 text-center">
                <a href="/" class="btn btn-secondary">KEMBALI HALAMAN UTAMA</a>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-verifikasi" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="post" action="{{ url("/bukti") }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="transaksi" value="{{ $transaksi->id_transaksi_sewa }}">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <h6>DETAIL SEWA</h6>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Lama Sewa</th>
                                                <th>:</th>
                                                <th>
                                                    {{$transaksi->lama_sewa}}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Waktu Sewa</th>
                                                <th>:</th>
                                                <th id="waktu-sewa">
                                                    {{date("Y-m-d", strtotime($transaksi->mulai_sewa))}} - {{date("Y-m-d", strtotime($transaksi->selesai_sewa))}}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Harga Total</th>
                                                <th>:</th>
                                                <th>
                                                    Rp {{ number_format($transaksi->total, 2, ',', '.') }}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th colspan="2">Upload Bukti</th>
                                                <th>
                                                    <input type="file" name="bukti" accept="image/*" required>
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection