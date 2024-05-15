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

    public function variablecosts(){
        return$this->hasMany(VariableCost::class, 'labors_id');
    }
}
