<div class="mb-3">
    <label for="name" class="form-label">Nama Supplier</label>
    <input type="text" id="name" name="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $suppliers->name ?? '') }}">
    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="no_tlp" class="form-label">No Telepon</label>
    <input type="number" id="no_tlp" name="no_tlp" rows="3"
        class="form-control @error('description') is-invalid @enderror">{{
old('no_tlp', $suppliers->no_tlp ?? '') }}</input>
    @error('description')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Batal</a>
