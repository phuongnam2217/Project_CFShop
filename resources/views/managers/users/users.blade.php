@extends('managers.layout.master')
@section('content')
    <div class="body">
        <div class="search">
            <div class="search-name">
                <form id="search-form">
                    <label for="" class="search-name-text">Tìm kiếm</label>
                    <input name="name" type="text" class="input" placeholder="Theo tên người dùng, .." />
                </form>
            </div>
            <div class="search-name" style="height: 130px">
                <form action="GET" id="search-form">
                    @csrf
                    <p class="search-name-text">Trạng thái</p>
                    <div><input type="checkbox" /> <label for="">Đang hoạt động</label></div>
                    <div><input type="checkbox" /> <label for="">Ngừng hoạt động</label></div>
                </form>
            </div>
        </div>
        <div class="table">
            <div class="subHeader">
                <div>
                    <h2>Người dùng</h2>
                </div>
                <div>

                    <!-- Thêm bàn -->
                    <div id="createUser" class="mybutton" data-bs-toggle="modal" data-bs-target="#modalUser">
                        <i class="fas fa-plus"></i> Người dùng
                    </div>
                    <div class="modal fade" id="modalUser" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Thêm mới người dùng</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="userForm" class="row g-3" style="margin: 0">
                                        @csrf
                                        <input type="hidden" name="id" id="id">
                                        <div class="col-md-6">
                                            <label for="" class="form-label">Tên người dùng</label>
                                            <input type="text" class="form-control" id="name" name="name" >
                                            <div class="text-danger text-center nameErr"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="form-label">Tên đăng nhập</label>
                                            <input type="text" class="form-control" id="username" name="username" >
                                            <div class="text-danger text-center usernameErrr"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputEmail4" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" >
                                            <div class="text-danger text-center emailErr"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputPassword4" class="form-label">Số điện thoại</label>
                                            <input type="text" class="form-control" id="phone" name="phone" >
                                            <div class="text-danger text-center phoneErr"></div>
                                        </div>
                                        <div class="col-6">
                                            <label for="inputAddress" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="" >
                                            <div class="text-danger text-center passwordErr"></div>
                                        </div>
                                        <div class="col-6">
                                            <label for="inputAddress2" class="form-label">Password Confirm</label>
                                            <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm" placeholder="" >
                                            <div class="text-danger text-center passwordConfirmErr"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputState" class="form-label">Vai trò</label>
                                            <select id="roles" name="role_id" class="form-select">
                                              @foreach($roles as $role)
                                                    <option class="role role{{$role->id}}" value="{{$role->id}}">{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 justify-content-end d-flex">
                                            <button id="submit" type="submit" class="btn btn-success">Sign in</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Thêm nhóm bàn -->


                </div>
            </div>
            <div class="card">
                <table class="data-table display nowrap dataTable dtr-inline collapsed">
                    <thead>
                       <tr>
                           <th style="width: 30px">STT</th>
                           <th style="width: 100px">Tên người dùng</th>
                           <th>Tên đăng nhập</th>
                           <th>Vai trò</th>
                           <th>Trạng thái</th>
                           <th style="width: 280px">Action</th>
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
@endsection
@section('js')
    <script>
        $(function (){
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
                    url: '{{route('users.index')}}',
                    data: function (d) {
                        d.name = $('input[name=name]').val();
                        d.email = $('input[name=email]').val();
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'username', name: 'username'},
                    {data: 'role_id',name: 'role_id'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            $('#search-form').on('submit change', function(e) {
                e.preventDefault();
                table.draw();
            })

            //Hiện form thêm mới người dùng
            $('#createUser').on('click',function (){
                $('.modal-title').html('Thêm mới người dùng');
                $('#userForm').trigger("reset");
                $('#saveBtn').val("create-Customer");
                $('#id').val('');
                $('#submit').val('create-user');
                const inputs = $('.form-control');
                const errors = $('.text-danger');
                $.each(inputs,function (idx,input){
                   $(input).removeClass('is-invalid');
                });
                $.each(errors,function (idx,error){
                    $(error).html('');
                });
                $('#submit').html('Thêm mới');
            })

            //Hiên cập nhật thông tin người dùng
            $('body').on('click','.edit-user',function (){
                let id = $(this).attr('data-id');
                $('#userForm').trigger('reset');
                $.ajax({
                    method: 'GET',
                    url: "{{route('users.index')}}"+"/"+id,
                    success: function (data){
                        const roles = $('.role')
                        $('#id').val(data.id);
                        $('#name').val(data.name);
                        $('#username').val(data.username);
                        $('#email').val(data.email);
                        $('#phone').val(data.phone);
                        $.each(roles,function (idx,role){
                            $(role).removeAttr('selected');
                        })
                        $(".role"+data.role_id).attr('selected','selected')
                        $('.modal-title').html('Cập nhật thông tin người dùng')
                        $('#submit').html('Cập nhật')
                        $('#submit').val('edit-user');
                        $('#modalUser').modal('show');
                    }
                })
            })

        //    Thêm mới user và edit users
            $('#submit').click(function (e){
                e.preventDefault();
                let valueSubmit = $(this).val();

                //Thêm mới
                if(valueSubmit == 'create-user'){
                    $.ajax({
                        type: "POST",
                        url: "{{route('users.store')}}",
                        data: $('#userForm').serialize(),
                        dataType: 'JSON',
                        success: function (data){
                            $('#modalUser').modal('hide');
                            table.draw();
                            swal('Success!',data,"success");
                        },
                        error: function (xhr){
                            let errors = xhr.responseJSON.errors;
                            if(errors.name){
                                $('.nameErr').html(errors.name[0]);
                                $('#name').addClass('is-invalid');
                            }
                            if(errors.username){
                                $('.usernameErrr').html(errors.username[0]);
                                $('#username').addClass('is-invalid');
                            }
                            if(errors.email){
                                $('.emailErr').html(errors.email[0]);
                                $('#email').addClass('is-invalid');
                            }
                            if(errors.phone){
                                $('.phoneErr').html(errors.phone[0]);
                                $('#phone').addClass('is-invalid');
                            }
                            if(errors.password){
                                $('.passwordErr').html(errors.password[0]);
                                $('#password').addClass('is-invalid');
                            }
                            if(errors.passwordConfirm){
                                $('.passwordConfirmErr').html(errors.passwordConfirm[0]);
                                $('#passwordConfirm').addClass('is-invalid');
                            }
                        }
                    })
                }

            //    Cập nhật
                if(valueSubmit == 'edit-user'){
                    let id = $('#id').val();
                    $.ajax({
                        type: "PUT",
                        url: "{{route('users.index')}}"+'/'+id,
                        data: $('#userForm').serialize(),
                        dataType: 'JSON',
                        success: function (data){
                            $('#modalUser').modal('hide');
                            table.draw();
                            swal("Success!",data,"success");
                        },
                        error: function (xhr){
                            let errors = xhr.responseJSON.errors;
                            if(errors.name){
                                $('.nameErr').html(errors.name[0]);
                                $('#name').addClass('is-invalid');
                            }
                            if(errors.username){
                                $('.usernameErrr').html(errors.username[0]);
                                $('#username').addClass('is-invalid');
                            }
                            if(errors.email){
                                $('.emailErr').html(errors.email[0]);
                                $('#email').addClass('is-invalid');
                            }
                            if(errors.phone){
                                $('.phoneErr').html(errors.phone[0]);
                                $('#phone').addClass('is-invalid');
                            }
                            if(errors.password){
                                $('.passwordErr').html(errors.password[0]);
                                $('#password').addClass('is-invalid');
                            }
                            if(errors.passwordConfirm){
                                $('.passwordConfirmErr').html(errors.passwordConfirm[0]);
                                $('#passwordConfirm').addClass('is-invalid');
                            }
                        }
                    })
                }
            })

            $('body').on('click','.delete-user',function (){
                let id = $(this).attr('data-id');
                swal({
                    title: "Delete?",
                    text: "Bạn có chắc xóa người dùng này !",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                type: "GET",
                                url: '{{route('users.index')}}'+'/'+id+"/delete",
                                dataType: 'JSON',
                                success: function (data){
                                    table.draw();
                                    swal(data, {
                                        icon: "success",
                                    });
                                },
                                error: function (xhr){
                                    let errors = xhr.responseJSON.errors;
                                    console.log(errors);
                                }
                            })
                        }
                    });
            })

            $('body').on('click','.changeActive',function (){
                let id = $(this).attr('data-id');
                console.log(id)
                $.ajax({
                    type: 'GET',
                    url: "{{route('users.index')}}"+"/"+id+"/changeActive",
                    dataType: "json",
                    success: function (data){
                        table.draw();
                        swal(data, {
                            icon: "success",
                        });
                    },
                    error: function (data){
                        console.log(data)
                    }
                })
            })


        })
    </script>
@endsection
