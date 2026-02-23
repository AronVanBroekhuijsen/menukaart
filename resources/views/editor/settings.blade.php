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
                        <tr>
                            <td>Feest dagen</td>
                            <td>
                                <div class="form-group">
                                    <div id="date-range-picker" date-rangepicker class="flex items-center">
                                        <div class="relative">
                                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"/></svg>
                                            </div>
                                            <input id="datepicker-range-start" name="start" type="text" class="block w-full ps-9 pe-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Select date start">
                                        </div>
                                        <span class="mx-4 text-body">to</span>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"/></svg>
                                            </div>
                                            <input id="datepicker-range-end" name="end" type="text" class="block w-full ps-9 pe-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Select date end">
                                        </div>
                                    </div>
                                    {{-- <select name="maincourses" class="form-control settings-select">
                                        <option value="">Geen category</option>
                                        @foreach($menus as $menu)
                                            @foreach($menu->courses as $courses)
                                                <option value="{{$courses->id}}" @if($courses->id == $settings->maincourses)selected @endif class="optionParent">{{$courses->title($courses->id)}}</option>
                                            @endforeach
                                        @endforeach
                                    </select> --}}
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
