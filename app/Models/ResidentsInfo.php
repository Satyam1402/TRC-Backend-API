<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidentsInfo extends Model
{
    use HasFactory;

    protected $table = 'resident_infos';  // Correct table name
    protected $fillable = [
        'resident_name',
        'email',
        'phone_number',
        'user_id',
    ];
}
