<div class="subTable">
    <div class="card">
        <table class="data-table display nowrap dataTable dtr-inline collapsed">
            <thead>
            <tr>
                <th style="width: 30px">STT</th>
                <th style="width: 100px">Tên bàn</th>
                <th style="width: 100px">Ghi chú</th>
                <th>Nhóm bàn</th>
                <th>Số ghế</th>
                <th>Trạng thái</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if($tables)
                @foreach($tables as $key => $table )
                    <tr>
                        <td hidden>{{$table->id}}</td>
                        <td>{{++$key}}</td>
                        <td>{{$table->name}}</td>
                        <td>{{$table->note}}</td>
                        <td>{{$table->group_id}}</td>
                        <td>{{$table->chair}}</td>
                        <td>
                            <span data-id="{{$table->id}}" class="changeActive badge {{($table->active ?'bg-success': 'bg-danger' )}}"> {{$table->active ? 'Đang hoạt động': 'Ngưng hoạt động'}}</span>
                        </td>
                        <td>
                            <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$table->id}}" data-original-title="Edit" class="edit edit-table"><i class="fas fa-pencil-alt"></i></a>
                            <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$table->id}}" data-original-title="Delete" class="delete-table"><i class="fas fa-trash-alt"></i></a>
                        </td>
                @endforeach
            @endif
            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>
</div>
