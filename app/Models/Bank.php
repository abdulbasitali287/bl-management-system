<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['bid'];
    protected $primaryKey = "bid";
    // protected $table = "banks";

    protected $fillable = ['name','branch','user_id','status'];

    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
}
