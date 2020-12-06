@extends('admin.admin')
@section('title', 'Products')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        List Products
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('products.create') }}" class="btn btn-tool">
                            <i class="fa fa-plus"></i> Add product
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if (Session::has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check"></i>&nbsp; {{ Session::get('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    {!! Form::open(['route' => 'products.index', 'method' => 'GET']) !!}
                    <div class="row">
                        <div class="form-group col-sm-4">
                            {!! Form::label('category', 'Category') !!}
                            {!! Form::select('category', $categories, $category, ['class' => 'form-control', 'placeholder' => 'Choose Category']) !!}
                        </div>
                        <div class="form-group col-sm-4">
                            {!! Form::label('name', 'Name') !!}
                            {!! Form::text('search', $search, ['class' => 'form-control', 'placeholder' => 'Filter Name']) !!}
                        </div>
                        <div class="form-group col-sm-4" style="margin-top: 2.5%">
                            <label for="">&nbsp;</label>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary"><i class="fa fa-sync"></i> Reload</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" id="dt">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Sku</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $item)
                                    <tr>
                                        <td>{{ ($products->currentpage()-1) * $products->perpage() + $key + 1  }}</td>
                                        <td>{{ $item->category->name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->sku }}</td>
                                        <td>{{ 'Rp. '.number_format($item->price,2,',','.') }}</td>
                                        <td>
                                            <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->image }}" width="100px">
                                        </td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            {!! Form::open(['route' => ['products.destroy', $item->id], 'method' => 'DELETE']) !!}
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <a href="{{ route('products.show', $item->id) }}" class="btn btn-sm btn-info" style="color: #fff"><i class="fa fa-eye"></i></a>
                                                    <a href="{{ route('products.edit', $item->id) }}" class="btn btn-sm btn-warning" style="color: #fff"><i class="fa fa-edit"></i></a>
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure ?')" style="color: #fff"><i class="fa fa-trash"></i></button>
                                                </div>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="float-right">
                                    {{ $products->appends(request()->input())->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @section('script')
    <script>
        $(function(){
            $('#dt').DataTable();
        });
    </script>
@endsection --}}
