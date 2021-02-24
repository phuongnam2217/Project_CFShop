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
    <div class="left__payment-header">
        <i class="fas fa-table"></i>
        {{$table->name}} / {{$table->group->name}}
    </div>
    <div class="payment__main">
        <div class="left__payment" style="width: 50%">
            <div class="payment__list">
                @foreach($order->products as $key => $item)
                    <div class="payment__item">
                        <div class="payment__item-name">
                            {{ $key+1 }}
                        </div>
                        <div class="payment__item-name">
                            {{$item->name}}
                        </div>
                        <div class="payment__item-quantity">
                            {{$item->pivot->quantity}}
                        </div>
                        <div class="payment__item-price">
                            {{number_format($item->pivot->priceEach)}}
                        </div>
                        <div class="payment__item-total">
                            {{number_format($item->pivot->total)}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="right__payment" style="width: 50%">
            <div class="sub_total right__payment-item">
                <label>Tổng Tiền : </label><span id="sub_total" data="{{$order->sub_total}}">{{number_format($order->sub_total)}}</span>
            </div>
            <div class="discount right__payment-item">
                <label for="">Giảm giá: (%): </label>
                <input type="number" id="discount">
            </div>
            <div class="total right__payment-item">
                <label>Khách cần trả: </label><span id="total">{{number_format($order->sub_total)}}</span>
            </div>
            <div class="customer right__payment-item">
                <label for="">Khách thanh toán: </label>
                <input type="number" id="customer">
            </div>
            <div class="excess right__payment-item">
                <label for="">Tiền thừa trả khách: </label>
                <span id="excess"></span>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" data="{{$order->id}}" id="action_payment" class="btn btn-success">Thanh toán</button>
</div>

