<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.head')
    </head>
    <body class="antialiased">

        @include('main.auth')

        <div class="container crud-table p-3">
            <form  id="saveSettings" action="{{route('save_settings')}}" method="post">
                @csrf
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="col-3">Instellingen</th>
                            <th class="col-7"></th>
                            <th><button href="" type="submit" class="btn btn-success w-100">Opslaan</i></button></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Drankenkaart</td>
                            <td>
                                <div class="form-group">
                                    <select name="drinkmenu" class="form-control settings-select">
                                        <option value="">Geen category</option>
                                        @foreach($menus as $menu)
                                            <option value="{{$menu->id}}" @if($menu->id == $settings->drinkmenu)selected @endif class="optionParent">{{$menu->title($menu->id)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Wijn</td>
                            <td>
                                <div class="form-group">
                                    <select name="wine_category" class="form-control settings-select">
                                        <option value="">Geen category</option>
                                        @foreach($menus as $menu)
                                            @foreach($menu->courses as $courses)
                                                <option value="{{$courses->id}}" @if($courses->id == $settings->wine)selected @endif class="optionParent">{{$courses->title($courses->id)}}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Bier</td>
                            <td>
                                <div class="form-group">
                                    <select name="beer_category" class="form-control settings-select">
                                        <option value="">Geen category</option>
                                        @foreach($menus as $menu)
                                            @foreach($menu->courses as $courses)
                                                <option value="{{$courses->id}}" @if($courses->id == $settings->beer)selected @endif class="optionParent">{{$courses->title($courses->id)}}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Cocktail bar</td>
                            <td>
                                <div class="form-group">
                                    <select name="cocktailmenu" class="form-control settings-select">
                                        <option value="">Geen category</option>
                                        @foreach($menus as $menu)
                                            <option value="{{$menu->id}}" @if($menu->id == $settings->cocktailmenu)selected @endif class="optionParent">{{$menu->title($menu->id)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Hoofdgerechten</td>
                            <td>
                                <div class="form-group">
                                    <select name="maincourses" class="form-control settings-select">
                                        <option value="">Geen category</option>
                                        @foreach($menus as $menu)
                                            @foreach($menu->courses as $courses)
                                                <option value="{{$courses->id}}" @if($courses->id == $settings->maincourses)selected @endif class="optionParent">{{$courses->title($courses->id)}}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>

        @include('layouts.body')
    </body>
</html>
