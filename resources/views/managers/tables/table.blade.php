@extends('managers.layout.master')
@section('content')

<section class="content">
<div class="body">
    <div class="search">
        <div class="search-name">
            <form action="">
                <label for="" class="search-name-text">Tìm kiếm</label>
                <input type="text" class="input" placeholder="Theo tên bàn, .." />
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
                <h2>Phòng/bàn</h2>
            </div>
            <div>

                <!-- Thêm bàn -->
                <div class="mybutton" data-bs-toggle="modal" data-bs-target="#addTable">
                    <i class="fas fa-plus"></i> Thêm bàn
                </div>
                <div class="modal fade" id="addTable" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Thêm bàn</h5>
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

                <!-- Thêm nhóm bàn -->
                <div class="mybutton" data-bs-toggle="modal" data-bs-target="#addGroup">
                    <i class="fas fa-plus"></i> Thêm nhóm
                </div>
                <div class="modal fade" id="addGroup" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Thêm nhóm bàn</h5>
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
        <div class="subTable"></div>
    </div>
</div>
</section>
@endsection
@section('js')
     <script>
    $(document).ready(function () {
        $("#tables").addClass("active");
    });
</script>
@endsection

