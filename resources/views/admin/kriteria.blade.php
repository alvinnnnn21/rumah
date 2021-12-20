@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <form method="post" action="{{ url('/kriteria') }}">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <h4>Kriteria</h4>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <table class="table text-center">
                        <tbody>
                            <tr>
                                <th>Kriteria</th>
                                @foreach($kriteria as $k)
                                    <th>{{ $k }}</th>
                                @endforeach
                            </tr>   
                            @foreach($kriteria as $key1 => $k1)
                                <tr>
                                    @foreach($kriteria as $key2 => $k2)
                                        @if($key2 == 0)
                                            <td>
                                                {{ $k1 }}
                                            </td>
                                        @endif
                                        @if($key1 == $key2)
                                            <td class="bg-secondary text-light">
                                                1
                                                <input type="hidden" name="kriteria-{{ $key1 }}-{{ $key2 }}" value="1">
                                            </td>
                                        @else
                                            <td style="width: 100px;">
                                                @if($key1 < $key2)
                                                    <select name="kriteria-{{ $key1 }}-{{ $key2 }}" class="form-control select-kriteria">
                                                        @for($i = 1; $i < 10; $i++)
                                                            <option {{ (AHP::cariNilaiKriteria($nilai_kriteria, $k1, $k2) == $i) ? 'selected' : ''}} value={{$i}}>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                @else
                                                    <input class="form-control" value="{{ (AHP::cariNilaiKriteria($nilai_kriteria, $k1, $k2)) ? AHP::cariNilaiKriteria($nilai_kriteria, $k1, $k2) : 1 }}" type="text" name="kriteria-{{ $key1 }}-{{ $key2 }}">
                                                @endif  
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <h4>Rumah</h4>
                </div>
            </div>
            @foreach($kriteria as $key0 => $k)
                <div class="row mt-2">
                    <div class="col-md-12">
                        <table class="table text-center">
                            <tbody>
                                <tr>
                                    <th>{{ $k }}</th>
                                    @foreach($rumah as $key => $r)
                                        <th>Rumah {{ $key + 1 }}</th>
                                    @endforeach
                                </tr>
                                @foreach($rumah as $key1 => $r1)
                                    <tr>
                                        @foreach($rumah as $key2 => $r2)
                                            @if($key2 == 0)
                                                <td>Rumah {{ $key1 + 1 }}</td>
                                            @endif
                                            @if($key1 == $key2)
                                                <td class="bg-secondary text-light">1</td>
                                                <input type="hidden" name="kriteria-{{ $key0 }}-rumah-{{ $r1->idrumah }}-{{ $r2->idrumah }}" value="1">
                                            @else
                                                <td style="width: 200px;">
                                                    @if($key1 < $key2)
                                                        <select name="kriteria-{{ $key0 }}-rumah-{{ $r1->idrumah }}-{{ $r2->idrumah }}" class="form-control select-rumah">
                                                            @for($i = 1; $i < 10; $i++)
                                                                <option {{ (AHP::cariNilaiRumah($nilai_rumah, $r1->idrumah, $r2->idrumah, $k) == $i) ? 'selected' : '' }} value={{$i}}>{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    @else
                                                        <input class="form-control" value="{{ (AHP::cariNilaiRumah($nilai_rumah, $r1->idrumah, $r2->idrumah, $k)) ? AHP::cariNilaiRumah($nilai_rumah, $r1->idrumah, $r2->idrumah, $k) : 1 }}" type="text" name="kriteria-{{ $key0 }}-rumah-{{ $r1->idrumah }}-{{ $r2->idrumah }}">
                                                    @endif 
                                                </td>
                                            @endif
                                        @endforeach 
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach 
            <div class="row mt-2 mb-3">
                <div class="col-md-12">
                    <button class="btn btn-primary float-right">Bandingkan</button>
                </div>
            </div>
        </form>
    </div>

    @push("script-admin")
        <script>
            var kriteria = {!! json_encode($kriteria) !!};
            var rumah = {!! json_encode($rumah) !!};

            $(document).on("change", "select.select-kriteria", function(){
                var id = $(this).attr("name");
                id = id.split("-");

                $("input[name=kriteria-" + id[2] + "-" + id[1] + "]").val(1 / parseInt($(this).val()));
            });

            $(document).on("change", "select.select-rumah", function(){
                var id = $(this).attr("name");
                id = id.split("-");

                $("input[name=kriteria-" + id[1] + "-rumah-" + id[4] + "-" + id[3] + "]").val(1 / parseInt($(this).val()));
            });
        </script>
    @endpush

@endsection