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
                            <li>
                                @if($item->is_active == 1)
                                @if ($item->id == $rev)
                                <a href="{{route('menu.food',['table'=>$item->table_number,'cust'=>$cust])}}" class="btn btn-primary">menu</a>
                                @endif
                                 @else <a href="{{route('menu',['table'=>$item->table_number,'cust'=>$cust])}}" class="btn btn-primary">reservasi</a> @endif

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
