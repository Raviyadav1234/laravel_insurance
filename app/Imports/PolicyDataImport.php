<?php

namespace App\Imports;

use App\Models\PolicyData;
use Maatwebsite\Excel\Concerns\ToModel;

class PolicyDataImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PolicyData([
            //
        ]);
    }
}
