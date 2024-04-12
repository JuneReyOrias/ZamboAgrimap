<?php

namespace App\Imports;

use App\Models\FixedCost;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportFixedCost implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    protected $personalInformationId;

    public function __construct($personalInformationId)
    {
        $this->personalInformationId = $personalInformationId;
    }


    public function model(array $row)
    {
      
        return new FixedCost([
            'personal_information_id' => $this->personalInformationId,
            'no_of_ha'=>$row['no_of_ha'],
            'cost_per_ha'=>$row['cost_per_ha'],
            'total_amount'=>$row['total_amount'],
        ]);
    }
}
