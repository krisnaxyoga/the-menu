@extends('layouts.admin')
@section('title', 'dashboard')
@section('content')
    <section>
        <div class="container mt-3">
            <h1 class="mt-2">Pesanan</h1>
            <hr>
            <div class="row" id="cart-items">

            </div>
            <h2>pesanan selesai</h2>
            <hr>
            <div class="row">
                 @foreach ($orderpaid as $item)
                    <div class="col-lg-6">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p>Customers Name : {{ $item->name }}</p>
                                        <a href="{{ route('order.showselesai',$item->id) }}" class="btn btn-secondary">paid</a>
                                    </div>
                                    <div>
                                        <p>Table :{{ $item->table->table_number }}</p>
                                        <p>Tgl :{{ $item->tgl_reservasi }}</p>
                                        <p>waktu :{{ $item->waktu_reservasi }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <h3>pesanan telah dibayar</h3>
            <hr>
            <div class="row">
                @foreach ($orderbayar as $item)
                   <div class="col-lg-6">
                       <div class="card mb-2">
                           <div class="card-body">
                               <div class="d-flex justify-content-between">
                                   <div>
                                       <p>Customers Name : {{ $item->name }}</p>
                                       <a href="#" class="btn btn-warning">telah di bayar</a>
                                   </div>
                                   <div>
                                       <p>Table :{{ $item->table->table_number }}</p>

                                       <p>Tgl :{{ $item->tgl_reservasi }}</p>
                                       <p>waktu :{{ $item->waktu_reservasi }}</p>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               @endforeach
           </div>
           <h3>Meja</h3>
           <hr>
           {{-- @if (session()->has('message'))
           <div class="row">
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                </div>
           </div>
            @endif --}}
           <div class="row">
            @foreach ($table as $item)
            <div class="col-lg-4">
                <div class="card @if($item->is_active == 1) bg-danger @else bg-success @endif">
                    <div class="card-body">
                        <ul>
                            <li><p class="text-white">Nomor meja : {{$item->table_number}}</p></li>
                            @if($item->is_active == 1)
                            <li><a href="{{route('kosongkanmeja',$item->id)}}" class="btn btn-primary">kosongkan</a></li>
                             @endif

                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
           </div>
        </div>
    </section>
    <script>
        function getData() {
        $.ajax({
            url: '/api/data', // Ganti dengan URL endpoint yang sesuai
            method: 'GET',
            success: function(response) {
            // Perbarui tampilan dengan data terbaru
            // ...
            $("#cart-items").html("");
                $.each(response?.data, function(index, item) {
                    // console.log(item.name,">>>>ITEM NAME")
                    var html = '<div class="col-lg-6"><div class="card mb-2"><div class="card-body"><div class="d-flex justify-content-between"><div><p>Customers Name : '+item.name+'</p><a href="/order/'+item.id+'" class="btn btn-success">Pesanan</a><a href="/hapusorder/'+item.id+'" class="btn btn-danger ml-2">hapus</a></div><div><p>Table :'+item.table.table_number+'</p><p>Tanggal :'+item.tgl_reservasi+'</p><p>Waktu :'+item.waktu_reservasi+'</p></div></div></div></div></div>'


                $("#cart-items").append(html);
                });
            console.log(response,">>>>DATA")

            // Lakukan polling kembali setelah beberapa waktu
            setTimeout(getData, 5000); // Misalnya, polling setiap 5 detik
            },
            error: function(error) {
            console.log('Terjadi kesalahan saat memperoleh data.');
            console.log(error);
            }
        });
        }

        // Mulai polling saat halaman dimuat
        $(document).ready(function() {
        getData();
        });
        </script>
@endsection
