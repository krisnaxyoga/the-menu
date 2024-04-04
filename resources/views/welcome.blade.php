@extends('layouts.auth')
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
                                        <h1 class="h4 text-gray-900 mb-4">Welcome</h1>
                                    
                                        @if (session()->has('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session('error') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                    </div>
                                    <form class="user"  method="post" action="{{ route('customer.store') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control form-control-user @error('name') is-invalid @enderror"
                                                id="exampleInputname" aria-describedby="nameHelp"
                                                placeholder="Enter Name...">
                                                @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                              @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="number" name="phone" class="form-control form-control-user @error('phone') is-invalid @enderror"
                                                id="exampleInputphone" placeholder="phone">
                                                @error('phone')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                        </div>
                                        <input type="text" hidden name="table_number" value="{{$table}}" class="form-control form-control-user @error('table_number') is-invalid @enderror"/>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Reservation
                                        </button>                  
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