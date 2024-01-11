<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixedCost extends Model
{
    use HasFactory;
    protected $table="fixed_costs";
    protected $fillable=[
        'personal_informations_id',
        'farm_profiles_id',
        'particular',
        'no_of_ha',
        'cost_per_ha',
        'total_amount',
    ];

    public function farmprofiles()
    {
        return $this->belongsTo(FarmProfile::class, 'farm_profiles_id','id')->withDefault();
    }

}
