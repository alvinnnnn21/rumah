@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>Lama Sewa (Tahun)</th>
                            <th>Waktu Sewa</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bukti as $b)
                            <tr>
                                <td>{{ $b->transaksi->lama_sewa }}</td>
                                <td>{{ $b->transaksi->mulai_sewa }} - {{ $b->transaksi->selesai_sewa }}</td>
                                <td>Rp {{ number_format($b->transaksi->total, 2, ',', '.') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-pemilik-{{ $b->transaksi->rumah->id_pemilik }}">
                                            Lihat Pemilik
                                        </button>
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#modal-penyewa-{{ $b->transaksi->pembeli->iduser }}">
                                            Lihat Penyewa
                                        </button>
                                        <button class="btn btn-success" data-toggle="modal" data-target="#modal-bukti-{{ $b->id_bukti_bayar }}">
                                            Lihat Bukti
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach 
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @foreach($bukti as $b)

        <div class="modal fade" id="modal-pemilik-{{ $b->transaksi->rumah->id_pemilik }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" readyonly disabled value="{{ $b->transaksi->rumah->pemilik->username }}">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control" readyonly disabled value="{{ $b->transaksi->rumah->pemilik->nama }}">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" readyonly disabled value="{{ $b->transaksi->rumah->pemilik->email }}">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label>No Telpon</label>
                                    <input type="text" name="no_telpon" class="form-control" readyonly disabled value="{{ $b->transaksi->rumah->pemilik->no_telpon }}">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label>Bank</label>
                                    <input type="text" name="bank" class="form-control" readyonly disabled value="{{ $b->transaksi->rumah->pemilik->bank }}">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label>No Rekening</label>
                                    <input type="number" name="no_rekening" class="form-control" readyonly disabled value="{{ $b->transaksi->rumah->pemilik->no_rekening }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="modal-penyewa-{{ $b->transaksi->pembeli->iduser }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" required value="{{ $b->transaksi->pembeli->username }}">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control" required value="{{ $b->transaksi->pembeli->nama }}">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" required value="{{ $b->transaksi->pembeli->email }}">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label>No Telpon</label>
                                    <input type="text" name="no_telpon" class="form-control" required value="{{ $b->transaksi->pembeli->no_telpon }}">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label>Bank</label>
                                    <input type="text" name="bank" class="form-control" required value="{{ $b->transaksi->pembeli->bank }}">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label>No Rekening</label>
                                    <input type="number" name="no_rekening" class="form-control" required value="{{ $b->transaksi->pembeli->no_rekening }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="modal-bukti-{{ $b->id_bukti_bayar }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <img src="{{ asset("images/bukti/" . $b->bukti) }}" style="width: 100%; height: 500px;">
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-5">
                                <div class="col-md-12 btn-group">
                                    <button class="btn btn-success btn-verifikasi" data-transaksi="{{ $b->idtransaksi }}" data-id="{{ $b->id_bukti_bayar }}" data-status="Berhasil">Terima</button>
                                    <button class="btn btn-danger btn-verifikasi" data-transaksi="{{ $b->idtransaksi }}" data-id="{{ $b->id_bukti_bayar }}" data-status="Gagal">Tolak</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

    @endforeach

    @push("script-admin")

        <script>

            $(document).on("click", "button.btn-verifikasi", function(){

                $.ajax({    
                    url: "{{ url('/bukti') }}" + "/" + $(this).attr("data-id"),
                    method: "put",
                    data: {
                        "_token": "{{csrf_token()}}",
                        "_method": "put",
                        "status": $(this).attr("data-status"),
                        "transaksi": $(this).attr("data-transaksi")
                    },
                    success: function(data){    
                        Swal.fire({
                            icon: data.status,
                            html: "<b>" + data.message + "</b>",
                            confirmButtomText: "OK",
                        }).then((result) => {
                            if(result.isConfirmed)
                            {
                                location.reload();
                            }
                        })
                    }
                })
            });

        </script>

    @endpush

@endsection