{{-- <div id="header" class="mx-3"> --}}
    <div id="cards" class="small row m-0 sticky-main">
        <div class="bg-primary text-secondary card link col" href="https://wijnkast.restaurantdehaas.nl/">
            <h3 class="spacing small-buttons">Wijnkamer</h3>
        </div>
        @each('modules.card', $menus, 'card')
        <div class="clearfix"></div>
    </div>

    <h1 class="text-tertiary">{{$menu->title($menu->id)}}</h1>
    <h6 class="text-white">Restaurant De Haas</h4>

    @include('modules.language')

    <div class="sticky-sub">
        <div class="container">
            <div id="cards" class="small grey row px-0 px-md-4">
                @each('modules.card', $menu->courses, 'card')
            </div>
        </div>
    </div>
    <div class="sticky-shadow"></div>
    <div class="shadow-cover"></div>


    @if($menu->id != $menu->drinkmenu() && $menu->id != $menu->cocktailmenu())
    <div class="allergy clearfix">
        <div class="float-left">
            <h4>{{$allergies->main}}</h4>
            <p class="">
                {{$allergies->content}}
            </p>
        </div>
        <div class="float-right">
            <img src="{{ asset('storage/images/Allergenen-1.png') }}" alt="Allergic picture">
        </div>
    </div>
    <h6 class="text-white">{!! $allergies->note !!}</h6>
    @endif
    {{-- </div> --}}
