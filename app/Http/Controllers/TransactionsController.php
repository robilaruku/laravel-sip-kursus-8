<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Excel;
use Session;

use App\Models\Transactions;
use App\Imports\TransactionsImport; // import 

use App\DataTableS\TransactionsDataTable; // import datatable

class TransactionsController extends Controller
{
    public function index(TransactionsDataTable $dataTable) {
        // $transactions = Transactions::get();
        // return view('admin.transactions.index', compact('transactions'));
        // dump($dataTable);exit;
        return $dataTable->render('admin.transactions.index');
    }

    public function create() {
        return view('admin.transactions.create');
    }

    public function import(Request $request) {
        $rules = [
            'excel'     => 'required'
        ];

        $messages = [
            'excel.required'        => 'File excel tidak boleh kosong.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        // ambil file excel
        $excel = $request->file('excel');

        Excel::import(new TransactionsImport, $request->file('excel'));

        Session::flash('success', 'Transactions Imported');

        return redirect('admin/transactions');

    }
}
