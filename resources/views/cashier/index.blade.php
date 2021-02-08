<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous"
    />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
        crossorigin="anonymous"
    />
    <link rel="stylesheet" href="{{asset('cashier/css/reset.css')}}"/>
    <link rel="stylesheet" href="{{asset('cashier/css/cashier.css')}}"/>
</head>
<body>
<div class="cashier">
    <div class="row">
        <div class="col-6" class="header">
            <!-- Header -->
            <ul class="nav header__list" id="pills-tab" role="tablist">
                <li class="nav-item header__item" role="presentation">
                    <a
                        class="nav-link active header__link"
                        id="pills-home-tab"
                        data-bs-toggle="pill"
                        href="#pills-home"
                        role="tab"
                        aria-controls="pills-home"
                        aria-selected="true"
                    ><i class="header__icon fas fa-table"></i> Phòng bàn</a
                    >
                </li>
                <li class="nav-item header__item" role="presentation">
                    <a
                        class="nav-link header__link"
                        id="pills-profile-tab"
                        data-bs-toggle="pill"
                        href="#pills-profile"
                        role="tab"
                        aria-controls="pills-profile"
                        aria-selected="false"
                    >
                        <i class="fas fa-utensils"></i>
                        Thực đơn
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <!-- Table -->
                <div class="tables tab-pane fade show active" id="pills-home" role="tabpanel"
                     aria-labelledby="pills-home-tab">
                    <div class="wrap__filter">
                        <ul class="wrap__list">
                            <li class="wrap__item"><a href="javascript:void(0)" data-group-id="0"
                                                      class="wrap__link active-table">Tất cả</a>
                            </li>
                            @foreach($groups as $group)
                                <li class="wrap__item">
                                    <a href="javascript:void(0)"
                                       data-group-id="{{$group->id}}"
                                       class="wrap__link">{{$group->name}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="wrap__form">
                            <form action="">
                                <div class="wrap__group"><input type="text" class="form-control wrap__input"
                                                                placeholder="Tìm bàn"/></div>
                            </form>
                        </div>
                    </div>
                    <div class="tables__list">
                        @foreach($tables as $table)
                            <div
                                class="tables__item tables__item{{$table->id}} {{$table->order_id ? 'tables__active':''}}"
                                title="{{$table->name}}" data-order-id="{{$table->order_id}}"
                                data-table-id="{{$table->id}}"
                            >
                                <div class="tables__icon">
                                    <i class="fas fa-chair"></i>
                                </div>
                                <div class="tables__content">{{$table->name}}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Product -->
                <div
                    class="product tab-pane fade"
                    id="pills-profile"
                    role="tabpanel"
                    aria-labelledby="pills-profile-tab"
                >
                    <!-- Wrap Product -->
                    <div class="category__filter">
                        <ul class="category__list">
                            <li class="category__item">
                                <a
                                    href="javascript:void(0)"
                                    data-category-id="1"
                                    class="category__link active-table"
                                >Tất cả</a
                                >
                            </li>
                            @foreach($categories as $category)
                                <li class="category__item">
                                    <a
                                        href="javascript:void(0)"
                                        data-category-id="{{$category->id}}"
                                        class="category__link"
                                    >{{$category->name}}</a
                                    >
                                </li>
                            @endforeach
                        </ul>
                        <div class="category__form">
                            <form action="" id="searcher">
                                @csrf
                                <input
                                    id="searcher" name="searcher"
                                    type="text"
                                    class="form-control wrap__input"
                                    placeholder="Tìm sản phẩm .."
                                />
                            </form>
                        </div>
                    </div>
                    <!-- Product List -->
                    <div class="product__list" id="product-category-list">
                        @foreach($products as $product)
                            <div class="product__item detailProduct" table-id="{{$table->id}}" product-id="{{$product->id}}">
                                <div style="height: 100px" class="product__img">
                                    <img src="{{$product->image}}" alt=""/>
                                </div>
                                <div class="product__content">
                                    <p class="product__name">{{$product->name}}</p>
                                    <p class="product__price">{{number_format($product->price)}} đ</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6" class="header" id="cart">
            <!-- header__left -->
{{--            <div class="header__left">--}}
{{--                <ul class="header__left__list">--}}
{{--                    <li class="nav-item header__left__item" role="presentation">--}}
{{--                        <a--}}
{{--                            class="nav-link active header__left__link"--}}
{{--                            id="pills-home-tab"--}}
{{--                            data-bs-toggle="pill"--}}
{{--                            href="javascript:void(0)"--}}
{{--                            role="tab"--}}
{{--                            aria-controls="pills-home"--}}
{{--                            aria-selected="true"--}}
{{--                        >--}}
{{--                            Hóa đơn 1</a--}}
{{--                        >--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--                <ul class="action">--}}
{{--                    <li class="action__item">admin</li>--}}
{{--                    <li class="action__item">--}}
{{--                        <div class="dropdown">--}}
{{--                            <a--}}
{{--                                class="btn"--}}
{{--                                href="#"--}}
{{--                                role="button"--}}
{{--                                id="dropdownMenuLink"--}}
{{--                                data-bs-toggle="dropdown"--}}
{{--                                aria-expanded="false"--}}
{{--                            >--}}
{{--                                <i class="action__icon fas fa-bars"></i>--}}
{{--                            </a>--}}

{{--                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">--}}
{{--                                <li><a class="dropdown-item" href="{{route('home')}}">Quản lí</a></li>--}}
{{--                                <li>--}}
{{--                                    <a class="dropdown-item" href="{{route('logout')}}">Đăng xuất</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--            <div class="tab-content" id="">--}}
{{--                <!-- Orders -->--}}

{{--                <div--}}
{{--                    class="cart tables tab-pane fade show active"--}}
{{--                    id="pills-home"--}}
{{--                    role="tabpanel"--}}
{{--                    aria-labelledby="pills-home-tab"--}}
{{--                >--}}
{{--                    <div class="nav__filter">--}}
{{--                        <ul class="nav__list">--}}
{{--                            <li class="nav__item">--}}
{{--                                <a--}}
{{--                                    href="javascript:void(0)"--}}
{{--                                    data-group-id="1"--}}
{{--                                    class="nav__link active-table"--}}
{{--                                >Bàn 1 / Trong nhà</a--}}
{{--                                >--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <div class="cart__list">--}}
{{--                        <div class="cart__item">--}}
{{--                            <div class="cart__trash">--}}
{{--                                <i class="cart__icon fas fa-trash-alt"></i>--}}
{{--                            </div>--}}

{{--                            <div class="cart__id">1</div>--}}
{{--                            <div class="cart__name">Coca</div>--}}
{{--                            <div class="cart__form">--}}
{{--                                <button class="cart__decrease">-</button>--}}
{{--                                <input class="cart__input" type="text" value="2"/>--}}
{{--                                <button class="cart__increase">+</button>--}}
{{--                            </div>--}}
{{--                            <div class="cart__price">12000</div>--}}
{{--                            <div class="cart__total">24000</div>--}}
{{--                        </div>--}}
{{--                        <div class="cart__item">--}}
{{--                            <div class="cart__trash">--}}
{{--                                <i class="cart__icon fas fa-trash-alt"></i>--}}
{{--                            </div>--}}

{{--                            <div class="cart__id">2</div>--}}
{{--                            <div class="cart__name">Expresso</div>--}}
{{--                            <div class="cart__form">--}}
{{--                                <button class="cart__decrease">-</button>--}}
{{--                                <input--}}
{{--                                    class="cart__input"--}}
{{--                                    style="width: 30px"--}}
{{--                                    type="text"--}}
{{--                                    value="2"--}}
{{--                                />--}}
{{--                                <button class="cart__increase">+</button>--}}
{{--                            </div>--}}
{{--                            <div class="cart__price">10000</div>--}}
{{--                            <div class="cart__total">20000</div>--}}
{{--                        </div>--}}
{{--                        <div class="cart__item">--}}
{{--                            <div class="cart__trash">--}}
{{--                                <i class="cart__icon fas fa-trash-alt"></i>--}}
{{--                            </div>--}}

{{--                            <div class="cart__id">1</div>--}}
{{--                            <div class="cart__name">Coca</div>--}}
{{--                            <div class="cart__form">--}}
{{--                                <button class="cart__decrease">-</button>--}}
{{--                                <input class="cart__input" type="text" value="2"/>--}}
{{--                                <button class="cart__increase">+</button>--}}
{{--                            </div>--}}
{{--                            <div class="cart__price">12000</div>--}}
{{--                            <div class="cart__total">24000</div>--}}
{{--                        </div>--}}
{{--                        <div class="cart__item">--}}
{{--                            <div class="cart__trash">--}}
{{--                                <i class="cart__icon fas fa-trash-alt"></i>--}}
{{--                            </div>--}}

{{--                            <div class="cart__id">2</div>--}}
{{--                            <div class="cart__name">Expresso</div>--}}
{{--                            <div class="cart__form">--}}
{{--                                <button class="cart__decrease">-</button>--}}
{{--                                <input--}}
{{--                                    class="cart__input"--}}
{{--                                    style="width: 30px"--}}
{{--                                    type="text"--}}
{{--                                    value="2"--}}
{{--                                />--}}
{{--                                <button class="cart__increase">+</button>--}}
{{--                            </div>--}}
{{--                            <div class="cart__price">10000</div>--}}
{{--                            <div class="cart__total">20000</div>--}}
{{--                        </div>--}}
{{--                        <div class="cart__item">--}}
{{--                            <div class="cart__trash">--}}
{{--                                <i class="cart__icon fas fa-trash-alt"></i>--}}
{{--                            </div>--}}

{{--                            <div class="cart__id">1</div>--}}
{{--                            <div class="cart__name">Coca</div>--}}
{{--                            <div class="cart__form">--}}
{{--                                <button class="cart__decrease">-</button>--}}
{{--                                <input class="cart__input" type="text" value="2"/>--}}
{{--                                <button class="cart__increase">+</button>--}}
{{--                            </div>--}}
{{--                            <div class="cart__price">12000</div>--}}
{{--                            <div class="cart__total">24000</div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <!-- Emty cart -->--}}
{{--                    <div class="empty"></div>--}}

{{--                    <div class="bill">--}}
{{--                        <div class="bill__content">--}}
{{--                            <div class="bill__item bill__text">Tổng tiền</div>--}}
{{--                            <div class="bill__item bill__quantity">2</div>--}}
{{--                            <div class="bill__item bill__total">300000</div>--}}
{{--                        </div>--}}
{{--                        <div class="bill__action">--}}
{{--                            <button--}}
{{--                                class="bill__pay btn-success"--}}
{{--                                data-bs-toggle="modal"--}}
{{--                                data-bs-target="#modalPayment"--}}
{{--                            >--}}
{{--                                <i class="fas fa-dollar-sign"></i>--}}
{{--                                Thanh Toán--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
</div>

<div
    class="modal fade payment"
    id="modalPayment"
    tabindex="-1"
    aria-labelledby="exampleModalFullscreenLabel"
    style="display: none"
    aria-hidden="true"
>
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content payment__content">
            <div class="modal-header">
                <h5 class="modal-title h5" id="exampleModalFullscreenLabel">
                    Phiếu thanh toán
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <!-- If else payment -->
                <div class="left__payment">
                    <div class="left__payment-header">
                        <i class="fas fa-table"></i>
                        Bàn 1 - trong nhà
                    </div>
                </div>
                <div class="right__payment"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success">Thanh toán</button>
            </div>
        </div>
    </div>
</div>
<script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
    integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU"
    crossorigin="anonymous"
></script>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
    integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj"
    crossorigin="anonymous"
></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('cashier/js/cashier.js')}}"></script>
<script src="{{asset('cashier/js/menu.js')}}"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        const getViewGroupTable = function (id) {
            $.ajax({
                type: 'get',
                url: "tables/" + id + "/viewTable",
                dataType: 'json',
                success: function (data) {
                    $('.tables__list').html(data);
                    let table_id = localStorage.getItem('table_id');
                    $('.tables__item' + table_id).addClass('tables__focus');
                }
            })
        }
        //Active Khi reload web
        $('.tables__item' + localStorage.getItem('table_id')).addClass('tables__focus');

        // Active wrap link
        const wrap_links = $('.wrap__link')
        $.each(wrap_links, function (indexInArray, valueOfElement) {
            $(valueOfElement).on('click', function () {
                $.each(wrap_links, function (indexInArray, valueOfElement) {
                    $(this).removeClass('active-table');
                });
                $(this).addClass('active-table');
            })
        });

        // Gọi ajax thay đổi html tables list
        $('.wrap__link').on('click', function () {
            const groupId = $(this).attr('data-group-id');
            getViewGroupTable(groupId);
        })
        //View cart
        const viewCart = function (table_id){
            $.ajax({
                type: 'get',
                url: "{{route('orders.index')}}"+'/'+table_id+'/viewCard',
                success: function (data){
                    $('#cart').html(data);
                },
                errors: function (xhr){
                    console.log(xhr.responseJSON)
                }
            })
        }
        viewCart(localStorage.getItem('table_id'))
        // Active wrap link và gọi ajax
        $('body').on('click', '.tables__item', function () {
            const tables__links = $('.tables__item')
            $.each(tables__links, function (indexInArray, valueOfElement) {
                $(this).removeClass('tables__focus');
            });
            $(this).addClass('tables__focus');
            let id = $(this).attr('data-table-id');
            localStorage.setItem('table_id', id);
            let table_id = localStorage.getItem('table_id');
            viewCart(table_id);
            // $('#pills-home-tab').removeClass('active');
            // $('#pills-profile-tab').addClass('active');
            // $('#pills-home').removeClass('show');
            // $('#pills-home').removeClass('active');
            // $('#pills-profile').addClass('show');
            // $('#pills-profile').addClass('active');
        })

        $('body').on('click','.product__item',function (){
            let product_id = $(this).attr('product-id');
            let table_id = localStorage.getItem('table_id');
            $.ajax({
                method: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'product_id': product_id,
                    'table_id': table_id
                },
                url: "{{route('orders.add')}}",
                success: function (data){
                    console.log(data);
                    viewCart(table_id);
                },
                error: function (xhr){
                    console.log(xhr.responseJSON)
                }
            })
        })

//    Active category_link
        const category_links = $('.category__link')

        $('.category__link').on('click', function () {

            $.each(category_links, function (indexInArray, valueOfElement) {
                $(valueOfElement).removeClass('active-table');
            });
            const categoryId = $(this).attr('data-category-id');
            $(this).addClass('active-table')
            //   Gọi ajax để thay đổi html products
        })

        // Action
        $('#icon').on('click', function () {
            console.log(1)
        })

        // Modal Payment
        $('.bill__pay').on('click', function () {
            $('#modalPayment').show();
            $('.payment__content').addClass('payment__content-right');
        })

    })
</script>
</body>
</html>
