@extends('layouts.admin')
@section('title', 'dashboard')
@section('content')
    <section>
        <div class="container mt-3">
            <h1 class="mt-2">Pesanan</h1>
            <div class="row">
                @foreach ($order as $item)
                    <div class="col-lg-6">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p>Customers Name : {{ $item->name }}</p>
                                        <a href="{{ route('order.show',$item->id) }}" class="btn btn-success">Pesanan</a>
                                    </div>
                                    <div>
                                        <p>Table :{{ $item->table->table_number }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
