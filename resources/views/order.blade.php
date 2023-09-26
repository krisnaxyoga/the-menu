@extends('layouts.app')
@section('title', 'menu')
@section('content')
<section>
    <div class="container">

        <!-- Outer Row -->

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4 mt-3">Order List</h1>
                                        @if (session()->has('message'))
                                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                    </div>
                                    <div class="container">
                                        <div class="row justify-content-center" id="products">
                                            @foreach ($data as $key=>$item)
                                                <div class="col-lg-4 col-md-6 col-12 mb-5">
                                                    <div class="card">
                                                         <div class="card-body">
                                                            <div class="d-flex justify-content-between">
                                                                <div>
                                                                  <h3>Menu : </h3>
                                                                  <p style="font-weight: bold">{{$item->product->name}}</p>
                                                                  <p>Qty :</p>
                                                                  <p style="font-weight: bold">{{$item->qty}} pcs</p>
                                                                </div>
                                                                <div>
                                                                    <p>sub total : <span style="font-weight: bold">{{'Rp ' . number_format($item->subtotal, 0, ',', '.')}}</span></p>

                                                                </div>
                                                            </div>
                                                            {{-- <span>
                                                                @if($item->is_active == 1)
                                                                <span class="bg-warning badge text-bg-warning text-light">menu sedang di siapkan</span>
                                                                @elseif($item->is_active == 2)
                                                                <span class="bg-success badge text-bg-succes text-light">sudah dibayar</span>
                                                                @else
                                                                <span class="bg-primary badge text-bg-primary text-light">selesai</span>
                                                                @endif
                                                            </span> --}}
                                                            <span>
                                                                @if($item->is_active == 1)
                                                                <span class="bg-warning badge text-bg-warning text-light">pesanan belum di bayar</span>
                                                                @elseif($item->is_active == 2)
                                                                <span class="bg-success badge text-bg-succes text-light">pesanan selesai</span>
                                                                @elseif($item->is_active == 0)
                                                                <span class="bg-info badge text-bg-info text-light">pesanan di proses</span>
                                                                @else
                                                                <span class="bg-primary badge text-bg-primary text-light">selesai</span>
                                                                @endif
                                                            </span>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

    </div>
   <!-- Bottom Navbar -->
<nav style="height: 62px;border-radius: 26px;" class="navbar navbar-dark bg-light shadow navbar-expand fixed-bottom">
    <ul class="navbar-nav nav-justified w-100">
        <li class="nav-item">
            <a href="{{ route('menu.food',['table'=>$meja,'cust'=>$cust]) }}" class="nav-link text-center text-secondary">
                <i class="fa fa-home"></i>
                <span class="small d-block">Home</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('cart',['table'=>$meja,'cust'=>$cust]) }}" class="nav-link text-center text-secondary">
                <i class="fa fa-shopping-cart"></i>
                <span class="small d-block">Cart</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('orderlist',['table'=>$meja,'cust'=>$cust])}}" class="nav-link text-center text-secondary">
                <i class="fa fa-book" aria-hidden="true"></i>
                <span class="small d-block">Order list</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('payment',['table'=>$meja,'cust'=>$cust])}}" class="nav-link text-center text-secondary">
                <i class="fa fa-credit-card" aria-hidden="true"></i>
                <span class="small d-block">Bayar Pesanan</span>
            </a>
        </li>
    </ul>
</nav>
</section>

@endsection
