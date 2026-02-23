<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.head')
    </head>
    <body class="antialiased">

        @include('main.auth')

        <div class="container crud-table p-3">
            <div class="form-group row">
                <form action="" class="col-10">
                    <select name="menu" class="form-control custom-select">
                        <option value="">Alles</option>
                        @foreach($menus as $menu)
                            <option value="{{$menu->title($menu->id)->nl}}" @if($menu->title($menu->id)->nl == $current)selected @endif class="optionParent">{{$menu->title($menu->id)->nl}}</option>
                        @endforeach
                    </select>
                </form>

                @if (Auth::user()->role == 'editor' || Auth::user()->role == 'admin')
                    <div class="col-2 pl-0">
                        @include('editor.category_modal', $menus)
                    </div>
                @endif
                <div class="clearfix"></div>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Details</th>
                        <th width="200px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr class="{{$item->type}}@if($item->toggle == 1 || $item->parent_toggle == 1) disabled @endif" >
                        @php
                            $title = $item->title($item->id);
                            $sub_title = $item->sub_title($item->id);
                        @endphp
                        <td><div></div>{{ $title->nl }}</td>
                        <td>{{ $sub_title->nl }}</td>
                        <td>
                        {{-- <a class="btn btn-primary" href=""><i class="fa-solid fa-pencil"></i></a> --}}
                        @if ($item->toggle == 1)
                            <a href="{{route( 'toggle' , ['id' => $item->id, 'type' => $item->type] )}}" type="submit" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                        @else
                            <a href="{{route( 'toggle' , ['id' => $item->id, 'type' => $item->type] )}}" type="submit" class="btn btn-danger"><i class="fa-solid fa-eye-slash"></i></a>
                        @endif
                        @if (Auth::user()->role == 'editor' || Auth::user()->role == 'admin')
                            @include('editor.category_modal_change', ['category' => $item, 'i', $i++])
                        @endif
                        @if (Auth::user()->role == 'admin')
                            <a href="{{route('destroy_category', ['id' => $item->id, 'type' => $item->type])}}" type="submit" class="btn btn-danger" onclick="return confirm('Verwijder {{$title->nl}}?')"><i class="fa-solid fa-trash"></i></a>

                            @if ($item->type == 'sub_courses')
                                <a href="{{route( 'duplicate_category' , ['id' => $item->id, 'type' => $item->type] )}}" class="btn btn-success">
                                    <i class="fa-regular fa-copy"></i>
                                </a>
                            @endif
                        @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $items->pages !!}
        </div>

        @include('layouts.body')
    </body>
</html>
