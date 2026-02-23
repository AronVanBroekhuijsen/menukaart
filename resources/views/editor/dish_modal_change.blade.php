<form  id="changeDish_{{$item->id}}" action="{{route('change_dish', ['id' => $item->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body row">
                    <div class="col-12 row p-3">
                        <div class="form-group col-11 select-view">
                            @include('editor.dish_category_select')
                            @if($item->product_id[0] != '' && $item->product_id[0] != '0')
                                @include('editor.dish_product_select')
                            @endif
                        </div>
                        <div class="form-switch custom-check col-1">
                            <label for="join_product" class="form-label">Bij product</label>
                            <input name="join_product" @if($item->product_id[0] != '' && $item->product_id[0] != '0') checked value="true"@else value="false"@endif id="join_product" type="checkbox" class="change_join_product form-check-input">
                        </div>
                        <div class="form-group">
                            <label for="img" class="form-label">Image</label>
                            <input name="img" id="img" type="file" accept="image/*" class="form-control">
                            @if ($item->image)
                                <img src="{{ asset('storage/images/uploaded/'. $item->image) }}" width="200px">
                                <div class="btn btn-danger remove-img">remove</div>
                                <input name="img-remove" type="hidden" value="false">
                            @endif
                        </div>
                    </div>
                    <div class="col-4">
                        @php
                            $title = $item->title($item->id);
                            $info = $item->info($item->id);
                            $big_description = $item->big_description($item->id);
                        @endphp
                        <div class="form-group">
                            <label for="title" class="form-label">Titel</label>
                            <input name="title" id="title" value="{{$title->nl}}" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="info" class="form-label">Info</label>
                            <textarea name="info" id="info">{{$info->nl}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="big_description" class="form-label">Extra info</label>
                            <textarea name="big_description" id="big_description">{{$big_description->nl}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="price" class="form-label">Prijs</label>
                            <input name="price" id="price" @if(str_replace(',', '.', $item->price) !== 0) value="{{str_replace(',', '.', $item->price)}}" @endif type="number" step=".01" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="price_large" class="form-label">Prijs 2</label>
                            <input name="price_large" id="price_large"  @if(str_replace(',', '.', $item->price_large) !== 0) value="{{str_replace(',', '.', $item->price_large)}}" @endif type="number" step=".01" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="beer_id" class="form-label">Bier</label>
                            <select name="beer_id" class="form-control dish-category-select">
                                <option value="">Geen bier</option>
                                @foreach($beers as $beer)
                                    @foreach($beer->dishes as $beer)
                                        <option value="{{$beer->id}}" @if ($beer->title($beer->id) == $item->beer_id) selected @endif class="optionParent">{{$beer->title($beer->id)->nl}}</option>
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
                                        <option value="{{$wine->id}}" @if ($wine->title($wine->id) == $item->wine_id) selected @endif class="optionParent">{{$wine->title($wine->id)->nl}}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="title_en" class="form-label">Titel Engels</label>
                            <input name="title_en" id="title_en" value="{{$title->en}}" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="info_en" class="form-label">Info Engels</label>
                            <textarea name="info_en" id="info_en">{{$info->en}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="big_description_en" class="form-label">Extra info Engels</label>
                            <textarea name="big_description_en" id="big_description_en">{{$big_description->en}}</textarea>
                        </div>
                        <div class="form-switch custom-check">
                            <label for="vegan" class="form-label">Vega</label>
                            <input type="hidden"  name="vegan" value="0" >
                            <input name="vegan" value="1" @if ($item->vegan == 1) checked @endif id="vegan" type="checkbox" class="form-check-input">
                        </div>
                        <div class="form-switch custom-check">
                            <label for="glute" class="form-label">Gluten vrij</label>
                            <input type="hidden"  name="glute" value="0" >
                            <input name="glute" value="1" @if ($item->glute == 1) checked @endif id="glute" type="checkbox" class="form-check-input">
                        </div>
                        <div class="form-switch custom-check">
                            <label for="lactose" class="form-label">Lactose intolerant</label>
                            <input type="hidden"  name="lactose" value="0" >
                            <input name="lactose" value="1" @if ($item->lactose == 1) checked @endif id="lactose" type="checkbox" class="form-check-input">
                        </div>
                        <div class="form-switch custom-check">
                            <label for="sauce" class="form-label">Saus</label>
                            <input type="hidden"  name="sauce" value="0" >
                            <input name="sauce" value="1" @if ($item->sauce == 1) checked @endif id="sauce" type="checkbox" class="form-check-input">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="title_de" class="form-label">Titel Duits</label>
                            <input name="title_de" id="title_de" value="{{$title->de}}" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="info_de" class="form-label">Info Duits</label>
                            <textarea name="info_de" id="info_de">{{$info->de}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="big_description_de" class="form-label">Extra info Duits</label>
                            <textarea name="big_description_de" id="big_description_de">{{$big_description->de}}</textarea>
                        </div>
                        <div class="form-switch custom-check">
                            <label for="vos_image" class="form-label">Vos Logo</label>
                            <input type="hidden"  name="vos_image" value="0">
                            <input name="vos_image" value="1" @if ($item->vos_image == 1) checked @endif id="vos_image" type="checkbox" class="form-check-input">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>

