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
                                        <h1 class="h4 text-gray-900 mb-4 mt-3">Payment</h1>
                                        @if (session()->has('message'))
                                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        Bayar Disini
                                                        <ul>
                                                            <li>Bank BCA: 1234567890</li>
                                                            <li>Bank Mandiri: 0987654321</li>
                                                            <li> Bank BNI: 9876543210</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="products">
                                            <div class="col-lg-12">
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for=""></label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="">upload bukti bayar</label>
                                                        <input type="file" class="form-control" name="gambar">
                                                    </div>
                                                </form>
                                            </div>
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
    </ul>
</nav>
</section>