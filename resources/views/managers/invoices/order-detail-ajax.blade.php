<div class="order-detail">
    <div style="font-size: 20px; font-weight: bold">
        <span>Mã hóa đơn:</span>
        <span>HD0000{{$order->id}}</span>
    </div>
    <div>
        <span>Check in:</span>
        <span>{{$order->check_in}}</span>
    </div>
    <div>
        <span>Check out:</span>
        <span>{{$order->check_out}}</span>
    </div>
</div>
<table style="width: 100%; text-align: center;" class="table table-bordered">
    <thead style="background-color: #DCF4FC">
    <tr>
        <th>Mã hàng</th>
        <th>Tên hàng</th>
        <th>Hình ảnh</th>
        <th>Số lượng</th>
        <th>Đơn giá</th>
        <th>Tổng</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <p hidden>{{$totalQty = 0}}</p>
        @forelse($order->products as $product)
            <td>{{$product->id}}</td>
            <td>{{$product->name}}</td>
            <td>
                            <img style="width: 150px; height: 100px" src="{{$product->image}}" alt="">
            </td>
            <td>{{$product->pivot->quantity}}</td>
            <td>{{number_format($product->pivot->priceEach)}} đ</td>
            <td>{{number_format($product->pivot->total)}} đ</td>
            <p hidden>{{$totalQty += $product->pivot->quantity}}</p>
    </tr>
    @empty
        <tr>
            <td colspan="3">No Information</td>
        </tr>
    @endforelse
    </tbody>
</table>
<table class="table-order-detail">
    <tbody>
    <tr>
        <td style="height:40px">Tổng số lượng:</td>
        <td>{{$totalQty}}</td>
    </tr>
    <tr>
        <td style="height:40px">Tổng tiền:</td>
        <td>{{number_format($order->sub_total)}} đ</td>
    </tr>
    <tr>
        <td style="height:40px">Giảm giá hóa đơn:</td>
        <td>{{$order->discount}} %</td>
    </tr>
    <tr style="font-size: 20px; font-style: italic">
        <td style="height:40px">Thành tiền:</td>
        <td>{{number_format($order->total)}} đ</td>
    </tr>
    </tbody>
</table>
