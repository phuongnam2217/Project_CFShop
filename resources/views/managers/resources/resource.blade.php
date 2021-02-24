@extends('managers.layout.master')
@section('content')

    <section class="content">
        <div class="body">
            <div class="search">
                <div class="search-name">
                    <form id="searchform">
                        @csrf
                        <label for="" class="search-name-text">Tìm kiếm</label>
                        <input type="text" id="search" name="search" class="input" placeholder="Theo tên phiếu nhập, .."/>
                    </form>
                </div>

{{--                Nguyeen lieeuj--}}
                <div class="search-group">
                    <form action="">
                        <label for="" class="search-name-text">Nguyên liệu - Đơn vị</label>
                        <div style="float: right; color: #0090da; cursor: pointer" data-bs-toggle="modal"
                             data-bs-target="#addResource"><i class="fas fa-plus-circle"></i></div>
                    </form>
                    <br/>
                    <form action="" id="resource-table-form">
                        @foreach($resources as $resource)
                            <div>
                                <label hidden>{{$resource->id}}</label>
                                <label>{{$resource->name}} - {{$resource->unit->name}}</label>
                                <a><i class="fas fa-trash-alt deleteResource"></i></a>
                            </div>
                        @endforeach
                    </form>
                </div>
            </div>

            {{--Add Resource Modal--}}
            <div class="modal fade" id="addResource" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm nguyên liệu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <form id="addform">
                            <div class="modal-body">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <lable>Tên nguyên liệu</lable>
                                    <input type="text" class="form-control name-category" name="name"
                                           placeholder="Tên nguyên liệu ..">
                                    <p class="text-danger addNameResource"></p>
                                </div>
                                <div class="form-group">
                                    <label>Đơn vị</label>
                                    <select name="unit_id" class="form-select select-category"
                                            aria-label="Default select example">
                                        @foreach($units as $unit)
                                            <option
                                                value="{{ $unit->id }}">{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <lable>Ghi chú</lable>
                                    <input type="text" class="form-control" name="note"
                                           placeholder="Ghi chú ..">
                                    <p class="text-danger noteResource"></p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{--Delete Resource--}}
            <div class="modal fade" id="resourceDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Xóa nhóm hàng</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <form id="deleteFormId">
                            <div class="modal-body">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <div class="form-group">
                                    <lable>Bạn có muốn xóa nguyên liệu này không ??</lable>
                                    <input type="hidden" class="form-control" name="id" id="delete_id">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="table">
                <div class="subHeader">
                    <div>
                        <h2>Nguyên liệu</h2>
                    </div>
                    <div>

                        <!-- Nhập nguyên liệu -->
                        <div class="mybutton" style="width: 160px" data-bs-toggle="modal" data-bs-target="#importResource">
                            <i class="fas fa-fw fa-file-import"></i> Nhập nguyên liệu
                        </div>
                        <div class="modal fade" id="importResource" tabindex="-1" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Nhập nguyên liệu</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <form id="importFormResource">
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            {{ method_field('POST') }}
                                            <div class="form-group">
                                                <lable>Tên hàng nhập</lable>
                                                <select name="resource_id" class="form-select select-category"
                                                        aria-label="Default select example">
                                                    @foreach($resources as $resource)
                                                        <option
                                                            value="{{ $resource->id }}">{{ $resource->name }} - {{$resource->unit->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group" style="padding-top: 10px">
                                                <lable>Giá nhập</lable>
                                                <input type="text" class="form-control priceProduct" name="unit_price"
                                                       placeholder="Giá nhập ..">
                                                <p class="text-danger unitPriceResource"></p>
                                            </div>
                                            <div class="form-group">
                                                <lable>Số lượng</lable>
                                                <input type="text" class="form-control quantityProduct" name="quantity"
                                                       placeholder="Số lượng ..">
                                                <p class="text-danger quantityResource"></p>
                                            </div>
                                            <div class="form-group">
                                                <lable>Ghi chú</lable>
                                                <input type="text" class="form-control stockProduct" name="note"
                                                       placeholder="Ghi chú ..">
                                                <p class="text-danger noteProduct"></p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Resource -->
                        <div class="modal fade" id="importResourceDeleteModal" tabindex="-1"
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
                           id="importResource-table-form">
                        <thead style="background-color: #DCF4FC">
                        <tr>
                            <th>Mã phiếu nhập</th>
                            <th>Tên nguyên liệu - đơn vị</th>
                            <th>Giá nhập</th>
                            <th>Số lượng</th>
                            <th>Tổng mua</th>
                            <th>Thời gian</th>
                            <th>Ghi chú</th>
                            <th>Xóa</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($importResources as $importResource)
                            <tr>
                                <td>{{$importResource->id}}</td>
                                <td>{{$importResource->resource->name}} - {{$importResource->resource->unit->name}}</td>
                                <td>{{number_format($importResource->unit_price)}} đ</td>
                                <td>{{$importResource->quantity}}</td>
                                <td>{{number_format($importResource->total_buy)}} đ</td>
                                <td>{{$importResource->created_at}}</td>
                                <td>{{$importResource->note}}</td>
                                <td hidden>{{$importResource->resource->id}}</td>
                                <td>
                                    <a><i class="fas fa-trash-alt deleteImportResource"></i></a>
                                </td>
                            </tr>
                        @endforeach
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
            $("#resources").addClass("active");
        });

        $(document).ready(function () {
            $('#addform').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "/resource/add",
                    data: $('#addform').serialize(),
                    success: function (response) {
                        $('#addResource').modal('hide')
                        $('#resource-table-form').html(response.view);
                        swal("Success", "Thêm mới thành công !", "success");
                    },
                    error: function (error) {
                        $(".name-category").addClass("is-invalid");
                        $(".addNameResource").html("* Tên nguyên liệu không được để trống !");
                    }
                })
            });

            $('body').on('click', '.deleteResource', function () {
                $('#resourceDeleteModal').modal('show');

                $div = $(this).closest('div')

                var data = $div.children("label").map(function () {
                    return $(this).text();
                }).get();

                $('#delete_id').val(data[0]);
            })

            $('#deleteFormId').on('submit', function (e) {
                e.preventDefault();

                var id = $('#delete_id').val();

                $.ajax({
                    type: "DELETE",
                    url: "/resource/delete/" + id,
                    data: $('#deleteFormId').serialize(),
                    success: function (response) {
                        $('#resourceDeleteModal').modal('hide')
                        $('#resource-table-form').html(response.view);
                            swal("Success", "Xóa nguyên liệu thành công !", "success");
                    },
                    error: function (error) {
                        console.log(error.responseJSON.message)
                        alert("Data not save !");
                    }
                })
            });

            $('#importFormResource').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "/resource/addResource",
                    data: $('#importFormResource').serialize(),
                    success: function (response) {
                        $('#importResource').modal('hide');
                        $('#importResource-table-form').html(response.view);
                        swal("Success", "Thêm mới thành công !", "success");
                    },
                    error: function (xhr) {
                        let error = xhr.responseJSON.errors;
                        console.log(xhr.responseJSON.message)
                        if (error.unit_price) {
                            $(".unitPriceResource").html(error.unit_price);
                            $(".priceProduct").addClass("is-invalid");
                        }
                        if (error.quantity) {
                            $(".quantityResource").html(error.quantity);
                            $(".quantityProduct").addClass("is-invalid");
                        };
                    }
                })
            });

            $('body').on('click', '.deleteImportResource', function () {
                $('#importResourceDeleteModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                $('#id').val(data[0]);
            })

            $('#deleteFormProduct').on('submit', function (e) {
                e.preventDefault();

                var id = $('#id').val();
                console.log(id);
                $.ajax({
                    type: "DELETE",
                    url: "/resource/destroy/" + id,
                    data: $('#deleteFormProduct').serialize(),
                    success: function (response) {
                        $('#importResourceDeleteModal').modal('hide');
                        $('#importResource-table-form').html(response.view);
                        swal("Success", "Xóa nguyên liệu thành công!", "success");
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
                    url: "/resource/search",
                    data: $('#searchform').serialize(),
                    success: function (response) {
                        $('#importResource-table-form').html(response.view);
                    },
                    error: function (xhr) {
                        alert("Error !");
                    }
                })
            });
        });
    </script>
@endsection

