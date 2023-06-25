<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Product Menus</h2>
    </div>
    <div class="card-body">
        {{-- <nav class="nav flex-colum">
            <a href="{{ url('admin/products/'.$productID.'/edit') }}" class="nav-link">Product Detail</a>
            <a href="{{ url('admin/products/'.$productID.'/images') }}" class="nav-link">Product Images</a>
        </nav> --}}
        <nav class="nav flex-colum">
            <a href="{{ url('admin/products/'.$productID.'/edit') }}" class="nav-link">Product Detail</a>
            @if ($productID == 0)
                <a href="{{ url('admin/products/'.$productID.'/images') }}" class="nav-link text-danger">Product Image (Please fill in the product details first then go to the edit feature)</a>
            @else
                <a href="{{ url('admin/products/'.$productID.'/images') }}" class="nav-link">Product Images</a>
            @endif
        </nav>        
    </div>
</div>