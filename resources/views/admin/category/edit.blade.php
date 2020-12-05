@extends('admin.admin')
@section('title', 'Edit Kategori')
@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ url('admin/category/'. $category->id) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Category</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Category</label>
                            <input value="{{ $category->name }}" type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" id="">
                                <option {{ $category->status == 'active' ? 'selected' : '' }} value="active">Active</option>
                                <option {{ $category->status == 'inactive' ? 'selected' : '' }} value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-outline-info">Back</a>
                        <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

