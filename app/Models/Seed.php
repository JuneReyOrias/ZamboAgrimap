<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seed extends Model
{
    use HasFactory;
    protected $table='seeds';
    protected $fillable=[
        'seed_name',
        'seed_type',
        'unit',
        'quantity',
        'unit_price',
        'total_seed_cost',
    ];
   
    public function variablecost()
    {
        return $this->belongsTo(VariableCost::class, 'id','seeds_id');
    }
}
