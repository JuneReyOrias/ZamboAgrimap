<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fertilizer extends Model
{
    use HasFactory;
    protected $table="fertilizers";
    protected $fillable=[
        'name_of_fertilizer',
        'type_of_fertilizer',
        'no_ofsacks',
        'unitprice_per_sacks',
        'total_cost_fertilizers'
    ];
    public function farmprofiles()
    {
        return $this->belongsTo(FarmProfile::class, 'farm_profiles_id','id')->withDefault();
    }
    public function variablecost()
    {
        return $this->belongsTo(VariableCost::class, 'id','fertilizers_id');
    }
}
