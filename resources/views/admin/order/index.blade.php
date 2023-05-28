@extends('layouts.admin')
@section('title', 'order')
@section('content')
<section>
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h2>order</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>customer</th>
                                    <th>table number</th>
                                    <th>menu</th>
                                    <th>qty</th>
                                    <th>sub total</th>
                                    <th>create at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->customer->name }}</td>
                                    <td>{{ $item->table->table_number }}</td>
                                   <td>{{ $item->product->name }}</td>
                                   <td>{{ $item->qty }}</td>
                                   <td>{{ $item->subtotal }}</td>
                                   <td>{{ $item->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection