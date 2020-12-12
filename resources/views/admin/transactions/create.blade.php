@extends('admin.admin')
@section('title', 'Transactions')
@section('content')
    <div class="row">
        <div class="col-12">
            {{ Form::open(['route'=>'transactions.import', 'files'=>true]) }}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Import Excel</h3>
                    </div>
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
                        <div class="form-group">
                            {{ Form::label('excel', 'File Excel') }}
                            {{ Form::file('excel', ['class'=>'form-control']) }}
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('admin/transactions') }}" class="btn btn-outline-secondary"><i class="fa fa-arrow-left"></i> Back</a>
                    <button class="btn btn-primary float-right" type="submit"><i class="fa fa-save"></i> Import</button>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection