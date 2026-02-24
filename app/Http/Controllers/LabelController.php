<?php

namespace App\Http\Controllers;

use Request;
use Redirect;
use App\Models\Label;
use App\Models\Dish;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class LabelController extends Controller
{

    public function label_view(Request $request)
    {
        $labels = Label::all();

        return view('editor.labels_view', ['labels' => $labels]);
        $labels = $request::input('labels');
    }

    public function add_label(Request $request)
    {
        $file = $request::file('img');
        if ($file != null) {
            $filename = md5($file->getClientOriginalName() . microtime());
            Storage::disk('images')->put($filename, file_get_contents($file->getRealPath()));
        }

        $label = new Label();
        $label->name = $request::input('label-name');
        $label->start = Carbon::parse($request::input('start'));
        $label->end = Carbon::parse($request::input('end'))->endOfDay();
        $label->image = $filename ?? '';
        $label->save();

        return Redirect::back();
    }

    public function change_label($id, Request $request)
    {
        $file = $request::file('img');

        $label = Label::find($id);

        if ($file != null) {
            Storage::disk('images')->delete($label->image);

            $filename = md5($file->getClientOriginalName() . microtime());
            Storage::disk('images')->put($filename, file_get_contents($file->getRealPath()));
            $label->image = $filename;
        }

        $label->name = $request::input('label-name');
        $label->start = Carbon::parse($request::input('start'));
        $label->end = Carbon::parse($request::input('end'))->endOfDay();
        $label->save();

        return Redirect::back();
    }

    public function change_label_view($id)
    {
        $label = Label::find($id);
        $label->start = Carbon::parse($label->start)->format('Y-m-d');
        $label->end = Carbon::parse($label->end)->format('Y-m-d');

        $html = view('editor.labels_modal_change', ['label' => $label])->render();

        return $html;
    }

    public function destroy_label($id)
    {
        Label::destroy($id);

        return Redirect::back();
    }
}
