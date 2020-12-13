@section('datatables_css')
    @include('layouts.datatables_css')
@endsection

{!! $dataTable->table(['width' => '100%', 'class' => 'table table-hover table-striped table-bordered']) !!}

@section('datatables_script')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endsection
