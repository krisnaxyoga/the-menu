@extends('layouts.admin')
@section('title', 'dashboard')
@section('content')
<style>
    .loader {
      border: 5px solid #ffffff;
      border-radius: 50%;
      border-top: 5px solid #3498db;
      width: 20px;
      height: 20px;
      -webkit-animation: spin 2s linear infinite; /* Safari */
      animation: spin 2s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    </style>
    <section>
        <div class="container mt-3">
            <h1 class="mt-2">Pesanan</h1>
            <div class="row">
                <div class="col-lg-6">
                    @if(count($order) == 0)
                    <div class="d-flex">
                        <div class="loader mx-2"></div>
                    <p>masih memesan...</p>
                    </div>

                    @endif
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
                @if(count($order) != 0)
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h3>Total Harga : <span style="font-weight:bold" class="text-danger">{{ 'Rp ' . number_format($total, 0, ',', '.') }}</span></h3>
                            <form action="{{ route('order.store') }}" method="post">
                                @csrf
                                <input class="form-control" hidden type="number" name="total" value="{{ $total }}">
                                <input class="form-control" hidden type="text" name="cust" value="{{ $cust_id }}">
                                <button type="submit" class="btn btn-primary">Pesanan Selesai</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
@endsection
