@extends('layouts.index')

@section('content')
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-12 text-center">
                <h4>Daftar transaksi Sewa</h4>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Waktu Sewa</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>   
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksi as $t)
                            <tr>
                                <td>#{{ $t->id_transaksi_sewa }}</td>
                                <td>{{ date("d M Y", strtotime($t->mulai_sewa)) }} - {{ date("d M Y", strtotime($t->selesai_sewa)) }}</td>
                                <td>Rp {{ number_format($t->total, 2, ',', '.') }}</td>
                                <td>{{ $t->status }}</td>
                                <td>
                                    @if($t->status == "Proses Pembayaran")
                                        <button class="btn btn-success" data-target="#modal-verifikasi-{{ $t->id_transaksi_sewa }}" data-toggle="modal">
                                            Verifikasi Pembayaran
                                        </button>   
                                    @endif
                                    <a href="{{ url("/rumah") . "/" . $t->idrumah }}" target="_blank" class="btn btn-info">
                                        Lihat Rumah
                                    </a>   
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @foreach($transaksi as $t)
        <div class="modal fade" id="modal-verifikasi-{{ $t->id_transaksi_sewa }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form method="post" action="{{ url("/bukti") }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="transaksi" value="{{ $t->id_transaksi_sewa }}">
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
                                                        {{$t->lama_sewa}} Tahun
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>Waktu Sewa</th>
                                                    <th>:</th>
                                                    <th id="waktu-sewa">
                                                        {{date("d M Y", strtotime($t->mulai_sewa))}} - {{date("d M Y", strtotime($t->selesai_sewa))}}
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>Harga Total</th>
                                                    <th>:</th>
                                                    <th>
                                                        Rp {{ number_format($t->total, 2, ',', '.') }}
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
    @endforeach

@endsection