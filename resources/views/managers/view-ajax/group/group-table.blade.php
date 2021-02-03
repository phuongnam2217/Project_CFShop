@foreach($groups as $group)
    <div>
        <input id="{{$group->name}}" name="group_id[]" value="{{$group->id}}" type="checkbox" />
        <label for="{{$group->name}}">{{$group->name}}</label>
        <a><i data-id="{{$group->id}}" class="fas fa-trash-alt deletegroup"></i></a>
        <a><i data-id="{{$group->id}}" class="fas fa-pencil-alt editgroup"></i></a>
    </div>
@endforeach
