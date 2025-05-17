<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentCollection extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'user_id',
        'amount',
        'due_date',
        'status',
        'receipt_number',
        'inspection_report',
    ];

    protected $casts = [
    'due_date' => 'datetime',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
