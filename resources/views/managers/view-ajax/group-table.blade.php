@foreach($groups as $group)
    <div>
        <label hidden>{{$group->id}}</label>
        <input type="checkbox" />
        <label>{{$group->name}}</label>
        <a><i class="fas fa-trash-alt deletegroup"></i></a>
        <a><i class="fas fa-pencil-alt editgroup"></i></a>
    </div>
@endforeach
