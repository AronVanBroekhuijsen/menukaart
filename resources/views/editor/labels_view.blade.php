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
                    <div class="offset-10 col-2 pl-0">
                        @include('editor.labels_modal')
                    </div>
                @endif
                <div class="clearfix"></div>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Start datum</th>
                        <th>Eind datum</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($labels as $label)
                    <tr>
                        <td><b>{{ $label->name }}</b></td>
                        <td>{{ $label->start }}</td>
                        <td>{{ $label->end }}</td>
                        <td>
                            @if (Auth::user()->role == 'editor' || Auth::user()->role == 'admin')
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary changeLabelButton" data-toggle="modal" data-target="#changeLabel" data-label-id="{{$label->id}}">
                                    <i class="fa-solid fa-pencil"></i>
                                </button>
                            @endif
                            @if (Auth::user()->role == 'admin')
                                <a href="{{route( 'destroy_label' , ['id' => $label->id] )}}" class="btn btn-danger" onclick="return confirm('Verwijder {{$label->name}}?')"><i class="fa-solid fa-trash"></i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                    <!-- Modal -->
                    <div class="modal fade changeLabelMain" id="changeLabel" tabindex="-1" role="dialog" aria-labelledby="changeLabelLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="changeLabelLabel">Feestdag aanpassen</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </tbody>
            </table>
        </div>

        @include('layouts.body')
    </body>
</html>
