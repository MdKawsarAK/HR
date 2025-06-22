@csrf
@if ($mode === 'edit')
    @method('PUT')
@endif

<div class="mb-2">
    <label>Person id</label>
    <select name="person_id" class="form-select">
        <option value="">Select Person id</option>
        @foreach ($people as $option)
            <option value="{{ $option->id }}" {{ old('person_id', $hrAttendance->person_id ?? '') == $option->id ? 'selected' : '' }}>{{ $option->name ?? $option->id }}</option>
        @endforeach
    </select>
</div>
<div class="mb-2">
    <label>Att datetime</label>
    <input type="date" name="att_datetime" value="{{ old('att_datetime', $hrAttendance->att_datetime ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>Method id</label>
    <select name="method_id" class="form-select">
        <option value="">Select Method id</option>
        @foreach ($methods as $option)
            <option value="{{ $option->id }}" {{ old('method_id', $hrAttendance->method_id ?? '') == $option->id ? 'selected' : '' }}>{{ $option->name ?? $option->id }}</option>
        @endforeach
    </select>
</div>
<button class="btn btn-success">{{ $mode === 'edit' ? 'Update' : 'Create' }}</button>