<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.head')
    </head>
    <body class="antialiased">

        @include('main.auth')

        <form class="container crud-table p-3" action="{{route('change_order', ['type' => $type])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <a href="{{route('order_view', ['type' => 'menu', 'id' => ''])}}" class="btn btn-primary col-2">Terug</a>
                <button href="" type="submit" class="btn btn-success float-right col-2">Opslaan</button>
            </div>
            <div id="sortable" data-type="{{$type}}">
                @if ($type == 'sub_product') @php $items = $items->full_sub_product @endphp @endif
                @foreach($items as $item)
                @if ($item->sub_product) @php $next_type = 'sub_product' @endphp @endif
                    <a class="bg-primary text-secondary card" @if($next_type != 'none') href="{{route('order_view', ['type' => $next_type, 'id' => $item->id])}}" @endif>
                        <input type="hidden" name="item[{{$item->id}}]" value="{{$item->order}}">
                        <h3 class="spacing small-buttons">{{$item->title($item->id)}}</h3>
                    </a>
                @endforeach
            </div>
        </form>

        @include('layouts.body')
    </body>
</html>
