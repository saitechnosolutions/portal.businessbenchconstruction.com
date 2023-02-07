<?php

namespace App\Imports;

use App\Models\uploadedestimate;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class UploadedEstimateImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new uploadedestimate([
            'stageid'    => $row['stageid'],
            'stagename' => $row['stagename'],
            'descriptions' => $row['description'],
            'quantity' => $row['quantity'],
            'unit' => $row['unit'],
            'rate' => $row['rate'],
            'amount' => $row['amount'],
            // 'rentention_amount' => $row['rentention_amount'],
            // 'amount_released' => $row['amount_released'],
            'clientid' => $row['clientid'],
            'engid' => $row['engid'],
            'stagetotamt' => $row['stagetotamt'],
            'clientpercentage' => $row['clientpercentage'],
            'clientestimateamt' => $row['clientestimateamt'],
            'paymentsplit' => $row['paymentsplit'],
            'dueamount' => $row['dueamount'],
            'clientdescription' => $row['clientestimatedesc'],
        ]);
    }
}
