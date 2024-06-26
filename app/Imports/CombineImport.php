<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CombineImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Personal Informations' => new PersonalInfoImport(),
            'FarmProfile' => new  ImportFarmProfile(),

        ];
    }
}
