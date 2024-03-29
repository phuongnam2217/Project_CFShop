<!DOCTYPE html>
<html lang="en">

<head>
    <title>CoffeeShop</title>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <meta name="_token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"/>
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
          integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
          crossorigin="anonymous"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">

{{--    Favicon--}}
    <link rel="shortcut icon" href="{{{ asset('image/logo.png') }}}">
    <!--  -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet"/>

    {{--     --}}
    <base href="/admin_resource/resource">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="{{asset('account_rescource/css/profile.css')}}">
</head>

<body>
<div class="header">
    <div class="header-logo">
        <img style="width: 90px; height: 50px" src="{{asset('image/logo2.png')}}" alt=""/>
    </div>
    <div class="header-establish">
        <ul class="header-establish-element">
            <li>
                <div class="btn-group" role="group">
                    <div id="btnGroupDrop1" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="hide-mobile fas fa-cog"></i> Thiết lập
                    </div>
                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <li><a class="dropdown-item" href="{{route('users.index')}}"><i class="fas fa-users"></i> Quản
                                lý người dùng</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="btn-group" role="group">
                    <div id="btnGroupDrop1" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle"></i> {{\Illuminate\Support\Facades\Auth::user()->name}}
                    </div>
                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <li><a id="showProfile" class="dropdown-item" href="javascript:void(0)"><i
                                    class="fas fa-user-alt"></i> Tài khoản</a></li>
                        <li><a class="dropdown-item" href="{{route('logout')}}"><i class="fas fa-sign-out-alt"></i> Đăng
                                xuất</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="nav">
    <div class="container-fluid">
        <div class="row">
            <a id="home" class="element" href="{{route('home')}}">
                <i class="fas fas fa-eye"></i> Tổng quan
            </a>
            @if(\Illuminate\Support\Facades\Auth::user()->role_id == 1)
            <a id="products" class="element" href="{{route('product.index')}}">
                <i class="fas fa-box-open"></i> Hàng hóa
            </a>
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->role_id == 1 || \Illuminate\Support\Facades\Auth::user()->role_id == 2 )
            <a id="resources" class="element resource" href="{{route('resource.index')}}">
                <i class="fas fa-people-carry"></i> Nguyên liệu
            </a>
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->role_id == 1 || \Illuminate\Support\Facades\Auth::user()->role_id == 2 )
            <a id="importProducts" class="element resource" href="{{route('importProduct.index')}}">
                <i class="fas fa-cube"></i> Nhập hàng
            </a>
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->role_id == 1)
            <a id="tables" class="element" href="{{route('table.index')}}">
                <i class="fas fa fa-table"></i> Phòng bàn
            </a>
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->role_id == 1 || \Illuminate\Support\Facades\Auth::user()->role_id == 3 )
            <a id="invoices" class="element" href="{{route('invoice.index')}}">
                <i class="fas fa-file-invoice-dollar"></i> Hóa đơn
            </a>
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->role_id == 1)
            <a id="reports" class="element" href="{{route('reports.index')}}"><i class="fas fa-chart-pie"></i> Báo cáo</a>
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->role_id == 1 || \Illuminate\Support\Facades\Auth::user()->role_id == 3 )
            <a class="element" href="{{route('orders.index')}}">
                <i class="fas fa-scroll"></i> Thu ngân
            </a>
            @endif
        </div>
    </div>
</div>
</div>

@yield('content')

