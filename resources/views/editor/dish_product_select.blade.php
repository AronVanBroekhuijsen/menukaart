<div class="product-select">
    <label for="product" class="form-label pt-2">Product</label>
    <select name="products[]" class="form-control dish-product-select" multiple="multiple" required>
        <option value="">Geen product</option>
        @foreach($dishes as $dish)
            <option value="{{$dish->id}}"  @if(isset($item)) @if(in_array($dish->id, $item->product_id)) selected @endif @endif class="optionParent">{{$dish->title($dish->id)->nl ?? $dish->title($dish->id)}}</option>
        @endforeach
    </select>
</div>
