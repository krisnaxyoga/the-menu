@extends('layouts.admin')
@section('title', 'meja')
@section('content')
<section>
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h2>@yield('title')</h2>
                </div>
                <div class="card-body">
                    <a href="{{ route('table.create') }}" class="btn btn-primary mb-2">add</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nomor meja</th>
                                    <th>created</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($table as $item)
                                <tr>
                                    <td>{{ $item->table_number }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td><a href="{{ route('table.edit',$item->id) }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="edit"></i></a>
                                        <a href="{{ route('table.edit',$item->id) }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i class='fas fa-qrcode'></i></a>
                                    
                                        <form class="d-inline" action="{{route('table.destroy', $item->id)}}" method="POST" onSubmit="return confirm('Apakah anda yakin akan menghapus data ini?');">
                                            @csrf
                                            @method('delete')

                                            <button type="submit" class="btn btn-datatable btn-icon btn-transparent-dark mr-2">
                                                <i data-feather="trash-2"></i>
                                            </button>
                                        </form>
                                    </td>
                                   
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