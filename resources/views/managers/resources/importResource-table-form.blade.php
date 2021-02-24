<table style="width: 100%; text-align: center;" class="table table-bordered"
       id="importResource-table-form">
    <thead style="background-color: #DCF4FC">
    <tr>
        <th>Mã phiếu nhập</th>
        <th>Tên nguyên liệu - đơn vị</th>
        <th>Giá nhập</th>
        <th>Số lượng</th>
        <th>Tổng mua</th>
        <th>Thời gian</th>
        <th>Ghi chú</th>
        <th>Xóa</th>
    </tr>
    </thead>
    <tbody>
    @foreach($importResources as $importResource)
        <tr>
            <td>{{$importResource->id}}</td>
            <td>{{$importResource->resource->name}} - {{$importResource->resource->unit->name}}</td>
            <td>{{number_format($importResource->unit_price)}} đ</td>
            <td>{{$importResource->quantity}}</td>
            <td>{{number_format($importResource->total_buy)}} đ</td>
            <td>{{$importResource->created_at}}</td>
            <td>{{$importResource->note}}</td>
            <td hidden>{{$importResource->resource->id}}</td>
            <td>
                <a><i class="fas fa-trash-alt deleteImportResource"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
