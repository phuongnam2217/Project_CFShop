<option value="">-- Lựa chọn --</option>
@foreach($groups as $group)
    <option class="option-group option{{$group->id}}" value="{{$group->id}}">{{$group->name}}</option>
@endforeach
