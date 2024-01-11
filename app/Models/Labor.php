<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labor extends Model
{
    use HasFactory;
    protected $table="labors";
    protected $fillable=[
        'no_of_person',
        'rate_per_person',
        'total_labor_cost',
       
    ];

    public function farmprofiles()
    {
        return $this->belongsTo(FarmProfile::class, 'farm_profiles_id','id')->withDefault();
    }
    public function variablecost()
    {
        return $this->belongsTo(VariableCost::class, 'id','labors_id');
    }
}
