<?php

namespace App\Imports;

use App\Models\Transactions;
use Maatwebsite\Excel\Concerns\ToModel;

class TransactionsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Transactions([
            'product_id' => $row[0],
            'trx_date' => $row[1],
            'price' => $row[2],
        ]);
    }
}
