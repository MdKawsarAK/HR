@csrf
@if ($mode === 'edit')
    @method('PUT')
@endif

<div class="mb-2">
    <label>Employee id</label>
    <select name="employee_id" class="form-select">
        <option value="">Select Employee id</option>
        @foreach ($employees as $option)
            <option value="{{ $option->id }}" {{ old('employee_id', $payrollInvoice->employee_id ?? '') == $option->id ? 'selected' : '' }}>{{ $option->name ?? $option->id }}</option>
        @endforeach
    </select>
</div>
<div class="mb-2">
    <label>Billed at</label>
    <input type="text" name="billed_at" value="{{ old('billed_at', $payrollInvoice->billed_at ?? '') }}" class="form-control">
</div>
<div class="mb-2">
    <label>Invoice total</label>
    <input type="text" name="invoice_total" value="{{ old('invoice_total', $payrollInvoice->invoice_total ?? '') }}" class="form-control">
</div>
<button class="btn btn-success">{{ $mode === 'edit' ? 'Update' : 'Create' }}</button>