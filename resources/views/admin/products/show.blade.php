@extends('admin.admin')
@section('title', 'Products')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Detail Product
                    </h3>
                </div>
                {!! Form::model($product, ['route' => ['products.show', $product->id], 'method' => 'patch']) !!}
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->image }}" srcset="" style="width: 100%">
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="form-group col-sm-6">
                             {!! Form::label('category', 'Category :') !!}
                             {!! Form::select('category_id', [null => 'Choose Category'] + $categories, null, ['class' => 'form-control', 'disabled', 'readonly']) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('name', 'Name :') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Name...', 'disabled', 'readonly']) !!}
                       </div>
                       <div class="form-group col-sm-6">
                            {!! Form::label('sku', 'SKU :') !!}
                            {!! Form::text('sku', null, ['class' => 'form-control', 'placeholder' => 'Enter SKU...', 'disabled', 'readonly']) !!}
                       </div>
                       <div class="form-group col-sm-6">
                            {!! Form::label('price', 'Price :') !!}
                            {!! Form::number('price', null, ['class' => 'form-control', 'placeholder' => 'Enter Price...', 'disabled', 'readonly']) !!}
                       </div>
                       <div class="form-group col-sm-6">
                            {!! Form::label('status', 'Status :') !!}
                            {!! Form::select('status', [
                                \App\Models\Product::STATUS_ACTIVE => \App\Models\Product::STATUS_ACTIVE,
                                \App\Models\Product::STATUS_INACTIVE => \App\Models\Product::STATUS_INACTIVE
                            ], null, ['class' => 'form-control', 'placeholder' => 'Choose Status', 'disabled', 'readonly']) !!}
                       </div>
                       <div class="form-group col-sm-12">
                            {!! Form::label('description', 'Description :') !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter Description...', 'disabled', 'readonly']) !!}
                       </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
