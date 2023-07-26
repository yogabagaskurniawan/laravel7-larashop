<div class="col-sm-3 col-md-3">
    @if ($categories)
    <div class="weight">
        <div class="title">
            <h2>categories</h2>
        </div>
        <div class="product-categories">
            <ul>
                @foreach ($categories as $category)
                <li><a href="{{ url('products?category='. $category->slug) }}">{{ $category->name }}</a></li> 
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    @if ($categories)
    <div class="weight">
        <div class="title">
            <h2>colors</h2>
        </div>
        <div class="product-categories">
            <ul>
                @foreach ($colors as $color)
                    <li><a href="{{ url('products?option='. $color->id) }}">{{ $color->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    @if ($sizes)
    <div class="weight">
        <div class="title">
            <h2>size filter</h2>
        </div>
        <div class="size">
            <ul>
                @foreach ($sizes as $size)
                    <li><a href="{{ url('products?option='. $size->id) }}">{{ $size->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
</div>