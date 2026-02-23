<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.head')
    </head>
    <body class="antialiased">

        @include('main.auth')

        <div class="container crud-table p-3">
            @if (Auth::user()->role == 'editor' || Auth::user()->role == 'admin')
                <div class="form-group row">
                    <div class="">
                        @include('editor.sauce_modal')
                    </div>
                    <div class="clearfix"></div>
                </div>
            @endif

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Titel</th>
                        <th>Prijs</th>
                        <th width="200px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sauces_view as $sauce)
                        <tr @if ($sauce->toggle == 1) class="disabled"@endif>
                            @php
                                $title = $sauce->title($sauce->id);
                            @endphp
                            <td>{{ $title->nl }}</td>
                            <td>{{ $sauce->price }}</td>
                            <td>
                                @if ($sauce->toggle == 1)
                                    <a href="{{route( 'toggle' , ['id' => $sauce->id, 'type' => 'sauce'] )}}" type="submit" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                                @else
                                    <a href="{{route( 'toggle' , ['id' => $sauce->id, 'type' => 'sauce'] )}}" type="submit" class="btn btn-danger"><i class="fa-solid fa-eye-slash"></i></a>
                                @endif
                                @if (Auth::user()->role == 'editor' || Auth::user()->role == 'admin')
                                    @include('editor.sauce_modal_change', ['sauce' => $sauce])
                                @endif
                                @if (Auth::user()->role == 'admin')
                                    <a href="{{route( 'destroy_sauce' , ['id' => $sauce->id] )}}" type="submit" class="btn btn-danger" onclick="return confirm('Verwijder {{$title->nl}}?')"><i class="fa-solid fa-trash"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @include('layouts.body')
    </body>
</html>
