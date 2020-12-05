@extends('admin.admin')
@section('title', 'Detail Kategori')
@section('content')
    <div class="row">
        <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Show Category</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Category</label>
                            <input value="{{ $category->name }}" readonly type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" class="form-control" readonly value="{{ $category->status }}">
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection

