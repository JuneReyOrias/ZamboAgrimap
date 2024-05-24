<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;
    protected $table='transports';
    protected $fillable=[
        'name_of_vehicle',
        'type_of_vehicle',
        'total_transport_per_deliverycost',
        'users_id',
        'personal_informations_id'
    ]; 

    public function variablecost(){
        return$this->hasMany(VariableCost::class, 'tranports_id');
    }
}
