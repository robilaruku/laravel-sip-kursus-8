@extends('admin.admin')
@section('title', 'Products')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Create Product
                    </h3>
                </div>
                {!! Form::open(['route' => 'products.store', 'method' => 'post', 'files' => true]) !!}
                <div class="card-body">
                   @if (!empty($errors->all()))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="row">
                        <div class="form-group col-sm-6">
                             {!! Form::label('category', 'Category :') !!}
                             {!! Form::select('category_id', [null => 'Choose Category'] + $categories, null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('name', 'Name :') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Name...']) !!}
                       </div>
                       <div class="form-group col-sm-6">
                            {!! Form::label('sku', 'SKU :') !!}
                            {!! Form::text('sku', null, ['class' => 'form-control', 'placeholder' => 'Enter SKU...']) !!}
                       </div>
                       <div class="form-group col-sm-6">
                            {!! Form::label('price', 'Price :') !!}
                            {!! Form::number('price', null, ['class' => 'form-control', 'placeholder' => 'Enter Price...']) !!}
                       </div>
                       <div class="form-group col-sm-6">
                            {!! Form::label('status', 'Status :') !!}
                            {!! Form::select('status', [
                                \App\Models\Product::STATUS_ACTIVE => \App\Models\Product::STATUS_ACTIVE,
                                \App\Models\Product::STATUS_INACTIVE => \App\Models\Product::STATUS_INACTIVE,
                            ], null, ['class' => 'form-control', 'placeholder' => 'Choose Status']) !!}
                       </div>
                       <div class="form-group col-sm-6">
                            {!! Form::label('image', 'Image :') !!}
                            {!! Form::file('image', ['class' => 'form-control']) !!}
                       </div>
                       <div class="form-group col-sm-12">
                            {!! Form::label('description', 'Description :') !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter Description...']) !!}
                       </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary"><i class="fa fa-arrow-left"></i> Back</a>
                    <button class="btn btn-primary float-right" type="submit"><i class="fa fa-save"></i> Save</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
