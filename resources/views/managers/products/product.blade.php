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
                <div class="search-name" style="height: 200px">
                    <form action="">
                        <label for="" class="search-name-text">Nhóm hàng</label>
                        <div style="float: right; color: #0090da; cursor: pointer" data-bs-toggle="modal" data-bs-target="#addGroup"><i class="fas fa-plus-circle"></i></div>
                        <input type="text" class="input" placeholder="Theo tên nhóm hàng, ..." />
                    </form>
                    <br />
                    <form action="">
                        <div>
                            <input type="checkbox" />
                            <label for="">Nước ngọt</label>
                        </div>
                        <div><input type="checkbox" /> <label for="">Cafe</label></div>
                        <div><input type="checkbox" /> <label for="">Bánh ngọt</label></div>
                    </form>
                </div>

                <div class="modal fade" id="addGroup" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Thêm nhóm hàng</h5>
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
                        <h2>Hàng hóa</h2>
                    </div>
                    <div>
                        <!--  -->
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

                        <!--  -->
                        <div class="mybutton" role="group">
                            <div id="btnGroupDrop1" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-plus"></i> Thêm mới
                            </div>
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <li data-bs-toggle="modal" data-bs-target="#addProduct"><i class="fas fa-plus"></i> Thêm
                                    hàng hóa</li>
                                <li data-bs-toggle="modal" data-bs-target="#addService"><i class="fas fa-plus"></i> Thêm
                                    dịch vụ</li>
                            </ul>
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

                        <!-- Add Service -->
                        <div class="modal fade" id="addService" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Thêm dịch vụ</h5>
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

                    </div>
                </div>
                <div class="subTable">

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
