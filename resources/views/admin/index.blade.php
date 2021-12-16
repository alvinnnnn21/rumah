@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No Telpon</th>
                        <th>Bank</th>
                        <th>No Rekening</th>
                        <th>Roles</th>
                        {{-- <th>Aksi</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($user as $u)
                        <tr>
                            <td>{{ $u->iduser }}</td>
                            <td>{{ $u->username }}</td>
                            <td>{{ $u->nama }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->no_telpon }}</td>
                            <td>{{ $u->bank }}</td>
                            <td>{{ $u->no_rekening }}</td>
                            <td>{{ ucfirst($u->roles) }}</td>
                            {{-- <td>
                                <div class="btn-group">
                                    <form method="post" id="form-delete-{{ $u->iduser }}" action="{{ url('/user') . "/" . $u->iduser }}">
                                        @csrf
                                        @method("delete")
                                        <button type="button" data-id="{{ $u->iduser }}" class="btn btn-danger btn-delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form> 
                                </div>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- @push("script-admin")

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
    </script>

@endpush     --}}
    
@endsection