<table style="width: 100%; text-align: center;" class="table table-bordered" id="importProduct-table-form">
    <thead style="background-color: #DCF4FC">
    <tr>
        <th>Mã hàng hóa</th>
        <th>Tên hàng hóa</th>
        <th>Giá nhập</th>
        <th>Số lượng</th>
        <th>Tổng mua</th>
        <th>Thời gian</th>
        <th>Ghi chú</th>
        <th>Xóa</th>
    </tr>
    </thead>
    <tbody>
    @foreach($importProducts as $importProduct)
        <tr>
            <td>{{$importProduct->id}}</td>
            <td>{{$importProduct->product->name}}</td>
            <td>{{$importProduct->unit_price}}</td>
            <td>{{$importProduct->quantity}}</td>
            <td>{{$importProduct->total_buy}}</td>
            <td>{{$importProduct->created_at}}</td>
            <td>{{$importProduct->note}}</td>
            <td>
                <a><i class="fas fa-trash-alt deleteProduct"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
