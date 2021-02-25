@extends('managers.layout.master')
@section('content')
    <section class="content">
        <div class="body">
            <div class="home-nav">
                <section id="what-we-do">
                    <div class="container-fluid">
                        <h2 style="margin-top: 20px" class="section-title mb-2 h1">Kết quả bán hàng hôm nay</h2>
                        <div class="row mt-5">
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                <div class="card">
                                    <div class="card-block block-3">
                                        <h3 class="card-title">Đơn hàng</h3>
                                        <p class="card-text">{{$count}} hóa đơn</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                <div class="card">
                                    <div class="card-block block-1">
                                        <h3 class="card-title">Doanh thu</h3>
                                        <p class="card-text">{{number_format($total)}} VNĐ</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                <div class="card">
                                    <div class="card-block block-6">
                                        <h3 class="card-title">Nhập hàng</h3>
                                        <p class="card-text">{{number_format($totalBuy)}} VNĐ</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="hot_product">
                        <h2 class="section-title mb-2 h1">Mặt hàng bán chạy</h2>
                        <table style="width: 80%; text-align: left; margin: auto">
                            <thead style="color: #0076b9; font-size: 25px">
                            <tr>
                                <th>Sản phẩm</th>
                                <th style="float: right">Số lượng bán</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($hotProducts as $key => $hotProduct)
                                <tr style="font-size: 20px">
                                    @foreach($products as $product)
                                        @if($product->id == $hotProduct->product_id)
                                            <td><p>TOP {{$key+1}}: {{$product->name}}</p><img
                                                    style="width: 100px; height: 100px" src="{{$product->image}}"
                                                    alt=""></td>
                                            <td style="float: right">{{$hotProduct->qty}} sản phẩm</td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
                <session>
                    <div class="hot_product">
                        <h2 class="section-title mb-2 h1">Sản phẩm sắp hết tồn kho</h2>
                        <table style="width: 80%; text-align: center; margin: auto;" class="table table-bordered">
                            <thead style="background-color: #DCF4FC">
                            <tr>
                                <th>Mã hàng hóa</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá bán</th>
                                <th>Nhóm hàng</th>
                                <th>Tồn kho còn lại</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($stockProducts as $stockProduct)
                                <tr>
                                    <td>{{$stockProduct->id}}</td>
                                    <td>{{$stockProduct->name}}</td>
                                    <td>{{number_format($stockProduct->price)}} đ</td>
                                    <td>{{$stockProduct->category->name}}</td>
                                    <td style="font-size: 16px; color: red;font-weight: bold">{{$stockProduct->stock}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </session>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        // (2500).toLocaleString('VN', {
        // style: 'currency',
        // currency: 'VND',
        // });
        $(document).ready(function () {
            $("#home").addClass("active");
        });
    </script>
@endsection
