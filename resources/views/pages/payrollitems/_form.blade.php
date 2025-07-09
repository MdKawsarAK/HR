@csrf
@if ($mode === 'edit')
    @method('PUT')
@endif

<div class="mb-2">
    <label>Name</label>
    <input type="text" name="name" value="{{ old('name', $payrollitem->name ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>Type id</label>
    <select name="type_id" class="form-select">
        <option value="">Select Type id</option>
        @foreach ($types as $option)
            <option value="{{ $option->id }}" {{ old('type_id', $payrollitem->type_id ?? '') == $option->id ? 'selected' : '' }}>{{ $option->name ?? $option->id }}</option>
        @endforeach
    </select>
</div>
<button class="btn btn-success">{{ $mode === 'edit' ? 'Update' : 'Create' }}</button>