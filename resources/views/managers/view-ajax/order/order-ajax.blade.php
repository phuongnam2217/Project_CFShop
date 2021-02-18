<div class="header__left">
    <ul class="header__left__list">
        <li class="nav-item header__left__item" role="presentation">
            <a
                class="nav-link active header__left__link"
                id="pills-home-tab"
                data-bs-toggle="pill"
                href="javascript:void(0)"
                role="tab"
                aria-controls="pills-home"
                aria-selected="true"
            >
                HD0000{{$order->id}} </a
            >
        </li>
    </ul>
    <ul class="action">
        <li class="action__item">admin</li>
        <li class="action__item">
            <div class="dropdown">
                <a
                    class="btn"
                    href="#"
                    role="button"
                    id="dropdownMenuLink"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                >
                    <i class="action__icon fas fa-bars"></i>
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="{{route('home')}}">Quản lí</a></li>
                    <li>
                        <a class="dropdown-item" href="{{route('logout')}}">Đăng xuất</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</div>
<div class="tab-content" id="">
    <!-- Orders -->
    <div
        class="cart tables tab-pane fade show active"
        id="pills-home"
        role="tabpanel"
        aria-labelledby="pills-home-tab"
    >
        <div class="nav__filter">
            <ul class="nav__list">
                <li class="nav__item">
                    <a
                        href="javascript:void(0)"
                        data-group-id="1"
                        class="nav__link active-table"
                    >{{$table->name}}/ {{$table->group->name}}</a
                    >
                </li>
            </ul>
            <ul class="nav__list">
                <li class="nav__item">
                    <a
                        href="javascript:void(0)"
                        data-group-id="1"
                        class="nav__link"
                    >Trạng thái: <span
                            class="{{$order->status == 2 ? 'text-danger' : 'text-success'}}">{{$order->status == 2 ? 'Đang chờ' : 'Hoàn tất'}}</span></a
                    >
                </li>
            </ul>
        </div>
        <div class="cart__list">
            @foreach($order->products as $item)
                <div class="cart__item">
                    <div class="cart__trash" product-id="{{$item->id}}">
                        <i class="cart__icon fas fa-trash-alt"></i>
                    </div>

                    <div class="cart__id">{{$item->id}}</div>
                    <div class="cart__name">{{$item->name}}</div>
                    <div class="cart__form">
                        <button class="cart__decrease" product-id="{{$item->id}}">-</button>
                        <input class="cart__input" type="text" value="{{$item->pivot->quantity}}"/>
                        <button class="cart__increase" product-id="{{$item->id}}">+</button>
                    </div>
                    <div class="cart__price">{{$item->pivot->priceEach}}</div>
                    <div class="cart__total">{{$item->pivot->total}}</div>
                    <div class="cart__status">
                        <input type="checkbox" value="{{$item->pivot->isMaking}}" class="cart__isMaking"
                               product-id="{{$item->id}}" {{$item->pivot->isMaking ? "checked":""}}>
                        @if($item->pivot->isMaking)
                            <div class="">
                                {{!\Carbon\Carbon::setLocale('vi')}}
                                {{\Carbon\Carbon::parse($item->pivot->release_at)->longAbsoluteDiffForHumans($item->pivot->created_at)}}
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
            <div class="empty"></div>
        </div>

        <!-- Emty cart -->
        <div class="bill">
            <div class="bill__content">
                <div class="bill__item bill__text">Tổng tiền:</div>
                {{--                <div class="bill__item bill__quantity">2</div>--}}
                <div class="bill__item bill__total">{{$order->sub_total}}</div>
            </div>
            <div class="bill__action">
                <button
                    class="bill__pay btn-success"
                    data-bs-toggle="modal"
                    data-bs-target="#modalPayment"
                >
                    <i class="fas fa-dollar-sign"></i>
                    Thanh Toán
                </button>
            </div>
        </div>
    </div>
</div>
