<div class="product__list tables__list" id="product-category-list">
    @foreach($products as $product)
        <div class="product__item detailProduct" product-id="{{$product->id}}">
            <div style="height: 100px" class="product__img">
                <img src="{{$product->image}}" alt=""/>
            </div>
            <div class="product__content">
                <p class="product__name">{{$product->name}}</p>
                <p class="product__price">{{number_format($product->price)}} đ</p>
            </div>
        </div>
    @endforeach
</div>
