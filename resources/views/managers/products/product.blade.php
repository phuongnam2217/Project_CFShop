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
                <div class="search-group">
                    <form action="">
                        <label for="" class="search-name-text">Nhóm hàng</label>
                        <div style="float: right; color: #0090da; cursor: pointer" data-bs-toggle="modal"
                             data-bs-target="#addCategory"><i class="fas fa-plus-circle"></i></div>
                        <input type="text" class="input" placeholder="Theo tên nhóm hàng, ..."/>
                    </form>
                    <br/>
                    <form action="" id="category-table-form">
                        @foreach($categories as $category)
                            <div>
                                <label hidden>{{$category->id}}</label>
                                <label>{{$category->name}}</label>
                                <a><i class="fas fa-trash-alt deletecategory"></i></a>
                                <a><i class="fas fa-pencil-alt editcategory"></i></a>
                            </div>
                        @endforeach
                    </form>
                </div>

                {{--Add Category Modal--}}
                <div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Thêm nhóm hàng</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <form id="addform">
                                <div class="modal-body">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <lable>Tên nhóm hàng</lable>
                                        <input type="text" class="form-control name-category" name="name"
                                               placeholder="Tên nhóm hàng ..">
                                        <p class="text-danger addNameCategory"></p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{--Edit Category Modal--}}
                <div class="modal fade" id="categoryEditModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Thêm nhóm hàng</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <form id="editFormId">
                                <div class="modal-body">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="id" id="edit_id">
                                        <lable>Tên nhóm hàng</lable>
                                        <input type="text" class="form-control name-editCategory" name="name" id="name">
                                        <p class="text-danger editNameCategory"></p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{--Delete Category--}}
                <div class="modal fade" id="categoryDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                        <lable>Bạn có muốn xóa nhóm hàng này không ??</lable>
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

                {{--Trang thai--}}
                <div class="search-name" style="height: 130px">
                    <p class="search-name-text">Trạng thái</p>
                    <form action="" id="statusform">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="search" id="1" value="1">
                            <label class="form-check-label" for="1">
                                Đang kinh doanh
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="search" id="0" value="0">
                            <label class="form-check-label" for="0">
                                Ngừng kinh doanh
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="search" id="2" value="2" checked>
                            <label class="form-check-label" for="2">
                                Tất cả
                            </label>
                        </div>
                    </form>
                </div>
            </div>

            {{--Table--}}
            <div class="table">
                <div class="subHeader">
                    <div>
                        <h2>Hàng hóa</h2>
                    </div>
                    <div>
                        <!-- Export -->
                        <div class="mybutton">
                            <i class="fas fa-fw fa-file-export"></i> Export
                        </div>

                        <!-- Import -->
                        <div class="mybutton" data-bs-toggle="modal" data-bs-target="#import">
                            <i class="fas fa-fw fa-file-import"></i> Import
                        </div>
                        <div class="modal fade" id="import" tabindex="-1" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import hàng hóa</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close
                                        </button>
                                        <button type="button" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add -->
                        <div class="mybutton" role="group">
                            <div data-bs-toggle="modal" data-bs-target="#addProduct">
                                <i class="fas fa-plus"></i> Thêm mới
                            </div>
                        </div>

                        <!-- Add Product -->
                        <div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Thêm hàng hóa</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <form id="addformproduct">
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            {{ method_field('POST') }}
                                            <div class="form-group">
                                                <lable>Tên hàng hóa</lable>
                                                <input type="text" class="form-control nameProduct" name="name_product"
                                                       placeholder="Tên hàng hóa ..">
                                                <p class="text-danger addNameProduct"></p>
                                            </div>
                                            <div class="form-group">
                                                <lable>Ảnh</lable>
                                                <input type="text" class="form-control" name="image">
                                                {{--                                                <input name="image" type="file" class="form-control">--}}
                                            </div>
                                            <div class="form-group">
                                                <lable>Loại hàng hóa</lable>
                                                <select name="isPortable" class="form-select" id="multi-selectbox"
                                                        aria-label="Default select example">
                                                    <option value="1">Hàng tồn kho</option>
                                                    <option value="2">Hàng dịch vụ</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <lable>Giá bán</lable>
                                                <input type="text" class="form-control priceProduct" name="price"
                                                       placeholder="Giá bán ..">
                                                <p class="text-danger addPriceProduct"></p>
                                            </div>
                                            <div class="form-group" id="stock-product">
                                                <lable>Tồn kho</lable>
                                                <input type="text" class="form-control stockProduct" name="stock"
                                                       placeholder="Tồn kho ..">
                                                <p class="text-danger addStockProduct"></p>
                                            </div>
                                            <div class="form-group">
                                                <lable>Nhóm hàng</lable>
                                                <select name="category_id" class="form-select select-category"
                                                        aria-label="Default select example">
                                                    @foreach($categories as $category)
                                                        <option
                                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>

                                                <lable>Loại thực đơn</lable>
                                                <select name="menu_id" id="" class="form-select"
                                                        aria-label="Default select example">
                                                    @foreach($menus as $menu)
                                                        <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                                    @endforeach
                                                </select>
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
                                                <lable>Bạn có muốn xóa sản phẩm này không ??</lable>
                                                <input type="hidden" class="form-control" name="id" id="product_id">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Xóa</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Update Product -->
                        <div class="modal fade" id="updateProduct" tabindex="-1" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Cập nhật hàng hóa</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <form id="updateformproduct">
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <input type="hidden" class="form-control" name="id" id="editProduct_id">
                                            <div class="form-group">
                                                <lable>Tên hàng hóa</lable>
                                                <input type="text" class="form-control nameProduct" name="name"
                                                       id="nameProduct"
                                                       placeholder="Tên hàng hóa ..">
                                                <p class="text-danger updateNameProduct"></p>
                                            </div>
                                            <div class="form-group">
                                                <lable>Ảnh</lable>
                                                <input type="text" class="form-control" id="imageProduct" name="image">
                                                {{--                                                <input name="image" type="file" id="imageProduct" class="form-control">--}}
                                            </div>
                                            <div class="form-group">
                                                <lable>Loại hàng hóa</lable>
                                                <select name="isPortable" id="isPortableProduct" class="form-select"
                                                        aria-label="Default select example">
                                                    <option value="1">Hàng tồn kho</option>
                                                    <option value="2">Hàng dịch vụ</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <lable>Giá bán</lable>
                                                <input type="text" class="form-control priceProduct" id="priceProduct"
                                                       name="price"
                                                       placeholder="Giá bán ..">
                                                <p class="text-danger updatePriceProduct"></p>
                                            </div>
                                            <div class="form-group" id="stock-product-update">
                                            </div>
                                            <div class="form-group">
                                                <lable>Nhóm hàng</lable>
                                                <select name="category_id" id="categoryProduct_id"
                                                        class="form-select select-category"
                                                        aria-label="Default select example">
                                                    @foreach($categories as $category)
                                                        <option
                                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>

                                                <lable>Loại thực đơn</lable>
                                                <select name="menu_id" id="menuProduct_id" class="form-select"
                                                        aria-label="Default select example">
                                                    @foreach($menus as $menu)
                                                        <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{--Detail Product--}}
                        <div class="modal fade" id="detailProduct" tabindex="-1" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Chi tiết hàng hóa</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body detailProduct">
                                        <p hidden id="detailProduct_id">
                                        <div style="width: 50%; float: left; text-align: center">
                                            <div id="detailImage">
                                            </div>
                                        </div>
                                        <div style="width: 50%; float: right; text-align: center">
                                            <div style="font-size: 25px; font-weight: bold">
                                                <span>Tên hàng hóa:</span>
                                                <span id="detailName"></span>
                                            </div>
                                            <div class="form-group">
                                                <span>Nhóm hàng:</span>
                                                <span id="detailCategory_id"></span>
                                            </div>
                                            <div style="font-size: 18px; font-style: italic">
                                                <span>Giá bán:</span>
                                                <span id="detailPrice"></span>
                                            </div>
                                            <div style="font-size: 18px; font-style: italic">
                                                <span>Tồn kho:</span>
                                                <span id="detailStock"></span>
                                            </div>
                                            <div>
                                                <span>Loại hàng hóa:</span>
                                                <span id="detailIsPortable"></span>
                                            </div>
                                            <div>
                                                <span>Loại thực đơn:</span>
                                                <span id="detailMenu_id"></span>
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

                    </div>
                </div>
                <div class="subTable">
                    <table style="width: 100%; text-align: center;" class="table table-bordered"
                           id="product-table-form">
                        <thead style="background-color: #DCF4FC">
                        <tr>
                            <th scope="col">#STT</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Tồn kho</th>
                            <th scope="col">Giá bán</th>
                            <th scope="col">Nhóm hàng</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($products)
                            @foreach($products as $key => $product)
                                <tr>
                                    <td hidden>{{$product->id}}</td>
                                    <td>{{++$key}}</td>
                                    <td>{{$product->name}}</td>
                                    <td hidden>{{$product->image}}</td>
                                    <td>{{$product->stock}}</td>
                                    <td>{{number_format($product->price)}} đ</td>
                                    <td hidden>{{$product->category_id}}</td>
                                    <td>{{$product->category->name}}</td>
                                    <td hidden>{{$product->menu_id}}</td>
                                    <td hidden>{{$product->isPortable}}</td>
                                    <td hidden>{{$product->active}}</td>
                                    <td hidden>{{$product->price}}</td>
                                    <td>
                                        <span class="form-check-input changeActive activeProduct {{ ($product->active == 1) ? 'active-style': 'inactive-style' }}" active-id="{{$product->id}}" name="active">
                                            {{ ($product->active == 1) ? 'Đang kinh doanh': 'Ngừng kinh doanh' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a><i data-id="{{$product->id}}" class="fas fas fa-eye detailProduct"></i></a>
                                        <a><i isPortableUpdate="{{$product->isPortable}}"
                                              class="fas fa-pencil-alt updateProduct"></i></a>
                                        <a><i class="fas fa-trash-alt deleteProduct"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div style="text-align: center" aria-label="Page Navigation">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#products").addClass("active");
        });

        $(document).ready(function () {
            // Category Ajax
            $('#addform').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "/category/add",
                    data: $('#addform').serialize(),
                    success: function (response) {
                        $('#addCategory').modal('hide')
                        $('#category-table-form').html(response.view);
                        $('.select-category').html(response.select);
                        swal("Success", "Thêm mới thành công !", "success");
                    },
                    error: function (error) {
                        $(".name-category").addClass("is-invalid");
                        $(".addNameCategory").html("* Tên nhóm hàng không được để trống !");
                    }
                })
            });

            $('body').on('click', '.deletecategory', function () {
                $('#categoryDeleteModal').modal('show');

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
                    url: "/category/delete/" + id,
                    data: $('#deleteFormId').serialize(),
                    success: function (response) {
                        console.log(response)
                        $('#categoryDeleteModal').modal('hide')
                        $('#category-table-form').html(response.view);
                        $('.select-category').html(response.select);
                        if (response.message) {
                            swal("Error", response.message, "error");
                        } else {
                            swal("Success", "Xóa nhóm hàng thành công !", "success");
                        }
                    },
                    error: function (error) {
                        console.log(error.responseJSON)
                        alert("Data not save !");
                    }
                })
            });

            $('body').on('click', '.editcategory', function () {
                $('#categoryEditModal').modal('show');

                $div = $(this).closest('div')

                var data = $div.children("label").map(function () {
                    return $(this).text();
                }).get();

                $('#edit_id').val(data[0]);
                $('#name').val(data[1]);
            })

            $('#editFormId').on('submit', function (e) {
                e.preventDefault();

                var id = $('#edit_id').val();

                $.ajax({
                    type: "PUT",
                    url: "/category/update/" + id,
                    data: $('#editFormId').serialize(),
                    success: function (response) {
                        $('#categoryEditModal').modal('hide');
                        $('#category-table-form').html(response.view);
                        $('.select-category').html(response.select);
                        $('#product-table-form').html(response.products);
                        swal("Success", "Cập nhật thành công !", "success");
                    },
                    error: function (error) {
                        $(".name-editCategory").addClass("is-invalid");
                        $(".editNameCategory").html("* Tên nhóm hàng không được để trống !");
                    }
                })
            });

            //  Product Ajax
            $('#addformproduct').on('submit', function (e) {
                e.preventDefault();

                // <div class="form-group">
                //     <lable>Tồn kho</lable>
                //     <input type="text" class="form-control stockProduct" name="stock"
                //            placeholder="Tồn kho ..">
                //         <p class="text-danger addStockProduct"></p>
                // </div>
                $.ajax({
                    type: "POST",
                    url: "/product/add",
                    data: $('#addformproduct').serialize(),
                    success: function (response) {
                        $('#addProduct').modal('hide');
                        $('#product-table-form').html(response.view);
                        swal("Success", "Thêm mới thành công !", "success");
                    },
                    error: function (xhr) {
                        let error = xhr.responseJSON.errors;
                        if (error.name) {
                            $(".addNameProduct").html(error.name);
                            $(".nameProduct").addClass("is-invalid");
                        }
                        if (error.price) {
                            $(".addPriceProduct").html(error.price);
                            $(".priceProduct").addClass("is-invalid");
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

                $('#product_id').val(data[0]);
            })

            $('#deleteFormProduct').on('submit', function (e) {
                e.preventDefault();

                var id = $('#product_id').val();

                $.ajax({
                    type: "DELETE",
                    url: "/product/delete/" + id,
                    data: $('#deleteFormProduct').serialize(),
                    success: function (response) {
                        $('#productDeleteModal').modal('hide');
                        $('#product-table-form').html(response.view);
                        swal("Success", "Xóa sản phẩm thành công!", "success");
                    },
                    error: function (error) {
                        alert("Data not save !");
                    }
                })
            });

            $('body').on('click', '.updateProduct', function () {
                $('#updateProduct').modal('show');

                let id = $(this).attr('isPortableUpdate');
                console.log(id);
                if (id == 1) {
                    $('#stock-product-update').html("<lable>Tồn kho</lable>" +
                        '<input placeholder="Tồn kho ..." id="stockProduct" type="text" class="form-control stockProduct" name="stock">' +
                        '<p class="text-danger updatePriceProduct"></p>');
                } else {
                    $('#stock-product-update').html(" ");
                }

                $tr = $(this).closest('tr')
                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                $('#editProduct_id').val(data[0]);
                $('#nameProduct').val(data[2]);
                $('#imageProduct').val(data[3]);
                $('#isPortableProduct').val(data[9]);
                $('#priceProduct').val(data[11]);
                $('#stockProduct').val(data[4]);
                $('#categoryProduct_id').val(data[6]);
                $('#menuProduct_id').val(data[8]);
                $('#activeProduct').val(data[10]);
            });

            $('#updateformproduct').on('submit', function (e) {
                e.preventDefault();

                var id = $('#editProduct_id').val();

                $.ajax({
                    type: "PUT",
                    url: "/product/update/" + id,
                    data: $('#updateformproduct').serialize(),
                    success: function (response) {
                        $('#updateProduct').modal('hide');
                        $('#product-table-form').html(response.view);
                        swal("Success", "Cập nhật thành công !", "success");
                    },
                    error: function (xhr) {
                        let error = xhr.responseJSON.errors;
                        if (error.name) {
                            $(".updateNameProduct").html("* Tên sản phẩm không được để trống !");
                            $(".nameProduct").addClass("is-invalid");
                        }
                        ;
                        if (error.price) {
                            $(".updatePriceProduct").html("* Giá bán không được để trống !");
                            $(".priceProduct").addClass("is-invalid");
                        }
                        ;
                        // if (error.stock) {
                        //     $(".updateStockProduct").html("* Tồn kho không được để trống !");
                        //     $(".stockProduct").addClass("is-invalid");
                        // }
                        // ;
                    }
                })
            });

            $('body').on('click', '.detailProduct', function () {
                let id = $(this).attr('data-id');

                console.log(id)
                $.ajax({
                    type: 'GET',
                    url: "{{route('product.index')}}" + "/" + id,
                    success: function (data) {
                        $('#detailProduct').modal('show');

                        $('#detailName').html(data.product.name);
                        $('#detailImage').html('<img style="width: 100%" src="' + data.product.image + '" alt="">');
                        // $('#detailImage').html('<img style="width: 100%" src="' + 'https://quangvoc8.s3.amazonaws.com/' + data.product.image + '" alt="">');
                        {{--                        <img style="width: 100px"--}}
                        {{--                             src="@if($product->getProductImage() == 'https://quangvoc8.s3.amazonaws.com/')--}}
                        {{--                                 https://miro.medium.com/max/2834/0*f81bU2qWpP51WWWC.jpg--}}
                        {{--@else--}}
                        {{--                             {{$product->getProductImage()}}--}}
                        {{--                             @endif"--}}
                        {{--                             class="img-border-radius avatar-40 img-fluid">--}}
                        $('#detailIsPortable').html(data.product.isPortable === 1 ? "Hàng hóa" : "Dịch vụ");
                        $('#detailPrice').html(new Intl.NumberFormat().format(data.product.price) + " đ");
                        $('#detailStock').html(data.product.stock);
                        $('#detailCategory_id').html(data.category.name);
                        $('#detailMenu_id').html(data.product.menu_id === 1 ? "Đồ uống" : data.product.menu_id === 2 ? "Đồ ăn" : "Khác");
                        $('#detailActive').html(data.product.active === 1 ? "Đang kinh doanh" : "Ngừng kinh doanh");
                        console.log(data.product.active);
                        if (data.product.active === 1) {
                            $("#detailActive").removeClass("inactive-style").addClass("active-style");
                        } else {
                            $("#detailActive").removeClass("active-style").addClass("inactive-style");
                        }
                    },
                    error: function (data) {

                    }
                })
            })

            //Search
            $('#searchform').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "/product/search",
                    data: $('#searchform').serialize(),
                    success: function (response) {
                        $('#product-table-form').html(response.view);
                    },
                    error: function (xhr) {
                        alert("Error !");
                    }
                })
            });

            //Status
            $('input[type="radio"]').click(function () {
                let id = $(this).val();
                console.log(id);
                $.ajax({
                    type: "get",
                    url: "/product/active/" + id,
                    success: function (response) {
                        $('#product-table-form').html(response.view);
                    },
                    error: function (error) {
                        alert("Data not save !");
                    }
                })
            })

            //Menu - not yet

            //Active
            $('body').on('click', '.activeProduct', function () {
                let id = $(this).attr('active-id');
                $.ajax({
                    type: "get",
                    url: "{{route('product.index')}}" + "/" + id + "/changeActive",
                    success: function (response) {
                        $('#product-table-form').html(response.view);
                    }
                })
            })

            //Portable
            $(document).ready(function () {
                $('#multi-selectbox').change(function () {
                    let id = $('#multi-selectbox').val();
                    if (id == 1) {
                        $('#stock-product').html("<lable>Tồn kho</lable>" +
                            '<input placeholder="Tồn kho ..." id="stock-product-input" type="text" class="form-control stockProduct" name="stock">' +
                            '<p class="text-danger addStockProduct"></p>');
                    } else {
                        $('#stock-product').html(" ");
                    }
                });
            });
            $(document).ready(function () {
                $('#isPortableProduct').change(function () {
                    let id = $('#isPortableProduct').val();
                    if (id == 1) {
                        $('#stock-product-update').html("<lable>Tồn kho</lable>" +
                            '<input placeholder="Tồn kho ..." id="stockProduct" type="text" class="form-control stockProduct" name="stock">' +
                            '<p class="text-danger updatePriceProduct"></p>');
                    } else {
                        $('#stock-product-update').html(" ");
                    }
                });
            });
        })
    </script>
@endsection
