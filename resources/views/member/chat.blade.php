@extends('layouts.index')

@push("style-member")
    <style>
        a:hover{
            text-decoration: none;
        }
        .chat .chat-history {
            padding: 30px 30px 20px;
            border-bottom: 2px solid white;
        }
        .chat .chat-history .message-data {
            margin-bottom: 15px;
        }
        .chat .chat-history .message-data-time {
            color: #a8aab1;
            padding-left: 6px;
        }
        .chat .chat-history .message {
            color: white;
            padding: 18px 20px;
            line-height: 26px;
            font-size: 16px;
            border-radius: 5px;
            margin-bottom: 30px;
            width: 90%;
            position: relative;
        }
        .chat .chat-history .message:after {
            content: "";
            position: absolute;
            top: -15px;
            left: 20px;
            border-width: 0 15px 15px;
            border-style: solid;
            border-color: #CCDBDC transparent;
            display: block;
            width: 0;
        }
        .chat .chat-history .you-message {
            background: #CCDBDC;
            color:#000000;
        }
        .chat .chat-history .me-message {
            background: #4CE97E;
        }
        .chat .chat-history .me-message:after {
            border-color: #4CE97E transparent;
            right: 20px;
            top: -15px;
            left: auto;
            bottom:auto;
        }
        .chat .chat-message {
            padding: 30px;
        }
        .chat .chat-message .fa-file-o, .chat .chat-message .fa-file-image-o {
            font-size: 16px;
            color: gray;
            cursor: pointer;
        }

        .chat-ul li{
            list-style-type: none;
        }

        .align-left {
            text-align: left;
        }

        .align-right {
            text-align: right;
        }

        .float-right {
            float: right;
        }

        .clearfix:after {
            visibility: hidden;
            display: block;
            font-size: 0;
            content: " ";
            clear: both;
            height: 0;
        }
        .you {
            color: #CCDBDC;
        }

        .me {
            color: #00FF51;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: "Raleway",sans-serif;
            color: #003366;
        }

    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <ul class="list-group mt-3">
                    @foreach($chat as $c)
                        @if(Auth::guard("member")->user()->roles === "penyewa")
                            <li id="chat-{{$c->idchat}}" class="list-group-item">
                                <a data-id="{{ $c->idchat }}" data-lawan="{{ $c->idpemilik }}" href="javascript:void(0)" class="text-dark chat-people">
                                    <i class="fas fa-user mr-3"></i>
                                    {{ $c->pemilik->nama }}
                                </a>
                            </li>
                        @else
                            <li id="chat-{{$c->idchat}}" class="list-group-item">
                                <a data-id="{{ $c->idchat }}" data-lawan="{{ $c->idpenyewa }}" href="javascript:void(0)" class="text-dark chat-people">
                                    <i class="fas fa-user mr-3"></i>
                                    {{ $c->penyewa->nama }}
                                </a>
                            </li>
                        @endif
                    @endforeach 
                </ul>
            </div>
            <div class="col-md-8 chat-box">
                <div class="row d-none mt-2 mr-1" id="header-nama-lawan">
                    <div class="col-md-12 d-flex flex-row bg-secondary py-2">
                        <i class="fas fa-user mr-3 mt-1"></i>
                        <h6 class="mt-1" id="nama-lawan"></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="chat" style="overflow: auto; height: 600px;">
                            <div class="chat-history">
                                <ul class="chat-ul">
                            
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 d-none" id="chat-input">
                    <div class="col-md-12 d-flex justify-content-between">
                        <input class="form-control text-message" style="width: 90%;" type="text">
                        <button class="btn btn-primary btn-send">Kirim</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push("script-member")

        <script type="text/javascript">

            var current_chat = {!! (isset($id)) ? json_encode($id) : -1 !!}
            var chat_id = {!! (isset($id)) ? json_encode($id) : -1 !!}
            var id_lawan = {!! (isset($lawan)) ? json_encode($lawan->iduser) : -1 !!}
            var roles = {!! json_encode(Auth::guard("member")->user()->roles) !!}

            if(chat_id > 0)   
            {
                $("#chat-" + chat_id).addClass("bg-secondary")
                $("#header-nama-lawan").removeClass("d-none");
                $("#chat-input").removeClass("d-none");

                $.ajax({
                    url: "{{ url('/detailchat') }}" + "/" + chat_id,
                    method: "get",
                    success: function(data){
                        var chats = JSON.parse(JSON.stringify(data));   
                        var html = "";

                        $("#nama-lawan").html(chats[(roles === "penyewa") ? "pemilik" : "penyewa"]["nama"]);

                        for(var i = 0; i < chats["detailchat"].length; i++)
                        {
                            if(chats["detailchat"][i]["idpengirim"] === {!! Auth::guard("member")->user()->iduser !!})
                            {
                                html += '<li class="clearfix">';
                                html += '<div class="message-data align-right">';
                                html += '<span class="message-data-name"></span><i class="fa fa-circle me"> Kamu ' +  ' ' + chats["detailchat"][i]["waktu"] + '</i>';
                                html += '</div>';
                                html += '<div class="message me-message float-right" style="word-wrap: break-word"> ' + chats["detailchat"][i]["pesan"] + '</div>';
                                html += '</li>';
                            }
                            else 
                            {
                                html += '<li>';
                                html += '<div class="message-data">';
                                html += '<span class="message-data-name"><i class="fa fa-circle you"></i> ' + chats[(roles === "penyewa") ? "pemilik" : "penyewa"]["nama"] + ' ' + chats["detailchat"][i]["waktu"] + '</span>';
                                html += '</div>';
                                html += '<div class="message you-message" style="word-wrap: break-word">' + chats["detailchat"][i]["pesan"] + '</div>';
                                html += '</li>';
                            }
                        }

                        $(".chat-ul").html(html);
                    }
                })
            }
            else if(chat_id == 0)
            {
                $("#header-nama-lawan").removeClass("d-none");
                $("#chat-input").removeClass("d-none");

                var nama_lawan = {!! (isset($lawan)) ? json_encode($lawan->nama) : "" !!}

                $("#nama-lawan").html(nama_lawan);
            }

            $(".btn-send").click(function(){

                var message = $(".text-message").val();
                var html = "";

                $.ajax({
                    url: "{{ url('/chat') }}",
                    method: "post",
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: "post",
                        message: message,
                        id: current_chat,
                        lawan: id_lawan
                    },
                    success: function(data){    

                        var chats = JSON.parse(JSON.stringify(data));   

                        html += '<li class="clearfix">';
                        html += '<div class="message-data align-right">';
                        html += '<span class="message-data-name"></span><i class="fa fa-circle me"> Kamu ' +  ' ' + chats["waktu"] + '</i>';
                        html += '</div>';
                        html += '<div class="message me-message float-right" style="word-wrap: break-word"> ' + chats["pesan"] + '</div>';
                        html += '</li>';

                        $(".chat-ul").append(html);
                    }
                })
            });

            $(".chat-people").click(function(){
                var chat = $(this).attr("data-id");
                var html = "";

                $("#chat-input").removeClass("d-none");

                if(current_chat !== 0)
                {   
                    $("#chat-" + current_chat).removeClass("bg-secondary");
                }

                current_chat = chat;
                id_lawan = $(this).attr("data-lawan");

                $(this).parent().addClass("bg-secondary");

                $.ajax({
                    url: "{{ url('/detailchat') }}" + "/" + chat,
                    method: "get",
                    success: function(data){
                        var chats = JSON.parse(JSON.stringify(data));   

                        $("#nama-lawan").html(("{!! Auth::guard("member")->user()->roles !!}"  === "penyewa") ? chats["pemilik"]["nama"] : chats["penyewa"]["nama"]);

                        for(var i = 0; i < chats["detailchat"].length; i++)
                        {
                            if(chats["detailchat"][i]["idpengirim"] === {!! Auth::guard("member")->user()->iduser !!})
                            {
                                html += '<li class="clearfix">';
                                html += '<div class="message-data align-right">';
                                html += '<span class="message-data-name"></span><i class="fa fa-circle me"> Kamu' +  ' ' + chats["detailchat"][i]["waktu"] + '</i>';
                                html += '</div>';
                                html += '<div class="message me-message float-right" style="word-wrap: break-word"> ' + chats["detailchat"][i]["pesan"] + '</div>';
                                html += '</li>';
                            }
                            else 
                            {
                                html += '<li>';
                                html += '<div class="message-data">';
                                html += '<span class="message-data-name"><i class="fa fa-circle you"></i>' +  chats[(roles === "penyewa") ? "pemilik" : "penyewa"]["nama"] + ' ' + chats["detailchat"][i]["waktu"] + '</span>';
                                html += '</div>';
                                html += '<div class="message you-message" style="word-wrap: break-word">' + chats["detailchat"][i]["pesan"] + '</div>';
                                html += '</li>';
                            }
                        }

                        $(".chat-ul").html(html);
                    }
                })
            });
        </script>
    @endpush    
@endsection