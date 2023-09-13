<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forwarder extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['fid'];
    protected $primaryKey = "fid";
    protected $fillable = ['name','status','user_id'];
    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
}
