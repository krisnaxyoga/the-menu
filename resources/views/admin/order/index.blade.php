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
                                    <th>status</th>
                                    <th>customer</th>
                                    <th>table number</th>
                                    <th>menu</th>
                                    <th>qty</th>
                                    <th>sub total</th>
                                    <th>waktu reservasi</th>
                                    <th>tanggal reservasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    @if($item->is_active == 1)
                                    <td>
                                        <span class="bg-warning badge text-bg-warning text-light">menu sedang di siapkan</span>
                                    </td>
                                    @elseif($item->is_active == 2)
                                    <td>
                                        <span class="bg-success badge text-bg-succes text-light">sudah dibayar</span>
                                    </td>
                                    @else
                                    <td>
                                        <span class="bg-primary badge text-bg-primary text-light">selesai</span>
                                    </td>
                                    @endif
                                    <td>{{ $item->customer->name }}</td>
                                    <td>{{ $item->table->table_number }}</td>
                                   <td>{{ $item->product->name }}</td>
                                   <td>{{ $item->qty }}</td>
                                   <td>{{ $item->subtotal }}</td>
                                   <td>{{ $item->customer->waktu_reservasi }}</td>
                                   <td>{{ $item->customer->tgl_reservasi }}</td>
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
