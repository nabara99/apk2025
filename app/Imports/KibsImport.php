<?php

namespace App\Imports;

use App\Models\Kib;
use Maatwebsite\Excel\Concerns\ToModel;

class KibsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Kib([
            'name' => $row[1],
            'merk' => $row[2],
            'type' => $row[3],
            'price' => is_numeric($row[4]) ? $row[4] : 0,
            'code' => $row[5],
            'condition' => $row[6],
            'place' => $row[7],
            'year' => $row[8],
        ]);
    }
}
