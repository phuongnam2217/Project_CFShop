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
                        <div>
                            <input id="status-all" name="active" value="2" type="radio" checked/>
                            <label for="status-all">Tất cả</label>
                        </div>
                        <div>
                            <input id="status-active" name="active" value="1" type="radio"/>
                            <label for="status-active">Đang hoạt động</label>
                        </div>
                        <div>
                            <input id="status-disable" name="active" value="0" type="radio"/>
                            <label for="status-disable">Ngừng hoạt động</label>
                        </div>
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
                                    <input class="group" id="group-{{$group->id}}" name="group_id[]" value="{{$group->id}}"
                                           type="checkbox"/>
                                    <label for="group-{{$group->id}}">{{$group->name}}</label>
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
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($tables)
                                @foreach($tables as $key => $table )
                                    <tr>
                                        <td hidden>{{$table->id}}</td>
                                        <td>{{++$key}}</td>
                                        <td>{{$table->name}}</td>
                                        <td>{{$table->note}}</td>
                                        <td>{{$table->group_id}}</td>
                                        <td>{{$table->chair}}</td>
                                        <td>
                                            <span data-id="{{$table->id}}" class="changeActive badge {{($table->active ?'bg-success': 'bg-danger' )}}"> {{$table->active ? 'Đang hoạt động': 'Ngưng hoạt động'}}</span>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$table->id}}" data-original-title="Edit" class="edit edit-table"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$table->id}}" data-original-title="Delete" class="delete-table"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
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
            var searchIDs = $(".group:checked").map(function(){
                return +$(this).val();
            }).get(); // <----
            console.log(searchIDs);
            //Search
            $('#search-form').on('submit change keyup', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: "{{route('table.index')}}",
                    data: $('#search-form').serialize(),
                    dataType: 'json',
                    success: function (data) {
                        $('.subTable').html(data.view)
                    },
                })
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
                $.each(inputs, function (idx, input) {
                    $(input).removeClass('is-invalid');
                });
                $.each(errors, function (idx, error) {
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
                            console.log(data)
                            $('.subTable').html(data.view)
                            $('#addTable').modal('hide');
                            swal(data.status, {
                                icon: "success",
                            });
                        },
                        error: function (xhr) {
                            let errors = xhr.responseJSON.errors;
                            if (errors.name) {
                                $('#name-table').addClass('is-invalid');
                                $('.name-table-err').html(errors.name)
                            }
                            if (errors.chair) {
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
                            $.ajax({
                                type: "GET",
                                url: "{{route('table.index')}}",
                                data: $('#search-form').serialize(),
                                dataType: 'json',
                                success: function (data) {
                                    $('.subTable').html(data.view)
                                },
                            })
                            $('#addTable').modal('hide');
                            swal(data.status, {
                                icon: "success",
                            });
                        },
                        error: function (xhr) {
                            let errors = xhr.responseJSON.errors;
                            if (errors.name) {
                                $('#name-table').addClass('is-invalid');
                                $('.name-table-err').html(errors.name)
                            }
                            if (errors.chair) {
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
                $.each(inputs, function (idx, input) {
                    $(input).removeClass('is-invalid');
                });
                $.each(errors, function (idx, error) {
                    $(error).html('');
                });
                $('table-form').trigger('reset')
                $.ajax({
                    type: "GET",
                    url: "{{route('table.index')}}" + "/" + id,
                    success: function (data) {
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
                                // $('.subTable').html(data.view)
                                swal(data.status, {
                                    icon: "success",
                                });
                                $.ajax({
                                    type: "GET",
                                    url: "{{route('table.index')}}",
                                    data: $('#search-form').serialize(),
                                    dataType: 'json',
                                    success: function (data) {
                                        $('.subTable').html(data.view)
                                    },
                                })
                            }
                        })
                    }
                });
            })

            //Thay đổi trạng thái
            $('body').on('click', '.changeActive', function () {
                let id = $(this).attr('data-id');
                swal({
                    title: "Are you sure?",
                    text: "Bạn có chắc bật/tắt hoạt động kinh doanh của bàn này !",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                type: "get",
                                url: "{{route('table.index')}}" + "/" + id + "/changeActive",
                                success: function (data) {
                                    $.ajax({
                                        type: "GET",
                                        url: "{{route('table.index')}}",
                                        data: $('#search-form').serialize(),
                                        dataType: 'json',
                                        success: function (data) {
                                            $('.subTable').html(data.view)
                                        },
                                    })
                                    swal(data.status, {
                                        icon: "success",
                                    });
                                }
                            })
                        }
                    });

            })

            $('#show-modal-group').click(function () {
                $('.modal-title').html('Thêm nhóm bàn');
                $('#addform').trigger('reset');
                $(':input[type="submit"]').val('create');
                $(':input[type="submit"]').html('Thêm mới');
                const inputs = $('.form-control');
                const errors = $('.text-danger');
                $.each(inputs, function (idx, input) {
                    $(input).removeClass('is-invalid');
                });
                $.each(errors, function (idx, error) {
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
                $.each(inputs, function (idx, input) {
                    $(input).removeClass('is-invalid');
                });
                $.each(errors, function (idx, error) {
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

