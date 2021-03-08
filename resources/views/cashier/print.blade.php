<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
</head>
<body>
<div class="hot_product" style="width: 80%; margin: auto">
    <h2 class="section-title mb-2 h1" style="text-align: center">Cafe Q&N</h2>
    <div class="row">
        <div class="col-md-12">
            <div class="heading">
                <div class="heading-title">
                    <h3>Địa chỉ: 28 Nguyễn Tri Phương, TP Huế</h3>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="heading">
                <div class="heading-title">
                    <h3>Số điện thoại: 0912.867.762</h3>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="heading">
                <div class="heading-title">
                    <h3>Ngày tháng: {{$order->check_out}}</h3>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="row">
            <div class="col-md-6">
                <strong style="font-size: 20px; font-style: italic">Cảm ơn quí khách và hẹn gặp lại !!!</strong> &ensp;
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <table style="width: 100%; text-align: center;" class="table table-bordered">
        <thead style="background-color: #DCF4FC">
        <tr>
            <th>Số thứ tự</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng </th>
            <th>Đơn giá</th>
            <th>Tổng</th>
        </tr>
        </thead>
        <tbody>
        <p hidden>{{$totalQty = 0}}</p>
        @foreach($order->products as $key => $item)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->pivot->quantity}}</td>
                <td>{{number_format($item->pivot->priceEach)}} đ</td>
                <td>{{number_format($item->pivot->total)}} đ</td>
                <p hidden>{{$totalQty += $item->pivot->quantity}}</p>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<table class="table-order-detail" style="float: right">
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
    <tr>
        <td><a style="background-color: yellowgreen; padding: 10px; border-radius: 5px" href="{{route('orders.index')}}" onclick="window.print()">In hóa đơn</a></td>
    </tr>
    </tbody>
</table>
</body>
</html>
