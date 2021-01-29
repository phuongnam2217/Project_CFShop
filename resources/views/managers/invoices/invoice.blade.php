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
                <div class="search-name" style="height: 130px">
                    <form action="">
                        <p class="search-name-text">Theo thời gian</p>
                        <div>
                            <input type="checkbox" />
                            <label for="">Ngày</label>
                        </div>
                        <div><input type="checkbox" /> <label for="">Tuần</label></div>
                        <div><input type="checkbox" /> <label for="">Tháng</label></div>
                    </form>
                </div>
                <div class="search-name" style="height: 130px">
                    <form action="">
                        <p class="search-name-text">Trạng thái</p>
                        <div><input type="checkbox" /> <label for="">Đang hoạt động</label></div>
                        <div><input type="checkbox" /> <label for="">Ngừng hoạt động</label></div>
                    </form>
                </div>
            </div>
            <div class="table">
                <div class="subHeader">
                    <div>
                        <h2>Hóa đơn</h2>
                    </div>
                    <div>
                        <!-- Export -->
                        <div class="mybutton">
                            <i class="fas fa-fw fa-file-export"></i> Export
                        </div>

                    </div>
                </div>
                <div class="subTable"></div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#invoices").addClass("active");
        });
    </script>
@endsection


