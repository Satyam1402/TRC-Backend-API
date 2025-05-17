<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserReward extends Model
{
    protected $fillable = ['user_id', 'action', 'related_id', 'related_type'];


    /*** Get the model that this reward is related to (Property, Payment, etc.)*/
    public function related()
    {
        return $this->morphTo();
    }
}
