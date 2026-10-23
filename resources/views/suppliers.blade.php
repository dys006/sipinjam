
@extends('layouts.app')

@section('title', 'suppliers')

@section('content')
<h3 class="mb-4">Daftar Supplier</h3>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No.</th>
                        <th>Nama Suppliers</th>
                        <th>No Telepon</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
