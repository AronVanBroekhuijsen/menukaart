<?php

namespace App\Http\Controllers;

use Request;
use Redirect;
use App\Models\User;

class UserController extends Controller
{
    public function user_view()
    {
        $users = User::all();

        return view('editor.users', ['users' => $users]);
    }

    public function save_user($id, Request $request)
    {
        $user = User::find($id);
        $user->role = $request::input('user_role');
        $user->save();

        return Redirect::back();
    }

    public function destroy_user($id)
    {
        $user = User::destroy($id);

        return Redirect::back();
    }
}
