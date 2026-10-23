@extends('layouts.app')
@section('title', 'Pinjam Alat')
@section('content')
<h3 class="mb-3">Pinjam Alat</h3>
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('peminjaman.store') }}" method="POST">
            @csrf

<div class="mb-3">
    <label class="form-label">Pilih Alat dan Jumlah</label>

    @foreach ($alatTersedia as $alat)
        <div class="row align-items-center mb-2">
            <div class="col-md-8">
                <label for="item_{{ $alat->id }}" class="form-label mb-0">
                    {{ $alat->code }} - {{ $alat->name }}
                    (Stok: {{ $alat->stock }})
                </label>
            </div>

            <div class="col-md-4">
                <input
                    type="number"
                    id="item_{{ $alat->id }}"
                    name="items[{{ $alat->id }}]"
                    min="0"
                    max="{{ $alat->stock }}"
                    value="{{ old('items.' . $alat->id, 0) }}"
                    class="form-control"
                    placeholder="Jumlah (0 = tidak dipinjam)"
                >
            </div>
        </div>
    @endforeach
</div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="qty" class="form-label">Jumlah</label>
                    <input type="number" id="qty" name="qty" min="1" value="{{
old('qty', 1) }}"
                        class="form-control @error('qty') is-invalid
@enderror">
                    @error('qty')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-8 mb-3">
                    <label for="due_date" class="form-label">Tanggal
                        Kembali</label>
                    <input type="date" id="due_date" name="due_date"
                        value="{{ old('due_date', now()->addDays(3)->toDateString()) }}"
                        class="form-control @error('due_date') is-invalid
@enderror">
                    @error('due_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="notes" class="form-label">Keperluan</label>
                <input type="text" id="notes" name="notes" value="{{ old('notes')
}}" class="form-control"
                    placeholder="Contoh: Praktikum Elektronika Dasar">
            </div>
            <button type="submit" class="btn btn-primary">Ajukan
                Peminjaman</button>
            <a href="{{ route('peminjaman.index') }}" class="btn btnsecondary">Batal</a>
        </form>
    </div>
</div>
@endsection
