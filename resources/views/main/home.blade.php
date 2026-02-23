<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Menukaart De Haas">
        <meta name="keywords" content="Menukaart, Menu, Kaart, De Haas, Restaurant">
        <meta name="author" content="Restaurant De Haas">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Menu</title>

        {{-- Fontawesome --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        {{-- Styles --}}
        <link rel="stylesheet" href="/css/app.css" />

    </head>
    <body class="antialiased text-center">

        @include('main.auth')

        <div id="header">
            <img alt="Logo de Haas" src="{{ asset('storage/images/LogoHaas_2021_site.png') }}" width="127" height="133">

            @include('modules.language')

            <p>
                <span class="text-primary"><i class="fa-solid fa-wifi"></i> De Haas Free Wifi</span>
                <span class="text-tertiary"><i class="fa-solid fa-unlock"></i> gappie</span>
            </p>
        </div>


        <div id="cards" class="big">
            <div class="bg-primary text-secondary card link col" href="https://wijnkast.restaurantdehaas.nl/">
                <h3 class="spacing small-buttons">Wijnkamer</h3>
                <span>Neem een kijkje in onze nieuwe Wijnkamer!!!</span>
            </div>

            @each('modules.card', $menus, 'card')
        </div>

        {{-- Initial scripts --}}
        <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


        {{-- Scripts --}}
        <script src="/js/app.js"></script>
    </body>
</html>
