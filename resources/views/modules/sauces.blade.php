@foreach($sauces as $sauce)
    <li class="sauce-li">{{$sauce->title($sauce->id)}} | + {{$sauce->price}}</li>
@endforeach
