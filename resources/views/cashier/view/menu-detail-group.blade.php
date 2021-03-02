<div class="product__list tables__list" id="product-category-list">
    @foreach($products as $product)
        <div class="product__item detailProduct" product-id="{{$product->id}}">
            <div style="height: 120px" class="product__img">
                <img style="height: 120px"
                     src="@if($product->getProductImage() == 'https://quangvoc8.s3.amazonaws.com/')
                         https://png.pngtree.com/png-clipart/20190705/original/pngtree-coffee-icon-vector-illustration-in-glyph-style-for-any-purpose-png-image_4258003.jpg
                     @else
                     {{$product->getProductImage()}}
                     @endif" alt=""/>
            </div>
            <div class="product__content">
                <p class="product__name">{{$product->name}}</p>
                <p class="product__price">{{number_format($product->price)}} đ</p>
            </div>
        </div>
    @endforeach
</div>
