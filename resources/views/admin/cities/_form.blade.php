<div class="mb-3">
    <label for="name" class="form-label">Назва міста</label>
    <input
        type="text"
        id="name"
        name="name"
        value="{{ old('name', $city->name ?? '') }}"
        class="form-control @error('name') is-invalid @enderror"
        required
    >
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
