<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['aid'];
    protected $primaryKey = "aid";
    protected $fillable = ['name','status','user_id'];
    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
}
