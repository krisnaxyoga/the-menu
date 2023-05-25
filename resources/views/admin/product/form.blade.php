@extends('layouts.admin')
@section('title','Product')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
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
                    <form action="@if($model->exists) {{ route('product.update', $model->id) }} @else {{ route('product.store') }} @endif" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method($model->exists ? 'PUT' : 'POST')

                        <div class="form-group">
                            <label class="small mb-1">Name <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="name" type="text" placeholder="Name" value="{{ old('name', $model->name) }}" />
                        </div>
                        <div class="form-group">
                            <?php if(old('image_name', $model->image_name) !== null){ ?>
                            <img src="{{ $model->image_url }}" class="img-fluid" style="width:200px;height:150px" alt=""/>
                            <?php }else{
                                ''
                            }  ?>
                            <label class="small mb-1">image<span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="image" type="file" placeholder="Name" value="{{ old('image_name', $model->image_name) }}" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">category<span class="text-danger">*</span></label>
                            <select name="category_id" id="" class="form-select form-control">
                                <option value="">Pilih</option>
                                @foreach ($category as $item )
                                    <option value="{{ $item->id }}" {{ old('category_id', $model->category_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">price<span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="price" type="number" placeholder="Harga" value="{{ old('price', $model->price) }}" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Description<span class="text-danger">*</span></label>
                            <textarea class="form-control form-control-solid" name="description" id="" cols="30" rows="10" value="{{ old('description', $model->description) }}">{{ old('description', $model->description) }}</textarea>
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