@extends('managers.layout.master')
@section('content')

    <section class="content">
        <div class="body">
            <div class="search">
                <div class="search-name">
                    <form action="">
                        <label for="" class="search-name-text">Tìm kiếm</label>
                        <input type="text" class="input" placeholder="Theo mã, tên hàng, .." />
                    </form>
                </div>
                <div class="search-name" style="height: auto">
                    <form action="">
                        <p class="search-name-text">Mối quan tâm</p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="search" id="1" value="1">
                            <label class="form-check-label" for="1">
                                Trong ngày
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="search" id="2" value="2">
                            <label class="form-check-label" for="2">
                                Trong tuần
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="search" id="3" value="3">
                            <label class="form-check-label" for="3">
                                Trong tháng
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="search" id="0" value="0" checked>
                            <label class="form-check-label" for="0">
                                Tất cả
                            </label>
                        </div>
                    </form>

                </div>
            </div>
            <div class="table">
                <div class="subHeader">
                    <div>
                        <h2>Báo cáo</h2>
                    </div>
                    <div>
                        <!-- Export -->
                        <div class="mybutton">
                            <i class="fas fa-fw fa-file-export"></i> Export
                        </div>
                    </div>
                </div>
                <div class="subTable report__view" id="report-view-ajax">
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
            </div>
        </div>
    </section>

@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#reports").addClass("active");

            //Time Search
            $('input[type="radio"]').click(function () {
                let id = $(this).val();
                $.ajax({
                    type: "get",
                    url: "/reports/time/" + id,
                    success: function (response) {
                        $('#report-view-ajax').html(response.view);
                    },
                    error: function (xhr) {
                        console.log(xhr.responseJSON.message)
                    }
                })
            })
        });
    </script>
@endsection
