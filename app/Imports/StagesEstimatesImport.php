<?php

namespace App\Imports;

use App\Models\Stage;
use Maatwebsite\Excel\Concerns\ToModel;

class StagesEstimatesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Stage([
            //
        ]);
    }
}
