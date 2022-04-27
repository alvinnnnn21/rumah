@extends('layouts.index')

@section('content')
    <div class="container-fluid text-secondary">
        <div class="row">
            <div class="col-md-4 py-2" style="height: 92vh;">
                <div  style=" border-right: 2px solid #e2dfdf; height: 100%;">
                    <ul class="list-group tutorial-list">
                        
                    </ul>
                </div>   
            </div>
            <div class="col-md-8 text-center">
                <h1 class="mt-4 title"></h1>
                <ul class="list-group tutorial-step mt-3">

                </ul>
            </div>
        </div>
    </div>

    @push("script-member")

        <script src="{{ asset('js/tutorial.js') }}"></script>
        
        <script>

            var user = {!! json_encode(Auth::user() ? Auth::guard()->user()->roles : "umum") !!}
            var html = "";

            for(var i = 0; i < tutorial.length; i++)
            {
                if(tutorial[i].tipe == "umum" || tutorial[i].tipe == user)
                {
                    html += '<button data-id=' + tutorial[i].id + ' class="btn btn-tutorial">';
                    html += '<li class="list-group-item">';
                    html += tutorial[i].tutorial;
                    html += "</li>";
                    html += '</button>';
                }
            }

            $(".tutorial-list").html(html);

            $(document).on("click", "button.btn-tutorial", function(){
                var id = $(this).attr("data-id");
                var selected = tutorial.filter((item) => item.id == id);
                var html = "";

                $(".title").html(selected[0].tutorial);

                for(var i = 0; i < selected[0].langkah.length; i++)
                {
                    html += '<li class="list-group-item">'
                    html += '<div class="d-flex flex-column align-items-center">';
                    html +=  (i + 1) + ". "  + selected[0].langkah[i].langkah;

                    for(var j = 0; j < selected[0].langkah[i].image.length; j++)
                    {
                        html += '<img class="mt-3" src={{ asset("images/tutorial/") }}' + "/" + selected[0].langkah[i].image[j] + ' width="400" height="400">'; 
                    }

                    html += "</div>";
                    html += '</li>';
                }

                $(".tutorial-step").html(html);
            });

        </script>

    @endpush
@endsection