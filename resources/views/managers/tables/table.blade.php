@extends('managers.layout.master')
@section('content')

    <section class="content">
        <div class="body">
            <div class="search">
                <form action="" id="search-form">
                    <div class="search-name">

                        <label for="" class="search-name-text">Tìm kiếm</label>
                        <input type="text" name="name" class="input" placeholder="Theo tên bàn, .."/>

                    </div>
                    <div class="search-name" style="height: 130px">
                        <p class="search-name-text">Trạng thái</p>
                        <div><input id="status-active" name="active" value="1" type="radio" checked/> <label
                                for="status-active">Đang hoạt động</label></div>
                        <div><input id="status-disable" name="active" value="0" type="radio"/> <label
                                for="status-disable">Ngừng hoạt động</label></div>
                    </div>
                    <div class="search-group">
                        <div class="">
                            <label for="" class="search-name-text">Nhóm bàn</label>
                            <div id="show-modal-group" style="float: right; color: #0090da; cursor: pointer">
                                <i class="fas fa-plus-circle"></i>
                            </div>
                        </div>
                        <br/>
                        <div id="group-table-form">
                            @foreach($groups as $group)
                                <div>
                                    <input class="group" id="{{$group->name}}" name="group_id" value="{{$group->id}}" type="checkbox"/>
                                    <label for="{{$group->name}}">{{$group->name}}</label>
                                    <a><i data-id="{{$group->id}}" class="fas fa-trash-alt deletegroup"></i></a>
                                    <a><i data-id="{{$group->id}}" class="fas fa-pencil-alt editgroup"></i></a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </form>
                {{--Add Group Modal--}}
                <div class="modal fade" id="modal-group" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                        <input name="id" type="hidden" value="">
                                    </div>
                                    <div class="form-group">
                                        <lable>Tên nhóm bàn</lable>
                                        <input type="text" id="group-name" class="form-control" name="name"
                                               placeholder="Tên nhóm bàn ..">
                                        <div class="text-danger text-center group-name-err"></div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close
                                    </button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table" style="padding: 0 10px">
                <div class="subHeader">
                    <div>
                        <h2>Phòng/bàn</h2>
                    </div>
                    <div>
                        <!-- Thêm bàn -->
                        <div class="mybutton" id="create-table" data-bs-toggle="modal" data-bs-target="#addTable">
                            <i class="fas fa-plus"></i> Thêm bàn
                        </div>
                        <!-- Modal thêm bàn -->
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
                                        <form id="table-form" method="post" action="{{route('table.store')}}">
                                            @csrf
                                            <input type="hidden" name="id" id="id-table">
                                            <div class="form-group d-flex justify-content-around mb-2">
                                                <label for="staticEmail" class="col-sm-2 col-form-label">Tên bàn</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="name" class="form-control" id="name-table"
                                                           value="">
                                                    <div class="text-danger text-center name-table-err"></div>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex mb-2 justify-content-around">
                                                <label for="inputPassword" class="col-sm-2 col-form-label">Số
                                                    ghế</label>
                                                <div class="col-sm-8">
                                                    <input type="number" name="chair" class="form-control"
                                                           id="chair-table" placeholder="">
                                                    <div class="text-danger text-center chair-table-err"></div>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex justify-content-around mb-2">
                                                <label for="staticEmail" class="col-sm-2 col-form-label">Nhóm
                                                    bàn</label>
                                                <div class="col-sm-8">
                                                    <select name="group_id" class="form-control" id="group-table">
                                                        <option value="">-- Lựa chọn --</option>
                                                        @foreach($groups as $group)
                                                            <option class="option-group option{{$group->id}}"
                                                                    value="{{$group->id}}">{{$group->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex justify-content-around mb-2">
                                                <label for="staticEmail" class="col-sm-2 col-form-label">Ghi chú</label>
                                                <div class="col-sm-8">
                                                    <textarea type="text" name="note" class="form-control"
                                                              id="note-table"></textarea>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end" style="margin-right: 30px">
                                                <button style="margin-right: 30px" type="button"
                                                        class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Bỏ qua
                                                </button>
                                                <button id="submit-table" type="submit" class="btn btn-primary">Save
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="subTable">
                    <div class="card">
                        <table class="data-table display nowrap dataTable dtr-inline collapsed">
                            <thead>
                            <tr>
                                <th style="width: 30px">STT</th>
                                <th style="width: 100px">Tên bàn</th>
                                <th style="width: 100px">Ghi chú</th>
                                <th>Nhóm bàn</th>
                                <th>Số ghế</th>
                                <th>Trạng thái</th>
                                <th style="width: 150px">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                </div>
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                retrieve: true,
                ajax: {
                    url: '{{route('table.index')}}',
                    data: function (d) {
                        d.name = $(':input[name="name"]').val();
                        d.active = $(':input[name="active"]:checked').val();
                        d.group_id = $(':input[name="group_id"]:checked').val();
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'note', name: 'note'},
                    {data: 'group_id', name: 'group_id'},
                    {data: 'chair', name: 'chair'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            //Search
            $('#search-form').on('submit change keyup', function (e) {
                e.preventDefault();
                table.draw();
            })
            //Show Modal Create
            $('#create-table').click(function () {
                $('.modal-title').html("Thêm bàn");
                $(':input[type="submit"]').html('Thêm mới')
                $(':input[type="submit"]').val('create')
                $('#table-form').trigger('reset')
                $('#note-table').html('')
                const inputs = $('.form-control');
                const errors = $('.text-danger');
                $.each(inputs,function (idx,input){
                    $(input).removeClass('is-invalid');
                });
                $.each(errors,function (idx,error){
                    $(error).html('');
                });
                let options = $('.option-group');
                $.each(options, function (idx, option) {
                    $(option).removeAttr('selected', 'selected');
                })
            })

            $('#submit-table').on('click', function (e) {
                e.preventDefault();
                let valueButton = $(':input[type="submit"]').val()
                if (valueButton == 'create') {
                    $.ajax({
                        type: "POST",
                        url: "{{route('table.store')}}",
                        data: $('#table-form').serialize(),
                        dataType: 'json',
                        success: function (data) {
                            table.draw();
                            $('#addTable').modal('hide');
                            swal('Success!', data, "success");
                        },
                        error: function (xhr) {
                            let errors = xhr.responseJSON.errors;
                            if(errors.name){
                                $('#name-table').addClass('is-invalid');
                                $('.name-table-err').html(errors.name)
                            }
                            if(errors.chair){
                                $('#chair-table').addClass('is-invalid');
                                $('.chair-table-err').html(errors.chair)
                            }
                        }
                    })
                }
                if (valueButton == 'update') {
                    let id = $('#id-table').val();
                    $.ajax({
                        type: "PUT",
                        url: "{{route('table.index')}}" + "/" + id + "/update",
                        data: $('#table-form').serialize(),
                        dataType: 'json',
                        success: function (data) {
                            table.draw();
                            $('#addTable').modal('hide');
                            swal('Success!', data, "success");
                        },
                        error: function (xhr) {
                            let errors = xhr.responseJSON.errors;
                            if(errors.name){
                                $('#name-table').addClass('is-invalid');
                                $('.name-table-err').html(errors.name)
                            }
                            if(errors.chair){
                                $('#chair-table').addClass('is-invalid');
                                $('.chair-table-err').html(errors.chair)
                            }
                        }
                    })
                }
            })

            $('body').on('click', '.edit-table', function () {
                let id = $(this).attr('data-id');
                let options = $('.option-group');
                $('.modal-title').html("Chỉnh sửa thông tin bàn");
                $(':input[type="submit"]').html('Cập nhật')
                $(':input[type="submit"]').val('update')
                const inputs = $('.form-control');
                const errors = $('.text-danger');
                $.each(inputs,function (idx,input){
                    $(input).removeClass('is-invalid');
                });
                $.each(errors,function (idx,error){
                    $(error).html('');
                });
                $('table-form').trigger('reset')
                $.ajax({
                    type: "GET",
                    url: "{{route('table.index')}}" + "/" + id,
                    success: function (data) {
                        console.log(data);
                        $('#name-table').val(data.name)
                        $('#id-table').val(data.id);
                        $('#chair-table').val(data.chair);
                        $.each(options, function (idx, option) {
                            $(option).removeAttr('selected', 'selected');
                        })
                        $('.option' + data.group_id).attr('selected', 'selected');
                        $('#note-table').html(data.note)
                        $('#addTable').modal('show');
                    },
                    error: function (data) {

                    }
                })
            })

            $('body').on('click', '.delete-table', function () {
                let id = $(this).attr('data-id');
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'get',
                            url: "{{route("table.index")}}" + "/" + id + "/delete",
                            success: function (data) {
                                table.draw()
                                swal(data, {
                                    icon: "success",
                                });
                            }
                        })
                    }
                });
            })

            //Thay đổi trạng thái
            $('body').on('click', '.changeActive', function () {
                let id = $(this).attr('data-id');
                $.ajax({
                    type: "get",
                    url: "{{route('table.index')}}" + "/" + id + "/changeActive",
                    success: function (data) {
                        table.draw();
                        swal(data, {
                            icon: "success",
                        });
                    }
                })
            })

            $('#show-modal-group').click(function () {
                $('.modal-title').html('Thêm nhóm bàn');
                $('#addform').trigger('reset');
                $(':input[type="submit"]').val('create');
                $(':input[type="submit"]').html('Thêm mới');
                const inputs = $('.form-control');
                const errors = $('.text-danger');
                $.each(inputs,function (idx,input){
                    $(input).removeClass('is-invalid');
                });
                $.each(errors,function (idx,error){
                    $(error).html('');
                });
                $('#modal-group').modal('show');
            })
            //Thêm nhóm bàn
            $('#addform').on('submit', function (e) {
                e.preventDefault();
                let value = $(':input[type="submit"]').val();
                if (value == 'create') {
                    $.ajax({
                        type: "POST",
                        url: "{{route('group.store')}}",
                        data: $('#addform').serialize(),
                        success: function (response) {
                            table.draw();
                            $('#group-table-form').html('').append(response.view);
                            $('#group-table').html('').append(response.viewSelect)
                            $('#modal-group').modal('hide');
                            swal(response.message, {
                                icon: "success",
                            });
                        },
                        error: function (xhr) {
                            let errors = xhr.responseJSON.errors
                            $('#group-name').addClass('is-invalid');
                            $('.group-name-err').html(errors.name)
                        }
                    })
                }
                if (value == 'update') {
                    let id = $(':input[name="id"]').val();
                    $.ajax({
                        type: "PUT",
                        url: "{{route('group.index')}}" + "/" + id + "/update",
                        data: $('#addform').serialize(),
                        success: function (response) {
                            table.draw();
                            $('#group-table-form').html('').append(response.view);
                            $('#group-table').html('').append(response.viewSelect)
                            $('#modal-group').modal('hide')
                            swal(response.message, {
                                icon: "success",
                            });
                        },
                        error: function (xhr) {
                            let errors = xhr.responseJSON.errors
                            $('#group-name').addClass('is-invalid');
                            $('.group-name-err').html(errors.name)
                        }
                    })
                }
            });
            //Edit nhóm bàn
            $('body').on('click', '.editgroup', function () {
                let id = $(this).attr('data-id');
                $('.modal-title').html('Chỉnh sửa nhóm bàn')
                $(':input[type="submit"]').html('Chỉnh sửa');
                $(':input[type="submit"]').val('update');
                const inputs = $('.form-control');
                const errors = $('.text-danger');
                $.each(inputs,function (idx,input){
                    $(input).removeClass('is-invalid');
                });
                $.each(errors,function (idx,error){
                    $(error).html('');
                });
                $.ajax({
                    type: 'GET',
                    url: "{{route('group.index')}}" + "/" + id,
                    success: function (data) {
                        $(':input[name="id"]').val(data.id);
                        $('#group-name').val(data.name);
                        $('#modal-group').modal('show')
                    },
                    error: function (data) {
                        console.log(data.responseJSON);
                    }
                })
            })

            $('body').on('click', '.deletegroup', function () {
                let id = $(this).attr('data-id');
                swal({
                    title: "Are you sure?",
                    text: "Bạn chắc có muốn xóa nhóm bàn này",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "get",
                            url: "{{route('group.index')}}" + "/" + id + "/delete",
                            dataType: "json",
                            success: function (data) {
                                $('#group-table-form').html('').append(data.view);
                                $('#group-table').html('').append(data.viewSelect)
                                swal(data.message, {
                                    icon: "success",
                                });
                            },
                            error: function (error) {
                                console.log(error.responseJSON)
                            }
                        })

                    }
                });
            })

        })
    </script>
@endsection

