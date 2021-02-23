<section id="what-we-do">
    <div class="container-fluid">
        <h2 style="margin-top: 20px; color: #4BAC4D" class="section-title mb-2 h1">Báo cáo bán hàng</h2>
        <div class="row mt-5">
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <div class="card">
                    <div class="card-block block-3">
                        <h3 class="card-title">Đơn hàng</h3>
                        <p class="card-text">{{$count}} đơn hàng</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <div class="card">
                    <div class="card-block block-5">
                        <h3 class="card-title">Sản phẩm</h3>
                        <p class="card-text">{{$countProduct}} sản phẩm</p>
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
                        <p class="card-text">{{number_format($totalBuyProduct)}} VNĐ</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <div class="card">
                    <div class="card-block block-2">
                        <h3 class="card-title">Nguyên liệu</h3>
                        <p class="card-text">{{number_format($totalBuyResource)}} VNĐ</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <div class="card">
                    <div class="card-block block-4">
                        <h3 class="card-title">Lợi nhuận</h3>
                        <p class="card-text">{{number_format($total-$totalBuyProduct-$totalBuyResource)}} VNĐ</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
