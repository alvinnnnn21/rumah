<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    
    $(".table").DataTable({});

</script>

@if(Session::has("message"))

    <script>
        Swal.fire({
            icon: {!! json_encode(Session::get("status")) !!},
            html: {!! json_encode("<b>" . Session::get("message") . "</b>") !!},
        })
    </script>   

@endif

@stack("script-admin")


