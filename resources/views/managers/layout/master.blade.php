<!DOCTYPE html>
<html lang="en">

<head>
    <title>CoffeeShop</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" />

    <base href="/admin_resource/resource">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="header">
        <div class="header-logo">
            <img src="https://fnb.kiotviet.vn/Content/img/kiotvietLogo.png" alt="" />
        </div>
        <div class="header-establish">
            <ul class="header-establish-element">
                <li>
                    <div class="btn-group" role="group">
                        <div id="btnGroupDrop1" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="hide-mobile fas fa-cog"></i> Thiết lập
                        </div>
                        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-clipboard-list"></i> Thiết lập người
                                    dùng</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-users"></i> Quản lý người dùng</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="btn-group" role="group">
                        <div id="btnGroupDrop1" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> Admin
                        </div>
                        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user-alt"></i> Tài khoản</a></li>
                            <li><a class="dropdown-item" href="{{route('logout')}}"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="nav">
        <div class="container">
            <div class="row">
                <a id="home" class="element" href="{{route('home')}}">
                    <i class="fas fas fa-eye"></i> Tổng quan
                </a>
                <a id="products" class="element" href="{{route('products')}}">
                    <i class="fas fa-box-open"></i> Hàng hóa
                </a>
                <a id="resources" class="element" href="{{route('resources')}}">
                    <i class="fas fa-people-carry"></i> Nguyên liệu
                </a>
                <a id="tables" class="element" href="{{route('tables')}}">
                    <i class="fas fa fa-table"></i> Phòng bàn
                </a>
                <a id="invoices" class="element" href="{{route('invoices')}}">
                    <i class="fas fa-file-invoice-dollar"></i> Hóa đơn
                </a>
                <a id="reports" class="element" href="{{route('reports')}}"><i class="fas fa-chart-pie"></i> Báo cáo</a>
                <a class="element cashier">
                    <i class="fas fa-scroll"></i> Thu ngân
                </a>
            </div>
        </div>
    </div>

    @yield('content')

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
    <script src="main.js"></script>
    @yield("js")
</body>

</html>
