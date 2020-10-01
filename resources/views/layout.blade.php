<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>RSUD</title>

        <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}" />

    </head>
    <body>

        @section('navbar')
            <nav class="navbar">
                <ul class="d-flex justify-content-center align-items-center flex-row">
                    <li class="active"><a href="">Periksa</a></li>
                    <li><a href="">Kirim Poli Lain</a></li>
                    <li><a href="">Hasil Lab</a></li>
                    <li class="profile d-flex flex-row align-items-center">
                        <img src="{{URL::asset('/img/1.png')}}" alt="Profile picture">
                        <p>Wahyudi</p>
                        <span><svg width="32" height="32" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.66675 6.66663L8.00008 9.99996L11.3334 6.66663H4.66675Z" fill="white"/></svg></span>
                    </li>
                </ul>
            </nav>
        @show
        
        <div class="bg-white">
            @yield ('content')
        </div>

    </body>
</html>
