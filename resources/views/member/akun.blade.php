@extends('layouts.index')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center mt-4">
            <h2 class="text-secondary">Akun Saya</h2>
        </div>
    </div>
    <form method="post" action="{{ url('/akun') }}">
        @csrf
        @method("put")
        <div class="row">
            <div class="col-md-12 d-flex flex-column" >
                <div class="d-flex align-items-center flex-column mt-2">
                    <label class="mt-2">Nama</label>
                    <input class="form-control w-25 w-sm-50 w-md-50" type="text" name="nama" value="{{ $user->nama }}" required>
                </div>
                <div class="d-flex align-items-center flex-column">
                    <label class="mt-2">Email</label>
                    <input class="form-control w-25 w-sm-50 w-md-50" type="text" name="email" value="{{ $user->email }}" required>
                </div>
                <div class="d-flex align-items-center flex-column">
                    <label class="mt-2">Username</label>
                    <input class="form-control w-25 w-sm-50 w-md-50" type="text" name="username" value="{{ $user->username }}" required>
                </div>
                <div class="d-flex align-items-center flex-column">
                    <label class="mt-2">No Telepon</label>
                    <input class="form-control w-25 w-sm-50 w-md-50" type="text" name="no_telpon" value="{{ $user->no_telpon }}" required>
                </div>
                <div class="d-flex align-items-center flex-column">
                    <label class="mt-2">BANK</label>
                    <input class="form-control w-25 w-sm-50 w-md-50" type="text" name="bank" value="{{ $user->bank }}" required>
                </div>
                <div class="d-flex align-items-center flex-column">
                    <label class="mt-2">No Rekening</label>
                    <input class="form-control w-25 w-sm-50 w-md-50" type="text" name="no_rekening" value="{{ $user->no_rekening }}" required>
                </div>
                <div class="d-block text-center">
                    <button class="btn btn-secondary w-15 mt-3" type="submit">Ubah</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection