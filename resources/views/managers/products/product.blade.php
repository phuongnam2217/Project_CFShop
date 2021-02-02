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
                        <p class="search-name-text">Loại thực đơn</p>
                        <div>
                            <input type="checkbox" />
                            <label for="">Đồ ăn</label>
                        </div>
                        <div><input type="checkbox" /> <label for="">Đồ uống</label></div>
                        <div><input type="checkbox" /> <label for="">Khác</label></div>
                    </form>
                </div>
                <div class="search-group">
                    <form action="">
                        <label for="" class="search-name-text">Nhóm hàng</label>
                        <div style="float: right; color: #0090da; cursor: pointer" data-bs-toggle="modal" data-bs-target="#addCategory"><i class="fas fa-plus-circle"></i></div>
                        <input type="text" class="input" placeholder="Theo tên nhóm hàng, ..." />
                    </form>
                    <br/>
                    <form action="">
                        @foreach($categories as $category)
                        <div>
                            <label hidden>{{$category->id}}</label>
                            <input type="checkbox" />
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
                                    <input type="text" class="form-control" name="name" placeholder="Tên nhóm hàng ..">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
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
                                        <input type="text" class="form-control" name="name" id="name">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
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
                                    <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{--Trang thai--}}
                <div class="search-name" style="height: 130px">
                    <form action="">
                        <p class="search-name-text">Trạng thái</p>
                        <div><input type="checkbox" /> <label for="">Đang hoạt động</label></div>
                        <div><input type="checkbox" /> <label for="">Ngừng hoạt động</label></div>
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
                                            data-bs-dismiss="modal">Close</button>
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
                                        <div class="form-group">
                                            <lable>Tên hàng hóa</lable>
                                            <input type="text" class="form-control" name="name" placeholder="Tên hàng hóa ..">
                                        </div>
                                        <div class="form-group">
                                            <lable>Ảnh</lable>
                                            <input type="text" class="form-control" name="image">
                                        </div>
                                        <div class="form-group">
                                            <lable>Loại hàng hóa</lable>
                                            <select name="isPortable" id="">
                                                <option value="1">Hàng tồn kho</option>
                                                <option value="2">Hàng dịch vụ</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <lable>Giá bán</lable>
                                            <input type="text" class="form-control" name="price" placeholder="Giá bán ..">
                                        </div>
                                        <div class="form-group">
                                            <lable>Tồn kho</lable>
                                            <input type="text" class="form-control" name="stock" placeholder="Tồn kho ..">
                                        </div>
                                        <div class="form-group">
                                            <lable>Nhóm hàng</lable>
                                            <select name="category_id" id="">
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>

                                            <lable>Loại thực đơn</lable>
                                            <select name="menu_id" id="">
                                                @foreach($menus as $menu)
                                                    <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Product -->
                        <div class="modal fade" id="productDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                            <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Delete</button>
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
                                        <h5 class="modal-title" id="exampleModalLabel">Thêm hàng hóa</h5>
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
                                                <input type="text" class="form-control" name="name" id="nameProduct" placeholder="Tên hàng hóa ..">
                                            </div>
                                            <div class="form-group">
                                                <lable>Ảnh</lable>
                                                <input type="text" class="form-control" id="imageProduct" name="image">
                                            </div>
                                            <div class="form-group">
                                                <lable>Loại hàng hóa</lable>
                                                <select name="isPortable" id="isPortableProduct">
                                                    <option value="1">Hàng tồn kho</option>
                                                    <option value="2">Hàng dịch vụ</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <lable>Giá bán</lable>
                                                <input type="text" class="form-control" id="priceProduct" name="price" placeholder="Giá bán ..">
                                            </div>
                                            <div class="form-group">
                                                <lable>Tồn kho</lable>
                                                <input type="text" class="form-control" id="stockProduct" name="stock" placeholder="Tồn kho ..">
                                            </div>
                                            <div class="form-group">
                                                <lable>Nhóm hàng</lable>
                                                <select name="category_id" id="categoryProduct_id">
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>

                                                <lable>Loại thực đơn</lable>
                                                <select name="menu_id" id="menuProduct_id">
                                                    @foreach($menus as $menu)
                                                        <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="subTable">
                    <table style="width: 100%; text-align: center;" class="table table-bordered">
                        <thead style="background-color: #DCF4FC">
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Tồn kho</th>
                            <th scope="col">Giá bán</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $key => $product)
                                <tr>
                                    <td hidden>{{$product->id}}</td>
                                    <td>{{++$key}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->image}}</td>
                                    <td>{{$product->stock}}</td>
                                    <td>{{$product->price}}</td>
                                    <td hidden>{{$product->category_id}}</td>
                                    <td hidden>{{$product->menu_id}}</td>
                                    <td hidden>{{$product->isPortable}}</td>
                                    <td>
                                        <a><i class="fas fas fa-eye"></i></a>
                                        <a><i class="fas fa-pencil-alt updateProduct"></i></a>
                                        <a><i class="fas fa-trash-alt deleteProduct"></i></a>
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
            $("#products").addClass("active");
        });
    </script>
