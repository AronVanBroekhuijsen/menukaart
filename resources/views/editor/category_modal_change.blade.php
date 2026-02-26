<!-- Button trigger modal -->
<button type="button" class="btn btn-primary change-category" data-toggle="modal" data-target="#changeCategory{{$i}}">
    <i class="fa-solid fa-pencil"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="changeCategory{{$i}}" tabindex="-1" role="dialog" aria-labelledby="changeCategory{{$i}}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeCategoryLabel">Category aanpassen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  id="changeCategory" action="{{route('change_category', ['id' => $category->id, 'type' => $category->type])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    @php
                        $title = $category->title($category->id);
                        $sub_title = $category->sub_title($category->id);
                        if ($category->type == 'sub_courses') {
                            $text_small = $category->text_small($category->id);
                            $text_large = $category->text_large($category->id);
                        }
                    @endphp
                    <div class="form-group">
                        <label for="img" class="form-label">Image</label>
                        <input name="img" id="img" type="file" accept="image/*" class="form-control">
                        @if ($item->image)
                            <img src="{{ asset('storage/images/uploaded/'. $item->image) }}" width="200px">
                            <div class="btn btn-danger remove-img">remove</div>
                            <input name="img-remove" type="hidden" value="false">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="title" class="form-label">Titel</label>
                        <input name="title" id="title" value="{{$title->nl}}" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="sub_title" class="form-label">Info</label>
                        <input name="sub_title" id="sub_title" value="{{$sub_title->nl}}" type="text" class="form-control" onchange="updateRequirementsCategory();">
                    </div>
                    @if ($category->type == 'sub_courses')
                    <div class="form-group">
                        <label for="text_small" class="form-label">Text Klein</label>
                        <input name="text_small" id="text_small" value="{{$text_small->nl}}" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="text_large" class="form-label">Text Groot</label>
                        <input name="text_large" id="text_large" value="{{$text_large->nl}}" type="text" class="form-control">
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="title_en" class="form-label">Titel Engels</label>
                        <input name="title_en" id="title_en" value="{{$title->en}}" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="sub_title_en" class="form-label">Info Engels</label>
                        <input name="sub_title_en" id="sub_title_en" value="{{$sub_title->en}}" type="text" class="form-control">
                    </div>
                    @if ($category->type == 'sub_courses')
                    <div class="form-group">
                        <label for="text_small_en" class="form-label">Text Klein Engels</label>
                        <input name="text_small_en" id="text_small_en" value="{{$text_small->en}}" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="text_large_en" class="form-label">Text Groot Engels</label>
                        <input name="text_large_en" id="text_large_en" value="{{$text_large->nl}}" type="text" class="form-control">
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="title_de" class="form-label">Titel Duits</label>
                        <input name="title_de" id="title_de" value="{{$title->de}}" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="sub_title_de" class="form-label">Info Duits</label>
                        <input name="sub_title_de" id="sub_title_de" value="{{$sub_title->de}}" type="text" class="form-control">
                    </div>
                    @if ($category->type == 'sub_courses')
                    <div class="form-group">
                        <label for="text_small_de" class="form-label">Text Klein Duits</label>
                        <input name="text_small_de" id="text_small_de" value="{{$text_small->de}}" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="text_large_de" class="form-label">Text Groot Duits</label>
                        <input name="text_large_de" id="text_large_de" value="{{$text_large->de}}" type="text" class="form-control">
                    </div>
                    @endif

                        <div class="row m-0">
                            <div for="date_label" class="form-label col-12 p-0">Selecteer datum label</div>
                            <hr class="w-100">
                            @foreach ($labels as $label)
                                <div class="form-switch custom-check col-6">
                                    <label for="{{$label->name}}" class="form-label">{{$label->name}}</label>
                                    <input name="labels[]" value="{{$label->id}}" @checked(($category->type === 'menu' && $label->menus->contains($item->id)) ||($category->type === 'courses' && $label->course->contains($item->id)) ||($category->type === 'sub_courses' && $label->subcourse->contains($item->id))) id="{{$label->name}}" type="checkbox" class="form-check-input">
                                </div>
                            @endforeach
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
