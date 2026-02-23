<!-- Button trigger modal -->
<button type="button" class="btn btn-success col-12 add-dish" data-toggle="modal" data-target="#addDish">
    Product toevoegen
</button>

<!-- Modal -->
<div class="modal fade" id="addDish" tabindex="-1" role="dialog" aria-labelledby="addDishLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductLabel">Product toevoegen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addDish" action="{{route('add_dish')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body row">
                    <div class="col-12 row p-3">
                        <div class="form-group col-11 select-view">
                            <label for="category" class="form-label">Categorie</label>
                            <select name="category" class="form-control dish-category-select" required>
                                <option value="">Geen category</option>
                                @foreach($menus as $menu)
                                    @foreach($menu->courses as $courses)
                                        @foreach($courses->sub_courses as $sub_courses)
                                            <option value="{{$sub_courses->id}}" class="optionParent">{{$sub_courses->title($sub_courses->id)}}</option>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="form-switch custom-check col-1">
                            <label for="join_product" class="form-label">Bij product</label>
                            <input name="join_product" value="false" id="join_product" type="checkbox" class="join_product form-check-input">
                        </div>
                        <div class="form-group">
                            <label for="img" class="form-label">Image</label>
                            <input name="img" id="img" type="file" accept="image/*" class="form-control">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="title" class="form-label">Titel</label>
                            <input name="title" id="title" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="info" class="form-label">Info</label>
                            <textarea name="info" id="info"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="big_description" class="form-label">Extra info</label>
                            <textarea name="big_description" id="big_description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="price" class="form-label">Prijs</label>
                            <input name="price" id="price" type="number" step=".01" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="price_large" class="form-label">Prijs 2</label>
                            <input name="price_large" id="price_large" type="number" step=".01" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="beer_id" class="form-label">Bier</label>
                            <select name="beer_id" class="form-control dish-category-select">
                                <option value="">Geen bier</option>
                                @foreach($beers as $beer)
                                    @foreach($beer->dishes as $beer)
                                        <option value="{{$beer->id}}" class="optionParent">{{$beer->title($beer->id)->nl}}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="wine_id" class="form-label">Wijn</label>
                            <select name="wine_id" class="form-control dish-category-select">
                                <option value="">Geen wijn</option>
                                @foreach($wines as $wine)
                                    @foreach($wine->dishes as $wine)
                                        <option value="{{$wine->id}}" class="optionParent">{{$wine->title($wine->id)->nl}}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="title_en" class="form-label">Titel Engels</label>
                            <input name="title_en" id="title_en" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="info_en" class="form-label">Info Engels</label>
                            <textarea name="info_en" id="info_en"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="big_description_en" class="form-label">Extra info Engels</label>
                            <textarea name="big_description_en" id="big_description_en"></textarea>
                        </div>
                        <div class="form-switch custom-check">
                            <label for="vegan" class="form-label">Vega</label>
                            <input type="hidden"  name="vegan" value="0" >
                            <input name="vegan" value="1" id="vegan" type="checkbox" class="form-check-input">
                        </div>
                        <div class="form-switch custom-check">
                            <label for="vegan" class="form-label">Gluten vrij</label>
                            <input type="hidden"  name="glute" value="0" >
                            <input name="glute" value="1" id="glute" type="checkbox" class="form-check-input">
                        </div>
                        <div class="form-switch custom-check">
                            <label for="vegan" class="form-label">Lactose intolerant</label>
                            <input type="hidden"  name="lactose" value="0" >
                            <input name="lactose" value="1" id="lactose" type="checkbox" class="form-check-input">
                        </div>
                        <div class="form-switch custom-check">
                            <label for="sauce" class="form-label">Saus</label>
                            <input type="hidden"  name="sauce" value="0">
                            <input name="sauce" value="1" id="sauce" type="checkbox" class="form-check-input">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="title_de" class="form-label">Titel Duits</label>
                            <input name="title_de" id="title_de" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="info_de" class="form-label">Info Duits</label>
                            <textarea name="info_de" id="info_de"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="big_description_de" class="form-label">Extra info Duits</label>
                            <textarea name="big_description_de" id="big_description_de"></textarea>
                        </div>
                        <div class="form-switch custom-check">
                            <label for="vos_image" class="form-label">Vos Logo</label>
                            <input type="hidden"  name="vos_image" value="0">
                            <input name="vos_image" value="1" id="vos_image" type="checkbox" class="form-check-input">
                        </div>
                        <div class="row m-0">
                            <div for="date_label" class="form-label col-12 p-0">Selecteer datum label</div>
                            <hr class="w-100">
                            @foreach ($labels as $label)
                                <div class="form-switch custom-check col-6">
                                    <label for="{{$label->name}}" class="form-label">{{$label->name}}</label>
                                    <input name="labels[{{$label->id}}][id]" value="{{$label->id}}" checked id="{{$label->name}}" type="checkbox" class="form-check-input">
                                </div>
                                <div class="form-switch col-6">
                                    <label for="{{$label->name}}_price" class="form-label">Prijs</label>
                                    <input name="labels[{{$label->id}}][price]" id="{{$label->name}}_price" type="number" step=".01" class="form-control">
                                </div>
                            @endforeach
                        </div>
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
