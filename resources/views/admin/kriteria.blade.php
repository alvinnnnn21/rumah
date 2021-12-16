@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
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
                            <th class="text-light">1</th>
                            <th>Carport</th>
                            <th>Kitchen Set</th>
                            <th>Air Bersih</th>
                            <th>Harga</th>
                            <th>Jumlah Kamar</th>
                            <th>Jumlah Kamar Mandi</th>
                            <th>Luas Tanah</th>
                            <th>Luas Bangunan</th>
                            <th>Daya Listrik</th>
                        </tr>
                        <tr>
                            <td>Carport</td>
                            <td>
                                1
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Kitchen Set</td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                1
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Air Bersih</td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                1
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Harga</td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                1
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Jumlah Kamar</td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                1
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Jumlah Kamar Mandi</td>
                            <<td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                1
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Luas Tanah</td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                1
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Luas Bangunan</td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                1
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Daya Listrik</td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select style="width: 100px;" class="form-control">
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                               1
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-2 mb-3">
            <div class="col-md-12">
                <button class="btn btn-primary float-right">Bandingkan</button>
            </div>
        </div>
    </div>

@endsection