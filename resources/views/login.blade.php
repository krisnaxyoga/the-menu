@extends('layouts.app')
@section('title', 'welcome')
@section('content')

<section>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-6 col-md-12">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                        @if (session()->has('message'))
                                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                                {{ session('message') }}
                                            </div>
                                        @endif
                                        @if (session()->has('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session('error') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                    </div>
                                    <form class="user"  method="get" action="{{ route('home.loginproses') }}">
                                        @csrf

                                        <div class="form-group">
                                            <input required type="text" name="email" class="form-control form-control-user @error('name') is-invalid @enderror"
                                                id="exampleInputname" aria-describedby="nameHelp"
                                                placeholder="Enter email...">
                                        </div>
                                        <div class="form-group">
                                            <input required type="number" name="phone" class="form-control form-control-user @error('phone') is-invalid @enderror"
                                                id="exampleInputphone" placeholder="phone">
                                                @error('phone')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            login
                                        </button>
                                        belum punya akun? <a href="{{ route('home.register') }}">daftar disini</a>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
