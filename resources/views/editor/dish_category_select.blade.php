<label for="category" class="form-label">Categorie</label>
<select name="category" class="form-control dish-category-select" @if($item->product_id[0] == '' || $item->product_id[0] == '0') required @endif>
    <option @if($item->product_id[0] == '' || $item->product_id[0] == '0') value="" @else value="0" @endif >Geen category</option>
    @foreach($menus as $menu)
        @foreach($menu->courses as $courses)
            @foreach($courses->sub_courses as $sub_courses)
                <option value="{{$sub_courses->id}}" @if(isset($item)) @if ($sub_courses->id == $item->sub_course_id) selected @endif @endif class="optionParent">{{$sub_courses->title($sub_courses->id)}}</option>
            @endforeach
        @endforeach
    @endforeach
</select>
