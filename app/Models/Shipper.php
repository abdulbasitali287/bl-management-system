<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipper extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['shipper_id'];
    protected $primaryKey = "shipper_id";
    protected $fillable = ['name','status','user_id','code','description'];

    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }

    // public function bill_of_lading(){
    //     return $this->hasOne(BillOfLading::class);
    // }
}
