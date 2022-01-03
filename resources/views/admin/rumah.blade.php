@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Judul</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Pemilik</th>
                            <th>Pesan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rumah as $r)
                            <tr>
                                <td>{{ $r->idrumah }}</td>
                                <td>{{ $r->judul }}</td>
                                <td>{{ $r->alamat }}</td>
                                <td>{{ $r->status }}</td>
                                <td>{{ $r->pemilik->nama }}</td>
                                <td><input type="text" value="{{ $r->pesan }}" class="form-control"></td>
                                @if($r->status == "Proses")
                                    <td>
                                        <div class="btn-group">
                                            <button data-id="{{ $r->idrumah }}" status="Setuju" class="btn btn-success btn-konfirmasi">Setuju</button>
                                            <button data-id="{{ $r->idrumah }}" status="Tolak" class="btn btn-danger btn-konfirmasi">Tolak</button>
                                        </div>
                                    </td>
                                @else
                                    <td></td>   
                                @endif
                                
                                {{-- <td>
                                    <form method="post" action="{{ url('/rumah') . "/" . $r->idrumah }}" id="form-delete-{{ $r->idrumah }}">
                                        @csrf
                                        @method("delete")
                                        <button type="button" class="btn btn-danger btn-delete" data-id="{{ $r->idrumah }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push("script-admin")

        <script>
            $(document).on("click", "button.btn-delete", function(){
                Swal.fire({
                    icon: "warning",
                    title: 'Yakin ingin menghapus user ini?',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#form-delete-" + $(this).attr("data-id")).submit();
                    }
                })
            });

            $(document).on("click", "button.btn-konfirmasi", function(){

                var alasan = "";
                var status = $(this).attr("status");

                if(status === "Tolak")
                {
                    alasan = prompt("Alasan penolakan...");
                }

                $.ajax({
                    url: "{{ url('/konfirmasi') }}" + "/" + $(this).attr("data-id"),
                    method: "post",
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: "put",
                        status,
                        alasan
                    },
                    success: function(data){
                        Swal.fire({
                            icon: data.status,
                            html: "<b>" + data.message + "</b>",
                        });

                        setTimeout(() => {
                            window.location.reload();
                        }, 2000)
                    }
                })

            });
        </script>

    @endpush

@endsection