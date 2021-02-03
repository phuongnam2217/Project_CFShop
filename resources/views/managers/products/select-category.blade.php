<select name="category_id" class="form-select select-category"
        aria-label="Default select example">
    @foreach($categories as $category)
        <option
            value="{{ $category->id }}">{{ $category->name }}</option>
    @endforeach
</select>
