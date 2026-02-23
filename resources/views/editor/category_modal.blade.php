<!-- Button trigger modal -->
<button type="button" class="btn btn-success col-12 add-category" data-toggle="modal" data-target="#addCategory">
    Category toevoegen
</button>

<!-- Modal -->
<div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="addCategoryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryLabel">Category toevoegen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  id="addCategory" action="{{route('add_category')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category" class="form-label">Categorie</label>
                        <div class="w-100">
                            <select name="category" class="form-control category-select">
                                <option value="">Geen category</option>
                                @foreach($menus as $menu)
                                    <option value="{{$menu->id}},{{$menu->type}}" class="optionParent">{{$menu->title($menu->id)->nl}}</option>
                                    @foreach($menu->courses as $courses)
                                        <option value="{{$courses->id}},{{$courses->type}}" class="optionParent">{{$courses->title($courses->id)->nl}}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="img" class="form-label">Image</label>
                        <input name="img" id="img" type="file" accept="image/*" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="title" class="form-label">Titel</label>
                        <input name="title" id="title" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="sub_title" class="form-label">Info</label>
                        <input name="sub_title" id="sub_title" type="text" class="form-control">
                    </div>
                    <div class="form-group hide">
                        <label for="text_small" class="form-label">Text Klein</label>
                        <input name="text_small" id="text_small" type="text" class="form-control">
                    </div>
                    <div class="form-group hide">
                        <label for="text_large" class="form-label">Text Groot</label>
                        <input name="text_large" id="text_large" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="title_en" class="form-label">Titel Engels</label>
                        <input name="title_en" id="title_en" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="sub_title_en" class="form-label">Info Engels</label>
                        <input name="sub_title_en" id="sub_title_en" type="text" class="form-control">
                    </div>
                    <div class="form-group hide">
                        <label for="text_small_en" class="form-label">Text Klein Engels</label>
                        <input name="text_small_en" id="text_small_en" type="text" class="form-control">
                    </div>
                    <div class="form-group hide">
                        <label for="text_large_en" class="form-label">Text Groot Engels</label>
                        <input name="text_large_en" id="text_large_en" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="title_de" class="form-label">Titel Duits</label>
                        <input name="title_de" id="title_de" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="sub_title_de" class="form-label">Info Duits</label>
                        <input name="sub_title_de" id="sub_title_de" type="text" class="form-control">
                    </div>
                    <div class="form-group hide">
                        <label for="text_small_de" class="form-label">Text Klein Duits</label>
                        <input name="text_small_de" id="text_small_de" type="text" class="form-control">
                    </div>
                    <div class="form-group hide">
                        <label for="text_large_de" class="form-label">Text Groot</label>
                        <input name="text_large_de" id="text_large_de" type="text" class="form-control">
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
