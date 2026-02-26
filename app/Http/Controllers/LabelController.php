<?php

namespace App\Http\Controllers;

use App\Models\MenuNl;
use Request;
use Redirect;
use App\Models\Label;
use App\Models\Dish;
use App\Models\Menu;
use App\Models\Course;
use App\Models\SubCourse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

Carbon::setTestNow(Carbon::parse('2026/02/21'));
$current = Carbon::now()->dayOfWeek();
dd($current);

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



        $alltoggle= [
            'menu_toggle' => ['model' => Menu::class, 'name' => 'menu'],
            'course_toggle' => ['model' => Course::class, 'name' => 'course'],
            'sub_course_toggle' => ['model' => SubCourse::class, 'name' => 'sub_course'],
            'dish_toggle' => ['model' => Dish::class, 'name' => 'dish'],
            ];

        foreach ($alltoggle as $togglename => $data) {
            if ($request::input($togglename) == 'on') {
                $model = $data['model'];
                $name = $data['name'];

                foreach ($model::all() as $$name) {
                    $collection = [];
                    foreach ($$name->labels as $old_label) {
                        $collection[$old_label['id']] = $model === Dish::class
                            ? ['price' => str_replace(',', '.', $$name->price)]
                            : [];
                    }
                    $collection[$label->id] = $model === Dish::class
                        ? ['price' => str_replace(',', '.', $$name->price)]
                        : [];
                    $$name->labels()->sync($collection);
                    $$name->save();
                }
            }
        }


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

    public function label_toggle($id)
    {

    }

    public function destroy_label($id)
    {
        $label = Label::findOrFail($id);
        $relations = ['menus', 'course', 'subcourse', 'dishes'];

        foreach ($relations as $relation) {
            $label->$relation()->wherePivot('label_id', $label->id)->detach();
        }

        Label::destroy($id);

        return Redirect::back();
    }
}
