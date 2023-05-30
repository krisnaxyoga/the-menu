@extends('layouts.admin')
@section('title', 'dashboard')
@section('content')
    <section>
        <div class="container mt-3">
            <h1 class="mt-2">Pesanan selesai</h1>
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
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h3>Total Harga : <span style="font-weight:bold" class="text-danger">{{ 'Rp ' . number_format($total, 0, ',', '.') }}</span></h3>
                            {{-- <form action="{{ route('order.bayar') }}" method="post">
                                @csrf
                                <input class="form-control" hidden type="number" name="total" value="{{ $total }}">
                                <input class="form-control" hidden type="text" name="cust" value="{{ $cust_id }}">
                                <button type="submit" class="btn btn-success">Order Selesai</button>
                            </form> --}}
                            <a href="{{ route('order.bayar',$cust_id) }}" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
