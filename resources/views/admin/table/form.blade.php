@extends('layouts.admin')
@section('title','meja')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">@if($model->exists) Edit @else Tambah @endif  @yield('title')</div>
                <div class="card-body">
                    @if (count($errors) > 0)
                        <div class="alert with-close alert-danger mb-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    <form action="@if($model->exists) {{ route('table.update', $model->id) }} @else {{ route('table.store') }} @endif" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method($model->exists ? 'PUT' : 'POST')

                        <div class="form-group">
                            <label class="small mb-1">Nomor menja<span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="table_number" type="text" placeholder="Masukan No.meja" value="{{ old('table_number', $model->table_number) }}" />
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary float-right" type="submit"><i class="far fa-save mr-1"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection