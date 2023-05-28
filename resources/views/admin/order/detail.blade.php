@extends('layouts.admin')
@section('title', 'dashboard')
@section('content')
    <section>
        <div class="container mt-3">
            <h1 class="mt-2">Pesanan</h1>
            <div class="row">
                <div class="col-lg-6">
                    @foreach ($order as $item)
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p>Customers Name : {{ $item->customer->name }}</p>
                                        <p>Table :{{ $item->table->table_number }}</p>
                                        <p>Pesanan : {{ $item->product->name }}</p>
                                    </div>
                                    <div>
                                        <p>Jumlah : {{ $item->qty }}</p>
                                        <p>Sub Total Harga: {{ $item->subtotal }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
