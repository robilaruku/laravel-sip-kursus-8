<?php

namespace App\DataTables;

use App\Models\Transactions;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class TransactionsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('name', function($trx){
            if (!empty($trx->product_id)) {
                return $trx->product->name;
            }else{
                return '';
            }
        })
        ->filterColumn('name', function($query, $keyword) {
            $query->whereHas('product', function ($query) use ($keyword) {
                $query->where('products.name', 'LIKE', "%{$keyword}%");
            });
        })
        ->editColumn('trx_date', function($trx){
            if (!empty($trx->trx_date)) {
                return date('d-M-Y', strtotime($trx->trx_date));
            }else{
                return '';
            }
        })
        ->editColumn('price', function($trx){
            if (!empty($trx->price)) {
                return "Rp " . number_format($trx->price,2,',','.');
            }else{
                return '';
            }
        })
        ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Customer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Transactions $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'name' => ['searchable' => true, 'title' => 'Product Name'],
            'trx_date' => ['searchable' => true, 'title' => 'Date'],
            'price' => ['searchable' => true, 'title' => 'Price'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'transactions_datatables_' . time();
    }
}
