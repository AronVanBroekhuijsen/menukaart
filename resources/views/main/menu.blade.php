<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1.0, user-scalable=no">
        <meta name="description" content="Menukaart De Haas">
        <meta name="keywords" content="Menukaart, Menu, Kaart, De Haas, Restaurant">
        <meta name="author" content="Restaurant De Haas">

        <title>{{$menu->title($menu->id)}} - Restaurant De Haas</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        {{-- Bootstrap --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        {{-- Fontawesome --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        {{-- Styles --}}
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    </head>
    <body class="antialiased text-center">

        @include('main.auth')

        @if($menu !== null)
            @include('modules.menuheader', ['menu' => $menu, 'allergies' => $allergies])

            @if($menu->id == $menu->cocktailmenu())
                <div class="w-50 mx-auto position-relative z-10 pt-3">
                    <h5 class="spacing text-white">{{$menu->sub_title($menu->id)}}</h3>
                </div>

                <div class="pt-3">
                    @foreach ($menu->courses as $course)
                        @include('modules.cocktail', ['course' => $course])
                    @endforeach
                </div>
            @else
                <div @if($menu->id == $menu->drinkmenu())class="pt-3"@endif>
                    @foreach ($menu->courses as $course)
                        @include('modules.course', ['course' => $course, 'side_info' => $side_info, 'sides' => $sides])
                    @endforeach
                </div>
            @endif
        @endif

        <a class="back-button" href="/@if(isset($_GET['lang']))?lang={{$_GET['lang']}}@endif" aria-label="Start page"><i class="fa-solid fa-share fa-2xl fa-rotate-180"></i></a>

        {{-- Initial scripts --}}
        <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        {{-- Scripts --}}
        <script src="{{asset('/js/app.js')}}"></script>
    </body>
</html>
