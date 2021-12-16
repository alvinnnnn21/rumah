<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>

    @include("includes.style")

</head>
<body>      

    <div class="container-fluid">
        <div class="row mt-5 mb-4">
            <div class="col-md-12 text-center">
                <h1 style="font-size: 60px" class="text-secondary">Register</h1>
            </div>
        </div>
        @if(isset($errors))
            @if(count($errors) > 0)
                <div class="row text-center mb-2">
                    <div class="col-md-12">
                        <ul style="list-style: none;">
                            @foreach ($errors->all() as $error)
                                <li class="mt-2">
                                    <span class="text-danger badge badge-danger text-light py-2 px-4">{{ $error }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        @endif
        <form method="post" action={{url('/register')}}>
            @csrf
            <div class="row mt-3 d-flex justify-content-center">
                <div class="col-md-6 d-flex align-items-center flex-column text-center font-weight-bold">
                    <label class="text-secondary">Nama</label>
                    <input name="nama" type="text" class="form-control w-50" required>
                </div>
            </div>
            <div class="row mt-3 d-flex justify-content-center">
                <div class="col-md-6 d-flex align-items-center flex-column text-center font-weight-bold">
                    <label class="text-secondary">Email</label>
                    <input name="email" type="email" class="form-control w-50" required>
                </div>
            </div>
            <div class="row mt-3 d-flex justify-content-center">
                <div class="col-md-6 d-flex align-items-center flex-column text-center font-weight-bold">
                    <label class="text-secondary">Username</label>
                    <input name="username" type="text" class="form-control w-50" required>
                </div>
            </div>
            <div class="row mt-2 d-flex justify-content-center">
                <div class="col-md-6 d-flex align-items-center flex-column text-center font-weight-bold">
                    <label class="text-secondary">Password</label>
                    <input name="password" type="password" class="form-control w-50" required>
                </div>
            </div>
            <div class="row mt-3 d-flex justify-content-center">
                <div class="col-md-6 d-flex align-items-center flex-column text-center font-weight-bold">
                    <label class="text-secondary">Nomor Telepon</label>
                    <input name="no_telpon" type="number" class="form-control w-50" required>
                </div>
            </div>
            <div class="row mt-3 d-flex justify-content-center">
                <div class="col-md-2 text-center">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="roles" id="exampleRadios1" value="pemilik" checked>
                        <label class="form-check-label" for="exampleRadios1">
                          Pemilik Rumah
                        </label>
                      </div>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="radio" name="roles" id="exampleRadios2" value="penyewa">
                        <label class="form-check-label" for="exampleRadios2">
                            Penyewa Rumah
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mt-5 d-flex justify-content-center mb-3">
                <div class="col-md-6 text-center">
                    <button type="submit" class="btn btn-secondary w-25">Register</button>
                </div>
            </div>
        </form>
    </div>

    @include("includes.script")
    
</body>
</html>