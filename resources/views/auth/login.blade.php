<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    @include("includes.style")

</head>
<body>      

    <div class="container-fluid">
        <div class="row mt-5 mb-3">
            <div class="col-md-12 text-center">
                <h1 style="font-size: 60px" class="text-secondary">Login</h1>
            </div>
        </div>
        @if(isset($errors))
            @if(count($errors) > 0)
                <div class="row text-center">
                    <div class="col-md-12">
                        @foreach ($errors->all() as $error)
                            <span class="text-danger badge badge-danger text-light py-2 px-4">{{ $error }}</span>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif
        @if(session("message"))
            <div class="row text-center">
                <div class="col-md-12">
                    <span class="text-danger badge badge-success text-light py-2 px-4">{{ session("message") }}</span>
                </div>
            </div>
        @endif
        <form method="post" action={{url('/login')}}>
            @csrf
            <div class="form-group row d-flex justify-content-center" style="margin-top: 40px;">
                <label class="text-secondary col-1">Username</label>
                <input name="username" type="text" class="form-control w-50 col-3">
            </div>
            <div class="form-group row d-flex justify-content-center" style="margin-top: 40px;">
                <label class="text-secondary col-1">Password</label>
                <input name="password" type="password" class="form-control w-50 col-3">
            </div>


            {{-- <div class="row mt-3 d-flex justify-content-center">
                <div class="col-md-6 d-flex align-items-center flex-column text-center font-weight-bold">
                    <label class="text-secondary">Username</label>
                    <input name="username" type="text" class="form-control w-50">
                </div>
            </div>
            <div class="row mt-2 d-flex justify-content-center">
                <div class="col-md-6 d-flex align-items-center flex-column text-center font-weight-bold">
                    <label class="text-secondary">Password</label>
                    <input name="password" type="password" class="form-control w-50">
                </div>
            </div> --}}
            <div class="row mt-5 d-flex justify-content-center">
                <div class="col-md-6 text-center">
                    <button type="submit" class="btn btn-secondary w-25">Login</button>
                </div>
            </div>
        </form>
    </div>

    @include("includes.script")
    
</body>
</html>