<div class="modal fade" id="modalProfile" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="header-profile">Người dùng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="profile-form" class="row g-3" style="margin: 0">
                    @csrf
                    <div class="col-md-6">
                        <label for="" class="form-label">Tên người dùng</label>
                        <input type="text" class="form-control" id="name-profile" name="name">
                        <div class="text-danger text-center name-profile-err"></div>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Tên đăng nhập</label>
                        <input type="text" class="form-control" id="username-profile" name="username">
                        <div class="text-danger text-center username-profile-err"></div>
                    </div>
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email-profile" name="email">
                        <div class="text-danger text-center email-profile-err"></div>
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone-profile" name="phone">
                        <div class="text-danger text-center phone-profile-err"></div>
                    </div>
                    <div class="col-md-12">
                        <label for="inputState" class="form-label">Vai trò :</label>
                        <span style="margin-left: 10px" class="badge {{(Auth::user()->role->id == \App\Constants\RoleConstant::ROLE_ADMIN ? 'bg-success' : (Auth::user()->role->id == \App\Constants\RoleConstant::ROLE_STOCKER? 'bg-primary' : 'bg-info' ))}}" id="role-profile">{{\Illuminate\Support\Facades\Auth::user()->role->name}}</span>
                    </div>
                    <div class="col-12 justify-content-end d-flex">
                        <button id="submit" type="submit" class="btn btn-success">Cập nhật</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="accordion" style="width: 100%" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Đổi mật khẩu
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                             data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row">
                                    <form action="" id="password-form">
                                        @csrf
                                        <div class="col-sm-6">
                                            <label>Mật khẩu hiện tại</label>
                                            <div class="form-group pass_show">
                                                <input id="profile-current-password" name="current_password" type="password" value="" class="form-control"
                                                       placeholder="Mật khẩu hiện tại">
                                            </div>
                                            <div class="text-center text-danger current_password-err"></div>
                                            <label>Mật khẩu mới</label>
                                            <div class="form-group pass_show">
                                                <input id="profile-password" name="password" type="password" value="" class="form-control"
                                                       placeholder="Mật khẩu mới">
                                            </div>
                                            <div class="text-center text-danger password-err"></div>
                                            <label>Nhập lại mật khẩu mới</label>
                                            <div class="form-group pass_show">
                                                <input id="profile-passwordConfirm" name="password_confirmation" type="password" value="" class="form-control"
                                                       placeholder="Nhập lại mật khẩu mới">
                                            </div>
                                            <div class="text-center text-danger password-confirm-err"></div>
                                        </div>
                                        <div class="col-12 justify-content-end d-flex">
                                            <button id="submit" type="submit" class="btn btn-success">Đổi mật khẩu</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
        integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous"></script>
<script src="main.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

    <script src="main.js"></script>
{{--<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.js"></script>--}}
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#showProfile').click(function () {
            const text_danger = $('.text-danger');
            const inputs = $('.form-control');
            $.each(inputs,function (idx,input){
                $(input).removeClass('is-invalid');
            })
            $.each(text_danger,function (idx,text){
                $(text).html('');
            })
            $.ajax({
                type: "GET",
                url: "{{route('profile.show')}}",
                success: function (data) {
                    $('#name-profile').val(data.user.name);
                    $('#username-profile').val(data.user.username);
                    $('#email-profile').val(data.user.email);
                    $('#phone-profile').val(data.user.phone);
                    // $('#role-profile').html(data.role.name);
                    $("#modalProfile").modal('show');
                },
                error: function (data) {
                    console.log(data);
                }
            })
        })

        //    Update profile
        $('#profile-form').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{route('profile.update')}}",
                data: $('#profile-form').serialize(),
                dataType: 'json',
                success: function (data) {
                    $('#profile-form').modal('hide');
                    swal('Success!', data, "success");
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors
                    if(errors.name){
                        $('#name-profile').addClass('is-invalid');
                        $('.name-profile-err').html(errors.name);
                    }
                    if(errors.username){
                        $('#username-profile').addClass('is-invalid');
                        $('.username-profile-err').html(errors.username);
                    }
                    if(errors.email){
                        $('#email-profile').addClass('is-invalid');
                        $('.email-profile-err').html(errors.email);
                    }
                    if(errors.phone){
                        $('#phone-profile').addClass('is-invalid');
                        $('.phone-profile-err').html(errors.phone)
                    }
                }
            })
        })
        //Đổi mật khẩu profile
        $('#password-form').on('submit',function (e){
            e.preventDefault();
            console.log('REQUEST', $('#password-form').serialize());
            $.ajax({
                method: "POST",
                data: $('#password-form').serialize(),
                dataType: 'json',
                url: "{{route('profile.changePassword')}}",
                success: function (data){
                    swal('Success!', data, "success");
                    $('#modalProfile').modal('hide');
                },
                error: function (xhr){
                    let errors = xhr.responseJSON.errors
                    if(errors.current_password){
                        $('.current_password-err').html(errors.current_password);
                        $('#profile-current-password').addClass('is-invalid');
                    }
                    if(errors.password){
                        $('.password-err').html(errors.password)
                        $('#profile-password').addClass('is-invalid')
                    }
                }
            })
        })
    })
</script>
<script>
    @if (session('alert'))
    swal('Warning!',"{{ session('alert') }}", "warning");
    @endif
</script>
@yield("js")
@yield("ajax")
</body>

</html>
