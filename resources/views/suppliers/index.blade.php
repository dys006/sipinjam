@extends('layouts.app')
@section('title', 'Suppliers')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Daftar Pemasok</h3>
    <a href="{{ route('suppliers.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Pemasok
    </a>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Pemasok</th>
                    <th>No Telepon</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($suppliers as $supplier)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->no_tlp }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada
                        Supplier.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
