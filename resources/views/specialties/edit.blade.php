@extends('layouts.app')

@section('title', 'Edit Specialty')

@section('content')
<style>
.form-page-container {
    max-width: 600px;
    margin: 0 auto;
}

.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 24px;
}

.page-header h1 {
    margin: 0;
    font-size: 24px;
    font-weight: 700;
    color: #0f172a;
    letter-spacing: -0.4px;
}

.page-header p {
    margin: 4px 0 0;
    color: #64748b;
    font-size: 13px;
}

.form-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    padding: 24px;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    margin-bottom: 6px;
    color: #334155;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .03em;
}

.form-control {
    width: 100%;
    padding: 10px 14px;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    background: #ffffff;
    color: #0f172a;
    font-size: 14px;
    box-sizing: border-box;
    transition: all .15s ease;
}

.form-control:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
}

textarea.form-control {
    min-height: 110px;
    resize: vertical;
}

.invalid-feedback {
    color: #dc2626;
    font-size: 12px;
    margin-top: 5px;
}

.is-invalid {
    border-color: #f87171 !important;
}

.form-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 24px;
    padding-top: 20px;
    border-top: 1px solid #f1f5f9;
}

.btn {
    min-height: 40px;
    padding: 0 18px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all .15s ease;
}

.btn-primary {
    background: #2563eb;
    color: #ffffff;
    border: 1px solid #2563eb;
}

.btn-primary:hover {
    background: #1d4ed8;
    border-color: #1d4ed8;
}

.btn-secondary {
    background: #ffffff;
    color: #64748b;
    border: 1px solid #cbd5e1;
}

.btn-secondary:hover {
    background: #f8fafc;
    color: #0f172a;
}
</style>

<div class="form-page-container">

    <div class="page-header">
        <div>
            <h1>Edit Specialty</h1>
            <p>Update information for <strong>{{ $specialty->name }}</strong></p>
        </div>
        <div>
            <a href="{{ route('specialties.index') }}" class="btn btn-secondary">
                ← Cancel
            </a>
        </div>
    </div>

    <div class="form-card">
        <form action="{{ route('specialties.update', $specialty) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="form-label">Specialty Name <span style="color: #dc2626;">*</span></label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       class="form-control @error('name') is-invalid @enderror" 
                       value="{{ old('name', $specialty->name) }}" 
                       required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" 
                          id="description" 
                          class="form-control @error('description') is-invalid @enderror">{{ old('description', $specialty->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('specialties.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Specialty</button>
            </div>
        </form>
    </div>

</div>
@endsection