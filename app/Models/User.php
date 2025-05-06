<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'user_role',
        'status',
        'otp',
        'otp_expiry',
        'otp_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'otp',
        'otp_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_expiry' => 'datetime'
    ];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function generateOtp()
    {
        $plainOtp = rand(100000, 999999); // Generate plain OTP
        $this->otp = Hash::make($plainOtp); // Store hashed version
        $this->otp_expiry = now()->addMinutes(30);
        $this->otp_token = Str::random(60);
        $this->save();

        // Log::info("Generated OTP for {$this->email}: {$plainOtp}"); // Log the plain OTP for debugging only not for production
        return $plainOtp; // Return the plain OTP to send via email
    }

    public function validateOtp($otp)
    {
        // Log::info("Validating OTP for user: {$this->email}");
        // Log::info("Entered OTP: {$otp}"); // Log the entered OTP

        // Check if OTP is expired
        $isExpired = now()->gte($this->otp_expiry);
        // Log::info("OTP Expired: " . ($isExpired ? 'Yes' : 'No'));

        // Validate OTP
        $isValid = Hash::check($otp, $this->otp);
        // Log::info("OTP Hash Match: " . ($isValid ? 'True' : 'False'));

        return $isValid && ! $isExpired;
    }




    // Clear OTP
    public function clearOtp()
    {
        // Log before clearing OTP
        // Log::info("Clearing OTP for user: {$this->email}");

        // Manually set the attributes to null
        $this->otp = null;
        $this->otp_expiry = null;
        $this->otp_token = null;

        // Save the changes to the database
        $result = $this->save();

        // Log after saving
        // if ($result) {
        //     Log::info("OTP cleared for user: {$this->email}");
        // } else {
        //     Log::error("Failed to clear OTP for user: {$this->email}");
        // }

        return $result;
    }



}
