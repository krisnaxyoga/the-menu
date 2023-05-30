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
                            <button class="btn btn-secondary mx-2" id="print-excel">Cetak Excel</button>
                        </div>
                        <h3>Total pendapatan : <span class="text-success" style="font-weight: bold">{{ 'Rp ' . number_format($total, 0, ',', '.') }}</span></h3>
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

<script>
    document.getElementById('print-excel').addEventListener('click', function() {
        // Ambil data yang ingin dicetak
        var array = {{$data}};
        var data = [
            ['CUSTOMER', 'TOTAL BAYAR','DATE'],
            array.forEach(function(element) {
                [ element.customer->name, element.total, element.created_at],
            });
        ];

        // Buat workbook baru
        var workbook = XLSX.utils.book_new();
        
        // Buat worksheet
        var worksheet = XLSX.utils.aoa_to_sheet(data);
        
        // Tambahkan worksheet ke workbook
        XLSX.utils.book_append_sheet(workbook, worksheet, 'Data');
        
        // Simpan workbook sebagai file Excel
        XLSX.writeFile(workbook, 'data.xlsx');
        });
</script>
@endsection