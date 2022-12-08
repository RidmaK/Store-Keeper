<?php

namespace App\Imports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportOder implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new Order([
            'source' => $row[9],
            'full_name' => $row[12],
            'phone' => $row[13],
            'address' => $row[14],
        ]);
    }
}
