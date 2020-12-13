@extends('admin.admin')
@section('title', 'Transactions')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        List Transactions
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('transactions.create') }}" class="btn btn-tool">
                            <i class="fa fa-plus"></i> Import transactions
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
                    <div class="table-responsive">
                        @include('admin.transactions.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