@endsection
@section('ajax')
    <script type="text/javascript">
        $(document).ready(function () {
            // Category Ajax
            $('#addform').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "/category/add",
                    data: $('#addform').serialize(),
                    success: function (response) {
                        console.log(response)
                        $('#addCategory').modal('hide')
                        alert("Thêm mới nhóm hàng thành công !");
                        location.reload();
                    },
                    error: function (error) {
                        console.log(error)
                        alert("Tên nhóm hàng không được để trống !");
                    }
                })
            });

            $('.deletecategory').on('click', function () {
                $('#categoryDeleteModal').modal('show');

                $div = $(this).closest('div')

                var data = $div.children("label").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id').val(data[0]);
            })

            $('#deleteFormId').on('submit', function (e) {
                e.preventDefault();

                var id = $('#delete_id').val();

                $.ajax({
                    type: "DELETE",
                    url: "/category/delete/"+id,
                    data: $('#deleteFormId').serialize(),
                    success: function (response) {
                        console.log(response)
                        $('#categoryDeleteModal').modal('hide')
                        alert("Xóa nhóm hàng thành công !");
                        location.reload();
                    },
                    error: function (error) {
                        console.log(error)
                        alert("Data not save !");
                    }
                })
            });

            $('.editcategory').on('click', function () {
                $('#categoryEditModal').modal('show');

                $div = $(this).closest('div')

                var data = $div.children("label").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#edit_id').val(data[0]);
                $('#name').val(data[1]);
            });

            $('#editFormId').on('submit', function (e) {
                e.preventDefault();

                var id = $('#edit_id').val();

                $.ajax({
                    type: "PUT",
                    url: "/category/update/"+id,
                    data: $('#editFormId').serialize(),
                    success: function (response) {
                        console.log(response)
                        $('#categoryEditModal').modal('hide')
                        alert("Cập nhật nhóm hàng thành công !");
                        location.reload();
                    },
                    error: function (error) {
                        console.log(error)
                        alert("Tên nhóm hàng không được để trống !");
                    }
                })
            });

            //  Product Ajax
            $('#addformproduct').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "/product/add",
                    data: $('#addformproduct').serialize(),
                    success: function (response) {
                        console.log(response)
                        $('#addProduct').modal('hide')
                        alert("Thêm mới hàng hóa thành công !");
                        location.reload();
                    },
                    error: function (error) {
                        console.log(error)
                        alert("Tên nhóm hàng không được để trống !");
                    }
                })
            });

            $('.deleteProduct').on('click', function () {
                $('#productDeleteModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#product_id').val(data[0]);
            })

            $('#deleteFormProduct').on('submit', function (e) {
                e.preventDefault();

                var id = $('#product_id').val();

                $.ajax({
                    type: "DELETE",
                    url: "/product/delete/"+id,
                    data: $('#deleteFormProduct').serialize(),
                    success: function (response) {
                        console.log(response)
                        $('#productDeleteModal').modal('hide')
                        alert("Xóa sản phẩm thành công !");
                        location.reload();
                    },
                    error: function (error) {
                        console.log(error)
                        alert("Data not save !");
                    }
                })
            });

            $('.updateProduct').on('click', function () {
                $('#updateProduct').modal('show');

                $tr = $(this).closest('tr')

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#editProduct_id').val(data[0]);
                $('#nameProduct').val(data[2]);
                $('#imageProduct').val(data[3]);
                $('#isPortableProduct').val(data[8]);
                $('#priceProduct').val(data[5]);
                $('#stockProduct').val(data[4]);
                $('#categoryProduct_id').val(data[6]);
                $('#menuProduct_id').val(data[7]);
            });

            $('#updateformproduct').on('submit', function (e) {
                e.preventDefault();

                var id = $('#editProduct_id').val();

                $.ajax({
                    type: "PUT",
                    url: "/product/update/"+id,
                    data: $('#updateformproduct').serialize(),
                    success: function (response) {
                        console.log(response)
                        $('#updateProduct').modal('hide')
                        alert("Cập nhật sản phẩm thành công !");
                        location.reload();
                    },
                    error: function (error) {
                        console.log(error)
                        alert("Error !");
                    }
                })
            });
        })
    </script>
@endsection
