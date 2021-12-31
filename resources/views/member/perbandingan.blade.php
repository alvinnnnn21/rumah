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
                    <table class="table text-center">
                        <tbody>
                            <tr>
                                <th style="width: 100px;">Kriteria</th>
                                @foreach($kriteria as $k)
                                    <th style="width: 100px;">{{ $k }}</th>
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
                                                <input type="hidden" name="kriteria-{{ $k1 }}-{{ $k2 }}" value="9">
                                            </td>
                                        @else
                                            <td style="width: 100px;">
                                                @if($key1 < $key2)
                                                    <select id="kriteria-{{ $key1 }}-{{ $key2 }}" name="kriteria-{{ $k1 }}-{{ $k2 }}" class="form-control select-kriteria">
                                                        @foreach($nilai as $key => $n)
                                                            <option {{ (AHP::cariNilaiKriteria($nilai_kriteria, $k1, $k2) == $n) ? 'selected' : ''}} value="{{ $n }}">{{ "1/" . (count($nilai) - $key + 1) }}</option>
                                                        @endforeach
                                                        @for($i = 1; $i < 10; $i++)
                                                            <option {{ (AHP::cariNilaiKriteria($nilai_kriteria, $k1, $k2) == $i) ? 'selected' : ''}} value={{$i}}>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                @else
                                                    <input class="form-control" value="{{ (AHP::cariNilaiKriteria($nilai_kriteria, $k1, $k2)) ? AHP::cariNilaiKriteria($nilai_kriteria, $k1, $k2) : 1 }}" type="text" id="kriteria-{{ $key1 }}-{{ $key2 }}" name="kriteria-{{ $k1 }}-{{ $k2 }}" readonly>
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
            <div class="row mt-3 mb-3">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-secondary w-25">
                        Bandingkan
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

            var kriteria = {!! json_encode($kriteria) !!};
            var rumah = {!! json_encode($rumah) !!};

            $(document).on("change", "select.select-kriteria", function(){
                var id = $(this).attr("id");
                id = id.split("-");
                
                $("#kriteria-" + id[2] + "-" + id[1]).val(parseFloat($(this).val()) < 1 ? Math.round(1 / parseFloat($(this).val())) : 1 / parseFloat($(this).val()));
            });
        </script>
    @endpush

    
@endsection