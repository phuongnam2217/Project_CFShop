<form action="" id="category-table-form">
    @foreach($categories as $category)
        <div>
            <label hidden>{{$category->id}}</label>
            <label>{{$category->name}}</label>
            <a><i class="fas fa-trash-alt deletecategory"></i></a>
            <a><i class="fas fa-pencil-alt editcategory"></i></a>
        </div>
    @endforeach
</form>
