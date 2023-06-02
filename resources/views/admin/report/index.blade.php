@extends('layouts.admin')
@section('title', 'order')
@section('content')


<section>
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-3">
                <div class="card-body">
                    <form action="{{ route('report.index') }}">
                        <div class="d-flex">
                            <div class="form-group">
                                <input type="date" class="form-control" value="{{ old('startdate', request('startdate')) }}" name="startdate"> 
                            </div>
                            <p class="mx-2">To</p>
                            <div class="form-group">
                                <input type="date" class="form-control" value="{{ old('enddate', request('enddate')) }}" name="enddate">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-secondary mx-2">Filter</button>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h2>order report</h2>
                        <div class="form-group">
                            <button class="btn btn-secondary mx-2" id="printButton"><i class="fa fa-file-pdf" aria-hidden="true"></i> &nbsp; Cetak laporan</button>
                        </div>
                        {{-- <h3>Total pendapatan : <span class="text-success" id="total" style="font-weight: bold">{{ 'Rp ' . number_format($total, 0, ',', '.') }}</span></h3> --}}
                    </div>
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>customer</th>
                                    <th>total</th>
                                    <th>create at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->customer->name }}</td>
                                   <td>{{ $item->total }}</td>
                                   <td>{{ $item->created_at }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td> Total Pendapatan : <span class="text-success" id="total" style="font-weight: bold">{{ 'Rp ' . number_format($total, 0, ',', '.') }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<script>
   $(document).ready(function() {
            $('#printButton').click(function() {
                var nilai = $('#total').text();
                console.log(nilai);
                var printContents = $('#dataTable').prop('outerHTML');
                // var total = '<h3 style="font-weight: bold"> Total : '+nilai+'</h3>'
                // $('.table-bordered').append(total);
                var originalContents = $('body').html();
               
                console.log(printContents);
                $('body').html(printContents);
                window.print();

                $('body').html(originalContents);
            });
        });
</script>
@endsection