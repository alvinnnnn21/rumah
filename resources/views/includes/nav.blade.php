<nav class="navbar navbar-expand-lg navbar-light bg-secondary d-flex">
    <ul class="d-flex justify-content-between p-0 mt-1 w-100" style="list-style-type: none;">
        <li class="dropdown btn-group">
            <button type="button" class="btn btn-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bars"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-left">
                <a href="{{ url("/") }}" class="dropdown-item" type="button">Menu Utama</a href="{{ url("/") }}">
                @if(!Auth::guard("member")->check())
                    <a href="{{ url("/login") }}" class="dropdown-item" type="button">Login</a>
                    <a href="{{ url("/register") }}" class="dropdown-item" type="button">Register</a>
                @else 
                    <a href="{{ url('/chat') }}" class="dropdown-item" type="button">Chat</a>
                    <a href="{{ url('/reminder') }}" class="dropdown-item" type="button">Reminder</a>
                    @if(Auth::guard("member")->user()->roles == "penyewa")
                        <a href="{{ url('/favorit') }}" class="dropdown-item" type="button">Favorit</a>
                        <a href="{{ url('/transaksi') }}" class="dropdown-item" type="button">Transaksi</a>
                    @endif
                @endif
                
            </div>
        </li>
        
        @if(Auth::guard("member")->check())
            <div class="d-flex align-items-center">
                <a href="{{ url("/") }}">
                    <h4 class="text-white m-0">JUDUL APLIKASI</h4>
                </a>
            </div>
            <div class="d-flex flex-row">
                <li class="dropdown">
                    <a href="{{ url("/tutorial") }}" class="btn btn-secondary d-flex flex-row align-items-center">
                        <i class="fas fa-book-open mr-3" style="font-size: 25px;"></i>
                        <h6>Baca Aku</h6>
                    </a>
                </li>
                <li class="dropdown ml-5">
                    <button type="button" class="btn btn-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-notification">
                        
                    </div>
                </li>
                <li class="dropdown ml-5">
                    <button type="button" class="btn btn-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{ url('/akun') }}" class="dropdown-item" type="button">Akun Saya</a>
                        <a href="{{ url('/notifikasi') }}" class="dropdown-item" type="button">Notifikasi</a>
                        @if(Auth::guard("member")->user()->roles === "pemilik")
                            <a href="{{ url('/rumahsaya') }}" class="dropdown-item" type="button">Rumah Saya</a>
                        @endif
                        <form method="post" action="{{ url("/logout") }}">
                            @csrf
                            <input type="hidden" role="member">
                            <button class="dropdown-item" type="submit">Logout</button>
                        </form>
                    </div>
                </li>
            </div>  
        @else 
            <div class="d-flex align-items-center">
                <a href="{{ url("/") }}">
                    <h4 class="text-white m-0">JUDUL APLIKASI</h4>
                </a>
            </div>
            <li class="dropdown">
                <a href="{{ url("/tutorial") }}" class="btn btn-secondary d-flex flex-row align-items-center">
                    <i class="fas fa-book-open mr-3" style="font-size: 25px;"></i>
                    <h6>Baca Aku</h6>
                </a>
            </li>
        @endif
    </ul>
</nav>

<div class="modal-transaksi">

</div>

@if(Auth::guard("member")->check())
    @push("script-member")
        <script>

            function getNotification()
            {
                $.ajax({
                    url: "{{ url('/notifikasi') }}" + "/" + {!! Auth::guard("member")->user()->iduser !!},
                    method: "get",
                    success: function(data){
                        $(".dropdown-notification").html(data.html);
                        $(".modal-transaksi").html(data.modal);
                    }
                })  
            }   

            getNotification();

            setInterval(getNotification, 5000);
        </script>
    @endpush
@endif