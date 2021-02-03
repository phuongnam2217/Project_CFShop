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
        <div class="search-group">
            <form action="">
                <label for="" class="search-name-text">Nhóm bàn</label>
                <div style="float: right; color: #0090da; cursor: pointer" data-bs-toggle="modal" data-bs-target="#addGroup"><i class="fas fa-plus-circle"></i></div>
                <input type="text" class="input" placeholder="Theo tên nhóm hàng, ..." />
            </form>
            <br/>
            <form action="" id="group-table-form">
                @foreach($groups as $group)
                    <div>
                        <label hidden>{{$group->id}}</label>
                        <input type="checkbox" />
                        <label>{{$group->name}}</label>
                        <a><i class="fas fa-trash-alt deletegroup"></i></a>
                        <a><i class="fas fa-pencil-alt editgroup"></i></a>
                    </div>
                @endforeach
            </form>
        </div>

        {{--Add Group Modal--}}
        <div class="modal fade" id="addGroup" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm nhóm bàn</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <form id="addform">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <lable>Tên nhóm bàn</lable>
                                <input type="text" class="form-control" name="name" placeholder="Tên nhóm bàn ..">
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
        {{--Edit Group Modal--}}
        <div class="modal fade" id="groupEditModal" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm nhóm bàn</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <form id="editFormId">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="id" id="edit_id">
                                <lable>Tên nhóm bàn</lable>
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
        {{--Delete Group--}}
        <div class="modal fade" id="groupDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                <lable>Bạn có muốn xóa nhóm bàn này không ??</lable>
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
@section('ajax')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#addform').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{route('group.store')}}",
                    data: $('#addform').serialize(),
                    success: function (response) {
                        console.log(response)
                        $('#group-table-form').html(response);
                        $('#addGroup').modal('hide')
                    },
                    error: function (error) {
                        console.log(error.responseJSON)
                    }
                })
            });

            $('.deletegroup').on('click', function () {
                $('#groupDeleteModal').modal('show');

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
                    url: "/group/delete/"+id,
                    data: $('#deleteFormId').serialize(),
                    success: function (response) {
                        console.log(response)
                        $('#groupDeleteModal').modal('hide')
                        alert("Xóa nhóm bàn thành công !");
                        location.reload();
                    },
                    error: function (error) {
                        console.log(error)
                        alert("Data not save !");
                    }
                })
            });

            $('.editgroup').on('click', function () {
                $('#groupEditModal').modal('show');

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
                    url: "/group/update/"+id,
                    data: $('#editFormId').serialize(),
                    success: function (response) {
                        console.log(response)
                        $('#groupEditModal').modal('hide')
                        alert("Cập nhật nhóm bàn thành công !");
                        location.reload();
                    },
                    error: function (error) {
                        console.log(error)
                        alert("Tên nhóm bàn không được để trống !");
                    }
                })
            })
        })
    </script>
@endsection

