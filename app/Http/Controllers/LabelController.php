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

class LabelController extends Controller
{

    public function label_view(Request $request)
    {
        $labels = Label::all();
        $formData = $this->formdata();

        return view('editor.labels_view', array_merge(['labels' => $labels], $formData));
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
        $label->which_day = json_encode($request::input('repeat_type') === 'add_repeatdaily' ? ['1','2','3','4','5','6','0'] : ($request::input('repeat_days') ?? []));
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
        $label->which_day = json_encode($request::input('repeat_type') === 'change_repeatdaily' ? ['1','2','3','4','5','6','0'] : ($request::input('repeat_days') ?? []));
        $label->save();

        return Redirect::back();
    }

    public function change_label_view($id, Request $request)
    {
        $label = Label::find($id);
        $label->start = Carbon::parse($label->start)->format('Y-m-d');
        $label->end = Carbon::parse($label->end)->format('Y-m-d');

        $formData = $this->formdata();

        $saveddays = json_decode($label->which_day, true) ?? [];

        $alldays = ['1','2','3','4','5','6','0'];
        $daily = !array_diff($alldays, $saveddays);

        $formData['repeats'][0]['checked'] = $daily;
        $formData['repeats'][1]['checked'] = !$daily;

        foreach ($formData['days'] as &$day) {
            $day['selected'] = in_array($day['value'], $saveddays);
        }

        return view('editor.labels_modal_change', array_merge(['label' => $label], $formData));
        $label = $request::input('labels');
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

    public function formdata()
    {
        return [
            'toggles' => [
                ['add_id' => 'add_menu_label_toggle', 'change_id' => 'change_menu_label_toggle', 'name' => 'menu_toggle', 'label' => 'Menu'],
                ['add_id' => 'add_course_label_toggle', 'change_id' => 'change_course_label_toggle', 'name' => 'course_toggle', 'label' => 'Gangen'],
                ['add_id' => 'add_sub_course_label_toggle', 'change_id' => 'change_sub_course_label_toggle', 'name' => 'sub_course_toggle', 'label' => 'Categorieën'],
                ['add_id' => 'add_dish_label_toggle', 'change_id' => 'change_dish_label_toggle', 'name' => 'dish_toggle', 'label' => 'Producten'],
            ],
            'repeats' => [
                ['add_id' => 'add_repeatdaily', 'change_id' => 'change_repeatdaily', 'label' => 'Elke dag', 'checked' => true],
                ['add_id' => 'add_repeatcustom', 'change_id' => 'change_repeatcustom', 'label' => 'Aangepast', 'checked' => false],
            ],
            'days' => [
                ['add_id' => 'add_ma', 'change_id' => 'change_ma', 'label' => 'Ma', 'value' => '1'],
                ['add_id' => 'add_di', 'change_id' => 'change_di', 'label' => 'Di', 'value' => '2'],
                ['add_id' => 'add_wo', 'change_id' => 'change_wo', 'label' => 'Wo', 'value' => '3'],
                ['add_id' => 'add_do', 'change_id' => 'change_do', 'label' => 'Do', 'value' => '4'],
                ['add_id' => 'add_vr', 'change_id' => 'change_vr', 'label' => 'Vr', 'value' => '5'],
                ['add_id' => 'add_za', 'change_id' => 'change_za', 'label' => 'Za', 'value' => '6'],
                ['add_id' => 'add_zo', 'change_id' => 'change_zo', 'label' => 'Zo', 'value' => '0'],
            ],
        ];
    }
}
