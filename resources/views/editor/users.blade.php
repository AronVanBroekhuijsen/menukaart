<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.head')
    </head>
    <body class="antialiased">

        @include('main.auth')

            <div class="container crud-table p-3">
                <div class="form-group row">
                    <div class="col-2 offset-10">
                        <a href="{{route( 'register')}}" type="submit" class="btn btn-success">Nieuwe gebruiker</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Titel</th>
                            <th>Role</th>
                            <th width="200px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <form id="saveUser" action="{{route('save_user', ['id' => $user->id])}}" method="post">
                            @csrf
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>
                                    <select name="user_role" class="form-select">
                                        <option value="user" @if ($user->role == 'user')selected @endif>Gebruiker</option>
                                        <option value="toggler" @if ($user->role == 'toggler')selected @endif>Aan/Uit</option>
                                        <option value="editor" @if ($user->role == 'editor')selected @endif>Bewerker</option>
                                        <option value="admin" @if ($user->role == 'admin')selected @endif>Beheerder</option>
                                    </select>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-check text-white"></i></button>
                                    @if (Auth::user()->role == 'admin')
                                        <a href="{{route( 'destroy_user' , ['id' => $user->id] )}}" type="submit" class="btn btn-danger" onclick="return confirm('Verwijder {{$user->name}}?')"><i class="fa-solid fa-trash"></i></a>
                                    @endif
                                </td>
                            </tr>
                        </form>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @include('layouts.body')
    </body>
</html>
