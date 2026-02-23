<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.head')
    </head>
    <body class="antialiased">

        @include('main.auth')


        <table class="table table-striped table-dark container">
            <thead>
              <tr>
                <th><b>Kaart</b></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach($menu as $card)
                <tr>
                    <td>{{$card->title}}</td>
                    <td>
                        <a href="edit?id={{$card->id}}"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="{{route('toggle', $card->id)}}"><i class="fa-solid fa-eye"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>

          @include('layouts.body')
    </body>
</html>
