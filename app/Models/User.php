<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bank(){
        return $this->hasOne(Bank::class,'user_id');
    }

    public function agent(){
        return $this->hasOne(Agent::class);
    }

    public function forwarder(){
        return $this->hasOne(Forwarder::class,'user_id');
    }

    public function shipper(){
        return $this->hasOne(Shipper::class);
    }

    public function shipping_line(){
        return $this->hasOne(ShippingLine::class);
    }

    public function bill_of_lading(){
        return $this->hasOne(BillOfLading::class);
    }
}
