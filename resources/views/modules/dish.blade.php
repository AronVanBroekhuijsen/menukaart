@if ($dish->toggle == 0)
    <div class="dish clearfix @if($dish->sub_course->course->menu_id == $dish->drinkmenu())my-table row @endif @if($dish->image && !$dish->big_description($dish->id))pb-3 @endif">
        @if($dish->sub_course->course->menu_id == $dish->drinkmenu())<div class="col"> @endif
            <h6 class="dish-h6">
                @if($dish->vos_image == 1)<img src="{{ asset('storage/images/LogoVos.png.webp') }}" style="padding: 7px;" alt="Vos ears for the beers">@endif
                <span class="col-6 pl-0">{{$dish->title($dish->id)}}</span>
                @if($dish->vegan == 1)<img src="{{ asset('storage/images/vega.png') }}" style="vertical-align: sub;" alt="vegan">@endif
                @if($dish->glute == 1)<img src="{{ asset('storage/images/gluten-free.png') }}" style="vertical-align: sub;" alt="gluten">@endif
                @if($dish->lactose == 1)<img src="{{ asset('storage/images/lactose-free.png') }}" style="vertical-align: sub;" alt="lactose">@endif
                @if($dish->big_description($dish->id))
                    <!-- Button trigger modal -->
                    <span type="button" class="col-6 p-0" data-toggle="modal" data-target="#openDescription{{$dish->id}}">
                        <i class="fa-solid fa-circle-info"></i> {{$dish->more_info()}}
                    </span>

                    <!-- Modal -->
                    <div class="modal fade wrapper" class="openDescription" id="openDescription{{$dish->id}}" tabindex="-1" role="dialog" aria-labelledby="openDescription{{$dish->id}}Label" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i aria-hidden="true" class="fa-solid fa-xmark"></i>
                                </button>
                                <div class="modal-body">
                                    <h3>{{$dish->title($dish->id)}}</h3>
                                    <h6>{!!$dish->info($dish->id)!!}</h4>
                                    @if($dish->image != '') <img src="{{ asset('storage/images/uploaded/'. $dish->image) }}" alt="Dish image {{$dish->title($dish->id)}}"> @endif
                                    <span style="width:70%;margin:0 15%;">{!!$dish->big_description($dish->id)!!}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </h6>
            @if($dish->info($dish->id))
                <span class="dish-p">{!!$dish->info($dish->id)!!}
                    @if($dish->sub_product)<span class="text-tertiary">@foreach($dish->sub_product as $sub_product)<br>- {{$sub_product}}@endforeach<span>@endif
                </span>
            @endif
        @if($dish->sub_course->course->menu_id == $dish->drinkmenu())</div>@endif
        <div class="suggestion @if($dish->sub_course->course->menu_id == $dish->drinkmenu())col-2 @endif">@if($dish->price !== '0,00'){{$dish->price}}@endif @if($dish->beer_id)<span class="dish-span"> / <i class="fa-solid fa-beer-mug-empty"></i> {{$dish->beer_id}} @endif @if($dish->wine_id)/ <i class="fa-solid fa-wine-glass"></i> {{$dish->wine_id}}</span>@endif</div>
        @if ($dish->sub_course->text_small($dish->sub_course->id) != '')
            <div class="suggestion @if($dish->sub_course->course->menu_id == $dish->drinkmenu())col-2 @endif">@if($dish->price_large !== '0,00'){{$dish->price_large}}@endif </div>
        @endif

        @if($dish->sauce)
            <div class="toppings">
                <h5 class="text-center pb-1 pt-2 cursor-pointer m-0" data-toggle="collapse" href="#collapseSauce{{$dish->id}}" role="button" aria-expanded="false" aria-controls="collapseSauce{{$dish->id}}">@if(isset($_GET['lang'])) @if($_GET['lang'] == 'en')Choose your sauce or topping here! @elseif($_GET['lang'] == 'de')Wählen Sie hier Ihre Soße oder Ihr Topping!@endif @else Kies hier je saus of topping!@endif<i class="fa-solid fa-circle-plus float-right px-2"></i></h5>
                <div class="collapse" id="collapseSauce{{$dish->id}}">
                    <ul class="text-left m-0 mx-3 pb-3 pt-2">
                        @include('modules.sauces')
                    </ul>
                </div>
            </div>
        @endif
        @if($dish->image && !$dish->big_description($dish->id))
            <div class="dish-image">
                <span class="title">{{$dish->title($dish->id)}}</span>
                <img src="{{ asset('storage/images/uploaded/'. $dish->image) }}" style="max-width: 100%;" alt="Dish image {{$dish->title($dish->id)}}">
            </div>
        @endif
        <hr class="dashed">
    </div>
@endif
