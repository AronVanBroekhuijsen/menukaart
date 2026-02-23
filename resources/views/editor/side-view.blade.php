<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.head')
    </head>
    <body class="antialiased">

        @include('main.auth')

        <div class="container crud-table p-3">
            <div class="form-group row">
                @if (Auth::user()->role == 'editor' || Auth::user()->role == 'admin')
                    <div class="col-6">
                        @include('editor.side_info', ['side_info' => $side_info])
                    </div>
                @endif
                @if (Auth::user()->role == 'editor' || Auth::user()->role == 'admin')
                    <div class="col-6">
                        @include('editor.side_modal')
                    </div>
                @endif
                <div class="clearfix"></div>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Titel</th>
                        <th width="200px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sides_view as $side)
                        <tr @if ($side->toggle == 1) class="disabled"@endif>
                            @php
                                $title = $side->title($side->id);
                            @endphp
                            <td>{{ $title->nl }}</td>
                            <td>
                                @if ($side->toggle == 1)
                                    <a href="{{route( 'toggle' , ['id' => $side->id, 'type' => 'side'] )}}" type="submit" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                                @else
                                    <a href="{{route( 'toggle' , ['id' => $side->id, 'type' => 'side'] )}}" type="submit" class="btn btn-danger"><i class="fa-solid fa-eye-slash"></i></a>
                                @endif
                                @if (Auth::user()->role == 'editor' || Auth::user()->role == 'admin')
                                    @include('editor.side_modal_change', ['side' => $side])
                                @endif
                                @if (Auth::user()->role == 'admin')
                                    <a href="{{route( 'destroy_side' , ['id' => $side->id] )}}" type="submit" class="btn btn-danger" onclick="return confirm('Verwijder {{$title->nl}}?')"><i class="fa-solid fa-trash"></i></a>
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
