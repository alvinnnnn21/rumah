@if(Request::is("ahp") || isset($footer) || Request::is("transaksi") || Request::is("akun") || Request::is("chat"))
    <footer class="position-absolute w-100" style="bottom: 0;">
        <div class="row">
            <div class="col-12 text-center py-3" style="background-color: #d9d6d0;">
                <h5 class="m-0">Created By .... </h5>
            </div>
        </div>
    </footer>
@else 
    <footer>
        <div class="row mt-5">
            <div class="col-12 text-center py-3" style="background-color: #d9d6d0;">
                <h5 class="m-0">Created By ....</h5>
            </div>
        </div>
    </footer>
@endif