@extends('layouts.index')

@section('content')

    @push("style-member")
        <style>
            hr{
                border: 1px solid rgba(167, 165, 165, 0.5);
            }
        </style>    
    @endpush

    <form method="post" action="{{ url('/ahp') }}">
        @csrf
        <input type="hidden" name="kriteria" value="{{ json_encode($kriteria) }}">
        <input type="hidden" name="rumah" value="{{ json_encode($rumah) }}">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-md-12 text-center">
                    <h4>Perbandingan Kriteria</h4>
                </div>
            </div>
            <hr>
            <div class="row mt-4">
                <div class="col-md-12">
                    <table class="table table-borderless text-center">
                        <tbody>
                            @foreach($kriteria as $key => $k)
                                <tr>
                                    <td colspan="3">
                                        <h5 id="kriteria-{{ $key }}">1</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left h5">{{ $k["k1"] }}</td>
                                    <td>
                                        <input class="form-control range" name="kriteria-{{ $key }}" value="1" data-id="kriteria-{{ $key }}" type="range" min="1" max="9">
                                    </td>
                                    <td class="text-right h5">{{ $k["k2"] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12 text-center">
                    <h4>Perbandingan Rumah</h4>
                </div>
            </div>
            <hr>
            @foreach($rumah as $key => $r1)
                <div class="row mt-5">
                    <div class="col-md-12 text-center">
                        <h4>{{ $r1["kriteria"] }}</h4>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <table class="table table-borderless text-center">
                            <tbody>
                                @foreach($r1["matrix"] as $key1 => $r2)
                                    <tr>
                                        <td colspan="3">
                                            <h5 id="rumah-{{ $key }}-{{ $r2["k1"] . "-" . $r2["k2"] }}">1</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left h5">Rumah {{ $r2["k1"] }}</td>
                                        <td>
                                            <input class="form-control range" name="rumah-{{ $key . "-" . $key1 }}" value="1" data-id="rumah-{{ $key }}-{{ $r2["k1"] . "-" . $r2["k2"] }}" type="range" min="1" max="9">
                                        </td>
                                        <td class="text-right h5">Rumah {{ $r2["k2"] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
            <div class="row mt-3 mb-3">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-secondary w-25">
                        CARI
                    </button>
                </div>
            </div>
        </div>
    </form>

    @push("script-member")
        <script>
            $(".range").change(function(){
                $("#" + $(this).attr("data-id")).html($(this).val());
            });
        </script>
    @endpush
@endsection