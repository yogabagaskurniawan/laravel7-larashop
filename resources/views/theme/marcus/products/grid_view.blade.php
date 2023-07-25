

<div class="row">
    @forelse ($products as $product)
        @include('theme.marcus.products.grid_box')
    @empty
    <div class="col-lg-4 mr-3">
        <p style="margin-left: 20px">No product found!</p>
    </div>
    @endforelse
</div>