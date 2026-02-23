<?php

namespace App\Http\Controllers;

use Request;
use Redirect;
use Carbon\Carbon;
use App\Models\Menu;
use App\Models\MenuNl;
use App\Models\MenuEn;
use App\Models\MenuDe;
use App\Models\Course;
use App\Models\CourseNl;
use App\Models\CourseEn;
use App\Models\CourseDe;
use App\Models\SubCourse;
use App\Models\SubCourseNl;
use App\Models\SubCourseEn;
use App\Models\SubCourseDe;
use App\Models\Label;
use App\Traits\FunctionsTrait;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    use FunctionsTrait;

    /**
     * View/Edit the Menu categories.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function category_view(Request $request)
    {
        $request = (object) $request::all();
        if (!isset($request->menu)) {
            $request->menu = null;
        }
        $menus = Menu::get();
        $items = collect();
        $page = $request->page ?? 1;
        $labels = Label::all();

        if ($request->menu == null) {
            $paginated = $this->pagination($menus, 2, $page);
        } else {
            $paginated = $menus;
        }

        foreach($paginated as $menu) {
            if($menu->title($menu->id)->nl != $request->menu && $request->menu != null) {continue;}
            $menu->type = 'menu';
            $items->add($menu);
            foreach($menu->courses as $courses) {
                if ($menu->toggle == 1) {
                    $courses->parent_toggle = 1;
                }
                $courses->type = 'courses';
                $items->add($courses);
                foreach($courses->sub_courses as $sub_courses) {
                    if ($courses->toggle == 1 || $courses->parent_toggle == 1) {
                        $sub_courses->parent_toggle = 1;
                    }
                    $sub_courses->type = 'sub_courses';
                    $items->add($sub_courses);
                }
            }
        }

        if ($request->menu == null) {
            $items->pages = $paginated->pages;
        } else {
            $items->pages = $this->pagination($menus, 0, $page);
        }

        return view('editor.category-view', ['items' => $items, 'menus' => $menus, 'current' => $request->menu, 'i' => 0, 'labels' => $labels]);
    }


    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_category(Request $request)
    {
        if ($request::input('category') == '') {

            $file = $request::file('img');
            if ($file != null) {
                $filename = md5($file->getClientOriginalName() . microtime());
                Storage::disk('images')->put($filename, file_get_contents($file->getRealPath()));
            }

            $category = new Menu();
            $category->image = $filename ?? '';
            $category->order = Menu::all()->count() + 1;
            $category->save();

            $translation = new MenuNl();
            $translation->menu_id = $category->id;
            $translation->title = $request::input('title');
            $translation->sub_title = $request::input('sub_title');
            $translation->save();

            $translation = new MenuEn();
            $translation->menu_id = $category->id;
            $translation->title = $request::input('title_en');
            $translation->sub_title = $request::input('sub_title_en');
            $translation->save();

            $translation = new MenuDe();
            $translation->menu_id = $category->id;
            $translation->title = $request::input('title_de');
            $translation->sub_title = $request::input('sub_title_de');
            $translation->save();

        } else {
            $id = explode(',',$request::input('category'))[0];
            $type = explode(',',$request::input('category'))[1];

            switch ($type) {
                case 'menu':
                    $file = $request::file('img');
                    if ($file != null) {
                        $filename = md5($file->getClientOriginalName() . microtime());
                        Storage::disk('images')->put($filename, file_get_contents($file->getRealPath()));
                    }

                    $category = new Course();
                    $category->menu_id = $id;
                    $category->image = $filename ?? '';
                    $category->order = Course::where('menu_id', '=', $id)->count() + 1;
                    $category->save();

                    $translation = new CourseNl();
                    $translation->course_id = $category->id;
                    $translation->title = $request::input('title');
                    $translation->sub_title = $request::input('sub_title');
                    $translation->save();

                    $translation = new CourseEn();
                    $translation->course_id = $category->id;
                    $translation->title = $request::input('title_en');
                    $translation->sub_title = $request::input('sub_title_en');
                    $translation->save();

                    $translation = new CourseDe();
                    $translation->course_id = $category->id;
                    $translation->title = $request::input('title_de');
                    $translation->sub_title = $request::input('sub_title_de');
                    $translation->save();
                    break;
                case 'courses':
                    $file = $request::file('img');
                    if ($file != null) {
                        $filename = md5($file->getClientOriginalName() . microtime());
                        Storage::disk('images')->put($filename, file_get_contents($file->getRealPath()));
                    }

                    $category = new SubCourse();
                    $category->course_id = $id;
                    $category->image = $filename ?? '';
                    $category->order = SubCourse::where('course_id', '=', $id)->count() + 1;
                    $category->save();

                    $translation = new SubCourseNl();
                    $translation->sub_course_id = $category->id;
                    $translation->title = $request::input('title');
                    $translation->sub_title = $request::input('sub_title');
                    $translation->text_small = $request::input('text_small');
                    $translation->text_large = $request::input('text_large');
                    $translation->save();

                    $translation = new SubCourseEn();
                    $translation->sub_course_id = $category->id;
                    $translation->title = $request::input('title_en');
                    $translation->sub_title = $request::input('sub_title_en');
                    $translation->text_small = $request::input('text_small_en');
                    $translation->text_large = $request::input('text_large_en');
                    $translation->save();

                    $translation = new SubCourseDe();
                    $translation->sub_course_id = $category->id;
                    $translation->title = $request::input('title_de');
                    $translation->sub_title = $request::input('sub_title_de');
                    $translation->text_small = $request::input('text_small_de');
                    $translation->text_large = $request::input('text_large_de');
                    $translation->save();
                    break;
            }
        }

        return Redirect::back();
    }


    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function change_category($id, $type, Request $request)
    {
        switch ($type) {
            case 'menu':
                $file = $request::file('img');
                $menu = Menu::where('id', '=', $id)->first();

                if ($request::input('img-remove') == 'true') {
                    Storage::disk('images')->delete($menu->image);
                    $menu->image = '';
                }

                if ($file != null) {
                    Storage::disk('images')->delete($menu->image);

                    $filename = md5($file->getClientOriginalName() . microtime());
                    Storage::disk('images')->put($filename, file_get_contents($file->getRealPath()));
                    $menu->image = $filename;
                }

                $menu->labels()->sync($request::input('labels'));
                $menu->save();

                $category = MenuNl::where('menu_id', '=', $id)->first();
                $category->title = $request::input('title');
                $category->sub_title = $request::input('sub_title');
                $category->save();

                $category = MenuEn::where('menu_id', '=', $id)->first();
                $category->title = $request::input('title_en');
                $category->sub_title = $request::input('sub_title_en');
                $category->save();

                $category = MenuDe::where('menu_id', '=', $id)->first();
                $category->title = $request::input('title_de');
                $category->sub_title = $request::input('sub_title_de');
                $category->save();
                break;
            case 'courses':
                $file = $request::file('img');
                $course = Course::where('id', '=', $id)->first();

                if ($request::input('img-remove') == 'true') {
                    Storage::disk('images')->delete($course->image);
                    $course->image = '';
                }

                if ($file != null) {
                    Storage::disk('images')->delete($course->image);

                    $filename = md5($file->getClientOriginalName() . microtime());
                    Storage::disk('images')->put($filename, file_get_contents($file->getRealPath()));
                    $course->image = $filename;
                }
                $course->save();

                $category = CourseNl::where('course_id', '=', $id)->first();
                $category->title = $request::input('title');
                $category->sub_title = $request::input('sub_title');
                $category->save();

                $category = CourseEn::where('course_id', '=', $id)->first();
                $category->title = $request::input('title_en');
                $category->sub_title = $request::input('sub_title_en');
                $category->save();

                $category = CourseDe::where('course_id', '=', $id)->first();
                $category->title = $request::input('title_de');
                $category->sub_title = $request::input('sub_title_de');
                $category->save();
                break;
            case 'sub_courses':
                $file = $request::file('img');
                $sub_course = SubCourse::where('id', '=', $id)->first();

                if ($request::input('img-remove') == 'true') {
                    Storage::disk('images')->delete($sub_course->image);
                    $sub_course->image = '';
                }

                if ($file != null) {
                    Storage::disk('images')->delete($sub_course->image);

                    $filename = md5($file->getClientOriginalName() . microtime());
                    Storage::disk('images')->put($filename, file_get_contents($file->getRealPath()));
                    $sub_course->image = $filename;
                }
                $sub_course->save();

                $category = SubCourseNl::where('sub_course_id', '=', $id)->first();
                $category->title = $request::input('title');
                $category->sub_title = $request::input('sub_title');
                $category->text_small = $request::input('text_small');
                $category->text_large = $request::input('text_large');
                $category->save();

                $category = SubCourseEn::where('sub_course_id', '=', $id)->first();
                $category->title = $request::input('title_en');
                $category->sub_title = $request::input('sub_title_en');
                $category->text_small = $request::input('text_small_en');
                $category->text_large = $request::input('text_large_en');
                $category->save();

                $category = SubCourseDe::where('sub_course_id', '=', $id)->first();
                $category->title = $request::input('title_de');
                $category->sub_title = $request::input('sub_title_de');
                $category->text_small = $request::input('text_small_de');
                $category->text_large = $request::input('text_large_de');
                $category->save();
                break;
        }

        return Redirect::back();
    }


    public function duplicate_category($id, $type)
    {
        switch ($type) {
            // case 'menu':
            //     $menu = Menu::where('id', '=', $id)->first();
            //     $newMenu = $menu->replicate();
            //     $newMenu->order = Menu::count() + 1;
            //     $newMenu->image = '';
            //     $newMenu->toggle = 1;
            //     $newMenu->created_at = Carbon::now();
            //     $newMenu->save();

            //     $MenuNl = MenuNl::where('menu_id', '=', $id)->first();
            //     $newMenu = $MenuNl->replicate();
            //     $newMenuNl->menu_id = $newMenu->id;
            //     $newMenuNl->title = $newMenuNl->title.'(kopie)';
            //     $newMenuNl->created_at = Carbon::now();
            //     $newMenuNl->save();

            //     $MenuEn = MenuEn::where('menu_id', '=', $id)->first();
            //     $newMenu = $MenuEn->replicate();
            //     $newMenuEn->menu_id = $newMenu->id;
            //     $newMenuEn->title = $newMenuEn->title.'(kopie)';
            //     $newMenuEn->created_at = Carbon::now();
            //     $newMenuEn->save();

            //     $MenuDe = MenuDe::where('menu_id', '=', $id)->first();
            //     $newMenu = $MenuDe->replicate();
            //     $newMenuDe->menu_id = $newMenu->id;
            //     $newMenuDe->title = $newMenuDe->title.'(kopie)';
            //     $newMenuDe->created_at = Carbon::now();
            //     $newMenuDe->save();
            //     break;
            // case 'courses':
            //     $course = Course::where('id', '=', $id)->first();
            //     $newCourse = $course->replicate();
            //     $newCourse->order = Course::count() + 1;
            //     $newCourse->image = '';
            //     $newCourse->toggle = 1;
            //     $newCourse->created_at = Carbon::now();
            //     $newCourse->save();

            //     $courseNl = CourseNl::where('course_id', '=', $id)->first();
            //     $newCourseNl = $courseNl->replicate();
            //     $newCourseNl->course_id = $newCourse->id;
            //     $newCourseNl->title = $newCourseNl->title.'(kopie)';
            //     $newCourseNl->created_at = Carbon::now();
            //     $newCourseNl->save();

            //     $courseEn = CourseEn::where('course_id', '=', $id)->first();
            //     $newCourseEn = $courseEn->replicate();
            //     $newCourseEn->course_id = $newCourse->id;
            //     $newCourseEn->title = $newCourseEn->title.'(kopie)';
            //     $newCourseEn->created_at = Carbon::now();
            //     $newCourseEn->save();

            //     $courseDe = CourseDe::where('course_id', '=', $id)->first();
            //     $newCourseDe = $courseDe->replicate();
            //     $newCourseDe->course_id = $newCourse->id;
            //     $newCourseDe->title = $newCourseDe->title.'(kopie)';
            //     $newCourseDe->created_at = Carbon::now();
            //     $newCourseDe->save();
            //     break;
            case 'sub_courses':
                $subCourse = SubCourse::where('id', '=', $id)->first();
                $newSubCourse = $subCourse->replicate();
                $newSubCourse->order = SubCourse::count() + 1;
                $newSubCourse->image = '';
                $newSubCourse->toggle = 1;
                $newSubCourse->created_at = Carbon::now();
                $newSubCourse->save();

                $subCourseNl = SubCourseNl::where('sub_course_id', '=', $id)->first();
                $newSubCourseNl = $subCourseNl->replicate();
                $newSubCourseNl->sub_course_id = $newSubCourse->id;
                $newSubCourseNl->title = $newSubCourseNl->title.'(kopie)';
                $newSubCourseNl->created_at = Carbon::now();
                $newSubCourseNl->save();

                $subCourseEn = SubCourseEn::where('sub_course_id', '=', $id)->first();
                $newCourseEn = $subCourseEn->replicate();
                $newCourseEn->sub_course_id = $newSubCourse->id;
                $newCourseEn->title = $newCourseEn->title.'(kopie)';
                $newCourseEn->created_at = Carbon::now();
                $newCourseEn->save();

                $subCourseDe = SubCourseDe::where('sub_course_id', '=', $id)->first();
                $newCourseDe = $subCourseDe->replicate();
                $newCourseDe->sub_course_id = $newSubCourse->id;
                $newCourseDe->title = $newCourseDe->title.'(kopie)';
                $newCourseDe->created_at = Carbon::now();
                $newCourseDe->save();
                break;
        }

        return Redirect::back();
    }


    /**
     * Store a newly created dish in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy_category($id, $type)
    {
        switch ($type) {
            case 'menu':
                Menu::destroy($id);
                MenuNl::where('menu_id', '=', $id)->delete();
                MenuEn::where('menu_id', '=', $id)->delete();
                MenuDe::where('menu_id', '=', $id)->delete();
                break;
            case 'courses':
                Course::destroy($id);
                CourseNl::where('course_id', '=', $id)->delete();
                CourseEn::where('course_id', '=', $id)->delete();
                CourseDe::where('course_id', '=', $id)->delete();
                break;
            case 'sub_courses':
                SubCourse::destroy($id);
                SubCourseNl::where('sub_course_id', '=', $id)->delete();
                SubCourseEn::where('sub_course_id', '=', $id)->delete();
                SubCourseDe::where('sub_course_id', '=', $id)->delete();
                break;
        }

        return Redirect::back();
    }
}
