<table style="width: 100%; text-align: center;" class="table table-bordered"
       id="product-table-form">
    <thead style="background-color: #DCF4FC">
    <tr>
        <th scope="col">#STT</th>
        <th scope="col">Tên sản phẩm</th>
        <th scope="col">Tồn kho</th>
        <th scope="col">Giá bán</th>
        <th scope="col">Nhóm hàng</th>
        <th scope="col">Trạng thái</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    @if ($products)
        @foreach($products as $key => $product)
            <tr>
                <td hidden>{{$product->id}}</td>
                <td>{{++$key}}</td>
                <td>{{$product->name}}</td>
                <td hidden>{{$product->image}}</td>
                <td>{{$product->stock}}</td>
                <td>{{number_format($product->price)}} đ</td>
                <td hidden>{{$product->category_id}}</td>
                <td>{{$product->category->name}}</td>
                <td hidden>{{$product->menu_id}}</td>
                <td hidden>{{$product->isPortable}}</td>
                <td hidden>{{$product->active}}</td>
                <td hidden>{{$product->price}}</td>
                <td>
                    <span class="form-check-input changeActive activeProduct {{ ($product->active == 1) ? 'active-style': 'inactive-style' }}" active-id="{{$product->id}}" name="active">
                                            {{ ($product->active == 1) ? 'Đang kinh doanh': 'Ngừng kinh doanh' }}
                                        </span>
                </td>
                <td>
                    <a><i data-id="{{$product->id}}" class="fas fas fa-eye detailProduct"></i></a>
                    <a><i isPortableUpdate="{{$product->isPortable}}"
                          class="fas fa-pencil-alt updateProduct"></i></a>
                    <a><i class="fas fa-trash-alt deleteProduct"></i></a>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
