@extends('managers.layout.master')
@section('content')

    <section class="content">
        <div class="body">
            <div class="search">
                <div class="search-name">
                    <form id="searchform">
                        @csrf
                        <label for="" class="search-name-text">Tìm kiếm</label>
                        <input type="text" id="search" name="search" class="input" placeholder="Theo tên hàng, .."/>
                    </form>
                </div>

            </div>
            <div class="table">
                <div class="subHeader">
                    <div>
                        <h2>Nhập hàng</h2>
                    </div>
                    <div>

                        <!-- Nhập hàng -->
                        <div class="mybutton" style="width: 160px" data-bs-toggle="modal" data-bs-target="#addProduct">
                            <i class="fas fa-fw fa-file-import"></i> Nhập hàng hóa
                        </div>
                        <div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Nhập hàng hóa</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <form id="importFormProduct">
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            {{ method_field('POST') }}
                                            <div class="form-group">
                                                <lable>Tên hàng nhập</lable>
                                                <select name="product_id" class="form-select select-category"
                                                        aria-label="Default select example">
                                                    @foreach($products as $product)
                                                        <option
                                                            value="{{ $product->id }}">{{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group" style="padding-top: 10px">
                                                <lable>Giá nhập</lable>
                                                <input type="text" class="form-control priceProduct" name="unit_price"
                                                       placeholder="Giá nhập ..">
                                                <p class="text-danger unitPriceProduct"></p>
                                            </div>
                                            <div class="form-group">
                                                <lable>Số lượng</lable>
                                                <input type="text" class="form-control quantityProduct" name="quantity"
                                                       placeholder="Số lượng ..">
                                                <p class="text-danger quantityImportProduct"></p>
                                            </div>
                                            <div class="form-group">
                                                <lable>Ghi chú nhập hàng</lable>
                                                <input type="text" class="form-control noteProduct" name="note"
                                                       placeholder="Ghi chú ..">
                                                <p class="text-danger noteProductImport"></p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Product -->
                        <div class="modal fade" id="productDeleteModal" tabindex="-1"
                             aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Xóa sản phẩm</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <form id="deleteFormProduct">
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <div class="form-group">
                                                <lable>Bạn có muốn xóa đơn nhập này không ??</lable>
                                                <input type="hidden" class="form-control" name="id" id="id">
                                                <input type="hidden" class="form-control" name="qty" id="qty">
                                                <input type="hidden" class="form-control" name="product_id" id="product_id">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Xóa</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="subTable">
                    <table style="width: 100%; text-align: center;" class="table table-bordered"
                           id="importProduct-table-form">
                        <thead style="background-color: #DCF4FC">
                        <tr>
                            <th>Mã phiếu nhập</th>
                            <th>Tên hàng hóa</th>
                            <th>Giá nhập</th>
                            <th>Số lượng</th>
                            <th>Tổng mua</th>
                            <th>Thời gian</th>
                            <th>Ghi chú</th>
                            <th>Xóa</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($importProducts as $importProduct)
                            <tr>
                                <td>{{$importProduct->id}}</td>
                                <td>{{$importProduct->product->name}}</td>
                                <td>{{number_format($importProduct->unit_price)}} đ</td>
                                <td>{{$importProduct->quantity}}</td>
                                <td>{{number_format($importProduct->total_buy)}} đ</td>
                                <td>{{$importProduct->created_at}}</td>
                                <td>{{$importProduct->note}}</td>
                                <td hidden>{{$importProduct->product->id}}</td>
                                <td>
                                    <a><i class="fas fa-trash-alt deleteProduct"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div style="text-align: center" aria-label="Page Navigation">
                        {{ $importProducts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#importProducts").addClass("active");
        });

        $(document).ready(function () {
            $('#importFormProduct').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "/importProduct/add",
                    data: $('#importFormProduct').serialize(),
                    success: function (response) {
                        $('#addProduct').modal('hide');
                        $('#importProduct-table-form').html(response.view);
                        swal("Success", "Thêm mới thành công !", "success");
                    },
                    error: function (xhr) {
                        let error = xhr.responseJSON.errors;
                        console.log(error);
                        if (error.unit_price) {
                            $(".unitPriceProduct").html(error.unit_price);
                            $(".priceProduct").addClass("is-invalid");
                        }
                        if (error.quantity) {
                            $(".quantityImportProduct").html(error.quantity);
                            $(".quantityProduct").addClass("is-invalid");
                        };
                        if (error.note) {
                            $(".noteProduct").html(error.note);
                            $(".noteProductImport").addClass("is-invalid");
                        };
                    }
                })
            });

            $('body').on('click', '.deleteProduct', function () {
                $('#productDeleteModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                $('#id').val(data[0]);
                $('#qty').val(data[3]);
                $('#product_id').val(data[7]);
            })

            $('#deleteFormProduct').on('submit', function (e) {
                e.preventDefault();

                var id = $('#id').val();
                console.log(id);
                $.ajax({
                    type: "DELETE",
                    url: "/importProduct/delete/" + id,
                    data: $('#deleteFormProduct').serialize(),
                    success: function (response) {
                        $('#productDeleteModal').modal('hide');
                        $('#importProduct-table-form').html(response.view);
                        swal("Success", "Xóa sản phẩm thành công!", "success");
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
                    url: "/importProduct/search",
                    data: $('#searchform').serialize(),
                    success: function (response) {
                        $('#importProduct-table-form').html(response.view);
                    },
                    error: function (xhr) {
                        alert("Error !");
                    }
                })
            });
        });
    </script>
@endsection

