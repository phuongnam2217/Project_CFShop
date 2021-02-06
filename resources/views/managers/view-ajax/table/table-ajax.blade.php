@foreach($tables as $table)
    <div
        class="tables__item tables__item{{$table->id}} {{$table->order_id ? 'tables__active':''}}"
        title="{{$table->name}}" data-order-id="{{$table->order_id}}" data-table-id="{{$table->id}}"
    >
        <div class="tables__icon">
            <i class="fas fa-chair"></i>
        </div>
        <div class="tables__content">{{$table->name}}</div>
    </div>
@endforeach
