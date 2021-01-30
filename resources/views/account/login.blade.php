<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login form</title>
    <link rel="stylesheet" href="{{asset('account_rescource/css/account.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
<div id="formLogin">
    <form action="{{route('login')}}" method="post">
        @csrf
        <div>Đăng nhập hệ thống</div>
        <div class="logo">
            <img src="https://cdn-app.kiotviet.vn/retailler/Content/kiotvietLogo.png" alt="">
        </div>
        <input class="text-field" name="username" type="text" placeholder="Username">
        <input class="text-field" name="password" type="password" placeholder="Password">
        <div class="">
            @if(Session::has('error'))
                <div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">{{Session::get('error')}}</div>
            @endif
        </div>
        <button class="btn btn-loginForm" href="javascript:void(0)">Login</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>
