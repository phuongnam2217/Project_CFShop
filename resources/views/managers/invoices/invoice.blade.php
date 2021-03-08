@extends('managers.layout.master')
@section('content')

    <section class="content">
        <div class="body">
            <div class="search">
                <div class="search-name">
                    <form id="searchform">
                        @csrf
                        <label for="" class="search-name-text">Tìm kiếm</label>
                        <input type="text" id="search" name="search" class="input" placeholder="Theo mã hóa đơn, .."/>
                    </form>
                </div>
                {{--Theo thời gian--}}
                <div class="search-name" style="height: 160px">
                    <p class="search-name-text">Theo thời gian</p>
                    <form action="" id="statusform">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="search" id="1" value="1">
                            <label class="form-check-label" for="1">
                                Ngày
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="search" id="2" value="2">
                            <label class="form-check-label" for="2">
                                Tuần
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="search" id="3" value="3">
                            <label class="form-check-label" for="3">
                                Tháng
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

{{--            Detail Order--}}
            <div class="modal fade" id="detailOrder" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Chi tiết hóa đơn</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body detailOrder" id="order-detail-ajax">

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

                </div>
                <div class="subTable" id="table-order">
                    <table style="width: 100%; text-align: center;" class="table table-bordered">
                        <thead style="background-color: #DCF4FC">
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Thời gian</th>
                            <th>Bàn</th>
                            <th>Tổng tiền</th>
                            <th>Chi tiết</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($orders)
                            @foreach($orders as $order)
                                <tr>
                                    <td>HD0000{{$order->id}}</td>
                                    <td>{{$order->check_out}}</td>
                                    @foreach($tables as $table)
                                        @if($order->table_id == $table->id)
                                            <td>{{$table->name}}</td>
                                        @endif
                                    @endforeach
                                    <td>{{number_format($order->total)}} đ</td>
                                    <td>
                                        <a><i data-id="{{$order->id}}" class="fas fas fa-eye detailOrder"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div style="text-align: center" aria-label="Page Navigation">
                        {{ $orders->links() }}
                    </div>
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
                    success: function (response) {
                        $('#detailOrder').modal('show');

                        $('#order-detail-ajax').html(response.view);
                    },
                    error: function (data) {
                        console.log(data.responseJSON.message)
                    }
                })
            });

            //Search
            $('#searchform').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "/invoice/search",
                    data: $('#searchform').serialize(),
                    success: function (response) {
                        $('#table-order').html(response.view);
                    },
                    error: function (xhr) {
                        console.log(xhr.responseJSON.message)
                    }
                })
            });

            //Time Search
            $('input[type="radio"]').click(function () {
                let id = $(this).val();
                console.log(id);
                $.ajax({
                    type: "get",
                    url: "/invoice/time/" + id,
                    success: function (response) {
                        $('#table-order').html(response.view);
                    },
                    error: function (xhr) {
                        console.log(xhr.responseJSON.message)
                    }
                })
            })
        });
    </script>
@endsection

