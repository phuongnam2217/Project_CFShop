<div class="subTable">
    <div class="card">
        <table class="data-table display nowrap dataTable dtr-inline collapsed">
            <thead>
            <tr>
                <th style="width: 30px">STT</th>
                <th style="width: 100px">Tên người dùng</th>
                <th>Tên đăng nhập</th>
                <th>Vai trò</th>
                <th>Trạng thái</th>
                <th style="width: 280px">Action</th>
            </tr>
            </thead>
            <tbody>
            @if($users)
                @foreach($users as $key => $user)
                    <tr>
                    <td>{{++$key}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->username}}</td>
                    <td><span class="badge bg-success">{{$user->role->name}}</span></td>
                    <td>
                        <span class="badge {{$user->active ? 'bg-success' : 'bg-danger'}}">{{$user->active ? 'Đang hoạt động': 'Ngưng hoạt động'}}</span>
                    </td>
                    <td>
                        <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$user->id}}" data-original-title="Edit" class="edit edit-user"><i class="fas fa-pencil-alt"></i></a>
                        <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$user->id}}" data-original-title="Delete" class="delete-user"><i class="fas fa-trash-alt"></i></a>
                    </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>
</div>
