<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingLine extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['ship_id'];
    protected $primaryKey = 'ship_id';
    protected $fillable = ['name','status','user_id'];
    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }

    // public function bill_of_lading(){
    //     return $this->hasOne(BillOfLading::class);
    // }
}
