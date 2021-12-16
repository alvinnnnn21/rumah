@extends('layouts.index')

@section('content')

    @push("style-member")

        <style>
            .fc-event {
                overflow: hidden;
                white-space: nowrap !important;
            }
        </style>

    @endpush

    <div class="container-fluid">
        <form method="post" action="{{ url('/reminder') }}">
            @csrf
            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h4>Tambah Jadwal</h4>
                        </div>
                        @if(isset($errors))
                            @if(count($errors) > 0)
                                <div class="row text-center mt-2">
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
                        <div class="card-body">
                            <label>Nama Acara</label>
                            <input type="text" name="acara" class="form-control" required>
                            <label class="mt-3">Tanggal Acara</label>
                            <input type="date" name="tanggal" class="form-control" required>
                            <label class="mt-3">Waktu Acara</label>
                            <input type="time" name="waktu" class="form-control" required>
                            <button type="submit" class="btn btn-secondary mt-3">Tambah</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div id="calendar">
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="modal-reminder" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>Acara</td>
                                <td>:</td>
                                <td id="modal-detail-acara"></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td id="modal-detail-tanggal"></td>
                            </tr>
                            <tr>
                                <td>Waktu</td>
                                <td>:</td>
                                <td id="modal-detail-waktu"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push("script-member")
        <script>
            var events = {!! json_encode($reminder) !!}

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: events.map(item => (
                    {
                        title: item.acara.toUpperCase(),
                        start: item.date,
                        time: item.time
                    }
                )),
                displayEventTime: true,
                eventClick: function(info){
                    $("#modal-reminder").modal("toggle");
                    $("#modal-detail-acara").html(info.event.title);
                    $("#modal-detail-tanggal").html(info.event.start);
                    $("#modal-detail-waktu").html(info.event.extendedProps.time);
                }
            });

            calendar.render();
        </script>
    @endpush
@endsection