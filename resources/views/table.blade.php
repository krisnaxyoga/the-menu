@extends('layouts.app')
@section('title', 'menu')
@section('content')
<section class="mt-5">
    <div class="container">
        
    <h1 class="text-center">MEJA</h1>
        <div class="row">
            @foreach ($data as $item)
            <div class="col-lg-4">
                <div class="card @if($item->is_active == 1) bg-danger @else bg-success @endif">
                    <div class="card-body">
                        <ul>
                            <li><p class="text-white">Nomor meja : {{$item->table_number}}</p></li>
                            <li><a href="{{route('menu',$item->table_number)}}" class="btn btn-primary">reservasi</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection