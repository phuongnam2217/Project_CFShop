<form action="" id="resource-table-form">
    @foreach($resources as $resource)
        <div>
            <label hidden>{{$resource->id}}</label>
            <label>{{$resource->name}} - {{$resource->unit->name}}</label>
            <a><i class="fas fa-trash-alt deleteResource"></i></a>
        </div>
    @endforeach
</form>
