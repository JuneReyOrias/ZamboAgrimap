<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesticide extends Model
{
    use HasFactory;
    protected $table='pesticides';
    protected $fillable =[
        'pesticides_name',
        'type_ofpesticides',
        'no_of_l_kg',
        'unitprice_ofpesticides',
        'total_cost_pesticides',
    ];
    public function variablecost()
    {
        return $this->belongsTo(VariableCost::class, 'id','pesticides_id');
    }
}
