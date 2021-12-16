@extends('layouts.index')

@section('content')
    <div class="container-fluid text-secondary">
        <div class="row">
            <div class="col-md-4 py-2" style="height: 92vh;">
                <div  style=" border-right: 2px solid #e2dfdf; height: 100%;">
                    <ul class="list-group">
                        <button class="btn">
                            <li class="list-group-item">Tutorial Menambah Rumah</li>
                        </button>
                        <button  class="btn">
                            <li class="list-group-item">Tutorial Mencari Rumah</li>
                        </button>
                        <button  class="btn">
                            <li class="list-group-item">Tutorial Menghubungi Pemilik</li>
                        </button>
                        <button  class="btn">
                            <li class="list-group-item">Tutorial Memesan</li>
                        </button>   
                    </ul>
                </div>   
            </div>
            <div class="col-md-8 text-center">
                <h1 class="mt-4">Tutorial</h1>
            </div>
        </div>
    </div>
@endsection