<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserReward;
use App\Models\User;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'unit_number',
        'street_number',
        'street_name',
        'suburb',
        'state_id',
        'postcode',
        'country_id',
        'contract_start_date',
        'contract_end_date',
    ];

    protected $casts = [
        'contract_start_date' => 'date',
        'contract_end_date' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($property) {
            // Delete the reward related to this property, if exists
            $reward = UserReward::where([
                'user_id' => $property->user_id,
                'action' => 'add_property',
                'related_id' => $property->id,
                'related_type' => self::class,
            ])->first();

            if ($reward) {
                $reward->delete();

                // Option 1: Manual decrement
                $user = $property->user;
                if ($user && $user->stars > 0) {
                    $user->decrement('stars');
                }

                // Option 2: Recalculate all stars (more robust)
                // $user->syncStars();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function rentCollections()
    {
        return $this->hasMany(RentCollection::class, 'property_id');
    }
}
