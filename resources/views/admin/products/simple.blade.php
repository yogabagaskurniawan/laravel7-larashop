<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" class="form-control" placeholder="price" value="{{ !empty($product) ? $product->price : '' }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="weight">Weight</label>
            <input type="text" name="weight" class="form-control" placeholder="weight" value="{{ !empty($product) ? $product->weight : '' }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="qty">Qty Inventory</label>
            {{-- <input type="text" name="qty" class="form-control" placeholder="qty" value="{{ !empty($product) ? $product->productInventory->qty : '' }}"> --}}
            <input type="text" name="qty" class="form-control" placeholder="qty" value="{{ !empty($product->productInventory) ? $product->productInventory->qty : '' }}">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="length">Length</label>
            <input type="text" name="length" class="form-control" placeholder="length" value="{{ !empty($product) ? $product->length : '' }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="width">Width</label>
            <input type="text" name="width" class="form-control" placeholder="width" value="{{ !empty($product) ? $product->width : '' }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="height">Height</label>
            <input type="text" name="height" class="form-control" placeholder="height" value="{{ !empty($product) ? $product->height : '' }}">
        </div>
    </div>
</div>
