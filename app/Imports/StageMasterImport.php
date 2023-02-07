<?php

namespace App\Imports;

use App\Models\stagemaster;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StageMasterImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new stagemaster([
            'stageid'    => $row['stageid'],
            'stagename' => $row['stagename'],
            'description' => $row['description'],
        ]);
    }
}
