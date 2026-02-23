<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.head')
    </head>
    <body class="antialiased">

        @include('main.auth')

        <div class="container crud-table p-3">
            <div class="form-group row">
                <form action="" class="col-10 row">
                    <div class="col-11">
                        <select name="menu" class="form-control custom-select">
                            <option value="">Selecteer Category</option>
                            <option value="0" @if(0 == $current)selected @endif>Sub Producten</option>
                            @foreach($menus as $menu)
                                <option value="{{$menu->title($menu->id)}}" @if($menu->title($menu->id) == $current)selected @endif class="optionParent">{{$menu->title($menu->id)}}</option>
                                    @foreach($menu->courses as $courses)
                                        <option value="{{$courses->title($courses->id)}}" @if($courses->title($courses->id) == $current)selected @endif class="optionSubParent">{{$courses->title($courses->id)}}</option>
                                        @foreach ($courses->sub_courses as $sub_courses)
                                            @if($sub_courses->title($sub_courses->id) == '') @continue @endif
                                            <option value="{{$sub_courses->title($sub_courses->id)}}" @if($sub_courses->title($sub_courses->id) == $current)selected @endif class="optionChild">{{$sub_courses->title($sub_courses->id)}}</option>
                                        @endforeach
                                    @endforeach
                            @endforeach
                        </select>
                        <input type="text" name="search_title" class="submit search_title form-control mt-2" value="{{ $search_title }}">
                    </div>

                    <div class="col-1 form-check">
                        <input type="checkbox" name="disabled" class="form-check-input" id="disabled" {{  ($disabled == 'on' ? ' checked' : '') }}>
                        <label for="disabled" class="form-check-label">Uit</label>
                    </div>
                </form>

                @if (Auth::user()->role == 'editor' || Auth::user()->role == 'admin')
                    <div class="col-2 pl-0">
                        @include('editor.dish_modal', $menus)
                    </div>
                @endif
                <div class="clearfix"></div>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Categorie</th>
                        <th>Titel</th>
                        <th>Info</th>
                        <th>Prijs</th>
                        <th>Prijs2</th>
                        {{-- <th>Vega</th> --}}
                        {{-- <th>Gluten</th> --}}
                        {{-- <th>Lactose</th> --}}
                        {{-- <th>Saus</th> --}}
                        {{-- <th>Vos logo</th> --}}
                        <th width="200px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr @if ($item->toggle == 1) class="disabled"@endif>
                        <td><b>{{ $item->category($item) }}</b></td>
                        @php
                            $title = $item->title($item->id);
                            $info = $item->info($item->id);
                        @endphp
                        <td>{{ $title->nl }}</td>
                        <td>{!! $info->nl !!}</td>
                        <td>@if($item->price !== '0,00'){{ $item->price }} @endif</td>
                        <td>@if($item->price_large !== '0,00'){{ $item->price_large }}@endif</td>
                        {{-- <td>@if($item->vegan == 1)<i class="fa-solid fa-check"></i>@else<i class="fa-solid fa-xmark"></i>@endif</td> --}}
                        {{-- <td>@if($item->glute == 1)<i class="fa-solid fa-check"></i>@else<i class="fa-solid fa-xmark"></i>@endif</td> --}}
                        {{-- <td>@if($item->lactose == 1)<i class="fa-solid fa-check"></i>@else<i class="fa-solid fa-xmark"></i>@endif</td> --}}
                        {{-- <td>@if($item->sauce == 1)<i class="fa-solid fa-check"></i>@else<i class="fa-solid fa-xmark"></i>@endif</td> --}}
                        {{-- <td>@if($item->vos_image == 1)<i class="fa-solid fa-check"></i>@else<i class="fa-solid fa-xmark"></i>@endif</td> --}}
                        <td>
                            @if ($item->toggle == 1)
                                <a href="{{route( 'toggle' , ['id' => $item->id, 'type' => 'dish'] )}}" type="submit" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                            @else
                                <a href="{{route( 'toggle' , ['id' => $item->id, 'type' => 'dish'] )}}" type="submit" class="btn btn-danger"><i class="fa-solid fa-eye-slash"></i></a>
                            @endif
                            @if (Auth::user()->role == 'editor' || Auth::user()->role == 'admin')
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary changeDishButton" data-toggle="modal" data-target="#changeDish" data-dish-id="{{$item->id}}">
                                    <i class="fa-solid fa-pencil"></i>
                                </button>

                                <a href="{{route( 'duplicate_dish' , ['id' => $item->id] )}}" class="btn btn-success">
                                    <i class="fa-regular fa-copy"></i>
                                </a>
                                {{-- @include('editor.dish_modal_change', ['menus' => $menus, 'item' => $item]) --}}
                            @endif
                            @if (Auth::user()->role == 'admin')
                                <a href="{{route( 'destroy_dish' , ['id' => $item->id] )}}" class="btn btn-danger" onclick="return confirm('Verwijder {{$title->nl}}?')"><i class="fa-solid fa-trash"></i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                    <!-- Modal -->
                    <div class="modal fade changeDishMain" id="changeDish" tabindex="-1" role="dialog" aria-labelledby="changeDishLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="changeDishLabel">Product aanpassen</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </tbody>
            </table>
            {!! $items->pages !!}
        </div>

        @include('layouts.body')
    </body>
</html>
