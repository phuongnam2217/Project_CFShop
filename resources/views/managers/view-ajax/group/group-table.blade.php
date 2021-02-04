@foreach($groups as $group)
    <div>
        <input class="group" id="group-{{$group->id}}" name="group_id[]" value="{{$group->id}}"
               type="checkbox"/>
        <label for="group-{{$group->id}}">{{$group->name}}</label>
        <a><i data-id="{{$group->id}}" class="fas fa-trash-alt deletegroup"></i></a>
        <a><i data-id="{{$group->id}}" class="fas fa-pencil-alt editgroup"></i></a>
    </div>
@endforeach
