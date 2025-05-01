<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'unit_number',
        'street_number',
        'street_name',
        'suburb',
        'state',
        'postcode',
        'country',
        'contract_start_date',
        'contract_end_date',
    ];

}
