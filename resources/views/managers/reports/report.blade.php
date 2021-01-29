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
                <div class="search-name" style="height: 160px">
                    <form action="">
                        <p class="search-name-text">Mối quan tâm</p>
                        <div>
                            <input type="checkbox" />
                            <label for="">Hàng hóa</label>
                        </div>
                        <div><input type="checkbox" /> <label for="">Doanh thu</label></div>
                        <div><input type="checkbox" /> <label for="">Lợi nhuận</label></div>
                        <div><input type="checkbox" /> <label for="">Phòng bàn</label></div>
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
                <div class="subTable"></div>
            </div>
        </div>
    </section>

@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#reports").addClass("active");
        });
    </script>
@endsection
