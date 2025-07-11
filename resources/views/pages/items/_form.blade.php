@csrf
@if ($mode === 'edit')
    @method('PUT')
@endif

<div class="mb-2">
    <label>Name</label>
    <input type="text" name="name" value="{{ old('name', $item->name ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>Item type id</label>
    <select name="item_type_id" class="form-select">
        <option value="">Select Item type id</option>
        @foreach ($itemTypes as $option)
            <option value="{{ $option->id }}" {{ old('item_type_id', $item->item_type_id ?? '') == $option->id ? 'selected' : '' }}>{{ $option->name ?? $option->id }}</option>
        @endforeach
    </select>
</div>
<button class="btn btn-success">{{ $mode === 'edit' ? 'Update' : 'Create' }}</button>