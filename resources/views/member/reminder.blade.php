@extends('layouts.index')

@section('content')
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-light">
                        <h4>Jadwal</h4>
                    </div>
                    <div class="card-body overflow-auto">
                        <ul class="list-group">
                            @foreach($reminder as $r)
                                <li class="list-group-item">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-md-7">
                                            <h6>{{ date("D, M Y h:i a", strtotime($r->date . " " . $r->time)) }}</h6>
                                            <p style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; width: 150">{{ $r->acara }}</p>
                                        </div>  
                                        <div class="col-md-5 button-group d-flex justify-content-end align-items-center">
                                            <a href="javascript:void(0)" role="button" data-toggle="modal" data-target="#modal-reminder-{{ $r->idreminder }}" class="btn" style="font-size: 15px;">
                                                <i class="fas fa-edit"></i>
                                                Ubah
                                            </a>
                                            <form method="post" action="{{ url('/reminder') . "/" . $r->idreminder }}" id="form-hapus-reminder-{{ $r->idreminder }}">
                                                @csrf
                                                @method("delete")
                                                <button type="button" class="btn btn-hapus" data-id="{{ $r->idreminder }}" style="font-size: 15px;">
                                                    <i class="fas fa-trash"></i>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach     
                        </ul>
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
        <a href="{{ url('/tambahreminder') }}" style="color: white;">
            <div class="fab mb-3 bg-secondary p-4" style="position: sticky; bottom: 0; border-radius: 50%; left: 5;">
                <i class="fas fa-plus"></i>
            </div> 
        </a>
    </div>

    @foreach($reminder as $r)

        <div class="modal fade" id="modal-reminder-{{ $r->idreminder }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="post" action="{{ url('/reminder') . "/" . $r->idreminder }}">
                    @csrf
                    @method("put")
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <label>Nama Acara</label>
                                <input type="text" name="acara" class="form-control" value="{{ $r->acara }}"required>
                                <label class="mt-3">Tanggal Acara</label>
                                <input type="date" name="tanggal" class="form-control" value="{{ date("Y-m-d", strtotime($r->date)) }}"required>
                                <label class="mt-3">Waktu Acara</label>
                                <input type="time" name="waktu" class="form-control" value="{{ $r->time }}"required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
        
    @endforeach

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
            
            $(document).on("click", "button.btn-hapus", function(){

                var id = $(this).attr("data-id");

                Swal.fire({
                    title: 'Konfirmasi Hapus Reminder',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: "Batal"
                }).then((result) => {
                if (result.isConfirmed) {
                    $("#form-hapus-reminder-" + id).submit();
                }
                })
            });
        </script>

    @endpush
@endsection