@if (!isset($card->menu_id) && ($card->label_date() == null || ($card->label_date() != null && $card->labels->first() != null)))
        <div id="{{$card->title($card->id)}}" href="/app/{{$card->title($card->id)}}/{{$card->id}}@if(isset($_GET['lang']))?lang={{$_GET['lang']}}@endif" class="bg-primary text-secondary card link col mx-auto">
            <h3 class="spacing small-buttons">{{$card->title($card->id)}}</h3>
            @if($card->id != $card->cocktailmenu()) <span>{{$card->sub_title($card->id)}}</span>@endif
        </div>
    @if(isset($card->menu_id))</div>@endif
@elseif (isset($card->menu_id))
    <div class="col-3 p-0 m-auto card-button">
        <div class="scroll-to bg-primary text-secondary card " href="#{{ preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '_', $card->title($card->id))) }}">
            <h3 class="spacing small-buttons">{{$card->title($card->id)}}</h3>
            <span>{{$card->sub_title($card->id)}}</span>
        </div>
    </div>
@endif
