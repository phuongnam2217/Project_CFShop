<table style="width: 100%; text-align: center;" class="table table-bordered">
    <thead style="background-color: #DCF4FC">
    <tr>
        <th>Mã hóa đơn</th>
        <th>Thời gian</th>
        <th>Bàn</th>
        <th>Tổng tiền</th>
        <th>Trạng thái</th>
        <th>Chi tiết</th>
    </tr>
    </thead>
    <tbody>
    @if($orders)
        @foreach($orders as $order)
            <tr>
                <td>HD0000{{$order->id}}</td>
                <td>{{$order->check_in}}</td>
                @foreach($tables as $table)
                    @if($order->table_id == $table->id)
                        <td>{{$table->name}}</td>
                    @endif
                @endforeach
                <td>{{number_format($order->sub_total)}} đ</td>
                <td>{{$order->status}}</td>
                <td>
                    <a><i data-id="{{$order->id}}" class="fas fas fa-eye detailOrder"></i></a>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
