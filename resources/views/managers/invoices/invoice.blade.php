@extends('managers.layout.master')
@section('content')

    <section class="content">
        <div class="body">
            <div class="search">
                <div class="search-name">
                    <form action="">
                        <label for="" class="search-name-text">Tìm kiếm</label>
                        <input type="text" class="input" placeholder="Theo mã, tên hàng, .."/>
                    </form>
                </div>
                <div class="search-name" style="height: 130px">
                    <form action="">
                        <p class="search-name-text">Theo thời gian</p>
                        <div>
                            <input type="checkbox"/>
                            <label for="">Ngày</label>
                        </div>
                        <div><input type="checkbox"/> <label for="">Tuần</label></div>
                        <div><input type="checkbox"/> <label for="">Tháng</label></div>
                    </form>
                </div>
                <div class="search-name" style="height: 130px">
                    <form action="">
                        <p class="search-name-text">Trạng thái</p>
                        <div><input type="checkbox"/> <label for="">Đang hoạt động</label></div>
                        <div><input type="checkbox"/> <label for="">Ngừng hoạt động</label></div>
                    </form>
                </div>
            </div>

{{--            Detail Order--}}
            <div class="modal fade" id="detailOrder" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Chi tiết hàng hóa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body detailOrder">
                            <div>
                                <div>
                                    <span>Tên hàng hóa:</span>
                                    <span id="detailName"></span>
                                </div>
                                <div class="form-group">
                                    <span>Nhóm hàng:</span>
                                    <span id="detailTable_id"></span>
                                </div>
                                <div>
                                    <span>Giá bán:</span>
                                    <span id="detailTotal"></span>
                                </div>
                                <div>
                                    <span>Discount:</span>
                                    <span id="detailDiscount"></span>
                                </div>
                                <div>
                                    <span>Trạng thái:</span>
                                    <span id="detailActive"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
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
                <div class="subTable">
                    <table style="width: 100%; text-align: center;" class="table table-bordered">
                        <thead style="background-color: #DCF4FC">
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Thời gian</th>
                            <th>Bàn</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($orders)
                            @foreach($orders as $order)
                                <tr>
                                    <td>HD0000{{$order->id}}</td>
                                    <td>{{$order->check_in}}</td>
                                    @foreach($tables as $table)
                                        @if($order->table_id == $table->id)
                                            <td>{{$table->name}}</td>
                                        @endif
                                    @endforeach
                                    <td>{{number_format($order->sub_total)}} đ</td>
                                    <td>{{$order->status}}</td>
                                    <td>
                                        <a><i data-id="{{$order->id}}" class="fas fas fa-eye detailOrder"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>

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
@section('ajax')
    <script type="text/javascript">
        $(document).ready(function () {
            $('body').on('click', '.detailOrder', function () {
                let id = $(this).attr('data-id');

                $.ajax({
                    type: 'GET',
                    url: "{{route('invoice.index')}}" + "/" + id,
                    success: function (data) {
                        console.log(data);
                        $('#detailOrder').modal('show');

                        $('#detailName').html(data.order.id);

                        $('#detailTable_id').html(data.order.table_id)
                    },
                    error: function (data) {

                    }
                })
            })
        });
    </script>
@endsection

